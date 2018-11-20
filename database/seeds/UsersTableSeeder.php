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
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('123456'),
            'confirmed' => 1,
            'confirmation_token' => str_random(25),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        factory(App\User::class, 1)->states('administrator')->create();

        factory(App\User::class, 50)->create();
    }
}
