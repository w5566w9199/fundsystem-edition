<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class indicator_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('indicator_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('indicator_table')->insert([
            'indicator_ioriented'=>'A1-3依職能基準導向檢核課程並回饋發展精進教學成效',
        ]);
    }
}
