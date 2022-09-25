<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubStrategyIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //分項計畫經費表
        Schema::create('sub_strategy_id_table', function (Blueprint $table) {
            $table->bigIncrements('sub_id');
            $table->integer('sub_num', false);//小分項
            $table->string('sub_item_id', 50);//大分項
            $table->string('emphasis', 2048);//方向計畫
            $table->string('target');//共同目標/自訂績效指標
            $table->foreign('sub_item_id')->references('sub_item_id')->on('sub_strategy_table');//完成狀態ID
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
