@extends("layout.app")

@section("title","Responsables")

@section("content")

    @include("responsibles.modals.create")

    <div class="container mt-4">
            <div class="row justify-content-center pb-4">
                <div class="col-sm-2">
                    <div class="d-grid">
                        <a type="button" class="btn btn-success" data-bs-toggle="modal"
                           data-bs-target="#create_responsible">
                            <i class="bi bi-person-fill-add" style="color: #ffffff"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-6"> @include("layout.messages") </div>
            </div>

        <table class="table table-bordered text-center table-hover">
            <thead>
            <tr>
                <th scope="col">NOMBRE</th>
                <th scope="col">CUENTA</th>
                <th scope="col">TELEFONO</th>
                <th scope="col">OPCIONES</th>
            </tr>
            </thead>
            <tbody>
            @forelse($responsibles as $responsible)
            @php $responsible = (object)$responsible; @endphp
                <tr>
                    <td>{{ $responsible->name }}</td>
                    <td>{{ $responsible->account }}</td>
                    <td>{{ $responsible->phone }}</td>
                    <td>
                        <a type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                           data-bs-target="#edit_responsible{{ $responsible->id }}">
                            <i class="bi bi-pen"></i>
                        </a>

                        <form class="btn p-0" action="{{ route("responsibles.destroy", $responsible->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return window.confirm('¿Quiere eliminar a {{ $responsible->name }}?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                        </form>
                    </td>
                </tr>

                @include("responsibles.modals.edit")

            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay Responsables Registrados.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $responsibles->links() }}
            </div>
        </div>
    </div>

@endsection
