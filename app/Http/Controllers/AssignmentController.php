<?php

namespace App\Http\Controllers;

use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function assign($personId, $roomId = null, $coffeeId = null, $step): void
    {
        Assignment::create([
            'person_id' => $personId,
            'room_id' => $roomId,
            'coffee_space_id' => $coffeeId,
            'step' => 'Etapa ' . $step,
        ]);
    }

    public function updateAssign($personId, $roomId = null, $coffeeId = null, $step): void
    {
        $assign = Assignment::where('person_id', $personId)
            ->where('step', 'Etapa ' . $step)
            ->first();

        $assign->update([
            'room_id' => $roomId,
            'coffee_space_id' => $coffeeId,
        ]);
    }

    public function getRoomParticipants($id, int $step)
    {
        $participants = Assignment::where('room_id', $id)
            ->where('step', 'Etapa '. $step)
            ->count();

        return $participants;
    }

    public function getCoffeeParticipants(int $id, int $step)
    {
        return Assignment::where('coffee_space_id', $id)
            ->where('step', 'Etapa '. $step)
            ->count();
    }

    public function verifyRoomCapacityUpdateEachStep(int $id, $requestCapacity)
    {
        $participantsStep1 = Assignment::where('room_id', $id)
            ->where('step', 'Etapa 1')
            ->count();

        if ($participantsStep1 > $requestCapacity) {
            return true;
        }

        $participantsStep2 = Assignment::where('room_id', $id)
            ->where('step', 'Etapa 2')
            ->count();

        if ($participantsStep2 > $requestCapacity) {
            return true;
        }

        return false;

    }

    public function verifyCoffeeCapacityUpdateEachStep(int $id, $requestCapacity)
    {
        $participantsStep1 = Assignment::where('coffee_space_id', $id)
            ->where('step', 'Etapa 1')
            ->count();

        if ($participantsStep1 > $requestCapacity) {
            return true;
        }

        $participantsStep2 = Assignment::where('coffee_space_id', $id)
            ->where('step', 'Etapa 2')
            ->count();

        if ($participantsStep2 > $requestCapacity) {
            return true;
        }

        return false;
    }

    public function deletePersonAssigns($id)
    {
        $assings = Assignment::where('person_id', $id)->get();

        foreach ($assings as $assing) {
            $assing->delete();
        }
    }

    public function unSetPlace(int $id, string $place)
    {
        $assigns = Assignment::where($place, $id)->get();

        foreach ($assigns as $assign) {
            $assign->update([
                $place => null,
            ]);
        }
    }


}
