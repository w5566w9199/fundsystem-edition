<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubPlanFundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //分項計畫經費表
        Schema::create('sub_plan_fund_table', function (Blueprint $table) {
            $table->bigIncrements('fund_detail_id');//經費細項ID
            $table->string('fund_item')->nullable();//項目
            $table->unsignedBigInteger('fund_id');//經費ID
            $table->unsignedBigInteger('implementation_matter_id');//執行事項(分項計畫)ID
            $table->bigInteger('amount');//金額
            $table->string('remark')->nullable();//備註
            $table->bigInteger(('estimated_amount'))->default(0);
            $table->bigInteger(('reimburse'))->default(0);
            $table->unsignedBigInteger('sub_id');//小分項
            // $table->integer('sub_id')->nullable();//分項
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
            $table->foreign('fund_id')->references('fund_id')->on('assets');//指標面向ID
            $table->foreign('sub_id')->references('sub_id')->on('sub_strategy_id_table');//指標面向ID
            $table->foreign('implementation_matter_id')->references('implementation_matter_id')->on('implementation_matter_table');//完成狀態ID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('sub_plan_fund_table');
    }
}
