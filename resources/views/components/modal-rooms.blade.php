<div class="modal fade" id="{{ isset($room) ? 'RoomEdit'.$room->id : "RoomsModal" }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ isset($room) ? 'Editar Sala' : 'Adicionar Sala' }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{  isset($room) ? route('room.update', $room->id) : route('room.store') }}" method="post">
                @csrf
                @isset($room)
                    @method('PUT')
                @else
                    @method('POST')
                @endisset

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $room->name ?? '' }}" required>
                        </div>
                        <div class="col">
                            <label for="capacity" class="form-label">Capacidade:</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $room->capacity ?? '' }}" required>
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
