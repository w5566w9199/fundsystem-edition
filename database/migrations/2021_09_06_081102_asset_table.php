<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //經費表
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('fund_id');//經費ID
            $table->unsignedBigInteger('fund_name_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('assets_item');//項目
            $table->bigInteger('amount');//金額
            $table->string('remark')->nullable();//備註
            $table->bigInteger(('estimated_amount'))->default(0);
            $table->bigInteger(('reimburse'))->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//建立日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
            $table->foreign('fund_name_id')->references('fund_name_id')->on('fund_name_table');//經費名稱ID
            $table->foreign('plan_id')->references('plan_id')->on('plan_table');//計畫ID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('asset_table');
    }
}
