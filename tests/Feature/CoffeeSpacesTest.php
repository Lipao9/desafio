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
        $data = [
            'name' => 'Café Externo',
            'capacity' => 40,
        ];

        $coffeeSpace = CoffeeSpace::create($data);

        $this->assertDatabaseHas('coffee_spaces', [
            'name' => 'Café Externo',
            'capacity' => 40,
        ]);
    }

    #[Test]
    public function can_retrieve_a_coffee_space()
    {
        $coffeeSpace = CoffeeSpace::factory()->create();

        $retrievedCoffeeSpace = CoffeeSpace::find($coffeeSpace->id);

        $this->assertEquals($coffeeSpace->id, $retrievedCoffeeSpace->id);
    }
}
