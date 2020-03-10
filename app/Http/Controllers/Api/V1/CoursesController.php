<?php

namespace App\Http\Controllers\Api\V1;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\Course as CourseResource;
use App\Http\Requests\Admin\StoreCoursesRequest;
use App\Http\Requests\Admin\UpdateCoursesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class CoursesController extends Controller
{
    public function index()
    {

	    if (Gate::denies('course_access')) {
		    return abort(401);
	    }

	    $query = Course::with('industry','created_by','updated_by')->select('courses.*');

        return DataTables::of($query)
	        ->addColumn('created_by', function(Course $model){
		        return $model->created_by ? $model->created_by->name : ''  ;
	        })
	        ->addColumn('updated_by', function(Course $model){
		        return $model->updated_by ? $model->updated_by->name : ''  ;
	        })
            ->addColumn('industry', function(Course $course){
		        return $course->industry ? $course->industry->title : '';
            })
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('course_view')) {
            return abort(401);
        }

        $course = Course::with(['industry','created_by', 'updated_by'])->findOrFail($id);

        return new CourseResource($course);
    }

    public function store(StoreCoursesRequest $request)
    {
        if (Gate::denies('course_create')) {
            return abort(401);
        }

        $course = Course::create($request->all());
        
        

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCoursesRequest $request, $id)
    {
        if (Gate::denies('course_edit')) {
            return abort(401);
        }

        $course = Course::findOrFail($id);
        $course->update($request->all());
        
        
        

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('course_delete')) {
            return abort(401);
        }

        $course = Course::findOrFail($id);
        $course->delete();

        return response(null, 204);
    }
}
