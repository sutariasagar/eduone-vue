<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 *
 * @package App
 * @property string $title
*/
class Permission extends Model
{
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    /**
	 * The database primary key value.
	 *
	 * @var string
	 */
    protected $fillable = ['title','group','label', 'created_by_id', 'updated_by_id'];


    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:permissions,title',
            'group' => 'max:191|required',
            'label' => 'max:191|required',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:permissions,title,'.$request->route('permission'),
            'group' => 'max:191|required',
            'label' => 'max:191|required',
        ];
    }

    public static function laratablesCustomAction($item)
	{
		$routeGroup = 'permissions';
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
