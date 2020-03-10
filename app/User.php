<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;
    use HasApiTokens;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'created_by_id', 'updated_by_id'];
    protected $hidden = ['password', 'remember_token','type'];
    protected $appends = ['profile_image'];
    protected $with = ['media'];
    
    public static function storeValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'email' => 'email|max:191|required|unique:users,email',
            'password' => 'required',
            'role' => 'array|required',
            'role.*' => 'integer|exists:roles,id|max:4294967295|required',
            // 'file' => 'nullable',
            // 'file.*' => 'file|nullable',
            'remember_token' => 'max:191|nullable',
            'type' => 'min:1|max:191|required',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'max:191|required',
            'email' => 'email|max:191|required|unique:users,email,'.$request->route('user'),
            'password' => '',
            'role' => 'array|required',
            'role.*' => 'integer|exists:roles,id|max:4294967295|required',
            // 'file' => 'sometimes',
            // 'file.*' => 'file|nullable',
            'remember_token' => 'max:191|nullable',
            'type' => 'min:1|max:191|required',
        ];
    }

    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }
    
    public function getFileAttribute()
    {
        return [];
    }

    public function getUploadedFileAttribute()
    {
        return $this->getMedia('file')->keyBy('id');
    }

    public function getProfileImageAttribute(){
        return $this->getMedia('file')->keyBy('id')->last();
    }

    
    /**
     * @return string
     */
    public function getFileLinkAttribute()
    {
        $file = $this->getMedia('file');
        if (! count($file)) {
            return null;
        }
        $html = [];
        foreach ($file as $file) {
            $html[] = '<img href="' . $file->getUrl() . '" target="_blank">' . $file->file_name . '</img>';
        }

        return implode('<br/>', $html);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    public function exams(){
		return $this->belongsToMany(Exam::class)->withPivot('created_at','type','result');
    }
    public function testCenterExams(){
		return $this->belongsToMany(Exam::class)->where('type','testcenter')->withPivot('created_at','type','result');
    }
    public function practiceExams(){
		return $this->belongsToMany(Exam::class)->where('type','practice')->withPivot('created_at','type','result');
    }

    public function examsWithResults() {
        return $this->belongsToMany(Exam::class)->whereNotNull('result')->withPivot('created_at','type','result');
    }

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }

    public static function laratablesCustomAction($item)
    {
        $routeGroup = 'users';
        return view('components.action', compact('item','routeGroup'))->render();
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function scopeUser($query)
    {
        return $query->where('type', '=', 'user')->orWhereNull('type');
    }
    public function scopeAllocatedTo($query)
    {
        return $query->where('allocated_to', '=', Auth::id());
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public static function examiners(){
		return User::whereHas('role', function ($query) {
			$query->where('title', 'like', '%examiner%');
		})->get();
    }
    public function allocatedExams(){
		return $this->belongsToMany(Exam::class,'exam_user','allocated_to');
	}
    
    public static function minAllocatedExaminer(){
		$examiners = User::examiners();

        if(isset($examiners) && sizeof($examiners)> 0){
            $min = 0;
            $max = 0;
            $examiner_id = 0;
            $examinerArray = array();
            //print_r($examiners);exit;
            $exam_counter = array();
            foreach ($examiners as $examiner){
                $examcount = array('user_id'=>$examiner->id, 'count'=>sizeof($examiner->allocatedExams));
                array_push($examinerArray, $examcount);

            }

            $minAllocatedUser = array_column($examinerArray, 'count');
            $min_array = $examinerArray[array_search(min($minAllocatedUser), $minAllocatedUser)];
            return $min_array['user_id'];
        }else{
                return 1;
        }
    }

    public function documentsViewed(){
        return $this->belongsToMany(LearningMaterialDocument::class);
    }
    public function practiceAnswers(){
		return $this->hasMany(UserPracticeAnswer::class);
    }

    public static function generateRandomString($length = 10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function splitName($name) {
        $parts = array();
    
        while ( strlen( trim($name)) > 0 ) {
            $name = trim($name);
            $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
            $parts[] = $string;
            $name = trim( preg_replace('#'.$string.'#', '', $name ) );
        }
    
        if (empty($parts)) {
            return false;
        }
    
        $parts = array_reverse($parts);
        $name = array();
        $name['first_name'] = $parts[0];
        $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
        $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');
    
        return $name;
    }
}
