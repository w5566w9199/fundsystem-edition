<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class status_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('status_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('status_table')->insert([
            'status'=>'審核中',
        ]);
        DB::table('status_table')->insert([
            'status'=>'審核完畢',
        ]);
    }
}
