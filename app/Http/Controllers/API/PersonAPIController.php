<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\PersonController;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonAPIController
{

    public function __construct(
        private PersonController $personController,
        private AssignmentController $assignmentController
    ){
    }

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
            'roomStep1' => 'nullable|integer',
            'roomStep2' => 'nullable|integer',
            'coffeeStep1' => 'nullable|integer',
            'coffeeStep2' => 'nullable|integer',
        ]);

        $this->checkPlacesCapacity($request);

        $person = Person::create($validatedData);

        $this->assignmentController->assign($person->id, $request->roomStep1 ?? null, $request->coffeeStep1 ?? null, 1);
        $this->assignmentController->assign($person->id, $request->roomStep2 ?? null, $request->coffeeStep2 ?? null, 2);

        return response()->json($person, 201);
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'roomStep1' => 'nullable|integer',
            'roomStep2' => 'nullable|integer',
            'coffeeStep1' => 'nullable|integer',
            'coffeeStep2' => 'nullable|integer',
        ]);

        $this->checkPlacesCapacity($request);

        $person->update($validatedData);

        $this->assignmentController->updateAssign($person->id, $request->roomStep1 ?? null, $request->coffeeStep1 ?? null, 1);
        $this->assignmentController->updateAssign($person->id, $request->roomStep2 ?? null, $request->coffeeStep2 ?? null, 2);

        return response()->json($person);
    }

    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $this->assignmentController->deletePersonAssigns($person->id);
        $person->delete();

        return response()->json(null, 204);
    }

    public function getAssignments($id)
    {
        $person = Person::findOrFail($id);

        $assignments = $person->assignments()
            ->whereIn('step', ['Etapa 1', 'Etapa 2'])
            ->with(['room', 'coffeeSpace'])
            ->get();

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

    public function checkPlacesCapacity($request)
    {
        if ($this->personController->checkRoomCapacity($request->roomStep1, 1) || $this->personController->checkRoomCapacity($request->roomStep2, 2)) {
            return response()->json(['message', 'Uma das salas atingiu seu limite de lotação']);
        }

        if ($this->personController->checkCoffeeSpaceCapacity($request->coffeeStep1, 1) || $this->personController->checkCoffeeSpaceCapacity($request->coffeeStep2, 2)) {
            return response()->json(['message', 'Um dos Espaços para Café atingiu seu limite de lotação']);
        }
    }

}
