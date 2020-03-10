<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;

/**
 * Class QuestionType
 *
 * @package App
 * @property string $title
 * @property string $skill
 * @property string $created_by
 * @property string $updated_by
*/
class QuestionType extends Model
{
    use SoftDeletes;
	use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    
    protected $fillable = ['title', 'skill_id', 'created_by_id', 'updated_by_id'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:question_types,title',
            'skill_id' => 'integer|exists:skills,id|max:4294967295|required',
            'module_id' => 'array|required',
            'module_id.*' => 'integer|exists:modules,id|max:4294967295|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:question_types,title,'.$request->route('question_type'),
            'skill_id' => 'integer|exists:skills,id|max:4294967295|required',
            'module_id' => 'array|required',
            'module_id.*' => 'integer|exists:modules,id|max:4294967295|required'
        ];
    }

    

    
    
    public function skill()
    {
        return $this->belongsTo(Skill::class, 'skill_id');
    }
    
    public function module_id()
    {
        return $this->belongsToMany(Module::class, 'module_question_type');
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function communication_skill()
	{
		return $this->belongsToMany(CommunicationSkill::class, 'questions_type_communication_skill');
	}
    
    
}
