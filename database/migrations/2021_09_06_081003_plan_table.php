<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //計畫總表
        Schema::create('plan_table', function (Blueprint $table) {
            $table->bigIncrements('plan_id');//計畫ID
            $table->string('plan_name');//計畫名稱
            $table->date('start_date')->nullable();//開始日期
            $table->date('end_date')->nullable();//結束日期
            $table->string('remark')->nullable();//備註
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//建立日期
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
        // Schema::dropIfExists('plan_table');
    }
}
