<?php

namespace App\Http\Controllers\Api\V1;

use App\AnswersType;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnswersType as AnswersTypeResource;
use App\Http\Requests\Admin\StoreAnswersTypesRequest;
use App\Http\Requests\Admin\UpdateAnswersTypesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;


class AnswersTypesController extends Controller
{
    public function index(Request $request)
    {
	    if (Gate::denies('answers_type_access') ) {
            return abort(401);
        }

        $query = AnswersType::with([ 'created_by', 'updated_by'])->select('answers_types.*');

        if($request->has("list") && $request->input("list", false)) {
            $answers_types = $query->get();
            $response_object = [];

            if(isset($answers_types) && sizeof($answers_types) > 0) {
                foreach ($answers_types as $answers_type) {
                    $response_object[] = new answersTypeResource($answers_type);
                }
            }
            return $response_object;
        }

        return DataTables::of($query)
            ->addColumn('created_by', function(AnswersType $answersType){
                return $answersType->created_by ? $answersType->created_by->name : '';
            })
            ->addColumn('updated_by', function(AnswersType $answersType){
                return $answersType->updated_by ? $answersType->updated_by->name : '';
            })
            ->make(true);
    }

    public function show($id)
    {
        if (Gate::denies('answers_type_view')) {
            return abort(401);
        }

        $answers_type = AnswersType::with(['created_by', 'updated_by'])->findOrFail($id);

        return new AnswersTypeResource($answers_type);
    }

    public function store(StoreAnswersTypesRequest $request)
    {
        if (Gate::denies('answers_type_create')) {
            return abort(401);
        }

        $answers_type = AnswersType::create($request->all());
        
        

        return (new AnswersTypeResource($answers_type))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateAnswersTypesRequest $request, $id)
    {
        if (Gate::denies('answers_type_edit')) {
            return abort(401);
        }

        $answers_type = AnswersType::findOrFail($id);
        $answers_type->update($request->all());
        
        
        

        return (new AnswersTypeResource($answers_type))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('answers_type_delete')) {
            return abort(401);
        }

        $answers_type = AnswersType::findOrFail($id);
        $answers_type->delete();

        return response(null, 204);
    }
}
