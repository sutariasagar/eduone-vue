<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AnswersType
 *
 * @package App
 * @property string $title
 * @property text $configurations
 * @property string $created_by
 * @property string $updated_by
*/
class AnswersType extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;

    
    protected $fillable = ['title', 'configurations', 'created_by_id', 'updated_by_id'];


    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:answers_types,title',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:answers_types,title,'.$request->route('answers_type'),
        ];
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
