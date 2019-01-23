<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'title' => 'Admin Side Menu',
            'description' => 'Lists the editable content in the back-office',
            'status' => 1,
        ]);
    }
}
