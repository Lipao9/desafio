<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\CoffeeSpace;
use App\Models\Person;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AssignmentsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_an_assignment()
    {
        // Criando os dados necessários
        $person = Person::factory()->create();
        $room = Room::factory()->create();
        $coffeeSpace = CoffeeSpace::factory()->create();

        $data = [
            'person_id' => $person->id,
            'room_id' => $room->id,
            'coffee_space_id' => $coffeeSpace->id,
            'step' => 'Etapa 1',
        ];

        // Criando a atribuição
        $assignment = Assignment::create($data);

        // Verificando se a atribuição foi salva corretamente
        $this->assertDatabaseHas('assignments', [
            'person_id' => $person->id,
            'room_id' => $room->id,
            'coffee_space_id' => $coffeeSpace->id,
            'step' => 'Etapa 1',
        ]);
    }

    #[Test]
    public function can_retrieve_an_assignment()
    {
        // Criando os dados necessários
        $assignment = Assignment::factory()->create();

        // Recuperando a atribuição
        $retrievedAssignment = Assignment::find($assignment->id);

        // Verificando se a atribuição foi recuperada corretamente
        $this->assertEquals($assignment->id, $retrievedAssignment->id);
    }
}
