<?php
/**
 * Copyright (c) 2019.
 */

/**
 * Created by PhpStorm.
 * User: keyurshah
 * Date: 16/04/19
 * Time: 7:51 PM
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionSetsRequest;
use App\Http\Requests\Admin\UpdateQuestionSetsRequest;
use App\QuestionSet;
use function explode;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\QuestionSet as QuestionSetResource;
use function json_decode;
use Yajra\DataTables\DataTables;

class QuestionSetsController extends Controller {
	public function index()
	{
		if (Gate::denies('question_set_access')) {
			return abort(401);
		}
		$query = QuestionSet::with(['created_by','updated_by'])->select('question_sets.*');


		return DataTables::of($query)
		                 ->addColumn('created_by', function(QuestionSet $item){
			                 return $item->created_by ? $item->created_by->name : ''  ;
		                 })
		                 ->addColumn('updated_by', function(QuestionSet $item){
			                 return $item->updated_by ? $item->updated_by->name : ''  ;
		                 })
		                 ->make(true);
	}

	public function show($id)
	{
		if (Gate::denies('question_set_view')) {
			return abort(401);
		}

		$question_set = QuestionSet::with(['created_by', 'updated_by','questions'])->findOrFail($id);

		return new QuestionSetResource($question_set);
	}

	public function store(StoreQuestionSetsRequest $request)
	{
		if (Gate::denies('question_set_create')) {
			return abort(401);
		}

		$questionSet = QuestionSet::create($request->all());

		if($request->has('selectedQuestions')){
			$ids = explode(',', $request->input('selectedQuestions'));
			$sQuestions = json_decode($request->input('selectedQuestions'));
			foreach ($sQuestions as $sections=>$ids){
				for($i=0; $i < sizeof($ids); $i++){
					$questionSet->questions()->attach([$ids[$i] => ['section'=>$sections]]);
				}
			}

		}


		return (new QuestionSetResource($questionSet))
			->response()
			->setStatusCode(201);
	}

	public function update(UpdateQuestionSetsRequest $request, $id)
	{
		if (Gate::denies('question_set_delete')) {
			return abort(401);
		}

		$questionSet = QuestionSet::findOrFail($id);
		$questionSet->update($request->all());
		if($request->has('selectedQuestions')){
			$questionSet->questions()->detach();
			$ids = explode(',', $request->input('selectedQuestions'));
			$sQuestions = json_decode($request->input('selectedQuestions'));
			foreach ($sQuestions as $sections=>$ids){
				for($i=0; $i < sizeof($ids); $i++){
					if(!$questionSet->questions->contains($ids[$i]))
						$questionSet->questions()->attach([$ids[$i] => ['section'=>$sections]]);
				}
			}
		}

		return (new QuestionSetResource($questionSet))
			->response()
			->setStatusCode(202);
	}

	public function destroy($id)
	{
		if (Gate::denies('question_set_delete')) {
			return abort(401);
		}

		$questionSet = QuestionSet::findOrFail($id);
		$questionSet->delete();

		return response(null, 204);
	}
}