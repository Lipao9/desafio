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
        // Dados para criação
        $data = [
            'name' => 'Ana Clara',
            'surname' => 'Orionte',
        ];

        // Criação de uma pessoa
        $person = Person::create($data);

        // Verificando se os dados foram salvos corretamente
        $this->assertDatabaseHas('people', [
            'name' => 'Ana Clara',
            'surname' => 'Orionte',
        ]);
    }

    #[Test]
    public function can_retrieve_a_person()
    {
        // Criando a pessoa
        $person = Person::factory()->create();

        // Buscando a pessoa no banco
        $retrievedPerson = Person::find($person->id);

        // Verificando se a pessoa foi recuperada corretamente
        $this->assertEquals($person->id, $retrievedPerson->id);
    }
}
