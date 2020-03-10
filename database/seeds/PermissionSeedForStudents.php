<?php

use Illuminate\Database\Seeder;

class PermissionSeedForStudents extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $items = [


            ['title' => 'student_access','group'=>'student', 'label'=>'Student'],
            ['title' => 'student_create','group'=>'student', 'label'=>'Student'],
            ['title' => 'student_edit','group'=>'student', 'label'=>'Student'],
            ['title' => 'student_view','group'=>'student', 'label'=>'Student'],
            ['title' => 'student_delete','group'=>'student', 'label'=>'Student']

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
