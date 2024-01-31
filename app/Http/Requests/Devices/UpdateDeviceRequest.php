<?php

namespace App\Http\Requests\Devices;

use App\Models\Device;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $id = $this->route('device');

        return [
            "type_device_id" => "required",
            "state" => "required",
            "brand" => "required",
            "model" => "required",
            "serial" => ["required",Rule::unique(Device::class)->ignore($id,"id")] ,
            "labeling" => ["nullable",Rule::unique(Device::class)->ignore($id,"id")],
        ];
    }

    public function messages()
    {
        return [
            "type_device_id.required" => "Selecciones un Tipo de Dispositivo",
            "state.required" => "Seleccione un estado",
            "brand.required" => "Ingrese una marca de dispositivo",
            "model.required" => "Ingrese un modelo de dispositivo",
            "serial.required" => "Llenar el campo Serial",
            "serial.unique" => "Este Serial ya existe",
            "labeling.unique" => "Esta Etiqueta ya existe",
        ];
    }
}
