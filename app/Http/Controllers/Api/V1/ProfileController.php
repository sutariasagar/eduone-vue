<?php

namespace App\Http\Controllers\Api\V1;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Resources\Profile as ProfileResource;
use App\Http\Controllers\Controller;
use Hash;
use App\Http\Controllers\Traits\FileUploadTrait;
use Validator;
use App\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Change password.
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = auth('api')->user(); 
        $user->update($request->all());

        if($request->has('profile_image')){
	        $media = Media::find($request->input('profile_image'));
	        if($media){
		        $media->model_type = User::class;
		        $media->model_id = $user->id;
		        $media->save();
	        }
        }


        return (new ProfileResource($user))
            ->response()
            ->setStatusCode(202);
           
    }

    public function show(Request $request)
    {
        $user = auth('api')->user();
        //$data = $user;
        $user->testCenterExams;
        $user->practiceExams;
        $user->exams;
        $user->package;        
        $user->examsWithResults;
        $user->package;
        return new ProfileResource($user);   
           
    }   
}
