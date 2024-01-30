<div class="modal fade" id="create_responsible" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear Responsable</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-body row g-3">
                    <form action="{{ route("responsibles.store") }}" method="post" autocomplete="off">
                        @csrf

                        <div class="col-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="account" class="form-label">Cuenta asociada</label>
                            <input type="email" id="account" name="account" class="form-control" required>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="phone" class="form-label">Telefono</label>
                            <input type="number" id="phone" name="phone" class="form-control">
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">CREAR</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
