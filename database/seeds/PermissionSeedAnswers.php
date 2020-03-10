<?php

use Illuminate\Database\Seeder;

class PermissionSeedAnswers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $items = [


            ['title' => 'answers_type_access','group'=>'answer type', 'label'=>'Answer Type Access'],
            ['title' => 'answers_type_create','group'=>'answer type', 'label'=>'Answer Type Create'],
            ['title' => 'answers_type_edit','group'=>'answer type', 'label'=>'Answer Type Edit'],
            ['title' => 'answers_type_view','group'=>'answer type', 'label'=>'Answer Type View'],
            ['title' => 'answers_type_delete','group'=>'answer type', 'label'=>'Answer Type Delete']

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
