<?php

use Illuminate\Database\Seeder;

class UpdatePermissions extends Seeder
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
            
            [ 'title' => 'user_management_access',],
            [ 'title' => 'permission_access',],
            [ 'title' => 'permission_create',],
            ['title' => 'permission_edit',],
            [ 'title' => 'permission_view',],
            [ 'title' => 'permission_delete',],
            [ 'title' => 'role_access',],
            [ 'title' => 'role_create',],
            [ 'title' => 'role_edit',],
            [ 'title' => 'role_view',],
            [ 'title' => 'role_delete',],
            [ 'title' => 'user_access',],
            [ 'title' => 'user_create',],
            [ 'title' => 'user_edit',],
            ['title' => 'user_view',],
            [ 'title' => 'user_delete',],
            [ 'title' => 'industry_access',],
            [ 'title' => 'industry_create',],
            [ 'title' => 'industry_edit',],
            [ 'title' => 'industry_view',],
            [ 'title' => 'industry_delete',],
            ['title' => 'course_access',],
            [ 'title' => 'course_create',],
            [ 'title' => 'course_edit',],
            [ 'title' => 'course_view',],
            [ 'title' => 'course_delete',],
            [ 'title' => 'subject_access',],
            [ 'title' => 'subject_create',],
            ['title' => 'subject_edit',],
            [ 'title' => 'subject_view',],
            [ 'title' => 'subject_delete',],
            [ 'title' => 'chapter_access',],
            [ 'title' => 'chapter_create',],
            [ 'title' => 'chapter_edit',],
            [ 'title' => 'chapter_view',],
            [ 'title' => 'chapter_delete',],
            [ 'title' => 'topic_access',],
            [ 'title' => 'topic_create',],
            [ 'title' => 'topic_edit',],
            [ 'title' => 'topic_view',],
            ['title' => 'topic_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
