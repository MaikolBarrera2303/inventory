@extends("layout.app")

@section("title","Crear Dispositivo")

@section("content")

    @include("layout.messages")

    <div class="row" style="margin: 2rem;">
        <div class="col mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">   <h3 class="pb-4">INFORMACION DISPOSITIVO</h3>     </div>
                        <div class="row g-3">


                            <div class="col-6">
                                <label for="responsible_id" class="form-label h6">Responsable</label>
                                <input type="text" class="form-control border-black" id="responsible_id"
                                       disabled value="{{ ($device->responsible_id === null) ? "N/A" : $device->responsible["name"] }}">
                            </div>

                            <div class="col-6">
                                <label for="type_device_id" class="form-label h6">Responsable</label>
                                <input type="text" class="form-control border-black" id="type_device_id"
                                       disabled value="{{ $device->type_device["name"] }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="state" class="form-label h6">Estado</label>
                                <input type="text" class="form-control border-black" id="state"
                                       disabled value="{{  $device->state }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="brand" class="form-label h6">Marca</label>
                                <input type="text" class="form-control border-black" id="brand"
                                       disabled value="{{ $device->brand }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="model" class="form-label h6">Modelo</label>
                                <input type="text" class="form-control border-black" id="model"
                                       disabled value="{{ $device->model }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="serial" class="form-label h6">Serial</label>
                                <input type="text" class="form-control border-black" id="serial"
                                       disabled value="{{ $device->serial }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="operating_system" class="form-label h6">Sistema Operativo</label>
                                <input type="text" class="form-control border-black" id="operating_system"
                                       disabled value="{{ $device->operating_system }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="processor" class="form-label h6">Procesador</label>
                                <input type="text" class="form-control border-black" id="processor"
                                       disabled value="{{ $device->processor }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="slots"  class="form-label h6">Slots</label>
                                <input type="text"  class="form-control border-black" id="slots"
                                       disabled value="{{ $device->slots }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="ram" class="form-label h6">R.A.M</label>
                                <input type="text" class="form-control border-black" id="ram"
                                       disabled value="{{ $device->ram }}">
                            </div>

                            <div class="col-4" style="padding-top: 6px">
                                <label for="memory" class="form-label h6">Memoria</label>
                                <input type="text" id="memory" class="form-control border-black" disabled
                                       value="{{ $device->memory }}">
                            </div>

                            <div class="col-4">
                                <label for="labeling" class="form-label h6">Etiquetado</label>
                                <input type="text" class="form-control border-black" id="labeling"
                                       disabled value="{{ $device->labeling }}">
                            </div>

                            <div class="col-4">
                                <label for="purchase_date" class="form-label h6">Fecha de Compra</label>
                                <input type="text" class="form-control border-black" id="purchase_date"
                                       disabled value="{{ $device->purchase_date }}">
                            </div>

                            <div class="col-4">
                                <label for="warranty" class="form-label h6">Garantia</label>
                                <input type="number" id="warranty" class="form-control border-black"
                                       disabled value="{{ ((new DateTime($device->warranty))->diff(new DateTime(date("Y-m-d"))))->days }}">
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <a class="btn btn-danger mt-2" href="{{ route("devices.index") }}">VOLVER</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
