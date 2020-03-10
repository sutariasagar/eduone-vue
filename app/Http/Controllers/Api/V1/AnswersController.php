<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
use App\Http\Resources\Exam as ExamResource;
use App\UserPracticeAnswer;
use Illuminate\Support\Facades\Auth;
use App\QuestionsBank;


class AnswersController extends Controller
{
    public function index(Request $request)
    {
	    
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $increment_count = true;
        $check = UserPracticeAnswer::where('question_id', $request->input('question_id', 1))
                                    ->where('user_id',$userId)
                                    ->first();
        if($check){
            $increment_count = false;
            $check->delete();
        }
        if(Auth::user()->practice_questions > 0 && $increment_count){            
            Auth::user()->practice_questions = Auth::user()->practice_questions - 1;
            Auth::user()->save();
        }
        $answer = new UserPracticeAnswer();
        $answer->user_id = $userId;        
        $answer->question_id = $request->input('question_id', 1);
        $answer->user_answer = $request->input('user_answer', null);
	    $answer->score = null;
        if ($request->file('audio')) {
            $music_file = $request->file('audio');
            $filename = $userId . '_' . '_' . $answer->question_id . "." . $music_file->getClientOriginalExtension();
            $location = storage_path() . '/app/public/practiceaudio/' . $filename;
            $music_file->move($location, $filename);
            $answer->user_answer = config('app.url') . '/practiceaudio/' . $filename . '/' . $filename;
        }


	    $question = QuestionsBank::find($answer->question_id);
	    $communicativeSkills = $question->question_type->communication_skill()->get();
        $totalCommunicativeSkills = sizeof($communicativeSkills);
        $correctCount = 0;
        $incorrectCount = 0;
        $enableAutoCheck = false;

        //print_r($question->question_details);
        // For FIB DropDown
	    if(isset($question->question_details->fib_dropdown) && $question->question_details->fib_dropdown){
            $enableAutoCheck = true;
			$answerString = str_replace('b_','',str_replace('#','',$answer->user_answer));			
	    	$userAnswer = json_decode($answerString,true);	    	
	        if(isset($question->answer_details->fib_dropdown->answers)){
				foreach ($question->answer_details->fib_dropdown->answers as $key=>$ans){                    
                    if(isset($userAnswer[$key+1]) && $userAnswer[$key+1] && $userAnswer[$key+1] == $ans){
						$correctCount++;
					}else{
                        if(isset($userAnswer[$key+1])){
                            $incorrectCount++;
                        }                        
                    }
				}
	        }
        }
        //FIB drag drop
        if(isset($question->question_details->fib_drag_drop) && $question->question_details->fib_drag_drop){
            $enableAutoCheck = true;
			$answerString = str_replace('b_','',str_replace('#','',$answer->user_answer));			
	    	$userAnswer = json_decode($answerString,true);	    	
	        if(isset($question->answer_details->fib_drag_drop->answers)){
				foreach ($question->answer_details->fib_drag_drop->answers as $key=>$ans){                      
                    if(isset($userAnswer[$key+1]) && $userAnswer[$key+1] && $userAnswer[$key+1] == $ans){                        
						$correctCount++;
					}else{
                        if(isset($userAnswer[$key+1])){
                            $incorrectCount++;
                        }                        
                    }
				}
	        }
        }
        //mcq single option
        if(isset($question->question_details->mcq_single_option) && $question->question_details->mcq_single_option){
            $enableAutoCheck = true;
            $userAnswer = $answer->user_answer;                                    
            if(isset($question->answer_details->mcq_single_option) && isset($userAnswer)){
				if($question->answer_details->mcq_single_option->text == $userAnswer){
                    $correctCount++;
                }else{
                    $incorrectCount++;
                }                
	        }            
        }
        // For MCQ Multiple Option
        if(isset($question->question_details->mcq_multiple_option) && $question->question_details->mcq_multiple_option){
            $enableAutoCheck = true;
            $userAnswer = $answer->user_answer;
            $userAnswer = json_decode($answer->user_answer,true);
            if(isset($userAnswer))
                $answerSize = sizeof($userAnswer);
            else
                $answerSize = 0;
            
            if(isset($question->answer_details->mcq_multiple_option) && isset($userAnswer)){
				foreach ($question->answer_details->mcq_multiple_option as $ans){
                    
                    if($ans->chosen){
                        if(in_array($ans->text,$userAnswer)){
                            $correctCount++;  
                            $answerSize--;      
                        }
                    }                    
                }
                $incorrectCount = $answerSize - $correctCount;
	        }            
        }

        //for FIB No Option
        if(isset($question->answer_details->fib_no_options) && $question->answer_details->fib_no_options){
            $enableAutoCheck = true;
            $answerString = str_replace('b_','',str_replace('#','',$answer->user_answer));			
	    	$userAnswer = json_decode($answerString,true);	    	
	        if(isset($question->answer_details->fib_no_options->answers)){
				foreach ($question->answer_details->fib_no_options->answers as $key=>$ans){                      
                    if(isset($userAnswer[$key+1]) && $userAnswer[$key+1] && $userAnswer[$key+1] == $ans){                        
						$correctCount++;
					}else{
                        if(isset($userAnswer[$key+1])){
                            $incorrectCount++;
                        }                        
                    }
				}
	        }
        }

        //highlight select
        if(isset($question->answer_details->select_text) && $question->answer_details->select_text){
            $enableAutoCheck = true;            
            $sampleuserAnswer = json_decode($answer->user_answer,true);
            $userAnswer = array();
            //print_r($sampleuserAnswer);
            if(isset($sampleuserAnswer) && sizeof($sampleuserAnswer) > 0){
                foreach($sampleuserAnswer as $key=>$uans){
                    $userAnswer[$key] = str_replace(array('.', ',',':'), '' , $uans);
                }
            }
            
            //print_r($userAnswer);exit;
            //$answerSize = sizeof($userAnswer);
            if(isset($userAnswer))
                $answerSize = sizeof($userAnswer);
            else
                $answerSize = 0;	
	        if(isset($question->answer_details->select_text) && isset($userAnswer)){
				foreach ($question->answer_details->select_text as $key=>$ans){                                          
                    if(in_array($ans->text,$userAnswer)){
                        $correctCount++;  
                        $answerSize--;      
                    }
                }
                $incorrectCount = $answerSize - $correctCount;
	        }
        }
        //exit;
        // For Ordered Text
        if(isset($question->question_details->ordered_text) && $question->question_details->ordered_text){
            $enableAutoCheck = true;
            $userAnswer = $answer->user_answer;            
            $userAnswer = json_decode($answer->user_answer,true);
            if(isset($userAnswer))
                $answerSize = sizeof($userAnswer);
            else
                $answerSize = 0;
            
            if(isset($question->answer_details->ordered_text) && isset($userAnswer)){
				foreach ($question->answer_details->ordered_text->suggestions as $key=>$ans){                    
                    if(isset($userAnswer[$key]) && $userAnswer[$key] == $ans->text){
                        $correctCount++;
                    }
                                        
                }
                $incorrectCount = $answerSize - $correctCount;
	        }            
        }        
        //exit;
        if($enableAutoCheck){
            $communicativeSkillActualScore = 0;
            $communicativeSkillMaxScore = 0;
            $newScore = 0;
            //print_r($question->questionSkillsMapping);
            if(isset($question->question_skills)){
                foreach($question->question_skills as $skill){                
                    if($skill->count_in_overall_score == 'true'){
                        if($skill->have_negative_marks == 'true'){
                            $newScore = $correctCount - $incorrectCount;
                            if($newScore < 0){
                                $newScore = 0;
                            }
                        }else{
                            $newScore = $correctCount;
                        }
                        $communicativeSkillActualScore+= $newScore;
                        $communicativeSkillMaxScore+= $skill->max_score;
                    }
                    
                }
            }        

            $communicativeSkillsBifurcation = [];
            $scores = json_decode('{}');
            foreach ($communicativeSkills as $skill){
                $communicativeSkillsBifurcation[$skill->title]['actual_score'] = $communicativeSkillActualScore/$totalCommunicativeSkills;
                $communicativeSkillsBifurcation[$skill->title]['max_score'] = $communicativeSkillMaxScore/$totalCommunicativeSkills;
            }
            $scores->communicative_skills = $communicativeSkillsBifurcation;
            //print_r($scores);exit;

            if(sizeof($communicativeSkillsBifurcation) > 0)
                $answer->score = json_encode($scores);
            else
                $answer->score = null;
        }

        $answer->save();
        $data = array();
        $data['success'] = true;
        $data['message'] = "Answer Saved Successfully";
        return new ExamResource($data);
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
