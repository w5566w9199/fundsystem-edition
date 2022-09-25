<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubPlanUseFund extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub_plan_use_fund', function (Blueprint $table) {
            $table->bigIncrements('use_fund_id');
            $table->string('requisition_num');
            $table->unsignedBigInteger('fund_detail_id');
            $table->BigInteger('amount');//總額
            $table->foreign('requisition_num')->references('requisition_num')->on('sub_plan_fund_detail_table');
            $table->foreign('fund_detail_id')->references('fund_detail_id')->on('sub_plan_fund_table');//KPI_ID
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
