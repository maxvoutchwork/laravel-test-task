<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $created_at = fake()->dateTimeInInterval('-1 month', '+3 weeks')->format('d.m.Y');

        return [
            'photo' => fake()->imageUrl(300, 300),
            'name' => fake()->firstName().' '.fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->numerify('+380 (##) ### ## ##'),
            'salary' => fake()->randomFloat(3, 0, 500),
            'date_of_employment' => $created_at,
            'position_id' => Position::inRandomOrder()->first()->id,
            'admin_created_id' => User::inRandomOrder()->first()->id,
            'admin_updated_id' => User::inRandomOrder()->first()->id,
            'created_at' => $created_at,
            'updated_at' => fake()->dateTimeBetween($created_at)->format('d.m.Y'),
        ];
    }
}
