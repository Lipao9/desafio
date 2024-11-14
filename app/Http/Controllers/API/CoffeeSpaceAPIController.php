<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CoffeeSpace;
use Illuminate\Http\Request;

class CoffeeSpaceAPIController extends Controller
{
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

        return response()->json($coffeeSpace, 201); // 201 Created
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

        $coffeeSpace->update($validatedData);

        return response()->json($coffeeSpace);
    }

    public function destroy($id)
    {
        $coffeeSpace = CoffeeSpace::findOrFail($id);
        $coffeeSpace->delete();

        return response()->json(null, 204); // 204 No Content
    }

    public function getPeopleInCoffeeSpace($id)
    {
        // Encontrar a sala
        $coffeeSpace = CoffeeSpace::findOrFail($id);

        // Recuperar as pessoas associadas à sala nas duas etapas
        $assignments = $coffeeSpace->assignments()
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
