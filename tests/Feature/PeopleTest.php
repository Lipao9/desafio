<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_a_person()
    {
        $data = [
            'name' => 'Ana Clara',
            'surname' => 'Orionte',
        ];

        $person = Person::create($data);

        $this->assertDatabaseHas('people', [
            'name' => 'Ana Clara',
            'surname' => 'Orionte',
        ]);
    }

    #[Test]
    public function can_retrieve_a_person()
    {
        $person = Person::factory()->create();

        $retrievedPerson = Person::find($person->id);

        $this->assertEquals($person->id, $retrievedPerson->id);
    }
}
