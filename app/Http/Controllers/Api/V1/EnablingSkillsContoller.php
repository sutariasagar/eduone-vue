<?php

namespace App\Http\Controllers\Api\V1;

use App\EnablingSkill;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnablingSkill as EnablingSkillResource;
use App\Http\Requests\Admin\StoreEnablingSkillsRequest;
use App\Http\Requests\Admin\UpdateEnablingSkillsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class EnablingSkillsController extends Controller
{
	public function index()
	{
		if (Gate::denies('enabling_skill_access')) {
			return abort(401);
		}

		$query = EnablingSkill::with(['skill','created_by','updated_by'])->select('enabling_skills.*');

		return DataTables::of($query)
			->addColumn('created_by', function(EnablingSkill $enabling_skill){
				return $enabling_skill->created_by ? $enabling_skill->created_by->name : '' ;
			})
			->addColumn('skill', function(EnablingSkill $enabling_skill){
                    return $enabling_skill->skill->map(function($skill) {
                        return "<span 'btn btn-sm'>".$skill->title.'</span>';
                    })->implode(' ');
                })
			->addColumn('updated_by', function(EnablingSkill $enabling_skill){
				return $enabling_skill->updated_by ? $enabling_skill->updated_by->name : '' ;
			})
			->make(true);

	}

	public function show($id)
	{
		if (Gate::denies('enabling_skill_view')) {
			return abort(401);
		}

		$enabling_skill = EnablingSkill::with(['skill','created_by', 'updated_by'])->findOrFail($id);

		return new EnablingSkillResource($enabling_skill);
	}

	public function store(StoreEnablingSkillsRequest $request)
	{
		if (Gate::denies('enabling_skill_create')) {
			return abort(401);
		}

		$enabling_skill = EnablingSkill::create($request->all());
        $enabling_skill->skill()->sync($request->input('skill', []));

		return (new EnablingSkillResource($enabling_skill))
			->response()
			->setStatusCode(201);
	}

	public function update(UpdateEnablingSkillsRequest $request, $id)
	{
		if (Gate::denies('enabling_skill_edit')) {
			return abort(401);
		}

		$enabling_skill = EnablingSkill::findOrFail($id);
		$enabling_skill->update($request->all());
		$enabling_skill->skill()->sync($request->input('skill', []));


		return (new EnablingSkillResource($enabling_skill))
			->response()
			->setStatusCode(202);
	}

	public function destroy($id)
	{
		if (Gate::denies('enabling_skill_delete')) {
			return abort(401);
		}

		$enabling_skill = EnablingSkill::findOrFail($id);
		$enabling_skill->delete();

		return response(null, 204);
	
	}
}