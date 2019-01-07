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
        //Full id 1
        DB::table('rights')->insert([
            'title' => 'Admin',
        ]);

        //BackOffice id 2
        DB::table('rights')->insert([
            'title' => 'BackOffice',
        ]);

        //Store id 3
        DB::table('rights')->insert([
            'title' => 'store',
        ]);

        //Update id 4
        DB::table('rights')->insert([
            'title' => 'update',
        ]);

        //Destroy id 5
        DB::table('rights')->insert([
            'title' => 'destroy',
        ]);

        //Publish id 6
        DB::table('rights')->insert([
            'title' => 'Publish',
        ]);

        //Thread id 7
        DB::table('rights')->insert([
            'title' => 'Thread',
        ]);

        //Reply id 8
        DB::table('rights')->insert([
            'title' => 'Reply',
        ]);

        //Label id 9
        DB::table('rights')->insert([
            'title' => 'Label',
        ]);

        //Index id 10
        DB::table('rights')->insert([
            'title' => 'index',
        ]);

        //Edit id 11
        DB::table('rights')->insert([
            'title' => 'edit',
        ]);

        //Show id 12
        DB::table('rights')->insert([
            'title' => 'show',
        ]);

        //Show id 13
        DB::table('rights')->insert([
            'title' => 'Home',
        ]);
    }
}
