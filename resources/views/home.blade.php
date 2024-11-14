<x-layout >
    <x-slot:title>
        Gestão de Reuniões
    </x-slot>

    <div class="container">
        <div class="title d-flex flex-column justify-content-center align-items-center pt-5">
            <h1>Gestão de Reuniões</h1>
            <p>Gerencie os participantes das sua reuniões e coffe break em duas etapas</p>
        </div>
        <x-alert/>
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#PersonModal">Adicionar Participante</button>
                <ul class="list-group mt-2 w-100">
                    @foreach($people as $person)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('person.show', $person->id) }}" class="link-underline link-underline-opacity-0">
                                {{ $person->name . ' ' .  $person->surname }}
                            </a>
                            <div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#PersonEdit{{ $person->id }}">Editar</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#PersonDelete{{ $person->id }}">Remover</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col  d-flex flex-column align-items-center">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#RoomsModal">Adicionar Salas</button>
                <ul class="list-group mt-2 w-100">
                    @foreach($rooms as $room)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('room.show', $room->id) }}" class="link-underline link-underline-opacity-0">
                                {{ $room->name }}
                            </a>
                            <div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#RoomEdit{{ $room->id }}">Editar</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#RoomDelete{{ $room->id }}">Remover</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col  d-flex flex-column align-items-center">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#CoffeeModal">Adicionar Café</button>
                <ul class="list-group mt-2 w-100">
                    @foreach($coffeeSpaces as $coffeeSpace)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('coffee.show', $coffeeSpace->id) }}" class="link-underline link-underline-opacity-0">
                                {{ $coffeeSpace->name }}
                            </a>
                            <div>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#CoffeeEdit{{ $coffeeSpace->id }}">Editar</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#CoffeeDelete{{ $coffeeSpace->id }}">Remover</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <x-modal-people :$rooms :$coffeeSpaces/>
    @foreach($people as $person)
        <x-modal-people :$person :$rooms :$coffeeSpaces/>
        <x-modal-confirm-delete :id="$person->id" modal="PersonDelete{{ $person->id }}" route="person.delete"/>
    @endforeach

    <x-modal-rooms/>
    @foreach($rooms as $room)
        <x-modal-rooms :$room/>
        <x-modal-confirm-delete :id="$room->id" modal="RoomDelete{{ $room->id }}" route="room.delete"/>
    @endforeach

    <x-modal-coffees/>
    @foreach($coffeeSpaces as $coffeeSpace)
        <x-modal-coffees :$coffeeSpace/>
        <x-modal-confirm-delete :id="$coffeeSpace->id" modal="CoffeeDelete{{ $coffeeSpace->id }}" route="coffee.delete"/>
    @endforeach
</x-layout>
