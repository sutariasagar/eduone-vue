<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ExamSectionSubjectMapping
 *
 * @package App
 * @property string $exam_section
 * @property integer $min_questions
 * @property integer $max_questions
*/
class ExamSectionSubjectMapping extends Model
{
    use SoftDeletes;

    
    protected $fillable = ['min_questions', 'max_questions', 'exam_section_id','chapter_id','subject_id','topic_id','sub_topic_id'];
    

    public static function storeValidation($request)
    {
        return [
            //'exam_section_id' => 'integer|exists:exam_sections,id|max:4294967295|required',
            'min_questions' => 'integer|max:4294967295|required',
			'max_questions' => 'integer|max:4294967295|required',
			//'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
			'chapter' => 'required',
			// 'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
			// 'subject' => 'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            //'exam_section_id' => 'integer|exists:exam_sections,id|max:4294967295|required',
            'min_questions' => 'integer|max:4294967295|required',
			'max_questions' => 'integer|max:4294967295|required',
			//'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
			'chapter' => 'required',
			// 'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
			// 'subject' => 'required'
        ];
    }

    

    
    
    public function exam_section()
    {
        return $this->belongsTo(ExamSection::class, 'exam_section_id');
    }

	public function subject()
	{
		return $this->belongsTo(Subject::class, 'subject_id');
	}

	public function chapter()
	{
		return $this->belongsTo(Chapter::class, 'chapter_id');
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class, 'topic_id');
	}

	public function subtopic()
	{
		return $this->belongsTo(Topic::class, 'sub_topic_id');
	}

	public function created_by()
	{
		return $this->belongsTo(User::class, 'created_by_id');
	}

	public function updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by_id');
	}
    
    
}
