<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionsType
 *
 * @package App
 * @property string $title
 * @property text $configurations
 * @property string $created_by
 * @property string $updated_by
*/
class QuestionsType extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    
    protected $fillable = ['title', 'sequence','configurations', 'created_by_id', 'updated_by_id'];

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:questions_types,title',
            'communication_skill' => 'array|required',
            'communication_skill.*' => 'integer|exists:communication_skills,id|max:4294967295|required',        
	        'sequence'=> 'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:questions_types,title,'.$request->route('questions_type'),
            'communication_skill' => 'array|required',
            'communication_skill.*' => 'integer|exists:communication_skills,id|max:4294967295|required',                        
            'sequence'=> 'required'
        ];
    }
    
    public function communication_skill()
    {        
        return $this->belongsToMany(CommunicationSkill::class, 'questions_type_communication_skill');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

	public function getConfigurationsAttribute($value){
		return json_decode($value);
	}
    
    
}
