<?php

namespace App\Http\Controllers;

use App\Models\fund_table;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class fund_tablecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $planname = DB::table('assets')->select('assets.*')->get();

        $funds = DB::table('plan_table')
                    ->join('assets', 'plan_table.plan_id', '=', 'assets.plan_id')
                    ->join('fund_name_table', 'assets.fund_name_id', '=', 'fund_name_table.fund_name_id')
                    ->select('plan_table.plan_name', 'assets.*', 'fund_name_table.fund_name')
                    ->orderBy('fund_id')
                    ->get();
        foreach ($funds as $fund){
            $fund->estimated_amount=DB::table('sub_plan_fund_table')
                ->join('sub_plan_fund_detail_table','sub_plan_fund_table.fund_detail_id','=','sub_plan_fund_detail_table.fund_detail_id')
                ->where('sub_plan_fund_table.fund_id','=',$fund->fund_id)
                ->where('sub_plan_fund_detail_table.status_id','=',1)
                ->sum('sub_plan_fund_detail_table.amount');
                $fund->reimburse=DB::table('sub_plan_fund_table')
                ->join('sub_plan_fund_detail_table','sub_plan_fund_table.fund_detail_id','=','sub_plan_fund_detail_table.fund_detail_id')
                ->where('sub_plan_fund_table.fund_id','=',$fund->fund_id)
                ->where('sub_plan_fund_detail_table.status_id','=',2)
                ->sum('sub_plan_fund_detail_table.amount');
            // $fund->reimburse=DB::select('SELECT amount from `sub_plan_fund_detail_table` WHERE `fund_detail_id` = ANY(SELECT fund_detail_id FROM `sub_plan_fund_table` WHERE fund_id = 1) AND status_id = 2');
        }
        return Inertia::render('fundtable/index', compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('fundtable/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
        'plan_name' => ['required', 'max:255', 'unique:plan_table,plan_name'],
        'asset_item' => ['required', 'max:255'],
        'fund_name_1' => ['required', 'integer'],
        'fund_name_2' => ['required', 'integer'],
        'fund_name_3' => ['required', 'integer'],
        'start_date' => ['date', 'before:end_date'],
        'end_date' => ['date', 'after:start_date'],
        ])->validate();
        DB::table('plan_table')->insert([
                'plan_name' =>$request['plan_name'],
                'start_date' =>$request['start_date'],
                'end_date' =>$request['end_date'],
                'remark' =>$request['remark'],
            ]);
        $plan_id = DB::table('plan_table')->select('plan_id')->where("plan_name", '=', $request->plan_name)->first()->plan_id;
        DB::table('assets')->insert([
            'fund_name_id' => 1,
            'plan_id' =>$plan_id,
            'assets_item' =>$request['asset_item'],
            'amount' =>$request['fund_name_1'],
        ]);
        DB::table('assets')->insert([
            'fund_name_id' =>2,
            'plan_id' =>$plan_id,
            'assets_item' =>$request['asset_item'],
            'amount' =>$request['fund_name_2'],
        ]);
        DB::table('assets')->insert([
            'fund_name_id' =>3,
            'plan_id' =>$plan_id,
            'assets_item' =>$request['asset_item'],
            'amount' =>$request['fund_name_3'],
        ]);
        DB::table('assets')->insert([
            'fund_name_id' =>4,
            'plan_id' =>$plan_id,
            'assets_item' =>$request['asset_item'],
            'amount' =>$request['fund_name_4'],
        ]);
        return Redirect::route('fund_table.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fund_table  $fund_table
     * @return \Illuminate\Http\Response
     */
    public function show(fund_table $fund_table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fund_table  $fund_table
     * @return \Illuminate\Http\Response
     */
    public function edit(fund_table $fund_table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fund_table  $fund_table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, fund_table $fund_table)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fund_table  $fund_table
     * @return \Illuminate\Http\Response
     */
    public function destroy(fund_table $fund_table)
    {
        //
    }
}
