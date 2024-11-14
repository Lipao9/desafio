<?php

namespace App\Http\Controllers;

use App\Models\CoffeeSpace;
use App\Models\Person;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $coffeeSpaces = CoffeeSpace::all();
        $people = Person::all();

//        foreach($people as $person){
//            $atribuicaoEtapa1 = $person->assignments()
//                ->where('step', 'Etapa 1')
//                ->where('coffee_space_id', 1)
//                ->first();
//
//            dd($atribuicaoEtapa1->coffeeSpace->name);
//
//        }

//        $person = Person::findOrFail(5);
//        foreach ($rooms as $room) {
//            $getRoomSpaceStep1 = $person->assignments()
//                ->where('step', 'Etapa 2')
//                ->where('person_id', $person->id)
//                ->where('room_id', $room->id)
//                ->first();
//
//            if ($getRoomSpaceStep1 && $getRoomSpaceStep1->room->id === $room->id){
//                dd($getRoomSpaceStep1->room->id);
//            }
//        }

        return view('home', compact('rooms', 'coffeeSpaces', 'people') );
    }
}
