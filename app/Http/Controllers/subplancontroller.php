<?php

namespace App\Http\Controllers;

use App\Models\subplan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

// $data_start = 20;
class subplancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


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
            // ->oldest()
            // ->where('sub_plan_fund_detail_table.created_at', 'like', '2022%')
            // ->where('plan_table.plan_name','like','111%')
            ->skip(0)->take(99)
            // ->take(10)
            ->get();
        $deps = DB::table('school_table')->get();
        return Inertia::render('subplan/index', compact('rows', 'deps'));
    }

    public function scroll(Request $request)
    {
        $data_start = $request->data_now;
        $year = $request->nowYear;
        $year= $year."%";
        $rows[0] = DB::table('sub_plan_fund_detail_table')
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
            // ->where('sub_plan_fund_detail_table.created_at', 'like', "2022%")
            ->skip(0)->take($data_start)
            ->get();
        $rows[1] = DB::table('school_table')->get();
        return $rows;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_strategy = DB::table('sub_strategy_table')->get();
        $deps = DB::table('school_table')->get();

        return Inertia::render('subplan/create', compact('sub_strategy', 'deps'));
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
            'requisition_num' => ['required', 'max:255', 'unique:sub_plan_fund_detail_table,requisition_num'],
            'amount' => ['required', 'integer'],
            'fund_detail_id' => ['required'],
        ])->validate();

        $fund_detail_id = $request->input('fund_detail_id');
        $fund_id = $request->input('fund_id');
        DB::table('sub_plan_fund_detail_table')->insert([
            'category' => $request->input('category'),
            'requisition_num' => $request->input('requisition_num'),
            'amount' => $request->input('amount'),
            'abstract' => $request->input('abstract'),
            'applicant' => $request->input('applicant'),
            'remark' => $request->input('remark'),
            'fund_detail_id' => $fund_detail_id,
        ]);

        /* sub_plan_fund_table預估金額更新 */
        //預估
        $est = DB::table('sub_plan_fund_detail_table')
            ->where("fund_detail_id", '=', $fund_detail_id)
            ->where("status_id", '=', 1)
            ->sum('amount');
        //已核銷
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
        return Redirect::route('subplan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subplan  $subplan
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $subplan)
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
            ->select('sub_plan_fund_detail_table.*', 'sub_plan_fund_table.fund_item', 'users.name', 'sub_plan_fund_table.amount as fund_amount', 'sub_strategy_id_table.*', 'sub_strategy_table.*', 'plan_table.plan_name', 'fund_name_table.fund_name', 'school_table.*', 'implementation_matter_table.*', 'sub_plan_fund_detail_table.applicant as sub_applicant', 'sub_plan_fund_detail_table.remark as sub_remark')
            ->orderBy('sub_plan_fund_detail_table.created_at', 'DESC')
            ->where("sub_plan_fund_detail_id", '=', $id)
            ->get()->first();
        $sub_strategy = DB::table('sub_strategy_table')
            ->get();
        $deps = DB::table('school_table')->get();
        $requisition_num = DB::table('sub_plan_fund_detail_table')
            ->where('sub_plan_fund_detail_id', '=', $id)
            ->first()
            ->requisition_num;
        $files = DB::table('sub_plan_fund_detail_file')
            ->where('sub_plan_fund_detail_id', '=', $id)
            ->where('status', '=', true)
            ->get();
        return Inertia::render('subplan/show', compact('sub_strategy', 'deps', 'rows', 'id', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subplan  $subplan
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
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
            ->select('sub_plan_fund_detail_table.*', 'sub_plan_fund_table.fund_item', 'users.name', 'sub_strategy_id_table.*', 'sub_strategy_table.*', 'plan_table.plan_name', 'fund_name_table.fund_name', 'school_table.*', 'implementation_matter_table.*', 'sub_plan_fund_detail_table.applicant as sub_applicant', 'sub_plan_fund_detail_table.remark as sub_remark')
            ->orderBy('sub_plan_fund_detail_table.created_at', 'DESC')
            ->where("sub_plan_fund_detail_id", '=', $id)
            ->get()->first();
        $sub_strategy = DB::table('sub_strategy_table')
            ->get();
        $deps = DB::table('school_table')->get();
        $requisition_num = DB::table('sub_plan_fund_detail_table')
            ->where('sub_plan_fund_detail_id', '=', $id)
            ->first()
            ->requisition_num;
        $files = DB::table('sub_plan_fund_detail_file')
            ->where('sub_plan_fund_detail_id', '=', $id)
            ->where('status', '=', true)
            ->get();
        return Inertia::render('subplan/edit', compact('sub_strategy', 'deps', 'rows', 'id', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subplan  $subplan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'requisition_num' => ['required', 'max:255'],
            'amount' => ['required', 'integer'],
            'fund_detail_id' => ['required'],
        ])->validate();

        $fund_detail_id = $request->input('fund_detail_id');
        $fund_id = $request->input('fund_id');
        DB::table('sub_plan_fund_detail_table')
            ->where('sub_plan_fund_detail_id', '=', $id)
            ->update([
                'category' => $request->input('category'),
                'requisition_num' => $request->input('requisition_num'),
                'amount' => $request->input('amount'),
                'abstract' => $request->input('abstract'),
                'applicant' => $request->input('applicant'),
                'remark' => $request->input('remark'),
                'fund_detail_id' => $fund_detail_id,
            ]);

        /* sub_plan_fund_table預估金額更新 */
        //預估
        $est = DB::table('sub_plan_fund_detail_table')
            ->where("fund_detail_id", '=', $fund_detail_id)
            ->where("status_id", '=', 1)
            ->sum('amount');
        //已核銷
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
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subplan  $subplan
     * @return \Illuminate\Http\Response
     */
    public function destroy(subplan $subplan)
    {
        //
    }
}
