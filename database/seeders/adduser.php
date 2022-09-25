<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class adduser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::table('users')->insert([
            'account'=> 'aa',
            'password'=>'$2y$10$qvnJdTDTr59mmeTTTuEa4OoiirlgEjyeJKgHv6SXw6393wLFJSyAm',
            'name'=>'測試1',
            'office'=>'123',
            'phone'=>'465654',
            'status'=>'1',
            'ext'=>'123',
            'role'=>'admin',
            'email'=>'a@a.a',
        ]);
    }
}
