<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Package
 *
 * @package App
 * @property string $title
 * @property integer $price
 * @property enum $status
 * @property integer $tests_with_assessment
 * @property integer $video_tutorials
 * @property integer $practice_questions
 * @property integer $mock_tests
 * @property integer $pte_vouchers
 * @property integer $webinar_sessions
 * @property enum $personal_feedback_and_assessment
 * @property integer $coaching_session_daily
 * @property string $unique_package_name
 * @property string $created_by
 * @property string $updated_by
*/
class Package extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;

    protected $fillable = ['title', 'price', 'status', 'tests_with_assessment', 'video_tutorials', 'practice_questions', 'mock_tests', 'pte_vouchers', 'webinar_sessions', 'personal_feedback_and_assessment', 'coaching_session_daily', 'unique_package_name', 'created_by_id', 'updated_by_id','testcenter_mocktests'];

    public static $enum_status = ["active" => "Active", "inactive" => "Inactive"];
    public static $enum_personal_feedback_and_assessment = ["true" => "True", "false" => "False"];

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:packages,title',
            'price' => 'integer|max:4294967295|required',
            'status' => 'in:active,inactive|required',
            'tests_with_assessment' => 'integer|max:4294967295|required',
            'video_tutorials' => 'integer|max:4294967295|required',
            'practice_questions' => 'integer|max:4294967295|required',
            'mock_tests' => 'integer|max:4294967295|required',
            'pte_vouchers' => 'integer|max:4294967295|required',
            'webinar_sessions' => 'integer|max:4294967295|required',
            'personal_feedback_and_assessment' => 'in:true,false|required',
            'coaching_session_daily' => 'integer|max:4294967295|required',
            'unique_package_name' => 'min:1|max:191|required|unique:packages,unique_package_name',
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:packages,title,'.$request->route('package'),
            'price' => 'integer|max:4294967295|required',
            'status' => 'in:active,inactive|required',
            'tests_with_assessment' => 'integer|max:4294967295|required',
            'video_tutorials' => 'integer|max:4294967295|required',
            'practice_questions' => 'integer|max:4294967295|required',
            'mock_tests' => 'integer|max:4294967295|required',
            'pte_vouchers' => 'integer|max:4294967295|required',
            'webinar_sessions' => 'integer|max:4294967295|required',
            'personal_feedback_and_assessment' => 'in:true,false|required',
            'coaching_session_daily' => 'integer|max:4294967295|required',
            'unique_package_name' => 'min:1|max:191|required|unique:packages,unique_package_name',
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
