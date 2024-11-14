<?php

use App\Http\Controllers\API\CoffeeSpaceAPIController;
use App\Http\Controllers\API\PersonAPIController;
use App\Http\Controllers\API\RoomAPIController;
use App\Http\Controllers\CoffeeSpaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/room/show/{id}', [RoomController::class, 'show'])->name('room.show');
Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
Route::put('/room/update/{id}', [RoomController::class, 'update'])->name('room.update');
Route::delete('/room/delete/{id}', [RoomController::class, 'destroy'])->name('room.delete');

Route::get('/coffee/show/{id}', [CoffeeSpaceController::class, 'show'])->name('coffee.show');
Route::post('/coffee/store', [CoffeeSpaceController::class, 'store'])->name('coffee.store');
Route::put('/coffee/update/{id}', [CoffeeSpaceController::class, 'update'])->name('coffee.update');
Route::delete('/coffee/delete/{id}', [CoffeeSpaceController::class, 'destroy'])->name('coffee.delete');

Route::get('/person/show/{id}', [PersonController::class, 'show'])->name('person.show');
Route::post('/person/store', [PersonController::class, 'store'])->name('person.store');
Route::put('/person/update/{id}', [PersonController::class, 'update'])->name('person.update');
Route::delete('/person/delete/{id}', [PersonController::class, 'destroy'])->name('person.delete');



//APIs
Route::prefix('api')->group(function () {
    Route::get('people', [PersonAPIController::class, 'index']);
    Route::post('people', [PersonAPIController::class, 'store']);
    Route::get('people/show/{id}', [PersonAPIController::class, 'show']);
    Route::put('people/update/{id}', [PersonAPIController::class, 'update']);
    Route::delete('people/delete/{id}', [PersonAPIController::class, 'destroy']);
    Route::get('people/{id}/assignments', [PersonAPIController::class, 'getAssignments']);

    Route::get('rooms', [RoomAPIController::class, 'index']);
    Route::post('rooms', [RoomAPIController::class, 'store']);
    Route::get('rooms/show/{id}', [RoomAPIController::class, 'show']);
    Route::put('rooms/update/{id}', [RoomAPIController::class, 'update']);
    Route::delete('rooms/delete/{id}', [RoomAPIController::class, 'destroy']);
    Route::get('rooms/{id}/people', [RoomAPIController::class, 'getPeopleInRoom']);

    Route::get('coffees', [CoffeeSpaceAPIController::class, 'index']);
    Route::post('coffees', [CoffeeSpaceAPIController::class, 'store']);
    Route::get('coffees/show/{id}', [CoffeeSpaceAPIController::class, 'show']);
    Route::put('coffees/update/{id}', [CoffeeSpaceAPIController::class, 'update']);
    Route::delete('coffees/delete/{id}', [CoffeeSpaceAPIController::class, 'destroy']);
    Route::get('coffees/{id}/people', [CoffeeSpaceAPIController::class, 'getPeopleInCoffeeSpace']);
});




