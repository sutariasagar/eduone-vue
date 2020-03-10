<?php

namespace App\Http\Controllers\Api\V1;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Subject;
use App\Http\Resources\StudentPanel;
use App\LearningMaterial;
use Yajra\DataTables\DataTables;
use App\QuestionsBank;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\Exam as ExamResource;
use App\Role;
use App\User;
use App\Answer;
use App\Exam;
use App\ExamUserIntroduction;
use Carbon\Carbon;
use App\LearningMaterialDocumentUser;
use App\LearningMaterialDocument;

class StudentPanelController extends Controller
{
    public function coursesAndChapters()
    {	    

	    $data = Subject::whereHas('chapters.learningMaterials.learningMaterialVideos')->with('chapters.learningMaterials.learningMaterialVideos')->select('subjects.*')->get();

        return new StudentPanel($data);        

    }

    public function coursesAndChaptersSeen()
    {	    

	    $data = Subject::whereHas('chapters.learningMaterials.learningMaterialVideosSeen')->with('chapters.learningMaterials.learningMaterialVideosSeen')->select('subjects.*')->get();

        return new StudentPanel($data);        

    }
    public function coursesAndChaptersNotSeen()
    {	            
        $data = Subject::doesntHave('chapters.learningMaterials.learningMaterialVideosSeen')->with('chapters.learningMaterials.learningMaterialVideos')->select('subjects.*')->get();
        return new StudentPanel($data);        
    }
    
    public function coursesAndChaptersDocuments()
    {	    
	    $data = Subject::whereHas('chapters.learningMaterials.learningMaterialPDFDocuments')->with('chapters.learningMaterials.learningMaterialPDFDocuments')->select('subjects.*')->get();
        return new StudentPanel($data);        

    }

    public function coursesAndChaptersDocumentsSeen()
    {	    

	    $data = Subject::whereHas('chapters.learningMaterials.learningMaterialPDFDocumentsSeen')->with('chapters.learningMaterials.learningMaterialPDFDocumentsSeen')->select('subjects.*')->get();

        return new StudentPanel($data);        

    }
    public function coursesAndChaptersDocumentsNotSeen()
    {	            
        $data = Subject::doesntHave('chapters.learningMaterials.learningMaterialPDFDocumentsSeen')->with('chapters.learningMaterials.learningMaterialPDFDocuments')->select('subjects.*')->get();
        return new StudentPanel($data);        
    }
    public function startExam()
    {

        $user = Auth::user();
        // $user->exams()->detach();
       if($user->mock_tests > 0){       
            if (sizeof($user->exams) > 0) {
                $examIds = array();
                foreach ($user->exams as $exam) {
                    array_push($examIds, $exam->id);
                }
                $examSet = Exam::with('speakingsection')->whereNull('deleted_at')->whereNotIn('id', $examIds)->inRandomOrder()->first();
            } else {
                $examSet = Exam::with('speakingsection')->whereNull('deleted_at')->inRandomOrder()->first();
            }
            if ($examSet) {
                $examiner = User::minAllocatedExaminer();
                //print_r($examiner);exit;
                $user->exams()->attach($examSet->id, ['allocated_to' => $examiner,'created_at'=>Carbon::now(),'type'=>'practice']);
                $user->mock_tests = $user->mock_tests + 1;
                $user->save();
                $data['success'] = true;
                $data['user'] = $user;
                $data['exam'] = $examSet;
                return new ExamResource($data);
            } else {
                $data['success'] = false;
                $data['message'] = "No exam is assigned to you.";
                return new ExamResource($data);
            }
        } else {
            $data['success'] = false;
            $data['message'] = "No exam is assigned to you.";
            return new ExamResource($data);
        }
    }
    public function getSectionWiseQuestions($examId)
    {
        $exam = Exam::findOrFail($examId);

        //print_r($exam->question_pool['value']);exit;
        if ($exam->question_pool['value'] == 'static') {


			$speaking = QuestionsBank::select('questions_banks.*')
			                            ->leftJoin('question_set_questions_bank','question_set_questions_bank.questions_bank_id','=','questions_banks.id')
										->leftJoin('questions_types','questions_banks.question_type_id','=','questions_types.id')
                                        ->where('questions_banks.include_in_practice_set','!=','true')
                                        ->where('question_set_questions_bank.question_set_id','=',$exam->question_set_id)
										->where('questions_banks.section_type','=','speaking')
										->orderBy('questions_types.sequence','asc')->inRandomOrder()->get();

	        $reading = QuestionsBank::select('questions_banks.*')
	                                 ->leftJoin('question_set_questions_bank','question_set_questions_bank.questions_bank_id','=','questions_banks.id')
	                                 ->leftJoin('questions_types','questions_banks.question_type_id','=','questions_types.id')
                                     ->where('questions_banks.include_in_practice_set','!=','true')
                                     ->where('question_set_questions_bank.question_set_id','=',$exam->question_set_id)
	                                 ->where('questions_banks.section_type','=','reading')
	                                 ->orderBy('questions_types.sequence','asc')->inRandomOrder()->get();
	        //dd(DB::getQueryLog());
	        $writing = QuestionsBank::select('questions_banks.*')
	                                ->leftJoin('question_set_questions_bank','question_set_questions_bank.questions_bank_id','=','questions_banks.id')
	                                ->leftJoin('questions_types','questions_banks.question_type_id','=','questions_types.id')
                                    ->where('questions_banks.include_in_practice_set','!=','true')
                                    ->where('question_set_questions_bank.question_set_id','=',$exam->question_set_id)
	                                ->where('questions_banks.section_type','=','writing')
	                                ->orderBy('questions_types.sequence','asc')->inRandomOrder()->get();
	        $listening_sst = QuestionsBank::select('questions_banks.*')
	                                ->leftJoin('question_set_questions_bank','question_set_questions_bank.questions_bank_id','=','questions_banks.id')
	                                ->leftJoin('questions_types','questions_banks.question_type_id','=','questions_types.id')
                                    ->where('questions_banks.include_in_practice_set','!=','true')
                                    ->where('question_set_questions_bank.question_set_id','=',$exam->question_set_id)
	                                ->where('questions_banks.section_type','=','listening_sst')
	                                ->orderBy('questions_types.sequence','asc')->inRandomOrder()->get();

	        $listening_rol = QuestionsBank::select('questions_banks.*')
	                                     ->leftJoin('question_set_questions_bank','question_set_questions_bank.questions_bank_id','=','questions_banks.id')
	                                     ->leftJoin('questions_types','questions_banks.question_type_id','=','questions_types.id')
                                         ->where('questions_banks.include_in_practice_set','!=','true')
                                         ->where('question_set_questions_bank.question_set_id','=',$exam->question_set_id)
	                                     ->where('questions_banks.section_type','=','listening_rol')
	                                     ->orderBy('questions_types.sequence','asc')->inRandomOrder()->get();






         $data['success'] = true;
            $data['speaking'] = $speaking;
            $data['reading'] = $reading;
            //$data['reading_time'] = $readingTime;
	        //$data['listeningrol_time'] = $listeningRolTime;
            $data['writing'] = $writing;
            $data['listeningsst'] = $listening_sst;
            $data['listeningrol'] = $listening_rol;

	        foreach ($exam->sections as $section){
		        if($section->timer == 'section_wise'){
		        	$data[str_replace('_','',$section->type).'_timer'] = 0;
		        	foreach ($data[str_replace('_','',$section->type)] as $question){
				        $data[str_replace('_','',$section->type).'_timer'] += $question->attempt_time;
			        }
		        }
	        }
            return new ExamResource($data);
        } else {

            $data['success'] = false;
            $data['message'] = "Random question pool is yet pending";
            return new ExamResource($data);
        }

    }

