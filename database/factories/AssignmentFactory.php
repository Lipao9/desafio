<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\CoffeeSpace;
use App\Models\Person;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsAssignment>
 */
class AssignmentFactory extends Factory
{
    protected $model = Assignment::class;

    public function definition()
    {
        return [
            'person_id' => Person::factory(), // Atribuindo uma pessoa gerada pela factory
            'room_id' => Room::factory(), // Atribuindo uma sala gerada pela factory
            'coffee_space_id' => CoffeeSpace::factory(), // Atribuindo um espaço de café gerado pela factory
            'step' => $this->faker->randomElement(['Etapa 1', 'Etapa 2']), // Aleatoriamente "Etapa 1" ou "Etapa 2"
        ];
    }
}
