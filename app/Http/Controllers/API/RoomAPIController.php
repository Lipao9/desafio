<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomAPIController extends Controller
{
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

        return response()->json($room, 201); // 201 Created
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
            'name' => 'sometimes|string|max:255',
            'capacity' => 'sometimes|integer',
        ]);

        $room->update($validatedData);

        return response()->json($room);
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return response()->json(null, 204); // 204 No Content
    }

    public function getPeopleInRoom($id)
    {
        // Encontrar a sala
        $room = Room::findOrFail($id);

        // Recuperar as pessoas associadas à sala nas duas etapas
        $assignments = $room->assignments()
            ->whereIn('step', ['Etapa 1', 'Etapa 2'])
            ->with('person') // Inclui as pessoas nas atribuições
            ->get();

        // Organizando as pessoas por etapa
        $result = [
            'etapa_1' => $assignments->where('step', 'Etapa 1')->pluck('person'),
            'etapa_2' => $assignments->where('step', 'Etapa 2')->pluck('person'),
        ];

        return response()->json($result);
    }
}
