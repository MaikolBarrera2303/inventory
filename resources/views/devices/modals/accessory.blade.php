<div class="modal fade" id="create_accessory{{ $device->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear Accesorio para {{ $device->brand." ".$device->model }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-top: 0">
                <div class="form-body row g-3">
                    <form action="{{ route("accessories.store") }}" method="post">
                        @csrf

                        <div class="col-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="serial" class="form-label">Serial</label>
                            <input type="text" id="serial" name="serial" class="form-control">
                        </div>

                        <div class="col-12 mt-2">
                            <label for="labeling" class="form-label">Etiquetado</label>
                            <input type="text" id="labeling" name="labeling" class="form-control">
                        </div>

                        <input name="device_id" type="hidden" value="{{ $device->id }}">

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
