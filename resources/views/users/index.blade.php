@extends("layout.app")

@section("title","Usuarios")

@section("content")

    @include("users.modals.create")

    <div class="container mt-4">
            <div class="row justify-content-center pb-4">
                <div class="col-sm-2">
                    <div class="d-grid">
                        <a type="button" class="btn btn-success" data-bs-toggle="modal"
                           data-bs-target="#create_user">
                            <i class="bi bi-person-fill-add" style="color: #ffffff"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-6"> @include("layout.messages") </div>
            </div>

        <table class="table table-bordered table-hover text-center">
            <thead>
            <tr>
                <th scope="col">NOMBRE</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ROL</th>
                <th scope="col">OPCIONES</th>
            </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <a type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                               data-bs-target="#edit_user{{ $user->id }}">
                                <i class="bi bi-pen"></i>
                            </a>

                            <form class="btn p-0" action="{{ route("users.destroy", $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return window.confirm('¿Quiere eliminar a {{ $user->name }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                            </form>
                        </td>
                    </tr>

                    @include("users.modals.edit")

                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay Accesorios disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection
