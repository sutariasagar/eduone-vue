<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Industry
 *
 * @package App
 * @property string $title
*/
class Industry extends Model
{
    use SoftDeletes;
	use CreatedByUpdatedByTrait;
	use CreatedAtUpdatedAtTrait;
	
	/**
	 * The database primary key value.
	 *
	 * @var string
	 */

	protected $fillable = ['title', 'created_by_id', 'updated_by_id'];


    public static function storeValidation($request)
    {
        return [
	        'title' => 'min:1|max:191|required|unique:industries,title',
        ];
    }

    public static function updateValidation($request)
    {
        return [
	        'title' => 'min:1|max:191|required|unique:industries,title,'.$request->route('industry'),
        ];
    }
	public static function laratablesCustomAction($item)
	{
		$routeGroup = 'industries';
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
