<?php

namespace App\Http\Controllers\Api\V1;

use App\Student;
use App\Media;
use App\Http\Controllers\Controller;
use App\Http\Resources\Student as StudentResource;
use App\Http\Requests\Admin\StoreStudentsRequest;
use App\Http\Requests\Admin\UpdateStudentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\User;
use App\Terminal;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Package;


                                                   
class StudentsController extends Controller
{
    public function index()
    {
        if (Gate::denies('student_access')) {
		    return abort(401);
	    }

        $query = Student::with(['package'])->select('users.*');

        return DataTables::of($query)
	        ->addColumn('package', function(Student $student){
		        return $student->package ? $student->package->title : ''  ;
            })
            // ->addColumn('created_by', function(Student $student){
		    //     return $student->created_by ? $student->created_by->name : ''  ;
	        // })
	        // ->addColumn('updated_by', function(Student $student){
		    //     return $student->updated_by ? $student->updated_by->name : ''  ;
            // })
            ->make(true);
        
    }

    public function show($id)
    {
        if (Gate::denies('student_view')) {
            return abort(401);
        }

        $student = Student::with(['package','created_by','updated_by'])->findOrFail($id);
        // $student = auth('api')->student();
        return new StudentResource($student);
    }

    public function store(StoreStudentsRequest $request)
    {
        if (Gate::denies('student_create')) {
            return abort(401);
        }
              
        $params = $request->all();    
        $params['password'] = $this->generateRandomString(6);
        $params['testcenter_password'] = $params['password'];                             
        $student = Student::create($params);
        $terminal = Terminal::whereNull('user_id')->first();
        $package = Package::find($params['package_id']);
        $student->tests_with_assessment = $package->tests_with_assessment;
        $student->video_tutorials = $package->video_tutorials;
        $student->practice_questions = $package->practice_questions;
        $student->mock_tests = $package->mock_tests;
        $student->pte_vouchers = $package->pte_vouchers;
        $student->webinar_sessions = $package->webinar_sessions;
        $student->personal_feedback_and_assessment = $package->personal_feedback_and_assessment;
        $student->coaching_session_daily = $package->coaching_session_daily;
        $student->save();

        if($request->has('student_image')){
            $media = Media::find($request->input('student_image'));
            if($media){
                $media->model_type = Student::class;
                $media->model_id = $student->id;
                $media->save();
            }
        }
        if($request->has('capture_image')){
            
            $image = $request->capture_image;  // your base64 encoded
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $student->id.'.'.'jpeg';
            $destination = \File::put(storage_path(). '/app/public/studentimages/' . $imageName, base64_decode($image));
            // $student->capture_image = 'studentimages/'.$student->id.'.jpeg';
            // $student->save();

           // $request->has('capture_image');
            // exit();        
        }
        $student->randompassword = $params['password'];
        if(isset($terminal)){            
            $terminal->user_id = $student->id;
            $terminal->save();

            $student->terminal = $terminal;
            
            return (new StudentResource($student))
                ->response()
                ->setStatusCode(201);
                
        }else{
            $student->terminal = null;
            return (new StudentResource($student))
            ->response()
            ->setStatusCode(201);
        }
        
    }

    public function update(UpdateStudentsRequest $request, $id)
    {
        if (Gate::denies('student_edit')) {
            return abort(401);
        }

        $student = Student::findOrFail($id);
        $student->update($request->all());

        if($request->has('student_image')){
	        $media = Media::find($request->input('student_image'));
	        if($media){
		        $media->model_type = Student::class;
		        $media->model_id = $student->id;
		        $media->save();
	        }
        }

        if($request->has('capture_image')){
            
            $image = $request->capture_image;  // your base64 encoded
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $student->id.'.'.'jpeg';
            $destination = \File::put(storage_path(). '/app/public/studentimages/' . $imageName, base64_decode($image)); 
        }

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('student_delete')) {
            return abort(401);
        }

        $student = Student::findOrFail($id);
        $student->delete();

        return response(null, 204);
    }

    public function getCredentials($id){        
        $student = Student::findOrFail($id);
        $terminal = Terminal::whereNull('user_id')->first();        
        if(isset($terminal)){
            
            $password = $this->generateRandomString(6);
            $student->testcenter_password = $password;
            $terminal->user_id = $student->id;
            $terminal->save();        
            $student->save();        
            $student->randompassword = $password;
            $student->terminal = $terminal;
            return new StudentResource($student);    
        }else{
            $student->terminal = null;
            $password = $this->generateRandomString(6);
            $student->testcenter_password = $password;                        
            $student->save();        
            $student->randompassword = $password;
            return new StudentResource($student);
        }        
        
        
    }

    public function resetPassword(Request $request){                
        $student = Student::findOrFail($request->id);
        $student->password = $request->newpassword;
        $student->save();
       //$student = Student::findOrFail($id);
    }
    
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
     

}
