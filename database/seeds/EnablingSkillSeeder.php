<?php

use Illuminate\Database\Seeder;

class EnablingSkillSeeder extends Seeder
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


            ['title' => 'enabling_skill_access','group'=>'enabling skill', 'label'=>'Enabling Skill Access'],
            ['title' => 'enabling_skill_create','group'=>'enabling skill', 'label'=>'Enabling Skill Create'],
            ['title' => 'enabling_skill_edit','group'=>'enabling skill', 'label'=>'Enabling Skill Edit'],
            ['title' => 'enabling_skill_view','group'=>'enabling skill', 'label'=>'Enabling Skill View'],
            ['title' => 'enabling_skill_delete','group'=>'enabling skill', 'label'=>'Enabling Skill Delete']

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
