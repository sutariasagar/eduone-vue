<?php

use Illuminate\Database\Seeder;

class PermissionSeedForSkilsAndDocuments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [


            [ 'title' => 'skill_access','group'=>'skill', 'label'=>'Skill Access'],
            [ 'title' => 'skill_create','group'=>'skill', 'label'=>'Skill Create'],
            [ 'title' => 'skill_edit','group'=>'skill', 'label'=>'Skill Edit'],
            [ 'title' => 'skill_view','group'=>'skill', 'label'=>'Skill View'],
            [ 'title' => 'skill_delete','group'=>'skill', 'label'=>'Skill Delete'],
            [ 'title' => 'question_type_access','group'=>'question type', 'label'=>'Question Type Access'],
            [ 'title' => 'question_type_create','group'=>'question type', 'label'=>'Question Type Create'],
            [ 'title' => 'question_type_edit','group'=>'question type', 'label'=>'Question Type Edit'],
            [ 'title' => 'question_type_view','group'=>'question type', 'label'=>'Question Type View'],
            [ 'title' => 'question_type_delete','group'=>'question type', 'label'=>'Question Type Delete'],
            [ 'title' => 'module_access','group'=>'module', 'label'=>'Module Access'],
            [ 'title' => 'module_create','group'=>'module', 'label'=>'Module Create'],
            [ 'title' => 'module_edit','group'=>'module', 'label'=>'Module Edit'],
            [ 'title' => 'module_view','group'=>'module', 'label'=>'Module View'],
            [ 'title' => 'module_delete','group'=>'module', 'label'=>'Module Delete'],
            [ 'title' => 'learning_material_access','group'=>'learning material', 'label'=>'Learning Material Access'],
            [ 'title' => 'learning_material_create','group'=>'learning material', 'label'=>'Learning Material Crete'],
            [ 'title' => 'learning_material_edit','group'=>'learning material', 'label'=>'Learning Material Edit'],
            [ 'title' => 'learning_material_view','group'=>'learning material', 'label'=>'Learning Material View'],
            [ 'title' => 'learning_material_delete','group'=>'learning material', 'label'=>'Learning Material Delete'],
            [ 'title' => 'learning_material_document_access','group'=>'learning material document', 'label'=>'Learning Material Document Access'],
            [ 'title' => 'learning_material_document_create','group'=>'learning material document', 'label'=>'Learning Material Document Create'],
            [ 'title' => 'learning_material_document_edit','group'=>'learning material document', 'label'=>'Learning Material Document Edit'],
            [ 'title' => 'learning_material_document_view','group'=>'learning material document', 'label'=>'Learning Material Document View'],
            [ 'title' => 'learning_material_document_delete','group'=>'learning material document', 'label'=>'Learning Material Document Delete'],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
