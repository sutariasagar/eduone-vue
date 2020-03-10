<?php
/**
 * Copyright (c) 2019.
 */

namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use function array_push;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Skill
 *
 * @package App
 * @property string $title
 * @property string $created_by
 * @property string $updated_by
 */
class QuestionSet extends Model
{
	use SoftDeletes;
	use CreatedByUpdatedByTrait;
	use CreatedAtUpdatedAtTrait;

	protected $fillable = ['title', 'created_by_id', 'updated_by_id'];

	protected $appends = ['selectedQuestions'];


	public static function storeValidation($request)
	{
		return [
			'title' => 'min:1|max:191|required|unique:question_sets,title',
		];
	}

	public static function updateValidation($request)
	{
		return [
			'title' => 'min:1|max:191|required|unique:skills,title,'.$request->route('question_sets')
		];
	}

	public function created_by()
	{
		return $this->belongsTo(User::class, 'created_by_id');
	}

	public function updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by_id');
	}

	public function questions()
	{
		return $this->belongsToMany(QuestionsBank::class);
	}

	public function getSelectedQuestionsAttribute()
	{
		$selectedIds = array('speaking'=>array(), 'reading'=>array(),'writing'=>array(),'listening_rol'=>array(),'listening_sst'=>array());
		foreach ($this->questions as $question){
			//$selectedIds[] = $question->id;
			if($question->section_type['value'])
				if(isset($selectedIds[$question->section_type['value']]))
					array_push($selectedIds[$question->section_type['value']],$question->id);
		}
		return $selectedIds;
	}


}
