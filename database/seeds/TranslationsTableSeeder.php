<?php

use Illuminate\Database\Seeder;

class TranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('translations')->insert([
            'label_id' => 1,
            'language_id' => 2,
            'content' => 'Публикация',
        ]);

        DB::table('translations')->insert([
            'label_id' => 2,
            'language_id' => 2,
            'content' => 'Автор',
        ]);

        DB::table('translations')->insert([
            'label_id' => 3,
            'language_id' => 2,
            'content' => 'Създадено на',
        ]);

        DB::table('translations')->insert([
            'label_id' => 4,
            'language_id' => 2,
            'content' => 'Променено на',
        ]);

        DB::table('translations')->insert([
            'label_id' => 5,
            'language_id' => 2,
            'content' => 'Запази промените',
        ]);

        DB::table('translations')->insert([
            'label_id' => 6,
            'language_id' => 2,
            'content' => 'Запази промените и излез',
        ]);

        DB::table('translations')->insert([
            'label_id' => 7,
            'language_id' => 2,
            'content' => 'Излез без да запазваш промените',
        ]);

        DB::table('translations')->insert([
            'label_id' => 8,
            'language_id' => 2,
            'content' => 'Съдържание',
        ]);;
    }
}
