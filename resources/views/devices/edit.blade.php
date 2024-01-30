@extends("layout.app")

@section("title","Crear Dispositivo")

@section("content")

    @include("layout.messages")

    <div class="row" style="margin: 2rem;">
        <div class="col mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">   <h3 class="pb-4">EDITAR DISPOSITIVO</h3>     </div>
                        @php $device = (object)$device; @endphp

                        <form class="row g-3 needs-validation" method="post" action="{{ route("devices.update",$device->id) }}" autocomplete="off">
                            @csrf
                            @method("PATCH")

                            <div class="col-6">
                                <label for="responsible_id" class="form-label h6">Responsable</label>
                                <select class="form-select border-black" id="responsible_id" name="responsible_id">
                                    <option {{ is_null($device->responsible_id) ? 'selected disabled ' : '' }}value="{{ optional($device->responsible)["id"] }}">
                                        {{ optional($device->responsible)["name"] ?? 'Seleccionar' }}</option>
                                    @foreach($responsibles as $responsible)
                                        <option value="{{ $responsible["id"] }}">{{ $responsible["name"] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="type_device_id" class="form-label h6">Tipo de Dispositivo</label>
                                <select class="form-select border-black" id="type_device_id" name="type_device_id" required>
                                    <option selected value="{{ $device->type_device["id"] }}">{{ $device->type_device["name"] }}</option>
                                    @foreach($typeDevices as $typeDevice)
                                        <option value="{{ $typeDevice["id"] }}">{{ $typeDevice["name"] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="state" class="form-label h6">Estado</label>
                                <select class="form-select border-black" id="state" name="state" required>
                                    <option selected value="{{ $device->state }}">{{ $device->state }}</option>
                                    <option value="en servicio">En Servicio</option>
                                    <option value="sin asignar">Sin Asignar</option>
                                    <option value="fuera de servicio">Fuera de Servicio</option>
                                </select>
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="brand" class="form-label h6">Marca</label>
                                <input type="text" class="form-control border-black" id="brand"
                                       name="brand" required value="{{ $device->brand }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="model" class="form-label h6">Modelo</label>
                                <input type="text" class="form-control border-black" id="model"
                                       name="model" required value="{{ $device->model }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="serial" class="form-label h6">Serial</label>
                                <input type="text" class="form-control border-black" id="serial"
                                       name="serial" required value="{{ $device->serial }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="operating_system" class="form-label h6">Sistema Operativo</label>
                                <input type="text" class="form-control border-black" id="operating_system"
                                       name="operating_system" value="{{ $device->operating_system }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="processor" class="form-label h6">Procesador</label>
                                <input type="text" class="form-control border-black" id="processor"
                                       name="processor" value="{{ $device->processor }}">
                            </div>

                            <div class="col-2" style="padding-top: 6px">
                                <label for="slots"  class="form-label h6">Slots</label>
                                <input type="text"  class="form-control border-black" id="slots"
                                       name="slotsOne" value="{{ Str::before($device->slots," DE ") }}">
                            </div>

                            <div class="col-2" style="padding-top: 36px">
                                <input type="text" class="form-control border-black" id="slots"
                                       name="slotsTwo" value="{{ Str::after($device->slots," DE ") }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="ram" class="form-label h6">R.A.M</label>
                                <input type="text" class="form-control border-black" id="ram"
                                       name="ram" value="{{ $device->ram }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="memory" class="form-label h6">Memoria</label>
                                <input type="text" id="memory" name="memory" class="form-control border-black"
                                       aria-describedby="memoryType" value="{{ Str::before($device->memory, " ") }}">
                                <div id="memoryType" class="form-text">
                                    <input style="margin-left: 2px" type="checkbox" id="ssd" name="ssd" value="SSD" @checked($typeMemory === "SSD")>
                                    <label for="ssd" style="margin-right: 20px" class="h6">SSD</label>
                                    <input type="checkbox" id="hdd" name="hdd" value="HDD" @checked($typeMemory === "HDD")>
                                    <label for="hdd" class="h6">HDD</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <label for="labeling" class="form-label h6">Etiquetado</label>
                                <input type="text" class="form-control border-black" id="labeling"
                                       name="labeling" value="{{ $device->labeling }}">
                            </div>

                            <div class="col-4">
                                <label for="purchase_date" class="form-label h6">Fecha de Compra</label>
                                <input type="date" class="form-control border-black"
                                       id="purchase_date" name="purchase_date" value="{{ $device->purchase_date }}">
                            </div>

                            <div class="col-4">
                                <label for="warranty" class="form-label h6">Garantia</label>
                                <input type="number" id="warranty" name="warranty" class="form-control border-black"
                                       aria-describedby="warrantyText" value="{{ ((new DateTime($device->warranty))->diff(new DateTime(date("Y-m-d"))))->days }}">
                                <div id="warrantyText" class="form-text">
                                    Escribir el tiempo de la grantia en dias
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">ACTUALIZAR</button>
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
