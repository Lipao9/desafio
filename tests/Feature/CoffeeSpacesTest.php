<?php

namespace Tests\Feature;

use App\Models\CoffeeSpace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CoffeeSpacesTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_a_coffee_space()
    {
        // Dados do espaço de café
        $data = [
            'name' => 'Café Externo',
            'capacity' => 40,
        ];

        // Criando o espaço de café
        $coffeeSpace = CoffeeSpace::create($data);

        // Verificando se o espaço foi criado corretamente
        $this->assertDatabaseHas('coffee_spaces', [
            'name' => 'Café Externo',
            'capacity' => 40,
        ]);
    }

    #[Test]
    public function can_retrieve_a_coffee_space()
    {
        // Criando o espaço de café
        $coffeeSpace = CoffeeSpace::factory()->create();

        // Recuperando o espaço
        $retrievedCoffeeSpace = CoffeeSpace::find($coffeeSpace->id);

        // Verificando se o espaço foi recuperado corretamente
        $this->assertEquals($coffeeSpace->id, $retrievedCoffeeSpace->id);
    }
}
