<?php

namespace App\Http\Controllers\Api\V1;

use App\Media;
use App\QuestionsBank;
use App\QuestionSet;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionsBank as QuestionsBankResource;
use App\Http\Requests\Admin\StoreQuestionsBanksRequest;
use App\Http\Requests\Admin\UpdateQuestionsBanksRequest;
use function gettype;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Gate;
use function json_decode;
use Yajra\DataTables\DataTables;


class QuestionsBanksController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('questions_bank_access') ) {
            return abort(401);
        }

		$query = QuestionsBank::with(['course','subject','chapter','topic','subtopic','question_type','answer_type', 'created_by', 'updated_by'])
		->select('questions_banks.*')
		->leftJoin('questions_types', 'questions_types.id','=','questions_banks.question_type_id');

        if($request->has('selected') && $request->has('parent_id')){
            $selected = $request->input('selected');
            $parentId = $request->input('parent_id');
            if($selected == 'selected'){
				$questionSet = QuestionSet::find($request->input('parent_id'));
				if($questionSet)
					$query = $questionSet->questions()->with(['course','subject','chapter','topic','subtopic','question_type','answer_type', 'created_by', 'updated_by'])
					->select('questions_banks.*')
					->leftJoin('questions_types', 'questions_types.id','=','questions_banks.question_type_id')
					->where('section_type','=',$request->input('section_type'));

            }
            if($selected == 'notselected'){
				$query = QuestionsBank::doesntHave('questionset')->with(['course','subject','chapter','topic','subtopic','question_type','answer_type', 'created_by', 'updated_by'])
				->select('questions_banks.*')
				->leftJoin('questions_types', 'questions_types.id','=','questions_banks.question_type_id')
				->where('section_type','=',$request->input('section_type'));
            } 
            
        }
        if($request->has('section_type')){
        	$query->where('section_type','=',$request->input('section_type'));
        }
        
        return DataTables::of($query)
			->addColumn('id', function(QuestionsBank $questions_bank){
				return $questions_bank->id;
			})
			->addColumn('course', function(QuestionsBank $questions_bank){
                return $questions_bank->course ? $questions_bank->course->title : '';
            })
	        ->addColumn('count', function(QuestionsBank $questions_bank){
		        return $questions_bank->questionset ? $questions_bank->questionset->count() : 0;
	        })
            ->addColumn('subject', function(QuestionsBank $questions_bank){
                return $questions_bank->subject ? $questions_bank->subject->title : '';
            })
            ->addColumn('chapter', function(QuestionsBank $questions_bank){
                return $questions_bank->chapter ? $questions_bank->chapter->title : '';
            })
            ->addColumn('topic', function(QuestionsBank $questions_bank){
                return $questions_bank->topic ? $questions_bank->topic->title : '';
            })
            ->addColumn('subtopic', function(QuestionsBank $questions_bank){
                return $questions_bank->subtopic ? $questions_bank->subtopic->title : '';
            })
            ->addColumn('question_type', function(QuestionsBank $questions_bank){
                return $questions_bank->question_type ? $questions_bank->question_type->title : '';
            })
            ->addColumn('answer_type', function(QuestionsBank $questions_bank){
                return $questions_bank->answer_type ? $questions_bank->answer_type->title : '';
            })
            ->addColumn('created_by', function(QuestionsBank $questions_bank){
                return $questions_bank->created_by ? $questions_bank->created_by->name : '';
            })
            ->addColumn('updated_by', function(QuestionsBank $questions_bank){
                return $questions_bank->updated_by ? $questions_bank->updated_by->name : '';
			})
			->filterColumn('question_type', function($query, $keyword) {
				$sql = "questions_types.title like ?";
				$query->whereRaw($sql, ["%{$keyword}%"]);
			})
			->filterColumn('count', function($query, $keyword) {
				$query->has('questionset', '=', $keyword);
			})
            ->make(true);

    }

    public function show($id)
    {
        if (Gate::denies('questions_bank_view')) {
           // return abort(401);
        }

        $questions_bank = QuestionsBank::with(['course','subject','chapter','topic','subtopic','question_type','answer_type', 'created_by', 'updated_by','learningMaterialDocuments','learningMaterial','tagged'])->findOrFail($id);

        return new QuestionsBankResource($questions_bank);
    }

    public function store(StoreQuestionsBanksRequest $request)
    {

        if (Gate::denies('questions_bank_create')) {
            return abort(401);
        }

        $questions_bank = QuestionsBank::create($request->all());

	    if($request->has('learning_material_documents')){
		    $documents = json_decode($request->input('learning_material_documents'));
		    for($i=0; $i < sizeof($documents); $i++){
			    $questions_bank->learningMaterialDocuments()->attach($documents[$i]->id);
		    }
	    }
	    if($request->has('solution_documents')){
		    $documents = json_decode($request->input('solution_documents'));
		    for($i=0; $i < sizeof($documents); $i++){
		    	//print_r($documents[$i]);exit;
		    	$media = Media::find($documents[$i][0]->id);
		    	if($media){
				    $media->model_type = QuestionsBank::class;
				    $media->model_id = $questions_bank->id;
				    $media->save();
			    }
		    }
	    }

	    if($request->has('tags')){
		    $tags = json_decode($request->input('tags'));
		    foreach ($tags as $tag){
			    //if(gettype($tag) != "object")
			        $questions_bank->tag($tag->tag_name);
		    }

	    }
	    if($request->has('question_skills')){
		    $questionSkills = json_decode($request->input('question_skills'));
		    $questions_bank->questionSkillsMapping()->detach();
		    foreach ($questionSkills as $qSkill){
			    //if(gettype($tag) != "object")
			    if($qSkill->count_in_overall_score || $qSkill->count_in_overall_score == 'true'){
				    $count_in_overall_score = "true";
			    }else{
				    $count_in_overall_score = "false";
			    }
			    if($qSkill->count_in_skill_score || $qSkill->count_in_skill_score == 'true'){
				    $count_in_skill_score = "true";
			    }else{
				    $count_in_skill_score = "false";
			    }
			    if($qSkill->have_negative_marks || $qSkill->have_negative_marks == 'true'){
				    $have_negative_marks = "true";
			    }else{
				    $have_negative_marks = "false";
			    }
			    $questions_bank->questionSkillsMapping()
			                   ->attach([$qSkill->skill_id => ['max_score'=>$qSkill->max_score,
			                                                   'have_negative_marks'=>$have_negative_marks,
			                                                   'count_in_overall_score'=>$count_in_overall_score,
			                                                   'count_in_skill_score'=>$count_in_skill_score]]);
		    }

	    }
        

        return (new QuestionsBankResource($questions_bank))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateQuestionsBanksRequest $request, $id)
    {
        if (Gate::denies('questions_bank_edit')) {
            return abort(401);
        }

        $questions_bank = QuestionsBank::findOrFail($id);
        $questions_bank->update($request->all());

	    //print_r($request->input('learning_material_documents'));exit;
	    //$questions_bank = QuestionsBank::create($request->all());

//        if($request->has('file_id')){
//	        $media = Media::find($request->input('file_id'));
//	        if($media){
//		        $media->model_type = User::class;
//		        $media->model_id = $user->id;
//		        $media->save();
//	        }
//        }

	    if($request->has('learning_material_documents')){
	    	$documents = json_decode($request->input('learning_material_documents'));
		    $questions_bank->learningMaterialDocuments()->detach();
	    	for($i=0; $i < sizeof($documents); $i++){
			    $questions_bank->learningMaterialDocuments()->attach($documents[$i]->id);
		    }
	    }

	    if($request->has('tags')){
			$tags = json_decode($request->input('tags'));
			$questions_bank->untag();
		    foreach ($tags as $tag){
		    	//if(gettype($tag) != "object")
			    $questions_bank->tag($tag->tag_name);
		    }
	    }
	    if($request->has('solution_documents')){
		    $documents = json_decode($request->input('solution_documents'));
			//print_r($documents);exit;
			Media::where('model_type','=',QuestionsBank::class)->where('model_id','=',$questions_bank->id)->delete();
			//$questions_bank->clearMediaCollection();
            for($i=0; $i < sizeof($documents); $i++){
                //print_r($documents[$i]);exit;
                //print_r($documents[$i]->id);exit;
                if($documents[$i]){
					
					if(isset($documents[$i]->id) ){
						$media = Media::find($documents[$i]->id);
					}else{
						$media = Media::find($documents[$i][0]->id);
					}
                    
                    if($media){
                        $media->model_type = QuestionsBank::class;
                        $media->model_id = $questions_bank->id;
                        $media->save();
                    }
                }
		    }
	    }

	    if($request->has('question_skills')){
		    $questionSkills = json_decode($request->input('question_skills'));
		    $questions_bank->questionSkillsMapping()->detach();
		    foreach ($questionSkills as $qSkill){
			    //if(gettype($tag) != "object")
			    if($qSkill->count_in_overall_score && $qSkill->count_in_overall_score == 'true'){
			    	$count_in_overall_score = "true";
			    }else{
				    $count_in_overall_score = "false";
			    }
			    if($qSkill->count_in_skill_score && $qSkill->count_in_skill_score == 'true'){
				    $count_in_skill_score = "true";
			    }else{
				    $count_in_skill_score = "false";
			    }
			    if($qSkill->have_negative_marks && $qSkill->have_negative_marks == 'true'){
				    $have_negative_marks = "true";
			    }else{
				    $have_negative_marks = "false";
			    }
			    $questions_bank->questionSkillsMapping()
			                   ->attach([$qSkill->skill_id => ['max_score'=>$qSkill->max_score,
			                                                   'have_negative_marks'=>$have_negative_marks,
			                                                   'count_in_overall_score'=>$count_in_overall_score,
			                                                   'count_in_skill_score'=>$count_in_skill_score]]);
		    }

	    }
        
        
        

        return (new QuestionsBankResource($questions_bank))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('questions_bank_delete')) {
            return abort(401);
        }

        $questions_bank = QuestionsBank::findOrFail($id);
        $questions_bank->delete();

        return response(null, 204);
    }
}
