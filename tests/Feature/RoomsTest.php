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
        $data = [
            'name' => 'Sala 203',
            'capacity' => 25,
        ];

        $room = Room::create($data);

        $this->assertDatabaseHas('rooms', [
            'name' => 'Sala 203',
            'capacity' => 25,
        ]);
    }

    #[Test]
    public function can_retrieve_a_room()
    {
        $room = Room::factory()->create();

        $retrievedRoom = Room::find($room->id);

        $this->assertEquals($room->id, $retrievedRoom->id);
    }
}
