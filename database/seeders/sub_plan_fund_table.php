<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sub_plan_fund_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('sub_plan_fund_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('sub_plan_fund_table')->insert([
            'fund_item'=>'禮卷',
            'fund_id'=>4,
            'implementation_matter_id'=>1,
            'amount'=>'10000',
            'estimated_amount'=>1500,
            'remark'=>'無',
            'sub_id'=>1,
        ]);
        // DB::table('sub_plan_fund_table')->insert([
        //     'fund_item'=>'審查費',
        //     'fund_id'=>4,
        //     'implementation_matter_id'=>1,
        //     'amount'=>'48600',
        //     'estimated_amount'=>48600,
        //     'remark'=>'無',
        //     'sub_id'=>2,
        // ]);
        // DB::table('sub_plan_fund_table')->insert([
        //     'fund_item'=>'印刷費',
        //     'fund_id'=>4,
        //     'implementation_matter_id'=>1,
        //     'amount'=>'8000',
        //     'remark'=>'無',
        //     'sub_id'=>3,
        // ]);
    }
}
