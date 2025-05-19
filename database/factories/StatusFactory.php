<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDateTime = $this->faker->dateTimeBetween('-2 years', 'now');
        $formattedDateTime = $randomDateTime->format('Y-m-d H:i:s');
        return [
            'user_id' => User::inRandomOrder()->first()?->id,

            'content' => $this->faker->text(),
            'created_at' => $formattedDateTime,
            'updated_at' => $formattedDateTime,
        ];
    }
}
