<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class form_of_writing extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_of_writing')->insert([ 'name' => 'Акорди', 'value' => 'chords']);
        DB::table('form_of_writing')->insert(['name' => 'Таби для гітари', 'value' => 'tabs']);
        DB::table('form_of_writing')->insert(['name' => 'Нотний розбір', 'value' => 'notes']);
    }
}
