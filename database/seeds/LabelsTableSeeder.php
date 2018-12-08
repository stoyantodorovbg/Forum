<?php

use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labels')->insert([
            'system_name' => 'thread',
            'default_content' => 'Thread',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'user',
            'default_content' => 'User',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'created_at',
            'default_content' => 'Created at',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'updated_at',
            'default_content' => 'Updated at',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'save',
            'default_content' => 'Save',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'save_exit',
            'default_content' => 'Save and Exit',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'exit_without_saving',
            'default_content' => 'Exit without saving',
            'default_language_id' => 1,
        ]);

        DB::table('labels')->insert([
            'system_name' => 'body',
            'default_content' => 'Body',
            'default_language_id' => 1,
        ]);
    }
}
