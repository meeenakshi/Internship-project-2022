<?php

namespace Database\Seeders;

use App\Models\WorkOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkOrder::factory()
            ->count(2)
            ->hasInterventions(2)
            ->create();

        WorkOrder::factory()
            ->count(2)
            ->hasInterventions(0)
            ->create();
    }
}
