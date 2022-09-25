<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FundPaid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fund_paid', function (Blueprint $table) {
            $table->unsignedBigInteger('implementation_matter_id');//經費細項ID
            $table->bigInteger('paid_amount');
            $table->string('paid_time')->nullable();
            $table->foreign('implementation_matter_id')->references('implementation_matter_id')->on('implementation_matter_table');//完成狀態ID
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
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
