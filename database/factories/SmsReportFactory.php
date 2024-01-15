<?php

namespace Database\Factories;
use App\Models\SmsReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SmsReport>
 */
class SmsReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SmsReport::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'number' => $this->faker->unique()->numerify('053######'),
            'message' => $this->faker->sentence,
            'send_time' => now(),
        ];
    }
}
