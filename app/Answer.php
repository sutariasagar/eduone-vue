<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\QuestionsBank;

/**
 * Class AnswersType
 *
 * @package App
 * @property string $title
 * @property text $configurations
 * @property string $created_by
 * @property string $updated_by
*/
class Answer extends Model
{
        
    public function question()
    {
        return $this->belongsTo(QuestionsBank::class,'question_id');
    }

	public static function updateValidation($request)
	{
		return [
			'score' => 'required',
		];
	}

	public function scopeSubmitted($query){
		return $query->where('status','=','submitted');
	}

	public function scopeNotSubmitted($query){
		return $query->where('status','=','draft')->orWhereNull('status');
	}

	public function getScoreAttribute($value){
		return json_decode($value);
	}
    
    
}
