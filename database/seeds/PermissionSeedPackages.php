<?php

use Illuminate\Database\Seeder;

class PermissionSeedPackages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $items = [


            ['title' => 'package_access','group'=>'package', 'label'=>'Package'],
            ['title' => 'package_create','group'=>'package', 'label'=>'Package'],
            ['title' => 'package_edit','group'=>'package', 'label'=>'Package'],
            ['title' => 'package_view','group'=>'package', 'label'=>'Package'],
            ['title' => 'package_delete','group'=>'package', 'label'=>'Package']

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
