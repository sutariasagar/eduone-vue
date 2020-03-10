<?php

use Illuminate\Database\Seeder;

class PermissionSeedQuestionsAndExam extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [


            ['title' => 'questions_type_access','group'=>'question type', 'label'=>'Question Type Access'],
            ['title' => 'questions_type_create','group'=>'question type', 'label'=>'Question Type Create'],
            ['title' => 'questions_type_edit','group'=>'question type', 'label'=>'Question Type Edit'],
            ['title' => 'questions_type_view','group'=>'question type', 'label'=>'Question Type View'],
            ['title' => 'questions_type_delete','group'=>'question type', 'label'=>'Question Type Delete'],
            ['title' => 'questions_bank_access','group'=>'question bank', 'label'=>'Question Bank Access'],
            ['title' => 'questions_bank_create','group'=>'question bank', 'label'=>'Question Bank Create'],
            ['title' => 'questions_bank_edit','group'=>'question bank', 'label'=>'Question Bank Edit'],
            ['title' => 'questions_bank_view','group'=>'question bank', 'label'=>'Question Bank View'],
            ['title' => 'questions_bank_delete','group'=>'question bank', 'label'=>'Question Bank Delete'],
            ['title' => 'exam_access','group'=>'exam', 'label'=>'Exam Access'],
            ['title' => 'exam_create','group'=>'exam', 'label'=>'Exam Creae'],
            ['title' => 'exam_edit','group'=>'exam', 'label'=>'Exam Edit'],
            ['title' => 'exam_view','group'=>'exam', 'label'=>'Exam View'],
            ['title' => 'exam_delete','group'=>'exam', 'label'=>'Exam Delete'],
            ['title' => 'question_set_access','group'=>'question set', 'label'=>'Question Set Access'],
            ['title' => 'question_set_create','group'=>'question set', 'label'=>'Question Set Creae'],
            ['title' => 'question_set_edit','group'=>'question set', 'label'=>'Question Set Edit'],
            ['title' => 'question_set_view','group'=>'question set', 'label'=>'Question Set View'],
            ['title' => 'question_set_delete','group'=>'question set', 'label'=>'Question Set Delete'],
        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
