<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class alltrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets_backup', function (Blueprint $table) {
            $table->bigIncrements('log_id');// bigIncrements為primary key
            $table->unsignedBigInteger('fund_id');//經費ID
            $table->unsignedBigInteger('fund_name_id');
            $table->unsignedBigInteger('plan_id');
            $table->string('assets_item');//項目
            $table->bigInteger('amount');//金額
            $table->string('remark')->nullable();//備註
            $table->bigInteger(('estimated_amount'))->default(0);
            $table->bigInteger(('reimburse'))->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//建立日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
        });
            DB::unprepared('
            CREATE TRIGGER trigger_assets_backup_delete
            before delete on assets
            FOR EACH ROW
            BEGIN
            INSERT INTO assets_backup
              (fund_id,fund_name_id,plan_id,assets_item,amount,remark,estimated_amount,reimburse,created_at,updated_at) values
              (old.fund_id,old.fund_name_id,old.plan_id,old.assets_item,old.amount,old.remark,old.estimated_amount,old.reimburse,old.created_at,old.updated_at);
            END
            ');

            DB::unprepared('
            CREATE TRIGGER trigger_assets_backup_update
            before update on assets
            FOR EACH ROW
            BEGIN
            INSERT INTO assets_backup
              (fund_id,fund_name_id,plan_id,assets_item,amount,remark,estimated_amount,reimburse,created_at,updated_at) values
              (old.fund_id,old.fund_name_id,old.plan_id,old.assets_item,old.amount,old.remark,old.estimated_amount,old.reimburse,old.created_at,old.updated_at);
            end
            ');


            // DB::unprepared('
            // CREATE TRIGGER trigger_assets_backup_insert
            // after insert on assets
            // FOR EACH ROW
            // BEGIN
            // INSERT INTO assets_backup(fund_id,fund_name_id,plan_id,assets_item,amount,remark,estimated_amount,reimburse,created_at,updated_at) values
            // (new.fund_id,new.fund_name_id,new.plan_id,new.assets_item,new.amount,new.remark,new.estimated_amount,new.reimburse,new.created_at,new.updated_at);
            // end
            // ');



        
        Schema::create('users_backup', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->unsignedBigInteger('id');
            $table->string('account');
            $table->string('password');
            $table->string('name');
            $table->string('office');
            $table->bigInteger('phone');
            $table->boolean('status')->default(true);
            $table->string('remark')->nullable();//備註
            $table->string('ext');//分機
            $table->string('role')->default('user');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
        // DB::unprepared('
        // CREATE TRIGGER trigger_users_backup_insert
        // after insert on users
        // FOR EACH ROW
        // BEGIN
        // INSERT INTO users_backup(id,account,password,name,office,phone,status,remark,ext,role,email,email_verified_at,remember_token,current_team_id,profile_photo_path,created_at,updated_at) values
        // (new.id,new.account,new.password,new.name,new.office,new.phone,new.status,new.remark,new.ext,new.role,new.email,new.email_verified_at,new.remember_token,new.current_team_id,new.profile_photo_path,new.created_at,new.updated_at);
        // end
        // '
        // );


        DB::unprepared('
        CREATE TRIGGER trigger_users_backup_update
        before update on users
        FOR EACH ROW
        BEGIN
        INSERT INTO users_backup(id,account,password,name,office,phone,status,remark,ext,role,email,email_verified_at,remember_token,current_team_id,profile_photo_path,created_at,updated_at) values
        (old.id,old.account,old.password,old.name,old.office,old.phone,old.status,old.remark,old.ext,old.role,old.email,old.email_verified_at,old.remember_token,old.current_team_id,old.profile_photo_path,old.created_at,old.updated_at);
        end
        '
        );


        DB::unprepared('
        CREATE TRIGGER trigger_users_backup_delete
        before delete on users
        FOR EACH ROW
        BEGIN
        INSERT INTO users_backup(id,account,password,name,office,phone,status,remark,ext,role,email,email_verified_at,remember_token,current_team_id,profile_photo_path,created_at,updated_at) values
        (old.id,old.account,old.password,old,old.name,old.office,old.phone,old.status,old.remark,old.ext,old.role,old.email,old.email_verified_at,old.remember_token,old.current_team_id,old.profile_photo_path,old.created_at,old.updated_at);
        end
        '
        );

    Schema::create('sub_plan_fund_table_backup', function (Blueprint $table) {
        $table->bigIncrements('log_id');
        $table->unsignedBigInteger('fund_detail_id');//經費細項ID
        $table->string('fund_item')->nullable();//項目
        $table->unsignedBigInteger('fund_id');//經費ID
        $table->unsignedBigInteger('implementation_matter_id');//執行事項(分項計畫)ID
        $table->bigInteger('amount');//金額
        $table->string('remark')->nullable();//備註
        $table->bigInteger(('estimated_amount'))->default(0);
        $table->bigInteger(('reimburse'))->default(0);
        $table->unsignedBigInteger('sub_id');//小分項
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
    });


        // DB::unprepared('
        // CREATE TRIGGER trigger_sub_plan_fund_detail_table_backup_insert
        // after insert on sub_plan_fund_detail_table
        // FOR EACH ROW
        // BEGIN
        // INSERT INTO sub_plan_fund_detail_table_backup(sub_plan_fund_detail_id,category,abstract,applicant,requisition_num,amount,status_id,fund_detail_id,remark,created_at,updated_at) values
        // (new.sub_plan_fund_detail_id,new.category,abstract,new.applicant,new.requisition_num,new.amount,new.status_id,new.fund_detail_id,new.remark,new.created_at,new.updated_at
        // );
        // end
        // '
        // );



        DB::unprepared('
        CREATE TRIGGER trigger_sub_plan_fund_detail_table_backup_update
        before update on sub_plan_fund_detail_table
        FOR EACH ROW
        BEGIN
        INSERT INTO sub_plan_fund_detail_table_backup(sub_plan_fund_detail_id,category,abstract,applicant,requisition_num,amount,status_id,fund_detail_id,remark,created_at,updated_at) values
        (old.sub_plan_fund_detail_id,old.category,old.abstract,old.applicant,old.requisition_num,old.amount,old.status_id,old.fund_detail_id,old.remark,old.created_at,old.updated_at
        );
        end
        '
        );


        DB::unprepared('
        CREATE TRIGGER trigger_sub_plan_fund_detail_table_backup_delete
        before delete on sub_plan_fund_detail_table
        FOR EACH ROW
        BEGIN
        INSERT INTO sub_plan_fund_detail_table_backup(sub_plan_fund_detail_id,category,abstract,applicant,requisition_num,amount,status_id,fund_detail_id,remark,created_at,updated_at) values
        (old.sub_plan_fund_detail_id,old.category,old.abstract,old.applicant,old.requisition_num,old.amount,old.status_id,old.fund_detail_id,old.remark,old.created_at,old.updated_at
        );
        end
        '
        );




        Schema::create('fund_paid_backup', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->unsignedBigInteger('implementation_matter_id');//經費細項ID
            $table->bigInteger('paid_amount');
            $table->string('paid_time')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
        });


        DB::unprepared('
        CREATE TRIGGER trigger_fund_paid_backup_delete
        before delete on fund_paid
        FOR EACH ROW
        BEGIN
        INSERT INTO fund_paid_backup(implementation_matter_id,paid_amount,paid_time,created_at) values
        (old.implementation_matter_id,old.paid_amount,old.paid_time,old.created_at
        );
        end
        '
        );

        // DB::unprepared('
        // CREATE TRIGGER trigger_fund_paid_backup_insert
        // after insert on fund_paid
        // FOR EACH ROW
        // BEGIN
        // INSERT INTO fund_paid_backup(implementation_matter_id,paid_amount,paid_time,created_at) values
        // (new.implementation_matter_id,new.paid_amount,new.paid_time,new.created_at
        // );
        // end
        // '
        // );

        DB::unprepared('
        CREATE TRIGGER trigger_fund_paid_backup_update
        before update on fund_paid
        FOR EACH ROW
        BEGIN
        INSERT INTO fund_paid_backup(implementation_matter_id,paid_amount,paid_time,created_at) values
        (old.implementation_matter_id,old.paid_amount,old.paid_time,old.created_at
        );
        end
        '
        );






        Schema::create('sub_plan_fund_detail_table_backup', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->unsignedBigInteger('sub_plan_fund_detail_id');//分項計畫經費細項ID
            $table->string('category', 20)->nullable();//請購單或印領清冊
            $table->string('abstract')->nullable();//請購單或印領清冊
            $table->string('applicant', 20)->nullable();//請購單或印領清冊
            $table->string('requisition_num');//請購單號
            $table->BigInteger('amount');//總額
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('fund_detail_id');
            $table->string('remark', 8192)->nullable();//備註
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//申請日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
        });

        DB::unprepared('
        CREATE TRIGGER trigger_sub_plan_fund_table_backup_delete
        before delete on sub_plan_fund_table
        FOR EACH ROW
        BEGIN
        INSERT INTO sub_plan_fund_table_backup(fund_detail_id,fund_item,fund_id,implementation_matter_id,amount,remark,estimated_amount,reimburse,sub_id,created_at,updated_at) values
        (old.fund_detail_id,old.fund_item,old.fund_id,old.implementation_matter_id,old.amount,old.remark,old.estimated_amount,old.reimburse,old.sub_id,old.created_at,old.updated_at
        );
        end
        '
        );


        DB::unprepared('
        CREATE TRIGGER trigger_sub_plan_fund_table_backup_update
        before update on sub_plan_fund_table
        FOR EACH ROW
        BEGIN
        INSERT INTO sub_plan_fund_table_backup(fund_detail_id,fund_item,fund_id,implementation_matter_id,amount,remark,estimated_amount,reimburse,sub_id,created_at,updated_at) values
        (old.fund_detail_id,old.fund_item,old.fund_id,old.implementation_matter_id,old.amount,old.remark,old.estimated_amount,old.reimburse,old.sub_id,old.created_at,old.updated_at
        );
        end
        '
        );


        // DB::unprepared('
        // CREATE TRIGGER trigger_sub_plan_fund_table_backup_insert
        // after insert on sub_plan_fund_table
        // FOR EACH ROW
        // BEGIN
        // INSERT INTO sub_plan_fund_table_backup(fund_detail_id,fund_item,fund_id,implementation_matter_id,amount,remark,estimated_amount,reimburse,sub_id,created_at,updated_at) values
        // (new.fund_detail_id,new.fund_item,new.fund_id,new.implementation_matter_id,new.amount,new.remark,new.estimated_amount,new.reimburse,new.sub_id,new.created_at,new.updated_at
        // );
        // end
        // '
        // );




        Schema::create('plan_table_backup', function (Blueprint $table) {
            $table->bigIncrements('log_id'); //log表的id 為此表的主鍵
            $table->unsignedBigInteger('plan_id');//計畫ID
            $table->string('plan_name');//計畫名稱
            $table->date('start_date')->nullable();//開始日期 nullable()是可為空值得意思
            $table->date('end_date')->nullable();//結束日期
            $table->string('remark')->nullable();//備註
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));//建立日期
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));//更新日期
        });

        // DB::unprepared('
        // CREATE TRIGGER trigger_plan_table_backup_insert
        // after insert on plan_table
        // FOR EACH ROW
        // BEGIN
        // INSERT INTO plan_table_backup(plan_id,plan_name,start_date,end_date,remark,created_at,updated_at) values
        // (new.plan_id,new.plan_name,new.start_date,new.end_date,new.remark,new.created_at,new.updated_at
        // );
        // end
        // '
        // );



        DB::unprepared('
        CREATE TRIGGER trigger_plan_table_backup_update
        before update on plan_table
        FOR EACH ROW
        BEGIN
        INSERT INTO plan_table_backup(plan_id,plan_name,start_date,end_date,remark,created_at,updated_at) values
        (old.plan_id,old.plan_name,old.start_date,old.end_date,old.remark,old.created_at,old.updated_at
        );
        end
        '
        );



        DB::unprepared('
        CREATE TRIGGER trigger_plan_table_backup_delete
        before delete on plan_table
        FOR EACH ROW
        BEGIN
        INSERT INTO plan_table_backup(plan_id,plan_name,start_date,end_date,remark,created_at,updated_at) values
        (old.plan_id,old.plan_name,old.start_date,old.end_date,old.remark,old.created_at,old.updated_at
        );
        end
        '
        );


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
