<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Examiner
 *
 * @package App
 * @property string $title
 * @property enum $question_pool
 * @property integer $total_marks
 * @property integer $passing_marks
 * @property integer $duration
 * @property enum $status
 * @property text $start_instructions
 * @property text $end_instructions
 * @property string $exam_type
 * @property integer $sections_count
 * @property tinyInteger $can_see_solution
 * @property string $instruction_type
 * @property string $created_by
 * @property string $updated_by
*/
class Examiner extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    
    protected $fillable = ['title', 'course_id', 'question_pool', 'total_marks', 'passing_marks', 'duration_min','duration_max', 'status', 'start_instructions', 'end_instructions', 'exam_type', 'sections_count', 'can_see_solution', 'instruction_type', 'created_by_id',
	    'updated_by_id',
	    'question_set_id'
    ];
    

    public static $enum_question_pool = ["random" => "Random", "static" => "Static"];

    public static $enum_status = ["active" => "Active", "inactive" => "Inactive"];

    public static $enum_exam_type = ["pte_simulation" => "PTE Simulation", "scored_free" => " Scored Free","unscored_free" => " Unscored Free", "proctored_online" => "Proctored Online"];

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:exams,title',
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'question_pool' => 'in:random,static|required',
            'total_marks' => 'integer|max:4294967295',
            'passing_marks' => 'integer|max:4294967295',
            'duration_min' => 'integer|max:4294967295|required',
            'duration_max' => 'integer|max:4294967295|required',
            'status' => 'in:active,inactive|required',
            'start_instructions' => 'max:65535|required',
            'end_instructions' => 'max:65535|nullable',
            'exam_type' => 'max:191|nullable',
            'sections_count' => 'integer|min:1|max:4294967295',
            'can_see_solution' => 'boolean|nullable',
            'instruction_type' => 'in:audio,video|max:191|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:exams,title,'.$request->route('exam'),
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'question_pool' => 'in:random,static|required',
            'total_marks' => 'integer|max:4294967295',
            'passing_marks' => 'integer|max:4294967295',
            'duration_min' => 'integer|max:4294967295|required',
            'duration_max' => 'integer|max:4294967295|required',
            'status' => 'in:active,inactive|required',
            'start_instructions' => 'max:65535|required',
            'end_instructions' => 'max:65535|nullable',
            'exam_type' => 'max:191|nullable',
            'sections_count' => 'integer|min:1|max:4294967295',
            'can_see_solution' => 'boolean|nullable',
            'instruction_type' => 'in:audio,video|max:191|required'
        ];
    }

    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

	public function writingsection()
	{
		return $this->hasOne(ExamSection::class)->where('type','=','writing');
	}

	public function speakingsection()
	{
		return $this->hasOne(ExamSection::class)->where('type','=','speaking');
	}
	public function listeningsstsection()
	{
		return $this->hasOne(ExamSection::class)->where('type','=','listening_sst');
	}
	public function listeningrolsection()
	{
		return $this->hasOne(ExamSection::class)->where('type','=','listening_rol');
	}
	public function readingsection()
	{
		return $this->hasOne(ExamSection::class)->where('type','=','reading');
	}

    public function users(){
		return $this->belongsToMany(User::class);
	}

    public function exams(){
	    return $this->belongsToMany(Exam::class);
    }

    
    
    
}
