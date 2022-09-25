<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class checksubplancontroller extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        DB::table('sub_plan_fund_detail_table')
        ->where("sub_plan_fund_detail_id", '=', $request -> checkid)
        ->update([
            'status_id' => 2
        ]);
        $sub_plan_fund_detail_id = $request -> checkid;
        $fund_detail_id = DB::table('sub_plan_fund_detail_table')
        ->where("sub_plan_fund_detail_id", '=', $sub_plan_fund_detail_id)
        ->select('sub_plan_fund_detail_table.fund_detail_id')
        ->first()
        ->fund_detail_id;
        
        $fund_id = DB::table('sub_plan_fund_detail_table')
        ->join('sub_plan_fund_table', 'sub_plan_fund_detail_table.fund_detail_id', '=', 'sub_plan_fund_table.fund_detail_id')
        ->where("sub_plan_fund_detail_id", '=', $sub_plan_fund_detail_id)
        ->select('sub_plan_fund_table.fund_id')
        ->first()
        ->fund_id;
        $est = DB::table('sub_plan_fund_detail_table')
        ->where("fund_detail_id", '=', $fund_detail_id)
        ->where("status_id", '=', 1)
        ->sum('amount');
        $rei = DB::table('sub_plan_fund_detail_table')
        ->where("fund_detail_id", '=', $fund_detail_id)
        ->where("status_id", '=', 2)
        ->sum('amount');
        
        DB::table('sub_plan_fund_table')
        ->where("fund_detail_id", '=', $fund_detail_id)
        ->update([
            'estimated_amount' => $est,
            'reimburse' => $rei,
        ]);
        /* assets預估金額更新 */
        $asset_est = DB::table('sub_plan_fund_table')
        ->where("fund_id", '=', $fund_id)
        ->sum('estimated_amount');

        $asset_rei = DB::table('sub_plan_fund_table')
        ->where("fund_id", '=', $fund_id)
        ->sum('reimburse');

        DB::table('assets')
        ->where("fund_id", '=', $fund_id)
        ->update([
            'estimated_amount' => $asset_est,
            'reimburse' => $asset_rei,
        ]);
        return $fund_detail_id;
    }
}
