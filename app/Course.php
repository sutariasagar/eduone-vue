<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 *
 * @package App
 * @property string $title
 * @property text $description
 * @property string $industry
 * @property integer $credit
*/
class Course extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    
    protected $fillable = ['title', 'description', 'credit', 'industry_id', 'created_by_id', 'updated_by_id'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:courses,title',
            'description' => 'max:65535|required',
            'industry_id' => 'integer|exists:industries,id|max:4294967295',
            'industry' => 'required',
            'credit' => 'integer|max:4294967295|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:courses,title,'.$request->route('course'),
            'description' => 'max:65535|required',
            'industry_id' => 'integer|exists:industries,id|max:4294967295|required',
            'industry' => 'required',
            'credit' => 'integer|max:4294967295|required'
        ];
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

	public static function laratablesCustomAction($item)
	{
		$routeGroup = 'courses';
		
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
