<?php

namespace App\Http\Controllers\Api\V1;

use App\QuestionType;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionType as QuestionTypeResource;
use App\Http\Requests\Admin\StoreQuestionTypesRequest;
use App\Http\Requests\Admin\UpdateQuestionTypesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class QuestionTypesController extends Controller
{
    public function index()
    {
	    $data = QuestionType::all();

	    return DataTables::of($data)->make(true);

        //return new QuestionTypeResource(QuestionType::with(['skill', 'module_id', 'created_by', 'updated_by'])->get());
    }

    public function show($id)
    {
        if (Gate::denies('question_type_view')) {
            return abort(401);
        }

        $question_type = QuestionType::with(['skill', 'module_id', 'created_by', 'updated_by'])->findOrFail($id);

        return new QuestionTypeResource($question_type);
    }

    public function store(StoreQuestionTypesRequest $request)
    {
        if (Gate::denies('question_type_create')) {
            return abort(401);
        }

        $question_type = QuestionType::create($request->all());
        $question_type->module_id()->sync($request->input('module_id', []));
        

        return (new QuestionTypeResource($question_type))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateQuestionTypesRequest $request, $id)
    {
        if (Gate::denies('question_type_edit')) {
            return abort(401);
        }

        $question_type = QuestionType::findOrFail($id);
        $question_type->update($request->all());
        $question_type->module_id()->sync($request->input('module_id', []));
        
        

        return (new QuestionTypeResource($question_type))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('question_type_delete')) {
            return abort(401);
        }

        $question_type = QuestionType::findOrFail($id);
        $question_type->delete();

        return response(null, 204);
    }
}
