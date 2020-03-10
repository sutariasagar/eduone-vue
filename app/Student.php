<?php
namespace App;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use App\User;
use Auth;
use Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash; 

/**
 * Class Student
 *
 * @package App
 * @property string $registration_id
 * @property string $test_taker_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property integer $phone
 * @property date $date_of_birth
 * @property enum $gender
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $type
*/
class Student extends User
{
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;

    /**
	 * The database primary key value.
	 *
	 * @var string
	 */
    protected $table = "users";
    protected $fillable = ['registration_id', 'test_taker_id', 'first_name', 'middle_name', 'last_name', 'email' , 'phone', 'date_of_birth', 'gender', 'country', 'state', 'city', 'package_id','name','password','terminal','type','username', 'created_by_id', 'updated_by_id','testcenter_password'];
    //protected $hidden = ['type'];
    protected $appends = ['student_image','capture_image'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', '=', 'student');
        });
    }
    public static function storeValidation($request)
    {
        return [
            'registration_id' => 'string|required',
            'test_taker_id' => 'string|required',
            'first_name' => 'min:1|max:191|required',
            'middle_name' => 'min:1|max:191',
            'last_name' => 'min:1|max:191|required',  
            'email' => 'email|max:191|required|unique:users,email',
            'phone' => 'integer|required',
            'date_of_birth' => 'date|required',
            'gender' => 'required',
            'country' => 'min:1|max:191|required',
            'state' => 'min:1|max:191',
            'city' => 'min:1|max:191|required',            
            'package_id' => 'integer|exists:packages,id|max:4294967295|required',
            'package' => 'required',
            'terminal' => 'integer|max:4294967295'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'registration_id' => 'string|required',
            'test_taker_id' => 'string|required',
            'email' => 'email|max:191|required|unique:users,email,'.$request->route('student'),
            'first_name' => 'min:1|max:191|required',   
            'middle_name' => 'min:1|max:191',
            'last_name' => 'min:1|max:191|required',
            'phone' => 'integer|required',
            'date_of_birth' => 'date|required',
            'gender' => 'required',
            'country' => 'min:1|max:191|required',
            'state' => 'min:1|max:191',
            'city' => 'min:1|max:191|required',            
            'package_id' => 'integer|exists:packages,id|max:4294967295|required',
            'package' => 'required',
            'terminal' => 'integer|max:4294967295'
        ];
    }
        

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
            
    public function getStudentImageAttribute(){
        return $this->getMedia('file')->keyBy('id')->last();
    }

    public function getCaptureImageAttribute(){        
        if (file_exists(storage_path(). '/app/public/studentimages/' .$this->id.'.jpeg')) {
            return  config('app.url').'/storage/studentimages/' .$this->id.'.jpeg' ;
        } else {
            return 'https://mm.aiircdn.com/158/834329.jpg';
        }     
    }
    public function created_by()
	{
		return $this->belongsTo(User::class, 'created_by_id');
	}

	public function updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by_id');
    }
    public function terminal()
	{
		return $this->hasMany(Terminal::class, 'user_id');
    }
     /**
     * Hash password
     * @param $input
     */
    public function setTestcenterPasswordAttribute($input)
    {        
        if ($input) {                    
            $this->attributes['testcenter_password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;            
        }
    }
}
