<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genre')->insert([ 'name' => 'ПОП' ]);
        DB::table('genre')->insert([ 'name' => 'РОК' ]);
        DB::table('genre')->insert([ 'name' => 'ХІП ХОП' ]);
        DB::table('genre')->insert([ 'name' => 'РЕП' ]);
        DB::table('genre')->insert([ 'name' => 'R & В' ]);
        DB::table('genre')->insert([ 'name' => 'ДЖАЗ' ]);
        DB::table('genre')->insert([ 'name' => 'НАРОДНА МУЗИКА' ]);
        DB::table('genre')->insert([ 'name' => 'ЕЛЕКТРО' ]);
        DB::table('genre')->insert([ 'name' => 'ПАТРІОТИЧНІ' ]);
        DB::table('genre')->insert([ 'name' => 'НОВОРІЧНІ' ]);
        DB::table('genre')->insert([ 'name' => 'РОМАНТИЧНІ' ]);
    }
}
