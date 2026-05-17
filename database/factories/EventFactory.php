<?php

namespace Database\Factories;

use App\Enums\EventStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'organizer_id' => User::factory(),
            'title' => fake()->sentence(4, false),
            'description' => fake()->paragraph(3),
            'date' => fake()->dateTimeBetween('+1 week', '+6 months')->format('Y-m-d'),
            'location' => fake()->city() . ', ' . fake()->stateAbbr(),
            'status' => EventStatus::Pending,
        ];
    }

    public function approved(): static
    {
        return $this->state(['status' => EventStatus::Approved]);
    }

    public function canceled(): static
    {
        return $this->state(['status' => EventStatus::Canceled]);
    }
}
