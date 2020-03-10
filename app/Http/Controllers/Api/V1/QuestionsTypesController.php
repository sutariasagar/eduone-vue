<?php

namespace App\Http\Controllers\Api\V1;

use App\QuestionsType;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionsType as QuestionsTypeResource;
use App\Http\Requests\Admin\StoreQuestionsTypesRequest;
use App\Http\Requests\Admin\UpdateQuestionsTypesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use function sizeof;
use Yajra\DataTables\DataTables;


class QuestionsTypesController extends Controller
{
    public function index(Request $request)
    {
	    if (Gate::denies('questions_type_access') ) {
            return abort(401);
        }

        $query = QuestionsType::with([ 'communication_skill','created_by', 'updated_by'])->select('questions_types.*');

	    if($request->has("list") && $request->input("list", false)) {
            $questions_types = $query->get();
            $response_object = [];

            if(isset($questions_types) && sizeof($questions_types) > 0) {
                foreach ($questions_types as $questions_type) {
                    $response_object[] = new QuestionsTypeResource($questions_type);
                }
            }
            return $response_object;
        }

	    return DataTables::of($query)
            ->addColumn('created_by', function(QuestionsType $questions_type){
                return $questions_type->created_by ? $questions_type->created_by->name : '';
            })
            ->addColumn('updated_by', function(QuestionsType $question_type){
                return $question_type->updated_by ? $question_type->updated_by->name : '';
            })            
            ->addColumn('communication_skill', function(QuestionsType $question_type){
                return $question_type->communication_skill->map(function($communicationskill) {
                    return "<span 'btn btn-sm'>".$communicationskill->title.'</span>';
                })->implode(' ');
            })
            ->make(true);
    }

    public function show($id)
    {
        if (Gate::denies('questions_type_view')) {
            return abort(401);
        }

        $questions_type = QuestionsType::with(['communication_skill','created_by', 'updated_by'])->findOrFail($id);

        return new QuestionsTypeResource($questions_type);
    }

    public function store(StoreQuestionsTypesRequest $request)
    {
        if (Gate::denies('questions_type_create')) {
            return abort(401);
        }

        $questions_type = QuestionsType::create($request->all());
        $questions_type->communication_skill()->sync($request->input('communication_skill', []));        

        return (new QuestionsTypeResource($questions_type))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateQuestionsTypesRequest $request, $id)
    {
        if (Gate::denies('questions_type_edit')) {
            return abort(401);
        }

        $questions_type = QuestionsType::findOrFail($id);
        $questions_type->update($request->all());
        $questions_type->communication_skill()->sync($request->input('communication_skill', []));
        
        

        return (new QuestionsTypeResource($questions_type))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('questions_type_delete')) {
            return abort(401);
        }

        $questions_type = QuestionsType::findOrFail($id);
        $questions_type->delete();

        return response(null, 204);
    }
}
