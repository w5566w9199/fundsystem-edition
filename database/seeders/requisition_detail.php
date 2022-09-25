<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class requisition_detail extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('requisition_detail')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('requisition_detail')->insert([
            'requisition_num'=>'00000-0001-123',
            'indicator'=>"外聘講師鐘點費",
            'quantity'=>15,
            'unit'=>"時",
            'price'=>100,
            'remark' => '無'
        ]);
        DB::table('requisition_detail')->insert([
            'requisition_num'=>'00000-0001-456',
            'indicator'=>'補充保費',
            'quantity'=>1,
            'unit'=>'式',
            'price'=>633,
            'remark' => '無'
        ]);
        DB::table('requisition_detail')->insert([
            'requisition_num'=>'00000-0001-123',
            'indicator'=>'膳費',
            'quantity'=>200,
            'unit'=>'人次',
            'price'=>80,
            'remark' => '無'
        ]);
    }
}
