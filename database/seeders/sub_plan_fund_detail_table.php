<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sub_plan_fund_detail_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('sub_plan_fund_detail_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('sub_plan_fund_detail_table')->insert([
            'remark'=>"
            預計：
                110年8月召開高教深耕計畫職能專業課程發展補助說明會。
                110/10月份辦理職能課程實務工作坊『分析/設計』階段6小時。
                110/10月份辦理職能課程實務工作坊『實施/評估』階段6小時。",
            'requisition_num'=>'00000-0001-123',
            'status_id'=>1,
            'fund_detail_id'=>1,
            'amount' => 1500,
        ]);
        // DB::table('sub_plan_fund_detail_table')->insert([
        //     'remark'=>
        //     '辦理說明會及工作坊之講師鐘點費為30,000元，其二代健保為630元。',
        //     'requisition_num'=>'00000-0001-456',
        //     'status_id'=>1,
        //     'amount' => 633,
        //     'fund_detail_id'=>2,
        // ]);
        // DB::table('sub_plan_fund_detail_table')->insert([
        //     'remark'=>
        //     '˙說明會預計60人次。
        //     ˙工作坊預計各50人次
        //     ˙職能團隊定期會議預計40人次。',
        //     'requisition_num'=>'00000-0001-133',
        //     'status_id'=>1,
        //     'amount' => 16000,
        //     'fund_detail_id'=>3,
        // ]);
    }
}
