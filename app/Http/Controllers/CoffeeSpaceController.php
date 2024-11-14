<?php

namespace App\Http\Controllers;

use App\Models\CoffeeSpace;
use Illuminate\Http\Request;

class CoffeeSpaceController
{
    public function __construct(private AssignmentController $assignmentController)
    {
    }

    public function show($id)
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);

        $peopleStep1 = $coffeeSpace->assignments()->where('step', 'Etapa 1')->with('person')->get()->pluck('person');
        $peopleStep2 = $coffeeSpace->assignments()->where('step', 'Etapa 2')->with('person')->get()->pluck('person');

        return view('coffee-space', compact('coffeeSpace', 'peopleStep1', 'peopleStep2'));
    }


    public function store(Request $request)
    {
        CoffeeSpace::create($request->all());

        return to_route('home')->with('success', 'Espaço para café cadastrado com sucesso!');
    }

    public function update(Request $request, int $id)
    {
        $room = CoffeeSpace::findOrFail($id);

        if($this->assignmentController->verifyCoffeeCapacityUpdateEachStep($id, $request->capacity)){
            return to_route('home')->with('error', 'Capacidade não disponivel por conta dos participantes');
        }

        $room->update($request->only('name', 'capacity'));

        return to_route('home')->with('success', 'Espaço para Café atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);

        $this->assignmentController->unSetPlace($id, 'coffee_space_id');

        $coffeeSpace->delete();

        return to_route('home')->with('success', 'Espaço para Café removido com sucesso!');
    }

    public function verifyCapacity($id, int $step): bool
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);

        $participants = $this->assignmentController->getCoffeeParticipants($id, $step);

        if (($participants + 1) > $coffeeSpace->capacity) {
            return true;
        }

        return false;
    }
}
