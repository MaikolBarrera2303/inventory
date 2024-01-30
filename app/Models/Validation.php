<?php

namespace App\Models;

use Illuminate\Validation\Rule;

class Validation
{
    /**
     * @param $controller
     * @param $id
     * @return array
     */
    public function device($controller,$id): array
    {
        return [
            "validate" => [
                "type_device_id" => "required",
                "state" => "required",
                "brand" => "required",
                "model" => "required",
                "serial" => ($controller === "store") ? ["required",Rule::unique(Device::class)] : ["required",Rule::unique(Device::class)->ignore($id,"id")],
                "labeling" => ($controller === "store") ? ["nullable",Rule::unique(Device::class)] : ["nullable",Rule::unique(Device::class)->ignore($id,"id")],
            ],
            "message" => [
                "type_device_id.required" => "Selecciones un Tipo de Dispositivo",
                "state.required" => "Seleccione un estado",
                "brand.required" => "Ingrese una marca de dispositivo",
                "model.required" => "Ingrese un modelo de dispositivo",
                "serial.required" => "Llenar el campo Serial",
                "serial.unique" => "Este Serial ya existe",
                "labeling.unique" => "Esta Etiqueta ya existe",
            ]
        ];
    }

    public function typeDevice()
    {
        return [
            "validate" => [
                "name" => Rule::unique(TypeDevice::class)
            ],
            "message" => [
                "name.unique" => "El dispositivo ya existe"
            ]
        ];
    }

}
