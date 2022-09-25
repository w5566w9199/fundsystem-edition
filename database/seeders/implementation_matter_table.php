<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class implementation_matter_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('implementation_matter_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('implementation_matter_table')->insert([
            'implementation_matter_name'=>'A1-學涯及職涯規劃與職能診斷諮詢輔導成效',
            'supplement'=>'補充說明',
            'director'=>'主管',
            'dep_id'=>1,
            'founder'=>1,
            'letter_num'=>'123456789',
            'remark'=>'無',
            'applicant' => '輸入人',
        ]);
    }
}
