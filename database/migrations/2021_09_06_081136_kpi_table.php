<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class KPITable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //KPI
        // Schema::create('kpi_table', function (Blueprint $table) {
        //     $table->bigIncrements('kpi_id');//KPI_ID
        //     $table->string('fund_detail_id');//經費細項ID
        //     $table->string('item');//項目
        //     $table->string('activity');//活動
        //     $table->string('remark');//備註
        //     $table->string('achieve');//目標成果
        //     $table->timestamp('ETA');//預計完成日期
        //     $table->unsignedBigInteger('status_id');

        //     $table->foreign('status_id')->references('status_id')->on('status_table');//完成狀態ID
        //     $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//建立日期
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
        // Schema::dropIfExists('kpi_table');
    }
}
