<?php

namespace App\Http\Controllers\Api\V1;

use App\Media;
use App\LearningMaterialDocument;
use App\Http\Controllers\Controller;
use App\Http\Resources\LearningMaterialDocument as LearningMaterialDocumentResource;
use App\Http\Requests\Admin\StoreLearningMaterialDocumentsRequest;
use App\Http\Requests\Admin\UpdateLearningMaterialDocumentsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use function json_decode;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;


class LearningMaterialDocumentsController extends Controller
{
    public function index()
    {
        if (Gate::denies('learning_material_document_access')) {
		    return abort(401);
        }

        $query = LearningMaterialDocument::with(['created_by','updated_by'])->select('learning_material_documents.*');
        
	    return DataTables::of($query)
            ->addColumn('created_by', function(LearningMaterialDocument $learning_material_document){
                return $learning_material_document->created_by ? $learning_material_document->created_by->name : ''  ;
            })
            ->addColumn('updated_by', function(LearningMaterialDocument $learning_material_document){
                return $learning_material_document->updated_by ? $learning_material_document->updated_by->name : ''  ;
            })
            ->addColumn('learning_material', function(LearningMaterialDocument $learning_material_document){
                return $learning_material_document->learning_material ? $learning_material_document->learning_material->name : ''  ;
            })
            ->make(true);
    }

    public function show($id)
    {
        if (Gate::denies('learning_material_document_view')) {
            return abort(401);
        }

        $learning_material_document = LearningMaterialDocument::with(['created_by', 'updated_by','learning_material'])->findOrFail($id);

        return new LearningMaterialDocumentResource($learning_material_document);
    }

    public function store(StoreLearningMaterialDocumentsRequest $request)
    {
        if (Gate::denies('learning_material_document_create')) {
            return abort(401);
        }

        $learning_material_document = LearningMaterialDocument::create($request->all());
        
        if($request->has('upload_file')){
		    $documents = json_decode($request->input('upload_file'));
		    for($i=0; $i < sizeof($documents); $i++){
		    	//print_r($documents[$i]);exit;
		    	$media = Media::find($documents[$i][0]->id);
		    	if($media){
				    $media->model_type = LearningMaterialDocument::class;
				    $media->model_id = $learning_material_document->id;
				    $media->save();
			    }
		    }
	    }

        return (new LearningMaterialDocumentResource($learning_material_document))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateLearningMaterialDocumentsRequest $request, $id)
    {
        if (Gate::denies('learning_material_document_edit')) {
            return abort(401);
        }

        $learning_material_document = LearningMaterialDocument::findOrFail($id);
        $learning_material_document->update($request->all());
        
        if($request->has('upload_file')){
            $documents = json_decode($request->input('upload_file'));
            Media::where('model_type','=',LearningMaterialDocument::class)->where('model_id','=',$learning_material_document->id)->delete();
            //print_r($documents);exit;
            for($i=0; $i < sizeof($documents); $i++){
                //print_r($documents[$i]);exit;
                //print_r($documents[$i]->id);exit;
                if($documents[$i]){         
                    //$media = Media::find($documents[$i]->id);

                    if(isset($documents[$i]->id) ){
						$media = Media::find($documents[$i]->id);
					}else{
						$media = Media::find($documents[$i][0]->id);
                    }
                    
                    if($media){
                        $media->model_type = LearningMaterialDocument::class;
                        $media->model_id = $learning_material_document->id;
                        $media->save();
                    }
                }
		    }
	    }
        return (new LearningMaterialDocumentResource($learning_material_document))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('learning_material_document_delete')) {
            return abort(401);
        }

        $learning_material_document = LearningMaterialDocument::findOrFail($id);
        $learning_material_document->delete();

        return response(null, 204);
    }
}
