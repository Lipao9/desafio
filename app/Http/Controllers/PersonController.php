<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Person;
use App\Models\Room;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function __construct(
        private RoomController $roomController,
        private CoffeeSpaceController $coffeeSpaceController,
        private AssignmentController $assignmentController,
    )
    {
    }

    public function show($id)
    {
        $person = Person::findOrFail($id);

        $getRoomStep1 = $person->assignments()->where('step', 'Etapa 1')->with('room')->first();
        $getRoomStep2 = $person->assignments()->where('step', 'Etapa 2')->with('room')->first();
        $getCoffeeStep1 = $person->assignments()->where('step', 'Etapa 1')->with('coffeeSpace')->first();
        $getCoffeeStep2 = $person->assignments()->where('step', 'Etapa 2')->with('coffeeSpace')->first();

        if ($getRoomStep1 && $getRoomStep1->room) {
            $roomStep1 = $getRoomStep1->room;
        }else{
            $roomStep1 = null;
        }

        if ($getRoomStep2 && $getRoomStep2->room) {
            $roomStep2 = $getRoomStep2->room;
        }else{
            $roomStep2 = null;
        }

        if ($getCoffeeStep1 && $getCoffeeStep1->coffeeSpace) {
            $coffeeStep1 = $getCoffeeStep1->coffeeSpace;
        }else{
            $coffeeStep1 = null;
        }

        if ($getCoffeeStep2 && $getCoffeeStep2->coffeeSpace) {
            $coffeeStep2 = $getCoffeeStep2->coffeeSpace;
        }else{
            $coffeeStep2 = null;
        }

        return view('person', compact('person', 'roomStep1', 'roomStep2', 'coffeeStep1', 'coffeeStep2'));

    }

    public function store(Request $request)
    {
        $person = Person::create($request->only('name', 'surname'));

        $this->checkCapacity($request);

        $this->assignmentController->assign($person->id, $request->roomStep1 ?? null, $request->coffeeStep1 ?? null, 1);
        $this->assignmentController->assign($person->id, $request->roomStep2 ?? null, $request->coffeeStep2 ?? null, 2);

        return to_route('home')->with('success', 'Pessoa cadastrada com sucesso');
    }

    public function update(Request $request, int $id)
    {
        $person = Person::findOrFail($id);
        $person->update($request->only('name', 'surname'));

        $this->checkCapacity($request);

        $this->assignmentController->updateAssign($person->id, $request->roomStep1 ?? null, $request->coffeeStep1 ?? null, 1);
        $this->assignmentController->updateAssign($person->id, $request->roomStep2 ?? null, $request->coffeeStep2 ?? null, 2);

        return to_route('home')->with('success', 'Pessoa atualizada com sucesso');
    }

    public function destroy(int $id)
    {
        $person = Person::findOrFail($id);
        $this->assignmentController->deletePersonAssigns($person->id);
        $person->delete();

        return to_route('home')->with('success', 'Pessoa removida com sucesso');
    }

    private function checkCapacity($request){
        if ($this->checkRoomCapacity($request->roomStep1, 1) || $this->checkRoomCapacity($request->roomStep2, 2)) {
            return redirect()->route('home')->with('error', 'Uma das salas atingiu seu limite de lotação');
        }

        if ($this->checkCoffeeSpaceCapacity($request->coffeeStep1, 1) || $this->checkCoffeeSpaceCapacity($request->coffeeStep2, 2)) {
            return redirect()->route('home')->with('error', 'Um dos espaços para café atingiu seu limite de lotação');
        }
    }

    private function checkRoomCapacity($room, $step)
    {
        if ($room) {
            $response = $this->roomController->verifyCapacity($room, $step);
            if ($response) {
                return true;
            }
        }
        return false;
    }

    private function checkCoffeeSpaceCapacity($coffeeSpace, $step)
    {
        if ($coffeeSpace) {
            $response = $this->coffeeSpaceController->verifyCapacity($coffeeSpace, $step);
            if ($response) {
                return true;
            }
        }
        return false;
    }



}
