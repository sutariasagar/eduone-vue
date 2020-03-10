<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
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
class Skill extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    
    protected $fillable = ['title', 'created_by_id', 'updated_by_id','enabling_skill_id'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:skills,title',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:skills,title,'.$request->route('skill')
        ];
    }

	public function enabling_skill()
	{
		return $this->belongsTo(EnablingSkill::class, 'enabling_skill_id');
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
