<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['id'=>0,'name'=>'user']);
        DB::table('roles')->insert(['id'=>1,'name'=>'moderator']);
        DB::table('roles')->insert(['id'=>0,'name'=>'administrator']);
    }
}
