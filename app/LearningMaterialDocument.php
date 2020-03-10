<?php
namespace App;

use App\Http\Controllers\Traits\CreatedByUpdatedByTrait;
use App\Http\Controllers\Traits\CreatedAtUpdatedAtTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Support\Facades\Auth;

/**
 * Class LearningMaterialDocument
 *
 * @package App
 * @property string $title
 * @property text $description
 * @property string $material_type
 * @property string $link
 * @property integer $priority
 * @property enum $mandatory
 * @property integer $credits
 * @property string $created_by
 * @property string $updated_by
 * @property string $learning_material
*/
class LearningMaterialDocument extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;
    use CreatedByUpdatedByTrait;
    use CreatedAtUpdatedAtTrait;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = ['title', 'description', 'material_type', 'link', 'priority', 'mandatory', 'credits',  'learning_material_id', 'created_by_id', 'updated_by_id','include_in_free_package'];
    protected $appends = ['file', 'file_link', 'uploaded_file', 'upload_file','file_tag'];
    protected $with = ['media'];
    

    public static $enum_mandatory = ["yes" => "Yes", "no" => "No"];

    public static function storeValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:learning_material_documents,title',
            'description' => 'max:65535|required',
            'material_type' => 'min:1|max:191|required',
            'link' => 'min:1|max:191|nullable',
            'priority' => 'integer|max:10000|nullable',
            'mandatory' => 'in:yes,no|required',
            'file' => 'nullable',
            'file.*' => 'file|nullable',
            'credits' => 'integer|max:1000|nullable',
            'learning_material_id' => 'integer|exists:learning_materials,id|max:4294967295|required',
            'learning_material' => 'required'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'title' => 'min:1|max:191|required|unique:learning_material_documents,title,'.$request->route('learning_material_document'),
            'description' => 'max:65535|required',
            'material_type' => 'min:1|max:191|required',
            'link' => 'min:1|max:191|nullable',
            'priority' => 'integer|max:10000|nullable',
            'mandatory' => 'in:yes,no|required',
            'file' => 'sometimes',
            'file.*' => 'file|nullable',
            'credits' => 'integer|max:1000|nullable',
            'learning_material_id' => 'integer|exists:learning_materials,id|max:4294967295|required',
            'learning_material' => 'required'
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
    
    public function getFileTagAttribute(){        

      $file = $this->getMedia('file');
        if (! count($file)) {
            return null;
        }
        $html = [];
        foreach ($file as $file) {
            $html[] = array('src'=>$file->getUrl(),'type'=>$file->mime_type);            
        }

        return $html;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
    
    public function learning_material()
    {
        return $this->belongsTo(LearningMaterial::class, 'learning_material_id');
    }

    public function learning_material_seen()
    {
        return $this->belongsToMany(User::class, 'learning_material_document_id')->where('user_id',Auth::user()->id);
    }
    
    public function users(){
		return $this->belongsToMany(User::class);
	}

    public function getUploadFileAttribute(){
		return $this->media;
    }
    
	public function getMaterialTypeAttribute($value)
	{
        $value = json_decode($value);
		$materialtypes = config('materialtypes');
		foreach ($materialtypes as $materialtype)
		{
			if(isset($value->id) && $materialtype['id'] == $value->id){
				return $materialtype;
			}
		}
	}
    
    public function scopeVideos($query){
        return $query->where('material_type->id', 'video');
    }
    public function scopeDocuments($query){
        return $query->where('material_type->id', 'pdf');
    }    
    
}
