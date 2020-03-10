<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Module
 *
 * @package App
 * @property string $title
 * @property string $created_by
 * @property string $updated_by
*/
class Module extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    
    protected $fillable = ['title', 'created_by_id', 'updated_by_id'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:modules,title',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:modules,title,'.$request->route('module'),
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
    
    
}
