<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $room = $this->faker->unique()->numberBetween(1, 500);

        return [
            'name' => $room,
            'description' => "Habitación $room",
            'room_type_id' => \App\Models\RoomType::inRandomOrder()->first()->id,
        ];
    }
}
