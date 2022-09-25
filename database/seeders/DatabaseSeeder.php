<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(adduser::class);
        $this->call(status_table::class);
        // \App\Models\User::factory(10)->create();
        $this->call(fund_name_table::class);
        $this->call(fund_name_table::class);
        $this->call(plan_table::class);
        $this->call(assets::class);
        $this->call(school_table::class);
        $this->call(implementation_matter_table::class);
        $this->call(sub_strategy_table::class);
        $this->call(sub_strategy_id_table::class);
        $this->call(sub_plan_fund_table::class);
        $this->call(kpi_table::class);
        // $this->call(indicator_table::class);
        $this->call(sub_plan_fund_detail_table::class);
        // $this->call(requisition_detail::class);
        // $this->call(sub_strategy_id_table::class);
    }
}
