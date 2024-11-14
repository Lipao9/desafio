
<!-- Modal -->
<div class="modal fade" id="{{ $modal }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header d-flex p-2 justify-content-center">
                <h1 class="modal-title fs-4" id="exampleModalLabel">Confirmar Deleção?</h1>
            </div>
            <div class="modal-body d-flex justify-content-center text-center">
                Deseja confirmar deleção deste item?
            </div>
            <form action="{{ route($route, $id) }}" method="post">
                <div class="d-flex justify-content-evenly gap-3 p-3">
                    <input type="button" class="btn btn-outline-secondary" style="width: 45%" data-bs-dismiss="modal" value="Voltar">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 45%">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
