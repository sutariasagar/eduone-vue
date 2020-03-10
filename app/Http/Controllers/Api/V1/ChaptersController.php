<?php

namespace App\Http\Controllers\Api\V1;

use App\Chapter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Chapter as ChapterResource;
use App\Http\Requests\Admin\StoreChaptersRequest;
use App\Http\Requests\Admin\UpdateChaptersRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class ChaptersController extends Controller
{
    public function index()
    {
        // if (Gate::denies('chapter_access')) {
		//     return abort(401);
	    // }

        $query = Chapter::with(['course','subject','created_by', 'updated_by'])->select('chapters.*');
        
        return DataTables::of($query)
	        ->addColumn('created_by', function(Chapter $chapter){
		        return $chapter->created_by ? $chapter->created_by->name : ''  ;
	        })
	        ->addColumn('updated_by', function(Chapter $chapter){
		        return $chapter->updated_by ? $chapter->updated_by->name : ''  ;
	        })
             ->addColumn('course', function(Chapter $chapter){
		        return $chapter->course ? $chapter->course->title : ''  ;
	        })
	        ->addColumn('subject', function(Chapter $chapter){
		        return $chapter->subject ? $chapter->subject->title : ''  ;
	        })->make(true);
        
    }

    public function show($id)
    {
        if (Gate::denies('chapter_view')) {
            return abort(401);
        }

        $chapter = Chapter::with(['course', 'subject','created_by', 'updated_by'])->findOrFail($id);

        return new ChapterResource($chapter);
    }

    public function store(StoreChaptersRequest $request)
    {
        if (Gate::denies('chapter_create')) {
            return abort(401);
        }

        $chapter = Chapter::create($request->all());
        
        

        return (new ChapterResource($chapter))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateChaptersRequest $request, $id)
    {
        if (Gate::denies('chapter_edit')) {
            return abort(401);
        }

        $chapter = Chapter::findOrFail($id);
        $chapter->update($request->all());


        return (new ChapterResource($chapter))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('chapter_delete')) {
            return abort(401);
        }

        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return response(null, 204);
    }
}
