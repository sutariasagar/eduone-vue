<?php

namespace App\Http\Controllers\Api\V1;

use App\LearningMaterial;
use App\Http\Controllers\Controller;
use App\Http\Resources\LearningMaterial as LearningMaterialResource;
use App\Http\Requests\Admin\StoreLearningMaterialsRequest;
use App\Http\Requests\Admin\UpdateLearningMaterialsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class LearningMaterialsController extends Controller
{
    public function index()
    {
	    if (Gate::denies('learning_material_access')) {
		    return abort(401);
        }

        $query = LearningMaterial::with(['course','subject','chapter','topic','subtopic','created_by','updated_by'])->select('learning_materials.*');
        
        return DataTables::of($query)
            ->addColumn('course', function(LearningMaterial $learning_material){
                return $learning_material->course ? $learning_material->course->title : '';
            })
            ->addColumn('subject', function(LearningMaterial $learning_material){
                return $learning_material->subject ? $learning_material->subject->title : '';
            })
            ->addColumn('chapter', function(LearningMaterial $learning_material){
                return $learning_material->chapter ? $learning_material->chapter->title : '';
            })
            ->addColumn('topic', function(LearningMaterial $learning_material){
                return $learning_material->topic ? $learning_material->topic->title : '';
            })
            ->addColumn('subtopic', function(LearningMaterial $learning_material){
                return $learning_material->subtopic ? $learning_material->subtopic->title : '';
            })
            ->addColumn('created_by', function(LearningMaterial $learning_material){
                return $learning_material->created_by ? $learning_material->created_by->name : ''  ;
            })
            ->addColumn('updated_by', function(LearningMaterial $learning_material){
                return $learning_material->updated_by ? $learning_material->updated_by->name : ''  ;
            })
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('learning_material_view')) {
            return abort(401);
        }

        $learning_material = LearningMaterial::with(['course', 'subject', 'chapter','topic','subtopic','created_by', 'updated_by'])->findOrFail($id);

        return new LearningMaterialResource($learning_material);
    }

    public function store(StoreLearningMaterialsRequest $request)
    {
        if (Gate::denies('learning_material_create')) {
            return abort(401);
        }

        $learning_material = LearningMaterial::create($request->all());
        
        

        return (new LearningMaterialResource($learning_material))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateLearningMaterialsRequest $request, $id)
    {
        if (Gate::denies('learning_material_edit')) {
            return abort(401);
        }

        $learning_material = LearningMaterial::findOrFail($id);
        $learning_material->update($request->all());
        
        
        

        return (new LearningMaterialResource($learning_material))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('learning_material_delete')) {
            return abort(401);
        }

        $learning_material = LearningMaterial::findOrFail($id);
        $learning_material->delete();

        return response(null, 204);
    }
}