    public function uploadIntroAudio(Request $request)
    {
        $userId = Auth::user()->id;
        $examUserIntro = new ExamUserIntroduction();
        $examUserIntro->user_id = $userId;
        $examUserIntro->exam_id = $request->input('exam_id', 1);

        if ($request->file('audio')) {
            // The file
            $music_file = $request->file('audio');

            // This will return "mp3" not the file name
            $filename = $userId . '_' . $examUserIntro->exam_id . "." . $music_file->getClientOriginalExtension();

            // This will return /audio/mp3
            $location = storage_path() . '/app/public/audio/' . $filename;
            // This will move the file to /public/audio/mp3/
            // and save it as "mp3" (not what you want)
            // example: /public/audio/mp3/mp3 (without extension)
            $music_file->move($location, $filename);

            $examUserIntro->filename = 'audio/' . $filename . '/' . $filename;
            // mp3 row in your column will just say "mp3"
            // since the $filename above is just an extension of the file

        }
        $examUserIntro->save();
        $data = array();
        $data['success'] = true;
        $data['message'] = "File Uploaded Successfully";
        return new ExamResource($data);
    }

    public function speakingAnswer(Request $request)
    {
        $userId = Auth::user()->id;
        $answer = new Answer();
        $answer->user_id = $userId;
        $answer->exam_id = $request->input('exam_id', 1);
        $answer->question_id = $request->input('question_id', 1);
        $answer->user_answer = $request->input('user_answer', null);
	    $answer->score = null;
        if ($request->file('audio')) {
            $music_file = $request->file('audio');
            $filename = $userId . '_' . $answer->exam_id . '_' . $answer->question_id . "." . $music_file->getClientOriginalExtension();
            $location = storage_path() . '/app/public/audio/' . $filename;
            $music_file->move($location, $filename);
            $answer->user_answer = config('app_url') . 'audio/' . $filename . '/' . $filename;
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

    public function practiceQuestions(Request $request){

        $query = QuestionsBank::with(['course','subject','chapter','topic','subtopic','question_type','answer_type', 'created_by', 'updated_by'])
		->select('questions_banks.*')
		->leftJoin('questions_types', 'questions_types.id','=','questions_banks.question_type_id')
        ->where('include_in_practice_set',true);
        
        if($request->has('section_type')){
        	$query->where('section_type','=',$request->input('section_type'));
        }
        
        return DataTables::of($query)
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
            ->make(true);
    }

    public function updateDocumentsUsed(Request $request){
        
        $learningMaterialDocumentId = $request->input('learning_material_document_id');
        $user = Auth::user();
        $learningMaterialDocument = LearningMaterialDocument::find($learningMaterialDocumentId);

        $check = LearningMaterialDocumentUser::where('user_id',Auth::user()->id)->where('learning_material_document_id', $learningMaterialDocumentId)->first();
        if(isset($check)){

        }else{
            
            $learningMaterialDocumentUser = new LearningMaterialDocumentUser();
            $learningMaterialDocumentUser->type = $learningMaterialDocument->material_type['id'];
            $learningMaterialDocumentUser->learning_material_id = $learningMaterialDocument->learning_material_id;
            $learningMaterialDocumentUser->user_id = $user->id;
            $learningMaterialDocumentUser->learning_material_document_id = $learningMaterialDocumentId;
            $learningMaterialDocumentUser->save();
            
            if(strtolower($learningMaterialDocument->material_type['id']) == "pdf"){
                $user->document_tutorials = $user->document_tutorials - 1;
            }                        
            if(strtolower($learningMaterialDocument->material_type['id']) == "video"){
                $user->video_tutorials = $user->video_tutorials - 1;
                $user->save();
            }
        }
        
        $data = array();
        $data['success'] = true;
        $data['message'] = "Answer Saved Successfully";
        return new ExamResource($data);

    }

    public function coursesAndChaptersCount()
    {	    

	    $count = LearningMaterialDocument::videos()->get()->count();

        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);                

    }

    public function coursesAndChaptersSeenCount()
    {	    

	    $count = Auth::user()->documentsViewed()->videos()->get()->count();        
        
        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);                

    }
    public function coursesAndChaptersNotSeenCount()
    {	            
        $count = Auth::user()->video_tutorials;
        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);        
    }

    public function coursesAndChaptersDocumentsCount()
    {	    

	    $count = LearningMaterialDocument::documents()->get()->count();

        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);                

    }

    public function coursesAndChaptersDocumentsSeenCount()
    {	    

	    $count = Auth::user()->documentsViewed()->documents()->get()->count();        
        
        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);                

    }
    public function coursesAndChaptersDocumentsNotSeenCount()
    {	            
        $count = LearningMaterialDocument::documents()->get()->count() - Auth::user()->documentsViewed()->documents()->get()->count();
        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);        
    }

    public function practiceQuestionsCount()
    {	            
        $count = QuestionsBank::practiceQuestions()->get()->count();
        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);        
    }
    public function practiceQuestionsSeenCount()
    {	            
        $count = Auth::user()->practiceAnswers()->get()->count();        
        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);        
    }
    public function practiceQuestionsSeen()
    {	
        $query = Auth::user()->practiceAnswers()->with('question','question.chapter','question.tagged')->orderBy('user_practice_answers.id');        
        
	    return DataTables::of($query)			    
			    ->make(true);            
        // $count = 
        // $data = array();
        // $data['success'] = true;
        // $data['count'] = $count;
        // $data['message'] = "Count Submitted Successfully";
        // return new ExamResource($data);        
    }
    public function practiceQuestionsNotSeenCount()
    {	            
        //$count = QuestionsBank::practiceQuestions()->get()->count() - Auth::user()->practiceAnswers()->get()->count();
        $count = Auth::user()->practice_questions;
        $data = array();
        $data['success'] = true;
        $data['count'] = $count;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);        
    }

    
    public function getQuestions($subjectid, $chapterid, $level){
     
        $questions = QuestionsBank::where('subject_id',$subjectid)
                                    ->where('chapter_id',$chapterid)
                                    ->withAllTags([$level])
                                    //->where('include_in_practice_set', true)                                    
                                    ->get();
        $data = array();
        $data['success'] = true;
        $data['count'] = sizeof($questions);
        $data['data'] = $questions;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);        
    }

    public function getQuestion($id){
        $questions = QuestionsBank::find($id);                                    
        $data = array();
        $data['success'] = true;
        $data['count'] = sizeof($questions);
        $data['data'] = $questions;
        $data['message'] = "Count Submitted Successfully";
        return new ExamResource($data);
    }
}
