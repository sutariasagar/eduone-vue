<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class LearningMaterial
 *
 * @package App
 * @property string $title
 * @property string $course
 * @property string $created_by
 * @property string $updated_by
*/
class LearningMaterial extends Model
{
    use SoftDeletes;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    use \Awobaz\Compoships\Compoships;
    
    protected $fillable = ['title', 'course_id', 'subject_id',  'chapter_id', 'topic_id','sub_topic_id','created_by_id', 'updated_by_id'];
    

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:learning_materials,title',
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
            'chapter' => 'required',
            //'topic_id' => 'integer|exists:topics,id|max:4294967295',
            //'topic' => 'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:learning_materials,title,'.$request->route('learning_material'),
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
            'chapter' => 'required',
            //'topic_id' => 'integer|exists:topics,id|max:4294967295',
            //'topic' => 'required'
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function subtopic()
    {
        return $this->belongsTo(Topic::class, 'sub_topic_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function learningMaterialDocuments()
    {
        return $this->hasMany(LearningMaterialDocument::class, 'learning_material_id');
    }

    public function learningMaterialVideos()
    {
        return $this->hasMany(LearningMaterialDocument::class, 'learning_material_id')->videos();
    }

    public function learningMaterialVideosNotSeen()
    {
        //$query = QuestionsBank::doesntHave('questionset')->with(['course','subject','chapter','topic','subtopic','question_type','answer_type', 'created_by', 'updated_by'])
        return $this->doesntHave(LearningMaterialDocumentUser::class, 'learning_material_id')->where('type','video')->learningMaterialVideos();
    }

    public function learningMaterialVideosSeen()
    {
        return $this->hasMany(LearningMaterialDocumentUser::class, 'learning_material_id')->where('type','video')->where('user_id', Auth::user()->id);
        //return $this->learningMaterialVideos()->learning_material_seen();
    }
        
    public function learningMaterialPDFDocuments()
    {
        return $this->hasMany(LearningMaterialDocument::class, 'learning_material_id')->documents();
    }

    public function learningMaterialPDFDocumentsNotSeen()
    {
        //$query = QuestionsBank::doesntHave('questionset')->with(['course','subject','chapter','topic','subtopic','question_type','answer_type', 'created_by', 'updated_by'])
        return $this->doesntHave(LearningMaterialDocumentUser::class, 'learning_material_id')->where('type','pdf')->learningMaterialPDFDocuments();
    }

    public function learningMaterialPDFDocumentsSeen()
    {
        return $this->hasMany(LearningMaterialDocumentUser::class, 'learning_material_id')->where('type','pdf')->where('user_id', Auth::user()->id);
        //return $this->learningMaterialVideos()->learning_material_seen();
    }
}
