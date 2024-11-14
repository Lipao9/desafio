<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CoffeeSpaceController;
use App\Models\CoffeeSpace;
use Illuminate\Http\Request;

class CoffeeSpaceAPIController
{
    public function __construct(
        private AssignmentController $assignmentController
    ){
    }

    public function index()
    {
        $coffeeSpaces = CoffeeSpace::all();
        return response()->json($coffeeSpaces);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        $coffeeSpace = CoffeeSpace::create($validatedData);

        return response()->json($coffeeSpace, 201);
    }

    public function show($id)
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);
        return response()->json($coffeeSpace);
    }

    public function update(Request $request, $id)
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'capacity' => 'sometimes|integer',
        ]);

        if($this->assignmentController->verifyCoffeeCapacityUpdateEachStep($id, $request->capacity)){
            return to_route('home')->with('error', 'Capacidade não disponivel por conta dos participantes');
        }

        $coffeeSpace->update($validatedData);

        return response()->json($coffeeSpace);
    }

    public function destroy($id)
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);

        $this->assignmentController->unSetPlace($id, 'coffee_space_id');

        $coffeeSpace->delete();

        return response()->json(null, 204);
    }

    public function getPeopleInCoffeeSpace($id)
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);

        $assignments = $coffeeSpace->assignments()
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
