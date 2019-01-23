<?php

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 1,
            'title' => 'Forum',
        ]);

        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 2,
            'title' => 'Blog',
        ]);

        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 3,
            'title' => 'Users',
        ]);

        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'position' => 4,
            'title' => 'System',
        ]);
    }
}
