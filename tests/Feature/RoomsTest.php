<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RoomsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_a_room()
    {
        // Dados para a sala
        $data = [
            'name' => 'Sala 203',
            'capacity' => 25,
        ];

        // Criando a sala
        $room = Room::create($data);

        // Verificando se a sala foi criada corretamente
        $this->assertDatabaseHas('rooms', [
            'name' => 'Sala 203',
            'capacity' => 25,
        ]);
    }

    #[Test]
    public function can_retrieve_a_room()
    {
        // Criando uma sala
        $room = Room::factory()->create();

        // Recuperando a sala
        $retrievedRoom = Room::find($room->id);

        // Verificando se a sala foi recuperada corretamente
        $this->assertEquals($room->id, $retrievedRoom->id);
    }
}
