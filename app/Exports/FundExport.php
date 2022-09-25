<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
class FundExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tmps = DB::table('implementation_matter_table')
        ->join('sub_plan_fund_table', 'implementation_matter_table.implementation_matter_id', '=', 'sub_plan_fund_table.implementation_matter_id')
        ->join('sub_plan_fund_detail_table', 'sub_plan_fund_table.fund_detail_id', '=', 'sub_plan_fund_detail_table.fund_detail_id')
        ->join('assets', 'sub_plan_fund_table.fund_id', '=', 'assets.fund_id')
        ->join('fund_name_table', 'assets.fund_name_id', '=', 'fund_name_table.fund_name_id')
        ->join('plan_table', 'assets.plan_id', '=', 'plan_table.plan_id')
        ->join('sub_strategy_id_table', 'sub_plan_fund_table.sub_id', '=', 'sub_strategy_id_table.sub_id')
        ->join('school_table', 'implementation_matter_table.dep_id', '=', 'school_table.dep_id')
        ->join('status_table', 'sub_plan_fund_detail_table.status_id','=','status_table.status_id')
        ->select(
                // 'sub_strategy_id_table.sub_item_id',#分項(A1)
                // 'sub_strategy_id_table.sub_num',#分項(0)
                DB::raw('CONCAT(sub_item_id,"-",sub_num) as test'),#分項A1-1
                'assets.assets_item',#經費來源(111執行)
                'fund_name_table.fund_name',#經費種類(人事費)
                'school_table.academy',#申請學院
                'school_table.department',#申請處室
                'implementation_matter_table.applicant as imp_table_applicant',#申請人
                'implementation_matter_table.letter_num',#簽呈編號
                'implementation_matter_table.implementation_matter_name',#簽呈主旨
                'implementation_matter_table.remark as imp_remark',#簽呈備註
                'sub_plan_fund_table.estimated_amount',#未核銷金額
                'sub_plan_fund_table.reimburse',#已核銷金額
                'sub_plan_fund_table.amount as sub_plan_amount',#簽呈總金額
                'sub_plan_fund_table.remark as sub_plan_remark',#簽呈經費備註
                // '',#總金額
                // '',#執行率
                'sub_plan_fund_detail_table.requisition_num',#請購單號
                'sub_plan_fund_detail_table.category',#請購類別
                'sub_plan_fund_detail_table.abstract',#請購摘要
                'sub_plan_fund_detail_table.amount as sub_plan_detail_amount',#核銷金額
                'status_table.status',#核銷狀態
                'sub_plan_fund_detail_table.created_at',#日期
                'sub_plan_fund_detail_table.applicant as sub_plan_detail_applicant',#請購單申請人
                )
        ->orderBy('sub_strategy_id_table.sub_item_id')
        ->get();
        return $tmps;
    }
    
    public function headings(): array
    {
        return ["執行計畫(分項)", "經費來源","經費種類", "申請學院", "申請處室","申請人","簽呈編號","簽呈主旨","簽呈備註","未核銷金額","已核銷金額","簽呈總金額","簽呈經費備註","請購單號","請購類別","請購摘要","核銷金額","核銷狀態","日期","請購單申請人"];
        // return ["執行計畫(分項)", "經費來源","經費種類", "申請學院", "申請處室","申請人","簽呈編號","簽呈主旨","簽呈備註","未核銷金額","已核銷金額","簽呈總金額","簽呈經費備註","總金額","執行率","請購單號","請購類別","請購摘要","核銷金額","核銷狀態","請購建立日期","請購單申請人"];
    }
}
