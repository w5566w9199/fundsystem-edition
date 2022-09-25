<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class IndicatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //指標面向ID對應
        // Schema::create('indicator_table', function (Blueprint $table) {
        //     $table->bigIncrements('indicator_id');//指標面向ID
        //     $table->string('indicator_ioriented');//指標面向
        //     $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//建立日期
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('indicator_table');
    }
}
