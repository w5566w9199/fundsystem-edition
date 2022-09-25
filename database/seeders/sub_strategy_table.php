<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sub_strategy_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('sub_strategy_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'A1',
            'sub_project'=>'提升學生學習及就業能力',
            'sub_strategy'=>'推動產業職能基準課程、證照與職能診斷',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'A2',
            'sub_project'=>'培養學生跨育及創新功能',
            'sub_strategy'=>'引導跨域學習，培養學生創新創業思維',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'A3',
            'sub_project'=>'強化學生程式及語文功能',
            'sub_strategy'=>'推動新雙語技能通識，中英文與程式並行',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'A4',
            'sub_project'=>'完善教學支援系統改善教學品質',
            'sub_strategy'=>'促進多元發展成長，建構教師職涯發展路徑',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'A5',
            'sub_project'=>'活用校務研究治理及回饋機制',
            'sub_strategy'=>'持續蒐集分析校務實證資訊以提供決策改善依據',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'B1',
            'sub_project'=>'活化及持續建置跨域教學及實踐場域',
            'sub_strategy'=>'活化跨領域教學學院及創新思考實踐場域',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'B2',
            'sub_project'=>'推動新南向跨域國際交流',
            'sub_strategy'=>'推動新南向研習營隊，拓展跨境合作視野',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'C1',
            'sub_project'=>'完善經濟或文化不力學生協助機制促進社會流動',
            'sub_strategy'=>'協助經濟或文化不利學生提升競爭力並落實其生活及學習輔導扶助、推動公益專班並輔導其考取專業證照以強化其就業競爭力',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'C2',
            'sub_project'=>'建置校務資訊公開制度',
            'sub_strategy'=>'依據大專校院校務及財務資訊公開內容架構表逐項公開各項校務資訊',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'C3',
            'sub_project'=>'健全校內原民學生支援體系',
            'sub_strategy'=>'協助原民學生提升競爭力並落實其生活及學習輔導扶助',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'D1',
            'sub_project'=>'提升社會實踐之貢獻度',
            'sub_strategy'=>'定位及建立全校性社會實踐生態系及激勵措施',
        ]);
        DB::table('sub_strategy_table')->insert([
            'sub_item_id'=>'D2',
            'sub_project'=>'提升在地或社會之貢獻度',
            'sub_strategy'=>'與在地或偏鄉結合共同關心永續議題與未來發展',
        ]);
    }
}
