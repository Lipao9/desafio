<div class="modal fade" id="{{ isset($person) ? 'PersonEdit'.$person->id : "PersonModal" }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ isset($person) ? 'Editar Pessoa' : 'Adicionar Pessoa' }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{  isset($person) ? route('person.update', $person->id) : route('person.store') }}" method="post">
                @csrf
                @isset($person)
                    @method('PUT')
                @else
                    @method('POST')
                @endisset
                <div class="modal-body d-flex align-items-center flex-column">
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $person->name ?? '' }}" required>
                        </div>
                        <div class="col">
                            <label for="surname" class="form-label">Sobrenome:</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{ $person->surname ?? '' }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <span class="fs-5 fw-bold">Salas</span>
                        <div class="row gap-1">
                            <div class="col">
                                <label for="name" class="form-label">Etapa 1:</label>
                                <select class="form-select" name="roomStep1" aria-label="Default select example">
                                    <option value="">Selecione uma Sala</option>
                                    @foreach($rooms as $room)
                                        <option
                                            @if(isset($person) && $person->getRoomIdInStep('Etapa 1') === $room->id)
                                                selected
                                            @endif
                                            value="{{ $room->id }}">{{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col">
                                    <label for="name" class="form-label">Etapa 2:</label>
                                    <select class="form-select" name="roomStep2" aria-label="Default select example">
                                        <option value="">Selecione uma Sala</option>
                                        @foreach($rooms as $room)
                                            <option
                                                @if(isset($person) && $person->getRoomIdInStep('Etapa 2') === $room->id)
                                                    selected
                                                @endif
                                                value="{{ $room->id }}">{{ $room->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="fs-5 fw-bold">Cafés</span>
                            <div class="row gap-1">
                                <div class="col">
                                    <label for="name" class="form-label">Etapa 1:</label>
                                    <select class="form-select" name="coffeeStep1" aria-label="Default select example">
                                        <option value="">Selecione uma Sala</option>
                                        @foreach($coffeeSpaces as $coffeeSpace)
                                            <option
                                                @if(isset($person) && $person->getCoffeeIdInStep('Etapa 1') === $coffeeSpace->id)
                                                    selected
                                                @endif
                                                value="{{ $coffeeSpace->id }}">{{ $coffeeSpace->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="name" class="form-label">Etapa 2:</label>
                                    <select class="form-select" name="coffeeStep2" aria-label="Default select example">
                                        <option value="">Selecione uma Sala</option>
                                        @foreach($coffeeSpaces as $coffeeSpace)
                                            <option
                                                @if(isset($person) && $person->getCoffeeIdInStep('Etapa 2') === $coffeeSpace->id)
                                                    selected
                                                @endif
                                                value="{{ $coffeeSpace->id }}">{{ $coffeeSpace->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Fechar">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

