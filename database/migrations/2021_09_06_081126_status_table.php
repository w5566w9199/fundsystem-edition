<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //完成狀態對應表
        Schema::create('status_table', function (Blueprint $table) {
            $table->bigIncrements('status_id');//完成狀態ID
            $table->string('status');//完成狀態名稱
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('status_table');
    }
}
