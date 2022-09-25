<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class school_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('school_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        /****************商學院**************/
        // DB::table('school_table')->insert([
        //     'academy'=>'商學院',
        //     'department'=>'國際貿易與經營系',
        // ]);
        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'國際貿易與經營系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'會計資訊系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'保險金融管理系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'企業管理系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'財政稅務系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'財務金融系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'應用統計系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'休閒事業經營系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'商業智慧應用與研究中心',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'商學院',
            'department'=>'企管系_智慧及創新營運技優領航專班',
        ]);
        /****************設計學院**************/
        DB::table('school_table')->insert([
            'academy'=>'設計學院',
            'department'=>'商業設計系',
        ]);
        DB::table('school_table')->insert([
            'academy'=>'設計學院',
            'department'=>'多媒體設計系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'設計學院',
            'department'=>'室內設計系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'設計學院',
            'department'=>'創意商品設計系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'設計學院',
            'department'=>'設計服務中心',
        ]);

        /****************資訊與流通學院**************/
        DB::table('school_table')->insert([
            'academy'=>'資訊與流通學院',
            'department'=>'資訊管理系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'資訊與流通學院',
            'department'=>'資訊工程系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'資訊與流通學院',
            'department'=>'流通管理系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'資訊與流通學院',
            'department'=>'資訊創新應用與服務中心',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'資訊與流通學院',
            'department'=>'人工智慧應用工程學士學位學程',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'資訊與流通學院',
            'department'=>'資訊管理系_技優領航專班',
        ]);
        /****************語文學院**************/

        DB::table('school_table')->insert([
            'academy'=>'語文學院',
            'department'=>'應用日語系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'語文學院',
            'department'=>'應用英語系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'語文學院',
            'department'=>'應用中文系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'語文學院',
            'department'=>'日本研究中心',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'語文學院',
            'department'=>'應用資訊日語技優領航專班',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'語文學院',
            'department'=>'應用中文系_多元敘事專才技優領航專班',
        ]);
        /****************中護健康學院**************/

        DB::table('school_table')->insert([
            'academy'=>'中護健康學院',
            'department'=>'護理系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'中護健康學院',
            'department'=>'美容系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'中護健康學院',
            'department'=>'老人服務事業管理系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'中護健康學院',
            'department'=>'健康產研中心',
        ]);
        DB::table('school_table')->insert([
            'academy'=>'中護健康學院',
            'department'=>'美容系_美容菁英技優領航專班',
        ]);
        /****************全人教育委員會**************/

        DB::table('school_table')->insert([
            'academy'=>'全人教育委員會',
            'department'=>'通識教育中心',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'全人教育委員會',
            'department'=>'語言中心',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'全人教育委員會',
            'department'=>'體育室',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'全人教育委員會',
            'department'=>'任務編組',
        ]);
        /****************智慧產業學院**************/

        DB::table('school_table')->insert([
            'academy'=>'智慧產業學院',
            'department'=>'商業經營系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'智慧產業學院',
            'department'=>'智慧生產工程系',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'智慧產業學院',
            'department'=>'智慧生產工程系_智慧生產工程技術技優領航專班',
        ]);

        /****************職涯及諮商輔導中心**************/

        DB::table('school_table')->insert([
            'academy'=>'職涯及諮商輔導中心',
            'department'=>'實習與就業輔導組',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'職涯及諮商輔導中心',
            'department'=>'諮商輔導組',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'職涯及諮商輔導中心',
            'department'=>'服務學習輔導組',
        ]);

        /****************研究發展處**************/

        DB::table('school_table')->insert([
            'academy'=>'研究發展處',
            'department'=>'學術發展組',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'研究發展處',
            'department'=>'產學合作組',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'研究發展處',
            'department'=>'校務企劃組',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'研究發展處',
            'department'=>'產研中心',
        ]);

        DB::table('school_table')->insert([
            'academy'=>'研究發展處',
            'department'=>'創新育成中心',
        ]);
        /****************軍訓室**************/
        DB::table('school_table')->insert([
            'academy'=>'研究發展處',
            'department'=>'創新育成中心',
        ]);
        /****************高教職能**************/
        DB::table('school_table')->insert([
            'academy'=>'高教職能',
            'department'=>'高教職能',
        ]);
    }
}
