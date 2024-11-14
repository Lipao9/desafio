<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AssignmentController;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomAPIController
{
    public function __construct(
        private AssignmentController $assignmentController
    ){
    }

    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        $room = Room::create($validatedData);

        return response()->json($room, 201);
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'string',
            'capacity' => 'integer',
        ]);

        if($this->assignmentController->verifyRoomCapacityUpdateEachStep($id, $request->capacity)) {
            return response()->json(['message' => 'Capacidade não disponivel por conta dos participantes'], 422);
        }

        $room->update($validatedData);

        return response()->json($room);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        $this->assignmentController->unSetPlace($id, 'room_id');

        $room->delete();

        return response()->json(null, 204);
    }

    public function getPeopleInRoom($id)
    {
        $room = Room::findOrFail($id);

        $assignments = $room->assignments()
            ->whereIn('step', ['Etapa 1', 'Etapa 2'])
            ->with('person')
            ->get();

        $result = [
            'etapa_1' => $assignments->where('step', 'Etapa 1')->pluck('person'),
            'etapa_2' => $assignments->where('step', 'Etapa 2')->pluck('person'),
        ];

        return response()->json($result);
    }
}
