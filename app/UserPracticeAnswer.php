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
class UserPracticeAnswer extends Model
{
        
    public function question()
    {
        return $this->belongsTo(QuestionsBank::class,'question_id');
    }

	public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

	public function getScoreAttribute($value){
        if($value)
		    return json_decode($value);
	}
    
    
}
