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
        DB::table('label_translations')->insert([
            'label_id' => 1,
            'language_id' => 2,
            'content' => 'Публикация',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 2,
            'language_id' => 2,
            'content' => 'Автор',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 3,
            'language_id' => 2,
            'content' => 'Създадено на',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 4,
            'language_id' => 2,
            'content' => 'Променено на',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 5,
            'language_id' => 2,
            'content' => 'Запази промените',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 6,
            'language_id' => 2,
            'content' => 'Запази промените и излез',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 7,
            'language_id' => 2,
            'content' => 'Излез без да запазваш промените',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 8,
            'language_id' => 2,
            'content' => 'Текст',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 10,
            'language_id' => 2,
            'content' => 'Английски',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 11,
            'language_id' => 2,
            'content' => 'Български',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 12,
            'language_id' => 2,
            'content' => 'Форум',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 13,
            'language_id' => 2,
            'content' => 'Започни дискусия',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 14,
            'language_id' => 2,
            'content' => 'Теми',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 15,
            'language_id' => 2,
            'content' => 'Разгедай дискусии',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 16,
            'language_id' => 2,
            'content' => 'Влез',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 17,
            'language_id' => 2,
            'content' => 'Регистрирай се',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 18,
            'language_id' => 2,
            'content' => 'ДИСКУСИИ ВЪВ ФОРУМА',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 19,
            'language_id' => 2,
            'content' => 'Търсене',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 20,
            'language_id' => 2,
            'content' => 'Въведи критерий за търсене',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 21,
            'language_id' => 2,
            'content' => 'Най популярни дискусии',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 22,
            'language_id' => 2,
            'content' => 'Не са намерени релевантни резултати.',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 23,
            'language_id' => 2,
            'content' => 'Публикувано от',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 24,
            'language_id' => 2,
            'content' => 'коментар',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 25,
            'language_id' => 2,
            'content' => 'коментара',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 26,
            'language_id' => 2,
            'content' => 'разглеждане',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 27,
            'language_id' => 2,
            'content' => 'разглеждания',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 28,
            'language_id' => 2,
            'content' => 'Започни нова дискусия',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 29,
            'language_id' => 2,
            'content' => 'Публикувай',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 30,
            'language_id' => 2,
            'content' => 'Избери тема',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 31,
            'language_id' => 2,
            'content' => 'Избери',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 32,
            'language_id' => 2,
            'content' => 'Име',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 32,
            'language_id' => 2,
            'content' => 'Текст',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 33,
            'language_id' => 2,
            'content' => 'Добави снимка',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 34,
            'language_id' => 2,
            'content' => 'публикува',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 35,
            'language_id' => 2,
            'content' => 'Преди',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 36,
            'language_id' => 2,
            'content' => 'Изтрий',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 37,
            'language_id' => 2,
            'content' => 'Редактирай',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 38,
            'language_id' => 2,
            'content' => 'Откажи промените',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 39,
            'language_id' => 2,
            'content' => 'Все още няма регистрирани действия за този участник.',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 40,
            'language_id' => 2,
            'content' => 'публикува',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 41,
            'language_id' => 2,
            'content' => 'отговори на',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 42,
            'language_id' => 2,
            'content' => 'гласува за отговор на тази дискусия',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 43,
            'language_id' => 2,
            'content' => 'E-Mail адрес',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 44,
            'language_id' => 2,
            'content' => 'Парола',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 45,
            'language_id' => 2,
            'content' => 'Запомни ме',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 46,
            'language_id' => 2,
            'content' => 'Забравили сте Вашата парола?',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 47,
            'language_id' => 2,
            'content' => 'Име',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 48,
            'language_id' => 2,
            'content' => 'Потвърди паролата',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 49,
            'language_id' => 2,
            'content' => 'Публикувано от',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 50,
            'language_id' => 2,
            'content' => 'Създай отговор',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 51,
            'language_id' => 2,
            'content' => 'Избери дискусия',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 52,
            'language_id' => 2,
            'content' => 'Редактирай отговор',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 53,
            'language_id' => 2,
            'content' => 'Създай дискусия',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 54,
            'language_id' => 2,
            'content' => 'Тема',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 55,
            'language_id' => 2,
            'content' => 'Избери тема',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 56,
            'language_id' => 2,
            'content' => 'Публикувано на',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 57,
            'language_id' => 2,
            'content' => 'от',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 58,
            'language_id' => 2,
            'content' => 'Създай етикет',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 59,
            'language_id' => 2,
            'content' => 'Системно име',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 60,
            'language_id' => 2,
            'content' => 'Редактирай етикет',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 61,
            'language_id' => 2,
            'content' => 'Редактирай дискусия',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 62,
            'language_id' => 2,
            'content' => 'Дефолтен език',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 63,
            'language_id' => 2,
            'content' => 'Преводи',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 64,
            'language_id' => 2,
            'content' => 'Език',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 65,
            'language_id' => 2,
            'content' => 'Няма преводи за този обект.',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 66,
            'language_id' => 2,
            'content' => 'Добави превод',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 67,
            'language_id' => 2,
            'content' => 'Запази този превод',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 68,
            'language_id' => 2,
            'content' => 'Редактиране на превод',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 69,
            'language_id' => 2,
            'content' => 'Добави превод на ',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 70,
            'language_id' => 2,
            'content' => 'Изтрий ',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 71,
            'language_id' => 2,
            'content' => ' превод',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 72,
            'language_id' => 2,
            'content' => 'Създай роля',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 73,
            'language_id' => 2,
            'content' => 'Права',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 74,
            'language_id' => 2,
            'content' => 'Избери разрешение, което да добавиш',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 75,
            'language_id' => 2,
            'content' => 'Няма разрешение за тази роля.',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 76,
            'language_id' => 2,
            'content' => 'Редактирай роля',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 77,
            'language_id' => 2,
            'content' => 'Няма права за това разрешение.',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 78,
            'language_id' => 2,
            'content' => 'Избери право, което да добавиш',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 79,
            'language_id' => 2,
            'content' => 'Редактирай разрешение',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 80,
            'language_id' => 2,
            'content' => 'Описание',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 81,
            'language_id' => 2,
            'content' => 'Редактирай право',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 82,
            'language_id' => 2,
            'content' => 'Създай право',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 83,
            'language_id' => 2,
            'content' => 'Създай разрешение',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 84,
            'language_id' => 2,
            'content' => 'Статус',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 85,
            'language_id' => 2,
            'content' => 'Активен',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 86,
            'language_id' => 2,
            'content' => 'Неактивен',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 87,
            'language_id' => 2,
            'content' => 'Търсене по статус',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 88,
            'language_id' => 2,
            'content' => 'От',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 89,
            'language_id' => 2,
            'content' => 'До',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 90,
            'language_id' => 2,
            'content' => 'Търси по име',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 91,
            'language_id' => 2,
            'content' => 'Търси по автор',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 92,
            'language_id' => 2,
            'content' => 'Търси по съдържание',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 93,
            'language_id' => 2,
            'content' => 'Търси по публикация',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 94,
            'language_id' => 2,
            'content' => 'Търси по системно име',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 95,
            'language_id' => 2,
            'content' => 'Търси по дефолтно съдържание',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 96,
            'language_id' => 2,
            'content' => 'Редактирай канал',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 97,
            'language_id' => 2,
            'content' => 'Създай канал',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 98,
            'language_id' => 2,
            'content' => 'Слъг',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 99,
            'language_id' => 2,
            'content' => 'Създай език',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 100,
            'language_id' => 2,
            'content' => 'Редактирай език',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 101,
            'language_id' => 2,
            'content' => 'Кратко име',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 102,
            'language_id' => 2,
            'content' => 'Роли',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 103,
            'language_id' => 2,
            'content' => 'Редактиране на потребител',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 104,
            'language_id' => 2,
            'content' => 'Създай нов потребител',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 105,
            'language_id' => 2,
            'content' => 'Добави роля',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 106,
            'language_id' => 2,
            'content' => 'Потребителят няма роли',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 107,
            'language_id' => 2,
            'content' => 'Потребителят няма разрешения',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 108,
            'language_id' => 2,
            'content' => 'Търси по име',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 109,
            'language_id' => 2,
            'content' => 'Имейл потвърждение',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 110,
            'language_id' => 2,
            'content' => 'Потвърден',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 111,
            'language_id' => 2,
            'content' => 'Не потвърден',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 112,
            'language_id' => 2,
            'content' => 'Имейл',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 113,
            'language_id' => 2,
            'content' => 'Търсене по имейл',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 114,
            'language_id' => 2,
            'content' => 'Всички',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 115,
            'language_id' => 2,
            'content' => 'Търси по роля',
        ]);

        DB::table('label_translations')->insert([
            'label_id' => 115,
            'language_id' => 2,
            'content' => 'Търси по разрешение',
        ]);
    }
}
