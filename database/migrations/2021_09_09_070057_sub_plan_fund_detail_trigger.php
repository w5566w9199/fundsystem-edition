<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubPlanFundDetailTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::unprepared('
        // CREATE TRIGGER fund_detail_insert BEFORE INSERT
        //     ON sub_plan_fund_detail_table
        //     FOR EACH ROW
        // BEGIN
        //     SET @AMOUNT := (SELECT amount from sub_plan_fund_table where fund_detail_id = new.fund_detail_id);
        //     SET @estimated_amount := (SELECT estimated_amount from sub_plan_fund_table where fund_detail_id = new.fund_detail_id);
        //     SET @reimburse := (SELECT reimburse from sub_plan_fund_table where fund_detail_id = new.fund_detail_id);
        //     SET @balance := @AMOUNT - @estimated_amount - @reimburse;
        //     SET @new_amount := new.quantity * new.price;
        //     IF (@new_amount > @balance) THEN
        //         SIGNAL SQLSTATE "50001" SET MESSAGE_TEXT = "此計畫剩餘經費不足";
        //     ELSE
        //         IF new.status_id = 1 THEN
        //             UPDATE sub_plan_fund_table SET estimated_amount= @estimated_amount + @new_amount where fund_detail_id = new.fund_detail_id;
        //             UPDATE sub_plan_fund_table SET amount= @balance where fund_detail_id = new.fund_detail_id;
        //         ELSE
        //             SIGNAL SQLSTATE "50001" SET MESSAGE_TEXT = "經費需通過校務研究中心核銷";
        //         END IF;
        //     END IF;
        // END
        // ');

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
