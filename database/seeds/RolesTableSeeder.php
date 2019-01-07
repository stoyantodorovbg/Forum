<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SuperAdmin id 1
        DB::table('roles')->insert([
            'title' => 'SuperAdmin',
        ]);

        //users
        DB::table('users_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        //Admin id 2
        DB::table('roles')->insert([
            'title' => 'Admin',
        ]);

        //users
        DB::table('users_roles')->insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);

        //Moderator id 3
        DB::table('roles')->insert([
            'title' => 'Moderator',
        ]);

        //users
        DB::table('users_roles')->insert([
            'user_id' => 3,
            'role_id' => 3,
        ]);

        //Registered id 4
        DB::table('roles')->insert([
            'title' => 'Registered',
        ]);

        //users
        DB::table('users_roles')->insert([
            'user_id' => 3,
            'role_id' => 4,
        ]);

        DB::table('users_roles')->insert([
            'user_id' => 4,
            'role_id' => 4,
        ]);

        //Banned id 5
        DB::table('roles')->insert([
            'title' => 'Banned',
        ]);

        //users
        DB::table('users_roles')->insert([
            'user_id' => 5,
            'role_id' => 5,
        ]);

        //TopWriter id 6
        DB::table('roles')->insert([
            'title' => 'TopWriter',
        ]);

        //TopReader id 7
        DB::table('roles')->insert([
            'title' => 'TopReader',
        ]);

        //Writer id 8
        DB::table('roles')->insert([
            'title' => 'Writer',
        ]);

        //Reader id 9
        DB::table('roles')->insert([
            'title' => 'Reader',
        ]);
    }
}
