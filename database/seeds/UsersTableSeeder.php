<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SuperAdmin id 1
        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('secret'),
            'confirmed' => 1,
            'confirmation_token' => str_random(25),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //Admin id 2
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'confirmed' => 1,
            'confirmation_token' => str_random(25),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //Moderator id 3
        DB::table('users')->insert([
            'name' => 'Moderator',
            'email' => 'moderator@example.com',
            'password' => bcrypt('secret'),
            'confirmed' => 1,
            'confirmation_token' => str_random(25),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //User id 4
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('secret'),
            'confirmed' => 1,
            'confirmation_token' => str_random(25),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //Tarikat id 5
        DB::table('users')->insert([
            'name' => 'Tarikat',
            'email' => 'tarikat@example.com',
            'password' => bcrypt('secret'),
            'confirmed' => 1,
            'confirmation_token' => str_random(25),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        factory(App\User::class, 10)->create();
    }
}
