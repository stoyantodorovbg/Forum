<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ReplyTableSeeder::class);
        $this->call(ChannelTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(LabelsTableSeeder::class);
    }
}
