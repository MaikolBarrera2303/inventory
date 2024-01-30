<div class="modal fade" id="create_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-body row g-3">
                    <form action="{{ route("users.store") }}" method="post" autocomplete="off">
                        @csrf

                        <div class="col-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old("name") }}" required>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="email" class="form-label">Correo Electronico</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old("email") }}" required>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="role_id" class="form-label">Rol</label>
                            <select id="role_id" name="role_id" class="form-select" required>
                                <option selected disabled value="">Seleccionar</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <div class="col-12 mt-3">
                            <label for="password_confirmation" class="form-label">Verificar Contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
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
