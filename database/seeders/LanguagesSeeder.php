<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $insert_data = [
            [
                'locale' => 'en-US',
                'prefix' => 'en'
            ],[
                'locale' => 'uk-UA',
                'prefix' => 'ua'
            ],[
                'locale' => 'ru-RU',
                'prefix' => 'ru'
            ]
        ];

        DB::table('languages')->insert($insert_data);
    }
}
