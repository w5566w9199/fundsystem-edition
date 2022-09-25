<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class LoadFundController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dep_id = $request -> depid;
        $rows = DB::table('implementation_matter_table')
        ->where("dep_id", '=', $dep_id)
        ->join('sub_plan_fund_table', 'implementation_matter_table.implementation_matter_id', '=', 'sub_plan_fund_table.implementation_matter_id')
        ->join('assets', 'sub_plan_fund_table.fund_id', '=', 'assets.fund_id')
        ->join('sub_strategy_id_table', 'sub_plan_fund_table.sub_id', '=', 'sub_strategy_id_table.sub_id')
        ->join('sub_strategy_table', 'sub_strategy_id_table.sub_item_id', '=', 'sub_strategy_table.sub_item_id')
        ->join('fund_name_table', 'assets.fund_name_id', '=', 'fund_name_table.fund_name_id')
        ->join('plan_table', 'assets.plan_id', '=', 'plan_table.plan_id')
        ->select('implementation_matter_table.*', 'assets.*', 'fund_name_table.*', 'sub_plan_fund_table.fund_item', 'sub_plan_fund_table.fund_detail_id', 'plan_table.*','sub_strategy_id_table.*','sub_strategy_table.*','sub_plan_fund_table.amount')
        ->orderBy('sub_strategy_id_table.sub_item_id')
        ->orderBy('sub_strategy_id_table.sub_num')
        ->orderBy('implementation_matter_table.letter_num')
        ->get();
        return $rows;
    }
}
