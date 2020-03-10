<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subject
 *
 * @package App
 * @property string $title
 * @property string $course
*/
class Subject extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    use \Awobaz\Compoships\Compoships;
    /**
	 * The database primary key value.
	 *
	 * @var string
	 */
    
    protected $fillable = ['title', 'course_id', 'created_by_id', 'updated_by_id'];

    public static function storeValidation($request)
    {
        return [    
            'title' => 'min:1|max:191|required|unique:subjects,title',
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:subjects,title,'.$request->route('subject'),
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
        ];
    }


    
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function chapters(){
        return $this->hasMany(Chapter::class);
    }
    public static function laratablesCustomAction($item)
	{
		$routeGroup = 'subjects';
		
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
