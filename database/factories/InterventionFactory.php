<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervention>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>User::factory(),
            'date'=>$this->faker->dateTimeThisDecade(),
            'time_from'=>$this->faker->time(),
            'time_to'=>$this->faker->time(),
            'remarks'=>$this->faker->sentence(),
            'work_order_id'=>WorkOrder::factory(),
        ];
    }
}
