<?php

namespace App\Http\Controllers\Api\V1;

use App\CommunicationSkill;
use App\Exam;
use App\ExamUser;
use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAnswerRequest;
use App\Http\Resources\Exam as ExamResource;
use App\Http\Resources\Answer as AnswerResource;
use App\Skill;
use App\Student;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use function json_decode;
use function json_encode;
use function sizeof;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class ResultsController extends Controller
{
    public function showResult($id)
    {
		$exam = Exam::findOrFail($id);		
        $students = $exam->users()->allocatedTo()->get();
        
        return DataTables::of($students)            
            ->make(true);

    }

    public function showReview($exam_id, $stu_id)
    {                
        $answers['speaking'] = Answer::whereHas('question', function ($query) {
            $query->speaking();
        })->with('question')->where('user_id','=',$stu_id)->where('exam_id','=',$exam_id)->whereNull('score')->orderBy('id','ASC')->get();

        $answers['reading'] = Answer::whereHas('question', function ($query) {
            $query->reading();
        })->with('question')->where('user_id','=',$stu_id)->where('exam_id','=',$exam_id)->whereNull('score')->orderBy('id','ASC')->get();

        $answers['writing'] = Answer::whereHas('question', function ($query) {
            $query->writing();
        })->with('question')->where('user_id','=',$stu_id)->where('exam_id','=',$exam_id)->whereNull('score')->orderBy('id','ASC')->get();

        $answers['listeningsst'] = Answer::whereHas('question', function ($query) {
            $query->listeningsst();
        })->with('question')->where('user_id','=',$stu_id)->where('exam_id','=',$exam_id)->whereNull('score')->orderBy('id','ASC')->get();

        $answers['listeningrol'] = Answer::whereHas('question', function ($query) {
            $query->listeningrol();
        })->with('question')->where('user_id','=',$stu_id)->where('exam_id','=',$exam_id)->whereNull('score')->orderBy('id','ASC')->get();

        return new ExamResource($answers);

    }
	public function saveAnswer(UpdateAnswerRequest $request, $answerId){
    	$answer = Answer::find($answerId);
		if($answer){
			$scores = json_decode($request->score);
			$communicativeSkills = $answer->question->question_type->communication_skill()->get();
			$totalCommunicativeSkills = sizeof($communicativeSkills);
			//print_r(sizeof($communicativeSkills));exit;
			$communicativeSkillsBifurcation = [];
			$enablingSkillsBifurcation = [];
			$communicativeSkillMaxScore = 0;
			$communicativeSkillActualScore = 0;
			if($scores->skills){
				foreach ($scores->skills as $score){
					//echo $score->over_all_Score;

					if($score->over_all_Score == 'true'){
						$communicativeSkillActualScore+= $score->value;
						$communicativeSkillMaxScore+= $score->max_score;
					}
					if($score->skill_score == 'true'){
						$skill = Skill::where('title','=',$score->skill)->first();

						if(isset($skill->enabling_skill) && isset($enablingSkillsBifurcation[$skill->enabling_skill->title])){
							$enablingSkillsBifurcation[$skill->enabling_skill->title]['max_score'] += $score->max_score;
							$enablingSkillsBifurcation[$skill->enabling_skill->title]['actual_score'] += $score->value;
						}else{
							if(isset($skill->enabling_skill)){
							$enablingSkillsBifurcation[$skill->enabling_skill->title]['max_score'] = $score->max_score;
							$enablingSkillsBifurcation[$skill->enabling_skill->title]['actual_score'] = $score->value;
							}
						}

						//print_r($skill->enablingSkill()->get());exit;
					}
				}
			}
			//print_r($enablingSkillsBifurcation);exit;
			if($communicativeSkillActualScore < 0){
				$communicativeSkillActualScore = 0;
			}
			foreach ($communicativeSkills as $skill){
				$communicativeSkillsBifurcation[$skill->title]['actual_score'] = $communicativeSkillActualScore/$totalCommunicativeSkills;
				$communicativeSkillsBifurcation[$skill->title]['max_score'] = $communicativeSkillMaxScore/$totalCommunicativeSkills;
			}
			$scores->communicative_skills = $communicativeSkillsBifurcation;
			$scores->enabling_skills = $enablingSkillsBifurcation;
			//print_r($communicativeSkillBifurcation);exit;
			//echo $communicativeSkillMaxScore;exit;


			$answer->score = json_encode($scores);
			$answer->status = 'submitted';
			$answer->save();
			return (new AnswerResource($answer))
				->response()
				->setStatusCode(202);
		}
	}	

	public function generateResult($exam_id, $stu_id){
		$answers = Answer::where('user_id','=',$stu_id)->where('exam_id','=',$exam_id)->whereNotNull('score')->get();
		
		$student = Student::find($stu_id);
		$examUser = ExamUser::where('user_id','=',$stu_id)->where('exam_id','=',$exam_id)->first();
		$totalCommunicativeScore = array();
		$totalEnablingScore = array();
		$communicativeMaxScore = 0;
		$communicativeActualScore = 0;
		$communicativeScore = 0;
		//$communicativeScore = CommunicationSkill::select('title')->get()[0]->toArray();
		//print_r($communicativeScore);exit;
		foreach ($answers as $answer){
			//if($totalCommunicativeScore[])
			//print_r($answer->score->communicative_skills);
			if($answer->score->communicative_skills){
				foreach($answer->score->communicative_skills as $key=>$cmskill){
					if(isset($totalCommunicativeScore[$key])){
						$totalCommunicativeScore[$key]['max_score']+= $cmskill->max_score;
						$totalCommunicativeScore[$key]['actual_score']+= $cmskill->actual_score;
					}else{
						$totalCommunicativeScore[$key]['max_score'] = $cmskill->max_score;
						$totalCommunicativeScore[$key]['actual_score'] = $cmskill->actual_score;
					}

					if($totalCommunicativeScore[ $key ]['max_score'] > 0){
						$totalCommunicativeScore[ $key ]['skill_score']  = round(($totalCommunicativeScore[ $key ]['actual_score'] * 90) / $totalCommunicativeScore[ $key ]['max_score'],0);
					}else{
						$totalCommunicativeScore[ $key ]['skill_score'] = 0;
					}

//					$communicativeMaxScore+= $totalCommunicativeScore[$key]['max_score'];
//					$communicativeActualScore+= $totalCommunicativeScore[$key]['actual_score'];
				}


			}
			if(isset($answer->score->enabling_skills) && $answer->score->enabling_skills) {
				foreach ( $answer->score->enabling_skills as $key => $cmskill ) {
					if ( isset( $totalEnablingScore[ $key ] ) ) {
						$totalEnablingScore[ $key ]['max_score']    += $cmskill->max_score;
						$totalEnablingScore[ $key ]['actual_score'] += $cmskill->actual_score;

					} else {
						$totalEnablingScore[ $key ]['max_score']    = $cmskill->max_score;
						$totalEnablingScore[ $key ]['actual_score'] = $cmskill->actual_score;
					}

					if($totalEnablingScore[ $key ]['max_score'] > 0){
						$totalEnablingScore[ $key ]['skill_score']  = round(($totalEnablingScore[ $key ]['actual_score'] * 90) / $totalEnablingScore[ $key ]['max_score'],0);
					}else{
						$totalEnablingScore[ $key ]['skill_score']  = 0;
					}

				}
			}


			//exit;
		}
		foreach ($totalCommunicativeScore as $key=>$value){
			// if($totalCommunicativeScore[$key]['actual_score'] < 10){
			// 	$totalCommunicativeScore[$key]['actual_score'] = 10;
			// }
			if($totalCommunicativeScore[$key]['skill_score'] < 10){
				$totalCommunicativeScore[$key]['skill_score'] = 10;
			}			
			$communicativeActualScore+= $totalCommunicativeScore[$key]['actual_score'];
			$communicativeMaxScore+= $totalCommunicativeScore[$key]['max_score'];
		}
		
		foreach($totalEnablingScore as $index=>$key){
			// if($key['actual_score'] < 10){						
			// 	$totalEnablingScore[$index]['actual_score'] = 10;
			// }
			if($key['skill_score'] < 10){						
				$totalEnablingScore[$index]['skill_score'] = 10;
			}
		}
		$result = array();
		$result['communicative_skills'] = $totalCommunicativeScore;
		// if($communicativeMaxScore < 10){
		// 	$communicativeMaxScore = 10;
		// }
		// if($communicativeActualScore < 10){
		// 	$communicativeActualScore = 10;
		// }

		$result['communicativeMaxScore'] = $communicativeMaxScore;
		$result['communicativeActualScore'] = $communicativeActualScore;
		$result['enabling_skills'] = $totalEnablingScore;
		if($communicativeMaxScore > 0){
			$result['overall_communicative_skills'] = round(($communicativeActualScore * 90) / $communicativeMaxScore,0);
		}else{
			$result['overall_communicative_skills'] = 0;
		}

		

		$result['student'] = $student;
		$result['examUser'] = $examUser;
		$result['result_url'] = '/storage/scores/'.$exam_id.'/'.$stu_id.'/result.pdf';
		$pdf = PDF::loadView('result', $result);
		//print_r($result);exit;
		$pdf->setPaper('a4', 'potrait');
		//print_r($pdf);
		//return $pdf->stream();
		Storage::put('public/scores/'.$exam_id.'/'.$stu_id.'/result.pdf', $pdf->output());
		//$pdf->save('scores/'.$exam_id.'/'.$stu_id.'/result.pdf');
		//exit;
		//$studentresult = ExamUser::find($examUser->id);
		$examUser->result = json_encode($result);
		$examUser->save();
		return new ExamResource($result);
	}
	public function saveAnswerAsDraft(UpdateAnswerRequest $request, $answerId){
		$answer = Answer::find($answerId);
		if($answer){
			$answer->score = $request->score;
			$answer->status = 'draft';
			$answer->save();
			return (new AnswerResource($answer))
				->response()
				->setStatusCode(202);
		}
	}

}
