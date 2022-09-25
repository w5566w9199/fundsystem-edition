<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fund_name_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('fund_name_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('fund_name_table')->insert([
            'fund_name'=>'人事費',
        ]);
        DB::table('fund_name_table')->insert([
            'fund_name'=>'業務費',
        ]);
        DB::table('fund_name_table')->insert([
            'fund_name'=>'資本門',
        ]);
        DB::table('fund_name_table')->insert([
            'fund_name'=>'配合款',
        ]);
    }
}
