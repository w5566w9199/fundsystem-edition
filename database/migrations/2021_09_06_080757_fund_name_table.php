<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FundNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //經費名稱
        Schema::create('fund_name_table', function (Blueprint $table) {
            $table->bigIncrements('fund_name_id');//經費名稱ID
            $table->string('fund_name')->unique();//經費名稱
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('fund_name_table');
    }
}
