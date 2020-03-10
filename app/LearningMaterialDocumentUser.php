<?php
/**
 * Copyright (c) 2019.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LearningMaterialDocumentUser
 *
 */
class LearningMaterialDocumentUser extends Model
{
    protected $table = 'learning_material_document_user';

    protected $with = ['learningMaterialDocuments'];
    
    public function learningMaterialDocuments(){
        return $this->belongsTo(learningMaterialDocument::class,'learning_material_document_id');
    }
    // public function learningMaterialVideos()
    // {
    //     return $this->hasMany(LearningMaterialDocument::class, 'learning_material_id')->where('material_type','video');
    // }
}
