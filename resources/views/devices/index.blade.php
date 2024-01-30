@extends("layout.app")

@section("title","Dispositivos")

@section("content")

    <div class="container mt-4">
        <div class="row justify-content-center pb-4">
            <div class="col-sm-2">
                <div class="d-grid">
                    <a class="btn btn-success" href="{{ route("devices.create") }}">
                        <i class="bi bi-clipboard-plus-fill" style="color: #ffffff"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-6"> @include("layout.messages") </div>
        </div>

        <table class="table table-bordered text-center table-hover">
            <thead>
            <tr>
                <th scope="col">RESPONSABLE</th>
                <th scope="col">TIPO</th>
                <th scope="col">ESTADO</th>
                <th scope="col">MARCA</th>
                <th scope="col">MODELO</th>
                <th scope="col">SERIAL</th>
                <th scope="col">OPCIONES</th>
            </tr>
            </thead>
            <tbody>
            @forelse($devices as $device)
                @php $device = (object)$device; @endphp
                <tr>
                    <td>
                        @if($device->responsible !== null)
                            {{ $device->responsible["name"] }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $device->type_device["name"] }}</td>
                    <td>
                        @if($device->state === "En Servicio")
                            <span class="badge text-bg-success">{{ $device->state }}</span>
                        @elseif($device->state === "Sin Asignar")
                            <span class="badge text-bg-warning">{{ $device->state }}</span>
                        @else
                            <span class="badge text-bg-danger">{{ $device->state }}</span>
                        @endif
                    </td>
                    <td>{{ $device->brand }}</td>
                    <td>{{ $device->model }}</td>
                    <td>{{ $device->serial }}</td>
                    <td>
                        <a type="button" title="Agregar Accesorio" class="btn text-white"  data-bs-toggle="modal"
                           style="background-color: #fd7e14" data-bs-target="#create_accessory{{ $device->id }}">
                            <i class="bi bi-mouse"></i>
                        </a>

                        <a type="button" title="Informacion" class="btn btn-info text-white" href="{{ route("devices.show",$device->id) }}">
                            <i class="bi bi-info-circle"></i>
                        </a>

                        <a type="button" title="Actualizar" class="btn btn-secondary text-white" href="{{ route("devices.edit",$device->id) }}">
                            <i class="bi bi-pen"></i>
                        </a>

                        <form class="btn p-0" action="{{ route("devices.destroy", $device->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Eliminar"
                                    onclick="return window.confirm('¿Quiere eliminar a {{ $device->serial }}?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @include("devices.modals.accessory")
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay Dispositivos Registrados.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $devices->links() }}
            </div>
        </div>
    </div>

@endsection
