<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsRoom>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'capacity' => $this->faker->NumberBetween(1, 50),
        ];
    }
}
