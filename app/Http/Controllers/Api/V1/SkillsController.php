<?php

namespace App\Http\Controllers\Api\V1;

use App\Skill;
use App\Http\Controllers\Controller;
use App\Http\Resources\Skill as SkillResource;
use App\Http\Requests\Admin\StoreSkillsRequest;
use App\Http\Requests\Admin\UpdateSkillsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class SkillsController extends Controller
{
    public function index()
    {
        if (Gate::denies('skill_access')) {
		    return abort(401);
        }

        $query = Skill::with(['created_by','updated_by','enabling_skill'])->select('skills.*');
        
	    return DataTables::of($query)
            ->addColumn('created_by', function(Skill $skill){
                return $skill->created_by ? $skill->created_by->name : ''  ;
            })
            ->addColumn('updated_by', function(Skill $skill){
                return $skill->updated_by ? $skill->updated_by->name : ''  ;
            })
            ->make(true);
    }

    public function show($id)
    {
        if (Gate::denies('skill_view')) {
            return abort(401);
        }

        $skill = Skill::with(['created_by', 'updated_by','enabling_skill'])->findOrFail($id);

        return new SkillResource($skill);
    }

    public function store(StoreSkillsRequest $request)
    {
        if (Gate::denies('skill_create')) {
            return abort(401);
        }

        $skill = Skill::create($request->all());
        


        return (new SkillResource($skill))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateSkillsRequest $request, $id)
    {
        if (Gate::denies('skill_edit')) {
            return abort(401);
        }

        $skill = Skill::findOrFail($id);
        $skill->update($request->all());
        
        
        

        return (new SkillResource($skill))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('skill_delete')) {
            return abort(401);
        }

        $skill = Skill::findOrFail($id);
        $skill->delete();

        return response(null, 204);
    }
}
