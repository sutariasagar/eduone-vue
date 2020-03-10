<?php

use Illuminate\Database\Seeder;

class PermissionForTerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $items = [


            ['title' => 'terminal_access','group'=>'terminal', 'label'=>'Terminal'],
            ['title' => 'terminal_create','group'=>'terminal', 'label'=>'Terminal'],
            ['title' => 'terminal_edit','group'=>'terminal', 'label'=>'Terminal'],
            ['title' => 'terminal_view','group'=>'terminal', 'label'=>'Terminal'],
            ['title' => 'terminal_delete','group'=>'terminal', 'label'=>'Terminal']

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
