<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubStrategyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //分項計畫經費表
        Schema::create('sub_strategy_table', function (Blueprint $table) {
            $table->string('sub_item_id', 50)->primary();//大分項
            $table->string('sub_project', 2048);//分項計畫
            $table->string('sub_strategy', 512);//分項策略
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
