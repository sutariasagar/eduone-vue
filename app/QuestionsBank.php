<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use function array_push;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class QuestionsBank
 *
 * @package App
 * @property string $title
 * @property text $header
 * @property integer $max_score
 * @property integer $preparation_time
 * @property integer $attempt_time
 * @property enum $status
 * @property integer $min_words
 * @property integer $max_words
 * @property string $question_type
 * @property string $created_by
 * @property string $updated_by
*/
class QuestionsBank extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
	use \Conner\Tagging\Taggable;
    protected $fillable = ['title', 'course_id', 'subject_id',  'chapter_id', 'topic_id','sub_topic_id', 'header', 'max_score', 'preparation_time', 'attempt_time', 'status', 'min_words', 'max_words', 'question_type_id','answer_type_id','solution_html','section_type', 'created_by_id', 'updated_by_id','question_details','answer_details','learning_material_id','include_in_practice_set','include_in_free_package'];
    protected $appends = ['file', 'file_link', 'uploaded_file','solution_documents','question_skills'];
    protected $with = ['media'];
//	protected $casts = [
//		'question_details' => 'array',
//		'answer_details' => 'array',
//	];
    public static $enum_status = ["active" => "Active", "inactive" => "Inactive"];
    public static $enum_section_type = ["speaking" => "Speaking", "writing" => "Writing","reading" => "Reading", "listening_sst" => "Listening (SST)","listening_rol" => "Listening (ROL)"];

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:questions_banks,title',
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
            'chapter' => 'required',
            // 'topic_id' => 'integer|exists:topics,id|max:4294967295|required',
            // 'topic' => 'required',
            'header' => 'max:65535|required',
            'max_score' => 'integer|max:10000|required',
            'preparation_time' => 'integer|max:1000|required',
            'attempt_time' => 'integer|max:100000|required',
            'status' => 'in:active,inactive|required',
            'min_words' => 'integer|max:4294967295|nullable',
            'max_words' => 'integer|max:4294967295|nullable',
            'question_type_id' => 'integer|exists:questions_types,id|max:4294967295|required',
            'question_type' => 'required',
            'answer_type_id' => 'integer|exists:answers_types,id|max:4294967295|required',
            'answer_type' => 'required',
            'solution_html' => 'max:65535',
            'section_type' => 'in:speaking,writing,reading,listening_sst,listening_rol|required',
            'file' => 'nullable',
            'file.*' => 'file|nullable',

        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:questions_banks,title,'.$request->route('questions_bank'),
            'course_id' => 'integer|exists:courses,id|max:4294967295|required',
            'course' => 'required',
            'subject_id' => 'integer|exists:subjects,id|max:4294967295|required',
            'subject' => 'required',
            'chapter_id' => 'integer|exists:chapters,id|max:4294967295|required',
            'chapter' => 'required',
            // 'topic_id' => 'integer|exists:topics,id|max:4294967295|required',
            // 'topic' => 'required',
            'header' => 'max:65535|required',
            'max_score' => 'integer|max:10000|required',
            'preparation_time' => 'integer|max:1000|required',
            'attempt_time' => 'integer|max:100000|required',
            'status' => 'in:active,inactive|required',
            'min_words' => 'integer|max:4294967295|nullable',
            'max_words' => 'integer|max:4294967295|nullable',
	        'question_type'=> 'required',
	        'answer_type'=>'required',
            'question_type_id' => 'integer|exists:questions_types,id|max:4294967295|required',
            'solution_html' => 'max:65535',
            'section_type' => 'in:speaking,writing,reading,listening_sst,listening_rol|required',
            'answer_type_id' => 'integer|exists:answers_types,id|max:4294967295|required',
            'file' => 'sometimes',
            'file.*' => 'file|nullable',
        ];
    }

    public function getFileAttribute()
    {
        return [];
    }

    public function getUploadedFileAttribute()
    {
        return $this->getMedia('file')->keyBy('id');
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
            $html[] = '<a href="' . $file->getUrl() . '" target="_blank">' . $file->file_name . '</a>';
        }

        return implode('<br/>', $html);
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

    public function question_type()
    {
        return $this->belongsTo(QuestionsType::class, 'question_type_id');
    }
    
    public function answer_type()
    {
        return $this->belongsTo(AnswersType::class, 'answer_type_id');
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function getQuestionDetailsAttribute($value){
		return json_decode($value);
    }
	public function getAnswerDetailsAttribute($value){
		return json_decode($value);
	}

	public function learningMaterialDocuments()
	{
		return $this->belongsToMany(LearningMaterialDocument::class);
	}
	public function learningMaterial()
	{
		return $this->belongsTo(LearningMaterial::class, 'learning_material_id');
    }
    
    public function questionset()
	{
		return $this->belongsToMany(QuestionSet::class);
	}

    public function getSectionTypeAttribute($value)
	{
		if($value == "writing"){
			return array('label'=>'Writing', 'value'=>'writing');
		}else if($value == "reading"){
			return array('label'=>'Reading', 'value'=>'reading');
		}else if($value == "speaking"){
            return array('label'=>'Speaking', 'value'=>'speaking');
        }else if($value == "listening_sst"){
			return array('label'=>'Listening (SST)', 'value'=>'listening_sst');
		}else {
            return array('label'=>'Listening (ROL)', 'value'=>'listening_rol');
        }
		return Exam::$enum_question_pool[$value];
	 }  

	public function getSolutionDocumentsAttribute(){
		return $this->media;
	}
	public function getTagsAttribute() {
	}

	public function questionSkillsMapping(){
		return $this->belongsToMany(Skill::class)->withPivot('skill_id', 'max_score','have_negative_marks','count_in_overall_score','count_in_skill_score');
	}

	public function getQuestionSkillsAttribute(){
		$questionSkills = $this->questionSkillsMapping()->get();
		$skills = array();
		foreach ($questionSkills as $question_skill){

			$temp = array();
			$temp = $question_skill['pivot'];
			$temp['skill'] = Skill::find($question_skill['pivot']->skill_id);
			array_push($skills,$temp);
		}
		return $skills;
	}


	public function scopeSpeaking($query){
		return $query->where('section_type','=','speaking');
	}
	public function scopeReading($query){
		return $query->where('section_type','=','reading');
	}
	public function scopeWriting($query){
		return $query->where('section_type','=','writing');
	}
	public function scopeListeningSST($query){
		return $query->where('section_type','=','listening_sst');
	}
	public function scopeListeningROL($query){
		return $query->where('section_type','=','listening_rol');
	}
	public function scopeListening($query){
		return $query->where('section_type','like','listening_%');
    }
    public function scopePracticeQuestions($query){
        return $query->where('include_in_practice_set', true);
    }

}
