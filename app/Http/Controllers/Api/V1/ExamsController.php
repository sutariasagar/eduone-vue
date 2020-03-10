<?php

namespace App\Http\Controllers\Api\V1;

use App\Exam;
use App\ExamSection;
use App\Http\Controllers\Controller;
use App\Http\Resources\Exam as ExamResource;
use App\Http\Requests\Admin\StoreExamsRequest;
use App\Http\Requests\Admin\UpdateExamsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class ExamsController extends Controller
{
    public function index()
    {
        if (Gate::denies('exam_access') ) {
            return abort(401);
        }

        $query = Exam::with([ 'created_by', 'updated_by'])->select('exams.*');

	    return DataTables::of($query)
            ->addColumn('created_by', function(Exam $exam){
                return $exam->created_by ? $exam->created_by->name : '';
            })
            ->addColumn('updated_by', function(Exam $exam){
                return $exam->updated_by ? $exam->updated_by->name : '';
            })
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('exam_view')) {
            return abort(401);
        }

        $exam = Exam::with(['created_by',
	        'updated_by',
	        'course',
	        'readingsection',
	        'writingsection',
	        'speakingsection',
	        'listeningsstsection',
	        'questionSet',
	        'listeningrolsection'])->findOrFail($id);

        return new ExamResource($exam);
    }

    public function store(StoreExamsRequest $request)
    {
        if (Gate::denies('exam_create')) {
            return abort(401);
        }

        $requestParams = $request->all();
        if($requestParams['question_set_id'] && $requestParams['question_set_id'] == "null"){
            $requestParams['question_set_id'] = null;
        }
        $exam = Exam::create($requestParams);
        
        
	    if($exam){
		    //$exam = Exam::with(['created_by', 'updated_by','course'])->findOrFail($exam->id);
		    $data = array('type'=>'speaking','exam_id'=>$exam->id);
		    $speaking = ExamSection::create($data);
		    $data = array('type'=>'writing','exam_id'=>$exam->id);
		    $writing = ExamSection::create($data);
		    $data = array('type'=>'reading','exam_id'=>$exam->id);
		    $reading = ExamSection::create($data);
		    $data = array('type'=>'listening_sst','exam_id'=>$exam->id);
		    $listening_sst = ExamSection::create($data);
		    $data = array('type'=>'listening_rol','exam_id'=>$exam->id);
		    $listening_rst = ExamSection::create($data);

		    $exam = Exam::with(['created_by',
			    'updated_by',
			    'course',
			    'readingsection',
			    'writingsection',
			    'speakingsection',
			    'listeningsstsection',
			    'listeningrolsection'])->findOrFail($exam->id);

	    }
        return (new ExamResource($exam))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateExamsRequest $request, $id)
    {
        if (Gate::denies('exam_edit')) {
            return abort(401);
        }

        $exam = Exam::findOrFail($id);
        $requestParams = $request->all();
        if($requestParams['question_set_id'] && $requestParams['question_set_id'] == "null"){
            $requestParams['question_set_id'] = null;
        }
        //$exam = Exam::create($requestParams);
        $exam->update($requestParams);
        
        
        

        return (new ExamResource($exam))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('exam_delete')) {
            return abort(401);
        }

        $exam = Exam::findOrFail($id);
        $exam->delete();

        return response(null, 204);
    }
}
