<?php
/**
 * Copyright (c) 2019.
 */

use Illuminate\Database\Seeder;

class PermissionQuestionSet extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$items = [


			['title' => 'question_set_access','group'=>'question_set', 'label'=>'Question Set'],
			['title' => 'question_set_create','group'=>'question_set', 'label'=>'Question Set'],
			['title' => 'question_set_edit','group'=>'question_set', 'label'=>'Question Set'],
			['title' => 'question_set_view','group'=>'question_set', 'label'=>'Question Set'],
			['title' => 'question_set_delete','group'=>'question_set', 'label'=>'Question Set']

		];

		foreach ($items as $item) {
			\App\Permission::create($item);
		}
	}
}
