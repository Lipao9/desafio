<div class="modal fade" id="{{ isset($coffeeSpace) ? 'CoffeeEdit'.$coffeeSpace->id : "CoffeeModal" }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ isset($coffeeSpace) ? 'Editar Espaço para Café' : 'Adicionar Espaço para Café' }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{  isset($coffeeSpace) ? route('coffee.update', $coffeeSpace->id) : route('coffee.store') }}" method="post">
                @csrf
                @isset($coffeeSpace)
                    @method('PUT')
                @else
                    @method('POST')
                @endisset
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $coffeeSpace->name ?? '' }}" required>
                        </div>
                        <div class="col">
                            <label for="capacity" class="form-label">Capacidade:</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $coffeeSpace->capacity ?? '' }}" required>
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
