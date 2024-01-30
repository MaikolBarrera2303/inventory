@extends("layout.app")

@section("title","Usuarios")

@section("content")

    @include("accessories.modals.create")

    <div class="container mt-4">
            <div class="row justify-content-center pb-4">
                <div class="col-sm-2">
                    <div class="d-grid">
                        <a type="button" class="btn btn-success" data-bs-toggle="modal"
                           data-bs-target="#create_accessory">
                            <i class="bi bi-clipboard-plus-fill" style="color: #ffffff"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-6"> @include("layout.messages") </div>
            </div>

        <table class="table table-bordered table-striped text-center">
            <thead>
            <tr>
                <th scope="col">NOMBRE</th>
                <th scope="col">SERIAL</th>
                <th scope="col">DISPOSITIVO</th>
                <th scope="col">OPCIONES</th>
            </tr>
            </thead>
            <tbody>
            @forelse($accessories as $accessory)
                <tr>
                    <td>{{ $accessory->name }}</td>
                    <td>{{ $accessory->serial }}</td>
                    <td>{{ $accessory->device->brand }}</td>
                    <td>
                        <a type="button" class="btn btn-info" data-bs-toggle="modal"
                           data-bs-target="#edit_user{{ $user->id }}">
                            <i class="bi bi-pen"></i>
                        </a>

                        <form class="btn p-0" action="{{ route("accessories.destroy", $accessory->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return window.confirm('¿Quiere eliminar a {{ $accessory->name }}?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay Accesorios disponibles.</td>
                </tr>
            @endforelse

            </tbody>
        </table>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $accessories->links() }}
            </div>
        </div>
    </div>

@endsection
