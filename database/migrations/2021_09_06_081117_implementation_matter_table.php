<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ImplementationMatterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //執行事項(分項計畫)
        Schema::create('implementation_matter_table', function (Blueprint $table) {
            $table->bigIncrements('implementation_matter_id');//執行事項(分項計畫)ID
            $table->string('implementation_matter_name');//執行事項(分項計畫)名稱
            // $table->string('sub_strategy');//分項策略
            $table->string('supplement')->nullable();//補充說明
            $table->string('director')->nullable()->nullable();//計畫主管
            $table->string('remark')->nullable();//備註
            $table->string('applicant')->nullable();
            $table->unsignedBigInteger('founder')->nullable();//備註
            $table->unsignedBigInteger('dep_id')->nullable();//備註
            $table->string('letter_num')->nullable();//簽呈編號
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//建立日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
            $table->foreign('founder')->references('id')->on('users');//計畫ID
            $table->foreign('dep_id')->references('dep_id')->on('school_table');//計畫ID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('implementation_matter_table');
    }
}
