<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use App\Exports\FundExport;
use Maatwebsite\Excel\Facades\Excel;
class FileDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('filedownload/index');
        //
    }


    public function export() 
    {
        $all_sub_plan_fund_detail_id=DB::table('sub_plan_fund_table')->select('sub_plan_fund_table.fund_detail_id')->get();
        $all_assets_fund_id=DB::table('assets')->select('assets.fund_id')->get();
        foreach ($all_sub_plan_fund_detail_id as $fund_detail_id){
            // return $fund_detail_id->fund_detail_id;
            $est = DB::table('sub_plan_fund_detail_table')
            ->where("fund_detail_id", '=', $fund_detail_id->fund_detail_id)
            ->where("status_id", '=', 1)
            ->sum('amount');
            //已核銷
            $rei = DB::table('sub_plan_fund_detail_table')
            ->where("fund_detail_id", '=', $fund_detail_id->fund_detail_id)
            ->where("status_id", '=', 2)
            ->sum('amount');
            
            DB::table('sub_plan_fund_table')
            ->where("fund_detail_id", '=', $fund_detail_id->fund_detail_id)
            ->update([
                'estimated_amount' => $est,
                'reimburse' => $rei,
            ]);
        }
        foreach ($all_assets_fund_id as $fund_id){
            /* assets預估金額更新 */
            $asset_est = DB::table('sub_plan_fund_table')
            ->where("fund_id", '=', $fund_id->fund_id)
            ->sum('estimated_amount');
    
            $asset_rei = DB::table('sub_plan_fund_table')
            ->where("fund_id", '=', $fund_id->fund_id)
            ->sum('reimburse');
    
            DB::table('assets')
            ->where("fund_id", '=', $fund_id->fund_id)
            ->update([
                'estimated_amount' => $asset_est,
                'reimburse' => $asset_rei,
            ]);
        }        
        return Excel::download(new FundExport, 'download.xlsx');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
