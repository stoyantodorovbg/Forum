<?php

use Illuminate\Database\Seeder;

class RightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CRUD id 1
        DB::table('rights')->insert([
            'title' => 'Full',
        ]);

        //CRUD id 2
        DB::table('rights')->insert([
            'title' => 'BackOffice',
        ]);

        //CRUD id 3
        DB::table('rights')->insert([
            'title' => 'CRUD',
        ]);

        //Read id 4
        DB::table('rights')->insert([
            'title' => 'Read',
        ]);

        //Store id 5
        DB::table('rights')->insert([
            'title' => 'Store',
        ]);

        //Update id 6
        DB::table('rights')->insert([
            'title' => 'update',
        ]);

        //Destroy id 7
        DB::table('rights')->insert([
            'title' => 'destroy',
        ]);

        //Only id 8
        DB::table('rights')->insert([
            'title' => 'Only',
        ]);

        //Publish id 9
        DB::table('rights')->insert([
            'title' => 'Publish',
        ]);

        //Thread id 10
        DB::table('rights')->insert([
            'title' => 'Thread',
        ]);

        //Reply id 11
        DB::table('rights')->insert([
            'title' => 'Reply',
        ]);

        //Label id 12
        DB::table('rights')->insert([
            'title' => 'Label',
        ]);
    }
}
