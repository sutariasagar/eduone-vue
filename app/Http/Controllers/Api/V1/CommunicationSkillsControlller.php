<?php

namespace App\Http\Controllers\Api\V1;

use App\CommunicationSkill;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommunicationSkill as CommunicationSkillResource;
use App\Http\Requests\Admin\StoreCommunicationSkillsRequest;
use App\Http\Requests\Admin\UpdateCommunicationSkillsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class CommunicationSkillsController extends Controller
{
    public function index()
    {
	    if (Gate::denies('communication_skill_access')) {
		    return abort(401);
        }

        $query = CommunicationSkill::with(['created_by','updated_by'])->select('communication_skills.*')->orderBy('updated_at','desc');
        
        return DataTables::of($query)
            ->addColumn('created_by', function(CommunicationSkill $communication_skill){
                return $communication_skill->created_by ? $communication_skill->created_by->name : ''  ;
            })
            ->addColumn('updated_by', function(CommunicationSkill $communication_skill){
                return $communication_skill->updated_by ? $communication_skill->updated_by->name : ''  ;
            })
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('communication_skill_view')) {
            return abort(401);
        }

        $communication_skill = CommunicationSkill::with(['created_by', 'updated_by'])->findOrFail($id);

        return new CommunicationSkillResource($communication_skill);
    }

    public function store(StoreCommunicationSkillsRequest $request)
    {
        if (Gate::denies('communication_skill_create')) {
            return abort(401);
        }

        $communication_skill = CommunicationSkill::create($request->all());
        
        

        return (new CommunicationSkillResource($communication_skill))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCommunicationSkillsRequest $request, $id)
    {
        if (Gate::denies('communication_skill_edit')) {
            return abort(401);
        }

        $communication_skill = CommunicationSkill::findOrFail($id);
        $communication_skill->update($request->all());
        
        
        

        return (new CommunicationSkillResource($communication_skill))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('communication_skill_delete')) {
            return abort(401);
        }

        $communication_skill = CommunicationSkill::findOrFail($id);
        $communication_skill->delete();

        return response(null, 204);
    }
}
