<x-layout >
    <x-slot:title>
        Participantes
    </x-slot>
    <div class="container">
        <h1>Participante: {{ $person->name . ' ' . $person->surname }}</h1>
        <div class="">
            @if($roomStep1)
                <div class="d-flex">
                    <h3>Sala Etapa 1: </h3>
                    <a href="{{ route('room.show', $roomStep1->id) }}">
                        <span class="mx-3 fs-4" style="margin: 0;">{{ $roomStep1->name ?? '' }}</span>
                    </a>
                </div>
            @endif
            @if($roomStep2)
                <div class="d-flex">
                    <h3>Sala Etapa 2: </h3>
                    <a href="{{ route('room.show', $roomStep2->id) }}">
                        <span class="mx-3 fs-4" style="margin: 0;">{{ $roomStep2->name ?? '' }}</span>
                    </a>
                </div>
            @endif
            @if($coffeeStep1)
                <div class="d-flex">
                    <h3>Espaço para Café Etapa 1: </h3>
                    <a href="{{ route('room.show', $coffeeStep1->id) }}">
                        <span class="mx-3 fs-4" style="margin: 0;">{{ $coffeeStep1->name ?? '' }}</span>
                    </a>
                </div>
            @endif
            @if($coffeeStep2)
                <div class="d-flex">
                    <h3>Espaço para Café Etapa 2: </h3>
                    <a href="{{ route('room.show', $coffeeStep2->id) }}">
                        <span class="mx-3 fs-4" style="margin: 0;">{{ $coffeeStep2->name ?? '' }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layout>
