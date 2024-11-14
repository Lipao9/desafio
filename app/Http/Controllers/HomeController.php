<?php

namespace App\Http\Controllers;

use App\Models\CoffeeSpace;
use App\Models\Person;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $rooms = Room::all();
        $coffeeSpaces = CoffeeSpace::all();
        $people = Person::all();

        return view('home', compact('rooms', 'coffeeSpaces', 'people') );
    }
}
