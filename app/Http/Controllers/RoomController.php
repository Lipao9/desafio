<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(private AssignmentController $assignmentController)
    {
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);

        $peopleStep1 = $room->assignments()->where('step', 'Etapa 1')->with('person')->get()->pluck('person');
        $peopleStep2 = $room->assignments()->where('step', 'Etapa 2')->with('person')->get()->pluck('person');

        return view('room', compact('room', 'peopleStep1', 'peopleStep2'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        Room::create($request->all());

        return to_route('home')->with('success', 'Sala cadastrada com sucesso!');
    }

    public function update(Request $request, int $id)
    {
        $room = Room::findOrFail($id);

        if($this->assignmentController->verifyRoomCapacityUpdateEachStep($id, $request->capacity)){
            return to_route('home')->with('error', 'Capacidade não disponivel por conta dos participantes');
        }

        $room->update($request->only('name', 'capacity'));

        return to_route('home')->with('success', 'Sala atualizada com sucesso!');
    }

    public function destroy(int $id)
    {
        $room = Room::findOrFail($id);

        $this->assignmentController->unSetPlace($id, 'room_id');

        $room->delete();

        return to_route('home')->with('success', 'Sala removida com sucesso!');
    }

    public function verifyCapacity($id, int $step)
    {
        $room = Room::findOrFail($id);

        $participants = $this->assignmentController->getRoomParticipants($id, $step);

        if (($participants + 1) > $room->capacity) {
            return true;
        }

        return false;
    }

}
