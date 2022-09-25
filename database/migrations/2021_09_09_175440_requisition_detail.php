<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RequisitionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 請購單內容
        Schema::create('requisition_detail', function (Blueprint $table) {
            $table->bigIncrements('requisition_num_id');//請購單內容ID
            $table->string('requisition_num');//請購單號
            $table->string('indicator');//經費項目
            $table->bigInteger('quantity');//數量
            $table->string('unit');//單位
            $table->bigInteger('price');//單價
            $table->string('remark', 8192)->nullable();//備註
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
            $table->foreign('requisition_num')->references('requisition_num')->on('sub_plan_fund_detail_table');//請購單號
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
