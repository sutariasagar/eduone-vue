<?php

use Illuminate\Database\Seeder;

class CommunicationSkills extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $items = [


            ['title' => 'communication_skill_access','group'=>'communication skill', 'label'=>'Communication Skill Access'],
            ['title' => 'communication_skill_create','group'=>'communication skill', 'label'=>'Communication Skill Create'],
            ['title' => 'communication_skill_edit','group'=>'communication skill', 'label'=>'Communication Skill Edit'],
            ['title' => 'communication_skill_view','group'=>'communication skill', 'label'=>'Communication Skill View'],
            ['title' => 'communication_skill_delete','group'=>'communication skill', 'label'=>'Communication Skill Delete']

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }   
    }
}
