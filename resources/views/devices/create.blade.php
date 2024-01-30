@extends("layout.app")

@section("title","Crear Dispositivo")

@section("content")

    @include("layout.messages")

    <div class="row" style="margin: 2rem;">
        <div class="col mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">   <h3 class="pb-4">CREAR DISPOSITIVO</h3>     </div>

                        <form class="row g-3 needs-validation" method="post" action="{{ route("devices.store") }}" autocomplete="off">
                            @csrf

                            <div class="col-6">
                                <label for="responsible_id" class="form-label h6">Responsable</label>
                                <select class="form-select border-black" id="responsible_id" name="responsible_id">
                                    <option selected disabled value="">Seleccionar</option>
                                    @foreach($responsibles as $responsible)
                                        <option value="{{ $responsible["id"] }}">{{ $responsible["name"] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="type_device_id" class="form-label h6">Tipo de Dispositivo</label>
                                <select class="form-select border-black" id="type_device_id" name="type_device_id" required>
                                    <option selected disabled value="">Seleccionar</option>
                                    @foreach($typeDevices as $typeDevice)
                                        <option value="{{ $typeDevice["id"] }}">{{ $typeDevice["name"] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="state" class="form-label h6">Estado</label>
                                <select class="form-select border-black" id="state" name="state" required>
                                    <option selected disabled value="">Seleccionar</option>
                                    <option value="en servicio">En Servicio</option>
                                    <option value="sin asignar">Sin Asignar</option>
                                    <option value="fuera de servicio">Fuera de Servicio</option>
                                </select>
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="brand" class="form-label h6">Marca</label>
                                <input type="text" class="form-control border-black" id="brand"
                                       name="brand" required value="{{ old("brand") }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="model" class="form-label h6">Modelo</label>
                                <input type="text" class="form-control border-black" id="model"
                                       name="model" required value="{{ old("model") }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="serial" class="form-label h6">Serial</label>
                                <input type="text" class="form-control border-black" id="serial"
                                       name="serial" required>
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="operating_system" class="form-label h6">Sistema Operativo</label>
                                <input type="text" class="form-control border-black" id="operating_system"
                                       name="operating_system" value="{{ old("operating_system") }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="processor" class="form-label h6">Procesador</label>
                                <input type="text" class="form-control border-black" id="processor"
                                       name="processor" value="{{ old("processor") }}">
                            </div>

                            <div class="col-2" style="padding-top: 6px">
                                <label for="slots"  class="form-label h6">Slots</label>
                                <input type="text"  class="form-control border-black" id="slots" name="slotsOne">
                            </div>

                            <div class="col-2" style="padding-top: 36px">
                                <input type="text" class="form-control border-black" id="slots" name="slotsTwo">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="ram" class="form-label h6">R.A.M</label>
                                <input type="text" class="form-control border-black" id="ram"
                                       name="ram" value="{{ old("ram") }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="memory" class="form-label h6">Memoria</label>
                                <input type="text" id="memory" name="memory" class="form-control border-black"
                                       aria-describedby="memoryType" value="{{ old("memory") }}">
                                <div id="memoryType" class="form-text">
                                    <input style="margin-left: 2px" type="checkbox" id="ssd" name="ssd" value="SSD" >
                                    <label for="ssd" style="margin-right: 20px" class="h6">SSD</label>
                                    <input type="checkbox" id="hdd" name="hdd" value="HDD" >
                                    <label for="hdd" class="h6">HDD</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <label for="labeling" class="form-label h6">Etiquetado</label>
                                <input type="text" class="form-control border-black" id="labeling" name="labeling">
                            </div>

                            <div class="col-4">
                                <label for="purchase_date" class="form-label h6">Fecha de Compra</label>
                                <input type="date" class="form-control border-black" id="purchase_date" name="purchase_date">
                            </div>

                            <div class="col-4">
                                <label for="warranty" class="form-label h6">Garantia</label>
                                <input type="number" id="warranty" name="warranty" class="form-control border-black"
                                       aria-describedby="warrantyText">
                                <div id="warrantyText" class="form-text">
                                    Escribir el tiempo de la grantia en dias
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">CREAR</button>
                                    <a class="btn btn-danger mt-2" href="{{ route("devices.index") }}">VOLVER</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/ValidateCreateDevice.js"></script>

@endsection
