<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class LoadScrollController extends Controller
{
    //
    public function index()
    {
        $rows = DB::table('sub_plan_fund_detail_table')
            ->join('sub_plan_fund_table', 'sub_plan_fund_detail_table.fund_detail_id', '=', 'sub_plan_fund_table.fund_detail_id')
            ->join('sub_strategy_id_table', 'sub_plan_fund_table.sub_id', '=', 'sub_strategy_id_table.sub_id')
            ->join('sub_strategy_table', 'sub_strategy_id_table.sub_item_id', '=', 'sub_strategy_table.sub_item_id')
            ->join('implementation_matter_table', 'sub_plan_fund_table.implementation_matter_id', '=', 'implementation_matter_table.implementation_matter_id')
            ->join('users', 'implementation_matter_table.founder', '=', 'users.id')
            ->join('assets', 'sub_plan_fund_table.fund_id', '=', 'assets.fund_id')
            ->join('fund_name_table', 'assets.fund_name_id', '=', 'fund_name_table.fund_name_id')
            ->join('plan_table', 'assets.plan_id', '=', 'plan_table.plan_id')
            ->join('school_table', 'implementation_matter_table.dep_id', '=', 'school_table.dep_id')
            ->select('sub_plan_fund_detail_table.*', 'sub_plan_fund_table.fund_item', 'users.name', 'sub_strategy_id_table.*', 'sub_strategy_table.*', 'plan_table.plan_name', 'fund_name_table.fund_name', 'school_table.department')
            ->orderBy('sub_plan_fund_detail_table.created_at', 'DESC')
            ->offset(0)->limit(31)
            ->get();
        $deps = DB::table('school_table')->get();
        return $rows;
    }
}
