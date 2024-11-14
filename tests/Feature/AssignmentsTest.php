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
        $person = Person::factory()->create();
        $room = Room::factory()->create();
        $coffeeSpace = CoffeeSpace::factory()->create();

        $data = [
            'person_id' => $person->id,
            'room_id' => $room->id,
            'coffee_space_id' => $coffeeSpace->id,
            'step' => 'Etapa 1',
        ];

        $assignment = Assignment::create($data);

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
        $assignment = Assignment::factory()->create();

        $retrievedAssignment = Assignment::find($assignment->id);

        $this->assertEquals($assignment->id, $retrievedAssignment->id);
    }
}
