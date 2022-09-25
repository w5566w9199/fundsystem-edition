<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class assets extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        1業務費
        2人事費
        3補助款資本門
        4配合款
        */
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('assets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('assets')->insert([
            'fund_name_id'=> 2,
            'plan_id'=>1,
            'assets_item'=>'第一部分',
            'amount'=>9500000,
            'remark'=>'無',
        ]);
        DB::table('assets')->insert([
            'fund_name_id'=> 1,
            'plan_id'=>1,
            'assets_item'=>'第一部分',
            'amount'=>12600000,
            'remark'=>'無',
        ]);
        DB::table('assets')->insert([
            'fund_name_id'=> 3,
            'plan_id'=>1,
            'assets_item'=>'第一部分',
            'amount'=>25100000,
            'remark'=>'無',
        ]);
        DB::table('assets')->insert([
            'fund_name_id'=> 4,
            'plan_id'=>1,
            'assets_item'=>'第一部分',
            'amount'=>502000,
            'estimated_amount'=>1500,
            'remark'=>'無',
        ]);
        // DB::table('assets')->insert([
        //     'fund_name_id'=> 2,
        //     'plan_id'=>1,
        //     'assets_item'=>'USR',
        //     'amount'=>1095524,
        //     'remark'=>'無',
        // ]);
        // DB::table('assets')->insert([
        //     'fund_name_id'=> 1,
        //     'plan_id'=>1,
        //     'assets_item'=>'USR',
        //     'amount'=>1404476,
        //     'remark'=>'無',
        // ]);
        // DB::table('assets')->insert([
        //     'fund_name_id'=> 3,
        //     'plan_id'=>1,
        //     'assets_item'=>'USR',
        //     'amount'=>0,
        //     'remark'=>'無',
        // ]);
        // DB::table('assets')->insert([
        //     'fund_name_id'=> 4,
        //     'plan_id'=>1,
        //     'assets_item'=>'USR',
        //     'amount'=>1000000,
        //     'remark'=>'無',
        // ]);
    }
}
