<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //分項計畫經費表
        Schema::create('school_table', function (Blueprint $table) {
            $table->bigIncrements('dep_id');//經費細項ID
            $table->string('academy');//學院
            $table->string('department');//科系
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
