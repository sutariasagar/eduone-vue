<?php

namespace App\Http\Controllers\Api\V1;

use App\Topic;
use App\Http\Controllers\Controller;
use App\Http\Resources\Topic as TopicResource;
use App\Http\Requests\Admin\StoreTopicsRequest;
use App\Http\Requests\Admin\UpdateTopicsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class TopicsController extends Controller
{
    public function index()
    {
        if (Gate::denies('topic_access')) {
		    return abort(401);
	    }

        $query = Topic::with(['course','subject','chapter','parent','created_by','updated_by'])->select('topics.*');

        return DataTables::of($query)
            ->addColumn('course', function(Topic $topic){
                return $topic->course ? $topic->course->title : '';
            })
            ->addColumn('subject', function(Topic $topic){
                return $topic->subject ? $topic->subject->title : '';
            })
            ->addColumn('chapter', function(Topic $topic){
                return $topic->chapter ? $topic->chapter->title : '';
            })
            ->addColumn('parent', function(Topic $topic){
                return $topic->parent ? $topic->parent->title : '';
            })
	        ->addColumn('created_by', function(Topic $model){
		        return $model->created_by ? $model->created_by->name : ''  ;
	        })
	        ->addColumn('updated_by', function(Topic $model){
		        return $model->updated_by ? $model->updated_by->name : ''  ;
	        })
            ->make(true);
    }

    public function show($id)
    {
        if (Gate::denies('topic_view')) {
            return abort(401);
        }

        $topic = Topic::with(['course', 'subject', 'chapter', 'subtopic','parent','created_by', 'updated_by'])->findOrFail($id);

        return new TopicResource($topic);
    }

    public function store(StoreTopicsRequest $request)
    {
        if (Gate::denies('topic_create')) {
            return abort(401);
        }

        $topic = Topic::create($request->all());
        
        

        return (new TopicResource($topic))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateTopicsRequest $request, $id)
    {
        if (Gate::denies('topic_edit')) {
            return abort(401);
        }

        $topic = Topic::findOrFail($id);
        $topic->update($request->all());
        
        
        

        return (new TopicResource($topic))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('topic_delete')) {
            return abort(401);
        }

        $topic = Topic::findOrFail($id);
        $topic->delete();

        return response(null, 204);
    }
}
