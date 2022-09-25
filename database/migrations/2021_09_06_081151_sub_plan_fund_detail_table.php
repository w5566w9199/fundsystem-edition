<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubPlanFundDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 分項計畫經費細項
        Schema::create('sub_plan_fund_detail_table', function (Blueprint $table) {
            $table->bigIncrements('sub_plan_fund_detail_id');//分項計畫經費細項ID
            // $table->string('description', 8192);//說明
            $table->string('category', 20)->nullable();//請購單或印領清冊
            $table->string('abstract')->nullable();//請購單或印領清冊
            $table->string('applicant', 20)->nullable();//請購單或印領清冊
            $table->string('requisition_num')->unique();//請購單號
            $table->BigInteger('amount');//總額
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('fund_detail_id');
            $table->string('remark', 8192)->nullable();//備註
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
            $table->foreign('fund_detail_id')->references('fund_detail_id')->on('sub_plan_fund_table');//KPI_ID
            $table->foreign('status_id')->references('status_id')->on('status_table')->default(0);//完成狀態ID
        });

        //分項計畫經費細項
        // Schema::create('sub_plan_fund_detail_table', function (Blueprint $table) {
        //     $table->bigIncrements('sub_plan_fund_detail_id');//分項計畫經費細項ID
        //     $table->string('indicator');//經費項目
        //     $table->bigInteger('quantity');//數量
        //     $table->string('unit');//單位
        //     $table->bigInteger('price');//單價
        //     $table->string('description', 8192);//說明
        //     $table->unsignedBigInteger('indicator_id');
        //     $table->foreign('indicator_id')->references('indicator_id')->on('indicator_table');//指標面向ID
        //     $table->string('requisition_num');//請購單號
        //     $table->unsignedBigInteger('status_id');
        //     $table->foreign('status_id')->references('status_id')->on('status_table')->default(0);//完成狀態ID
        //     $table->unsignedBigInteger('fund_detail_id');
        //     $table->foreign('fund_detail_id')->references('fund_detail_id')->on('sub_plan_fund_table');//KPI_ID
        //     $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
        //     $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('sub_plan_fund_detail_table');
    }
}
