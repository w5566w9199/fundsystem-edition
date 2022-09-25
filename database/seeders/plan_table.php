<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class plan_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('plan_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('plan_table')->insert([
            'plan_name'=>'高等教育深耕計畫',
            'start_date'=>'2019-01-01',
            'end_date'=>'2020-01-01',
            'remark'=>'無',
        ]);
    }
}