<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Topic
 *
 * @package App 
 * @property string $title
 * @property string $course
 * @property string $subject
 * @property string $chapter
 * @property integer $learning_sequence
 * @property string $parent
*/
class Topic extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    /**
	 * The database primary key value.
	 *
	 * @var string
	 */
    
    protected $fillable = ['title', 'learning_sequence', 'course_id', 'subject_id', 'chapter_id', 'parent_id', 'created_by_id', 'updated_by_id'];

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:topics,title',
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
            'chapter' => 'required',
            'learning_sequence' => 'integer|max:4294967295|required',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:topics,title,'.$request->route('topic'),
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
            'chapter' => 'required',
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
    
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
    
    public function parent()
    {
        return $this->belongsTo(Topic::class, 'parent_id');
    }

    public function subTopic()
    {
        return $this->hasMany(Topic::class, 'parent_id','id');
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
