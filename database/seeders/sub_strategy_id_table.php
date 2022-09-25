<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sub_strategy_id_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('sub_strategy_id_table')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'A1',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'A1',
            'emphasis'=>'聚焦教育部公告之各中央目的事業主管機關核發、委託、認證或認可證照，設立獎勵辦法，鼓勵並輔導學生考取所核可之相關證照。優化系所「技術實務特色」課程，重視技術實務表現的學習評量，並輔佐學生參與競賽，累積專業實務競爭力。',
            'target'=>'學生專業實務技術能力提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>2,
            'sub_item_id'=>'A1',
            'emphasis'=>'持續推廣職能種子師資認證研習使教師能具備教學策略設計與訓練成效評估職能進而發展以學生為中心之翻轉課堂創新課程',
            'target'=>'教師推動創新教學成效之提升',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>3,
            'sub_item_id'=>'A1',
            'emphasis'=>'依產業基準檢討並發展與就業銜接為導向之職能專業課程',
            'target'=>'依職能基準導向檢核課程並回饋發展精進教學成效(自訂)',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>4,
            'sub_item_id'=>'A1',
            'emphasis'=>'學涯及職涯定向推動學習歷程及職能落差診斷輔導',
            'target'=>'學涯及職涯規劃與職能診斷諮詢輔導成效(自訂)',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>5,
            'sub_item_id'=>'A1',
            'emphasis'=>'推動最後一哩產學接軌之校外實習',
            'target'=>'提升學生校外實習參與成效(自訂)',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'A2',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'A2',
            'emphasis'=>'持續導入以學院為核心之跨領域及問題導向學習課程及學程模組',
            'target'=>'學生跨域學習能力提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>2,
            'sub_item_id'=>'A2',
            'emphasis'=>'持續推動創新管理及專題製作等必修課程以培養學生創新創業思維',
            'target'=>'開設創新創業課程及學生學習成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'A3',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'A3',
            'emphasis'=>'持續推動開設程式設計技能通識型必修課程以培養學生資訊能力',
            'target'=>'學生運算思維與程式設計能力提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>2,
            'sub_item_id'=>'A3',
            'emphasis'=>'持續推動全民中檢及中文能力雲端診斷系統並鏈結國語文核心通識課程',
            'target'=>'學生中文閱讀寫作能力提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>3,
            'sub_item_id'=>'A3',
            'emphasis'=>'導入專業英文能力認證並維持職場英文畢業門檻以推動職場及專業英文雙模認證模式',
            'target'=>'學生專業(職場)外語能力提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'A4',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'A4',
            'emphasis'=>'逐年聘任具實務經驗或產學績效之專任教師並推動以學院為本位之聘任模式',
            'target'=>'優畫師資質量及改善生師比推動成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>2,
            'sub_item_id'=>'A4',
            'emphasis'=>'依技術及職業教育法持續推動並協助教師進行產業研習或研究',
            'target'=>'專任教師業界實務經驗提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>3,
            'sub_item_id'=>'A4',
            'emphasis'=>'持續聘請曾於國際技能競賽獲獎之選手或業界技術精湛之大師擔任教學人員或專業實作之指導人員',
            'target'=>'專業及技術教師比率提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>4,
            'sub_item_id'=>'A4',
            'emphasis'=>'持續推動教師多元升等、教師社群、新進教師輔導、教師評鑑追蹤輔導等機制',
            'target'=>'完善教師教學支持系統',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'A5',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'A5',
            'emphasis'=>'持續擴建與活用校務研究專業管理制度',
            'target'=>'建置校務研究專業管理制度(IR)並回饋招生選才及精進教學成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>2,
            'sub_item_id'=>'A5',
            'emphasis'=>'持續建置與活用畢業生流向追蹤機制，並分析流向追蹤情形',
            'target'=>'畢業生之投入職場比率提升成效、建置校內畢業生流向追蹤機制並回饋精進教學成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'B1',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'B1',
            'emphasis'=>'活化三創交流實驗場域以推動提供創意及社會創新實踐，打造青年創意平臺，並持續擴增特色實驗場域。',
            'target'=>'提升創新創意交流場域的使用率並提升學生虛實整合經營能力(自訂)',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>2,
            'sub_item_id'=>'B1',
            'emphasis'=>'提升YSBC尤努斯社會企業研究中心之效用，結合YSBC培訓資源，並以Design Lab 創業實驗室模式推動創新創業幸福園，打造青年創業平臺',
            'target'=>'社會企業設計思考中心暨創業實驗室輔導創業(自訂)',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>3,
            'sub_item_id'=>'B1',
            'emphasis'=>'陸續籌設「智慧生產工程系」、「智慧生產工程產業博士班」等',
            'target'=>'擴增跨域智慧產業學院提升學生智動化能力(自訂)',
        ]);
        
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'B2',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'B2',
            'emphasis'=>'配合新南向政策，與菲律賓國立馬可仕大學共同推動青年國際交流研習營隊及教師交流，拓展跨境合作視野，並持續擴大辦理如東南亞、澳洲等國家，納入更多元之交流國家。',
            'target'=>'推動新南向青年營隊及師資交流以提昇國際多元融合能力(自訂)',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'C1',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'C1',
            'emphasis'=>'提供各項經濟或文化不利學生優先入學、助學與獎助措施，促使安心就學',
            'target'=>'經濟或文化不利學生進入國立技專校院就讀比率逐年提升情形',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>2,
            'sub_item_id'=>'C1',
            'emphasis'=>'提供多重輔導機制與措施及個別化關懷扶助，促使樂在就學',
            'target'=>'經濟或文化不利學生獲得輔導或協助之比率提升成效',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>3,
            'sub_item_id'=>'C1',
            'emphasis'=>'推動英檢及大專生金融就業公益專班並提供證照考照補助及考取獎勵',
            'target'=>'提供經濟或文化不利獎勵補助輔導學生證能合一成效(自訂)',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'C2',
            'emphasis'=>'建構校務資訊公開制度並逐年提高辦學資訊',
            'target'=>'落實辦學公共性之責任，健全學校治理及生師權益保障，並建構校務資訊公開制度並逐年提高辦學資訊公開程度',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'C3',
            'emphasis'=>'建置原資中心及完善運作機制，並提供原住民族學生學習、生活輔導機制(含休、退學改善情形)，建構族群友善校園',
            'target'=>'強化原資中心運作機制，提升原住民族學生輔導成效及建構族群友善校園',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'D1',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'D1',
            'emphasis'=>'有效而持續的校級統合機制、建構認同社會實踐價值的校園協作生態系統及完善隊投入社會實踐教師之激勵制度',
            'target'=>'建構完善的大學實踐社會責任校務支持系統',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>0,
            'sub_item_id'=>'D2',
            'emphasis'=>'',
            'target'=>'',
        ]);
        DB::table('sub_strategy_id_table')->insert([
            'sub_num'=>1,
            'sub_item_id'=>'D2',
            'emphasis'=>'結合本校特色，協助在地或偏鄉地區促進優質教育發展、良好健康與福祉及青年返鄉，並透過社會創新與國際鏈結，實踐永續發展',
            'target'=>'連結外部資源協助在地永續發展',
        ]);
    }
}