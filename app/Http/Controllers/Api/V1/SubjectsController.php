<?php

namespace App\Http\Controllers\Api\V1;

use App\Subject;
use App\Http\Controllers\Controller;
use App\Http\Resources\Subject as SubjectResource;
use App\Http\Requests\Admin\StoreSubjectsRequest;
use App\Http\Requests\Admin\UpdateSubjectsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class SubjectsController extends Controller
{
    public function index()
    {
        // if (Gate::denies('subject_access')) {
		//     return abort(401);
        // }
        
        $query = Subject::with('course','created_by','updated_by')->select('subjects.*');

        return DataTables::of($query)
            ->addColumn('course', function(Subject $subject){
		        return $subject->course ? $subject->course->title : '';
            })
	        ->addColumn('created_by', function(Subject $model){
		        return $model->created_by ? $model->created_by->name : ''  ;
	        })
	        ->addColumn('updated_by', function(Subject $model){
		        return $model->updated_by ? $model->updated_by->name : ''  ;
	        })
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('subject_view')) {
            return abort(401);
        }

        $subject = Subject::with(['course','created_by', 'updated_by'])->findOrFail($id);

        return new SubjectResource($subject);
    }

    public function store(StoreSubjectsRequest $request)
    {
        if (Gate::denies('subject_create')) {
            return abort(401);
        }

        $subject = Subject::create($request->all());
        
        

        return (new SubjectResource($subject))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateSubjectsRequest $request, $id)
    {
        if (Gate::denies('subject_edit')) {
            return abort(401);
        }

        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        
        
        

        return (new SubjectResource($subject))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('subject_delete')) {
            return abort(401);
        }

        $subject = Subject::findOrFail($id);
        $subject->delete();

        return response(null, 204);
    }
}
