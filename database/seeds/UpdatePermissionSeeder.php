<?php

use Illuminate\Database\Seeder;

class UpdatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
		    [ 'title' => 'master_access','group'=>'master_access', 'label'=>'Master Access'],
            [ 'title' => 'learning_access','group'=>'learning_access', 'label'=>'Learning Access'],
            [ 'title' => 'question_access','group'=>'question_access', 'label'=>'Question Access'],

	    ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
