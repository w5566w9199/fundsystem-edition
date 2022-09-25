<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubPlanFundDetailFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub_plan_fund_detail_file', function (Blueprint $table) {
            $table->bigIncrements('sub_file_id');
            $table->unsignedBigInteger('sub_plan_fund_detail_id');//經費細項ID
            $table->string('filename');
            $table->string('original_filename');
            $table->unsignedBigInteger('founder');
            $table->string('requisition_num');
            $table->boolean('status')->default(true);
            $table->foreign('sub_plan_fund_detail_id')->references('sub_plan_fund_detail_id')->on('sub_plan_fund_detail_table');
            $table->foreign('founder')->references('id')->on('users');
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
