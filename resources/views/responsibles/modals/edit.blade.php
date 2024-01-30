<div class="modal fade" id="edit_responsible{{ $responsible->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Actualizar {{ $responsible->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-body row g-3">
                    <form action="{{ route("responsibles.update",$responsible->id) }}" method="post" autocomplete="off">
                        @csrf
                        @method("PATCH")

                        <div class="col-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $responsible->name }}" required>
                        </div>

                        <div class="col-12">
                            <label for="account" class="form-label">Cuenta</label>
                            <input type="email" id="account" name="account" class="form-control" value="{{ $responsible->account }}" required>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="phone" class="form-label">Telefono</label>
                            <input type="number" id="phone" name="phone" class="form-control" value="{{ $responsible->phone }}">
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">ACTUALIZAR</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
