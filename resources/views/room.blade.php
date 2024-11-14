<x-layout >
    <x-slot:title>
        Salas
    </x-slot>
    <div class="container">
        <h1>Sala: {{ $room->name }}</h1>
        <div class="d-flex justify-content-evenly">
            <div>
                <h3>Participantes da primeira etapa:</h3>
                <ul class="list-group">
                    @foreach($peopleStep1 as $person)
                        <li class="list-group-item">
                            <a href="{{ route('person.show', $person->id) }}">
                                {{ $person->name . ' ' . $person->surname }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3>Participantes da segunda etapa:</h3>
                <ul class="list-group">
                    @foreach($peopleStep2 as $person)
                        <li class="list-group-item">
                            <a href="{{ route('person.show', $person->id) }}">
                                {{ $person->name . ' ' . $person->surname }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layout>
