<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Chapter
 *
 * @package App
 * @property string $title
 * @property string $course
 * @property string $subject
 * @property integer $learning_sequence
*/
class Chapter extends Model
{
    use SoftDeletes;
	use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;

    /**
	 * The database primary key value.
	 *
	 * @var string
	 */
    
    protected $fillable = ['title', 'learning_sequence', 'course_id', 'subject_id' , 'created_by_id', 'updated_by_id'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:chapters,title',
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'learning_sequence' => 'integer|max:4294967295|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:chapters,title,'.$request->route('chapter'),
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'learning_sequence' => 'integer|max:4294967295|required'
        ];
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    
    public static function laratablesCustomAction($item)
	{
		$routeGroup = 'chapters';
	}

	public function created_by()
	{
		return $this->belongsTo(User::class, 'created_by_id');
	}

	public function updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by_id');
    }
    
    public function learningMaterials(){
        return $this->hasMany(LearningMaterial::class,'chapter_id');
    }

    public function practiceQuestions(){
        return $this->hasMany(QuestionsBank::class,'chapter_id')->with('question_type')->where('include_in_practice_set',true);
    }
    
}
