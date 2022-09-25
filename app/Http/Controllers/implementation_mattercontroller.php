<?php

namespace App\Http\Controllers;

use App\Models\implementation_matter;
use Database\Seeders\sub_plan_fund_detail_table;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class implementation_mattercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rows = DB::table('implementation_matter_table')
                    ->join('sub_plan_fund_table', 'implementation_matter_table.implementation_matter_id', '=', 'sub_plan_fund_table.implementation_matter_id')
                    // ->join('sub_plan_fund_detail_table', 'sub_plan_fund_table.fund_detail_id', '=', 'sub_plan_fund_detail_table.fund_detail_id')
                    ->join('assets', 'sub_plan_fund_table.fund_id', '=', 'assets.fund_id')
                    ->join('fund_name_table', 'assets.fund_name_id', '=', 'fund_name_table.fund_name_id')
                    ->join('plan_table', 'assets.plan_id', '=', 'plan_table.plan_id')
                    ->join('sub_strategy_id_table', 'sub_plan_fund_table.sub_id', '=', 'sub_strategy_id_table.sub_id')
                    ->join('school_table', 'implementation_matter_table.dep_id', '=', 'school_table.dep_id')
                    ->select('implementation_matter_table.*', 'sub_plan_fund_table.*', 'plan_table.plan_name', 'school_table.*',
                            'fund_name_table.fund_name', 'assets.assets_item', 'sub_strategy_id_table.*')
                    ->orderBy('sub_strategy_id_table.sub_id')
                    ->get();
        foreach ($rows as $row){
            $row -> estimated_amount = DB::table('sub_plan_fund_detail_table')
            ->where([['fund_detail_id','=', $row->fund_detail_id],['status_id','=',1]])
            ->sum('amount');
            $row -> reimburse = DB::table('sub_plan_fund_detail_table')
            ->where([['fund_detail_id','=', $row->fund_detail_id],['status_id','=',2]])
            ->sum('amount');
        }
        $deps = DB::table('school_table')->get();
        return Inertia::render('implementation_matter/index', compact('rows','deps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deps = DB::table('school_table')->get();

        $sub_strategys = DB::table('sub_strategy_id_table')
                    ->join('sub_strategy_table', 'sub_strategy_id_table.sub_item_id', '=', 'sub_strategy_table.sub_item_id')
                    ->select('sub_strategy_table.*', 'sub_strategy_id_table.*')
                    ->orderBy('sub_strategy_id_table.sub_item_id')
                    ->orderBy('sub_strategy_id_table.sub_num')
                    ->get();
        $funds = DB::table('plan_table')
                    ->join('assets', 'plan_table.plan_id', '=', 'assets.plan_id')
                    ->join('fund_name_table', 'assets.fund_name_id', '=', 'fund_name_table.fund_name_id')
                    ->select('plan_table.plan_name', 'assets.*', 'fund_name_table.fund_name')
                    ->orderBy('fund_id')
                    ->get();
        return Inertia::render('implementation_matter/create', compact('funds', 'sub_strategys', 'deps'));
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
            // 'letter_num' => ['required', 'unique:implementation_matter_table,letter_num'],
            'letter_num' => ['required'],
            'implementation_matter' => ['required','string', 'max:255'],
            // 'supplement' => ['required','string', 'max:255'],
            'dep_id' => ['required','integer'],
            'applicant' => ['required','string', 'max:255'],
            // 'director' => ['required','string', 'max:255'],
            'fund_lists' => ['required'],
            ])->validate();

        $userid = Auth::id();
        // $letter_status = DB::table('implementation_matter_table')
        // ->where("letter_num", '=', $request->letter_num)
        // ->exists();
        // if (!$letter_status){
        DB::table('implementation_matter_table')->insert([
            'implementation_matter_name' =>$request['implementation_matter'],
            'supplement' =>$request['supplement'],
            'director' =>$request['director'],
            'remark' =>$request['remark'],
            'applicant' =>$request['applicant'],
            'founder' =>$userid,
            'dep_id' =>$request['dep_id'],
            'letter_num' =>$request['letter_num'],
        ]);
        // }
        $implementation_matter_id = DB::table('implementation_matter_table')
        ->select('implementation_matter_id')
        ->where("letter_num", '=', $request->letter_num)
        ->latest('created_at')
        ->first()
        ->implementation_matter_id;

        foreach (json_decode($request['fund_lists']) as $ff) {
            DB::table('sub_plan_fund_table')->insert([
                'fund_id' => $ff -> fund_id,
                'implementation_matter_id' => $implementation_matter_id,
                'amount' => $ff -> amount,
                'remark' => !empty($ff -> remark) ?  $ff -> remark : "無",
                'sub_id' => $ff -> sub_id,
            ]);
        }
        return Redirect::route('implementation_matter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\implementation_matter  $implementation_matter
     * @return \Illuminate\Http\Response
     */
    public function show(implementation_matter $implementation_matter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\implementation_matter  $implementation_matter
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $deps = DB::table('school_table')->get();
        $sub_strategys = DB::table('sub_strategy_id_table')
                    ->join('sub_strategy_table', 'sub_strategy_id_table.sub_item_id', '=', 'sub_strategy_table.sub_item_id')
                    ->select('sub_strategy_table.*', 'sub_strategy_id_table.*')
                    ->orderBy('sub_strategy_id_table.sub_item_id')
                    ->orderBy('sub_strategy_id_table.sub_num')
                    ->get();
        $funds = DB::table('plan_table')
                    ->join('assets', 'plan_table.plan_id', '=', 'assets.plan_id')
                    ->join('fund_name_table', 'assets.fund_name_id', '=', 'fund_name_table.fund_name_id')
                    ->select('plan_table.plan_name', 'assets.*', 'fund_name_table.fund_name')
                    ->orderBy('fund_id')
                    ->get();
        $row = DB::table('implementation_matter_table')
        ->where('implementation_matter_id','=',$id)
        ->select('implementation_matter_table.*')
        ->get();

        $fund_lists=DB::table('sub_plan_fund_table')
        ->where('implementation_matter_id','=',$id)
        ->join('assets','sub_plan_fund_table.fund_id','=','assets.fund_id')
        ->join('sub_strategy_id_table','sub_plan_fund_table.sub_id','=','sub_strategy_id_table.sub_id')
        ->join('fund_name_table','assets.fund_name_id','=','fund_name_table.fund_name_id')
        ->join('plan_table','assets.plan_id','=','plan_table.plan_id')
        // ->join('sub_strategy_table','sub_strategy_id_table.sub_item_id','=','sub_strategy_table.sub_item_id')
        ->select('sub_plan_fund_table.*','sub_strategy_id_table.*','assets.*','fund_name_table.*','plan_table.*','sub_plan_fund_table.amount','sub_plan_fund_table.remark')
        ->orderBy('fund_detail_id')
        ->get();
        $letter_num = DB::table('implementation_matter_table')
        ->where('implementation_matter_id','=',$id)
        ->first()
        ->letter_num;
        $files = DB::table('implementation_matter_file')
        ->where('implementation_matter_id','=',$id)
        ->where('status','=',true)
        ->get();
        // $files = glob('implementation_matter_file\\' . $letter_num .'\\*');
        return Inertia::render('implementation_matter/edit', compact('funds', 'sub_strategys', 'deps','row','fund_lists','files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\implementation_matter  $implementation_matter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $imp_id)
    {
        Validator::make($request->all(), [
            'letter_num' => ['required'],
            'implementation_matter' => ['required','string', 'max:255'],
            'dep_id' => ['required','integer'],
            'applicant' => ['required','string', 'max:255'],
            ])->validate();

        // Validator::make($request['add_list'][0]->all(), [
        //     'fund_id' => ['required','integer'],
        //     'amount' => ['required','integer'],
        //     'sub_id' => ['required','integer'],
        //     'remark' => ['required','string', 'max:255'],
        //     ])->validate();
            
        // Validator::make($request['edit_tmp'][0]->all(), [
        //     'fund_detail_id' => ['required','integer'],
        //     'fund_id' => ['required','integer'],
        //     'amount' => ['required','integer'],
        //     'sub_id' => ['required','integer'],
        //     'remark' => ['required','string', 'max:255'],
        //     ])->validate();

        $userid = Auth::id();
        DB::table('implementation_matter_table')
        ->where("implementation_matter_id", '=', $imp_id)
        ->update([
            'implementation_matter_name' =>$request['implementation_matter'],
            'supplement' =>$request['supplement'],
            'director' =>$request['director'],
            'remark' =>$request['remark'],
            'applicant' =>$request['applicant'],
            'founder' =>$userid,
            'dep_id' =>$request['dep_id'],
            'letter_num' =>$request['letter_num'],
        ]);
        if($request->edit_tmp){
            foreach ($request['edit_tmp'] as $edit) {
                DB::table('sub_plan_fund_table')
                ->where('fund_detail_id','=',$edit['fund_detail_id'])
                ->update([
                    'fund_id' => $edit['fund_id'],
                    'amount' => $edit['amount'],
                    'remark' => !empty($edit['remark']) ?  $edit['remark'] : "無",
                    'sub_id' => $edit['sub_id'],
                    // 'update_user_id' => $userid,
                ]);
            }
        }
        if($request->add_list){
            foreach ($request['add_list'] as $add) {
                DB::table('sub_plan_fund_table')->insert([
                    'fund_id' => $add['fund_id'],
                    'implementation_matter_id' => $request['implementation_matter_id'],
                    'amount' => $add['amount'],
                    'remark' => !empty($add['remark']) ?  $add['remark'] : "無",
                    'sub_id' => $add['sub_id'],
                    // 'update_user_id' => $userid,
                ]);
            }
        }
        return Redirect::route('implementation_matter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\implementation_matter  $implementation_matter
     * @return \Illuminate\Http\Response
     */
    public function destroy(implementation_matter $implementation_matter)
    {
        //
    }
}
