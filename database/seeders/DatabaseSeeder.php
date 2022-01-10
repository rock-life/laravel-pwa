<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name'=>'user']);
        DB::table('roles')->insert(['name'=>'moderator']);
        DB::table('roles')->insert(['name'=>'administrator']);
    }
}
