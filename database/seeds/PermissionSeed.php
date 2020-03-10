<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $items = [
		    [ 'title' => 'user_management_access','group'=>'user_management_access', 'label'=>'User Management Access'],
		    [ 'title' => 'permission_access','group'=>'permission', 'label'=>'Permission Access'],
		    [ 'title' => 'permission_create','group'=>'permission', 'label'=>'Permission Create'],
		    ['title' => 'permission_edit','group'=>'permission', 'label'=>'Permission Edit'],
		    [ 'title' => 'permission_view','group'=>'permission', 'label'=>'Permission View'],
		    [ 'title' => 'permission_delete','group'=>'permission', 'label'=>'Permission Delete'],
		    [ 'title' => 'role_access','group'=>'role', 'label'=>'Role Access'],
		    [ 'title' => 'role_create','group'=>'role', 'label'=>'Role Create'],
		    [ 'title' => 'role_edit','group'=>'role', 'label'=>'Role Edit'],
		    [ 'title' => 'role_view','group'=>'role', 'label'=>'Role View'],
		    [ 'title' => 'role_delete','group'=>'role', 'label'=>'Role Delete'],
		    [ 'title' => 'user_access','group'=>'user', 'label'=>'User Access'],
		    [ 'title' => 'user_create','group'=>'user', 'label'=>'User Create'],
		    [ 'title' => 'user_edit','group'=>'user', 'label'=>'User Edit'],
		    ['title' => 'user_view','group'=>'user', 'label'=>'User View'],
		    [ 'title' => 'user_delete','group'=>'user', 'label'=>'User Delete'],
		    ['title' => 'industry_access','group'=>'industry', 'label'=>'Industry Access'],
		    ['title' => 'industry_create','group'=>'industry', 'label'=>'Industry Create'],
		    ['title' => 'industry_edit','group'=>'industry', 'label'=>'Industry Edit'],
		    ['title' => 'industry_view','group'=>'industry', 'label'=>'Industry View'],
		    ['title' => 'industry_delete','group'=>'industry', 'label'=>'Industry Delete'],
		    ['title' => 'course_access','group'=>'course', 'label'=>'Course Access'],
		    ['title' => 'course_create','group'=>'course', 'label'=>'Course Create'],
		    ['title' => 'course_edit','group'=>'course', 'label'=>'Course Edit'],
		    ['title' => 'course_view','group'=>'course', 'label'=>'Course View'],
		    ['title' => 'course_delete','group'=>'course', 'label'=>'Course Delete'],
		    ['title' => 'subject_access','group'=>'subject', 'label'=>'Subject Acccess'],
		    ['title' => 'subject_create','group'=>'subject', 'label'=>'Subject Create'],
		    ['title' => 'subject_edit','group'=>'subject', 'label'=>'Subject Edit'],
		    ['title' => 'subject_view','group'=>'subject', 'label'=>'Subject View'],
		    ['title' => 'subject_delete','group'=>'subject', 'label'=>'Subject Delete'],
		    ['title' => 'chapter_access','group'=>'chapter', 'label'=>'Chapter Acccess'],
		    ['title' => 'chapter_create','group'=>'chapter', 'label'=>'Chapter Create'],
		    ['title' => 'chapter_edit','group'=>'chapter', 'label'=>'Chapter Edit'],
		    ['title' => 'chapter_view','group'=>'chapter', 'label'=>'Chapter View'],
		    ['title' => 'chapter_delete','group'=>'chapter', 'label'=>'Chapter Delete'],
		    ['title' => 'topic_access','group'=>'topic', 'label'=>'Topic Access'],
		    ['title' => 'topic_create','group'=>'topic', 'label'=>'Topic Create'],
		    ['title' => 'topic_edit','group'=>'topic', 'label'=>'Topic Edit'],
		    ['title' => 'topic_view','group'=>'topic', 'label'=>'Topic View'],
		    ['title' => 'topic_delete','group'=>'topic', 'label'=>'Topic Delete'],

	    ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
