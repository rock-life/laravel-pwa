<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class artist extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artist')->insert(['name'=>'Океан Ельзи']);
        DB::table('artist')->insert(['name'=>'Фліт']);
        DB::table('artist')->insert(['name'=>'Тінь Сонця']);
    }
}
