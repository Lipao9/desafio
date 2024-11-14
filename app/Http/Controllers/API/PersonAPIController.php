<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonAPIController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return response()->json($people);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
        ]);

        $person = Person::create($validatedData);

        return response()->json($person, 201); // 201 Created
    }

    public function show($id)
    {
        $person = Person::findOrFail($id);
        return response()->json($person);
    }

    public function update(Request $request, $id)
    {
        $person = Person::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'surname' => 'sometimes|string|max:255',
        ]);

        $person->update($validatedData);

        return response()->json($person);
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return response()->json(null, 204); // 204 No Content
    }

    public function getAssignments($id)
    {
        // Encontrar a pessoa
        $person = Person::findOrFail($id);

        // Recuperando as atribuições para cada etapa
        $assignments = $person->assignments()
            ->whereIn('step', ['Etapa 1', 'Etapa 2'])
            ->with(['room', 'coffeeSpace'])
            ->get();

        // Separando as atribuições por etapa
        $result = [
            'etapa_1' => [
                'sala' => $assignments->firstWhere('step', 'Etapa 1')?->room,
                'espaco_cafe' => $assignments->firstWhere('step', 'Etapa 1')?->coffeeSpace,
            ],
            'etapa_2' => [
                'sala' => $assignments->firstWhere('step', 'Etapa 2')?->room,
                'espaco cafe' => $assignments->firstWhere('step', 'Etapa 2')?->coffeeSpace,
            ]
        ];

        return response()->json($result);
    }

}
