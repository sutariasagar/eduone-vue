<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ExamSection
 *
 * @package App
 * @property string $title
 * @property integer $min_questions
 * @property integer $max_questions
 * @property string $timer
 * @property tinyInteger $is_subsection
 * @property integer $min_time
 * @property integer $max_time
*/
class ExamSection extends Model
{
    use SoftDeletes;

    
    protected $fillable = ['title', 'min_questions', 'max_questions', 'timer', 'is_subsection', 'min_time', 'max_time','exam_id','type'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required',
            'min_questions' => 'integer|max:4294967295|required',
            'max_questions' => 'integer|max:4294967295|required',
            'timer' => 'in:question_wise,section_wise|max:191|required',
            'is_subsection' => 'boolean|required',
            'min_time' => 'integer|max:4294967295|required',
            'max_time' => 'integer|max:4294967295|required',
            //'exam_id' => 'integer|exists:exams,id|max:4294967295|required',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'min_questions' => 'integer|max:4294967295|required',
            'max_questions' => 'integer|max:4294967295|required',
            'timer' => 'in:question_wise,section_wise|max:191|required',
            'is_subsection' => 'boolean|required',
            'min_time' => 'integer|max:4294967295|required',
            'max_time' => 'integer|max:4294967295|required',
            //'exam_id' => 'integer|exists:exams,id|max:4294967295|required',
        ];
    }

    
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    
    
    
}
