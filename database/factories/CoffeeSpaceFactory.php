<?php

namespace Database\Factories;

use App\Models\CoffeeSpace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsCoffeeSpace>
 */
class CoffeeSpaceFactory extends Factory
{
    protected $model = CoffeeSpace::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'capacity' => $this->faker->NumberBetween(1, 50),
        ];
    }
}
