<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Role extends Model
{
	use CreatedByUpdatedByTrait;
	public $timestamps = true;

	/**
	 * The database primary key value.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

    protected $fillable = ['title', 'created_by_id', 'updated_by_id','created_at','updated_at'];
    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:roles,title',
            'permission' => 'array|required',
            'permission.*' => 'integer|exists:permissions,id|max:4294967295|required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:roles,title,'.$request->route('role'),
            'permission' => 'array|required',
            'permission.*' => 'integer|exists:permissions,id|max:4294967295|required'
        ];
    }

    

    
    
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
    
    
    public static function laratablesCustomAction($item)
	{
		$routeGroup = 'industries';
//		return view('components.action', compact('item','routeGroup'))->render();
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
