<?php

namespace App\Http\Requests\Responsibles;

use App\Models\Responsible;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateResponsibleRequest extends FormRequest
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
        $id = $this->route('responsible');

        return [
            "name" => ["required",Rule::unique(Responsible::class)->ignore($id,"id")],
            "account" => ["required",Rule::unique(Responsible::class)->ignore($id,"id")],
        ];
    }

    public function messages()
    {
        return [
            "name.unique" => "Ya existe el responsable",
            "name.required" => "El campo NOMBRE es requerido",
            "account.required" => "El campo CUENTA ASOCIADA es requerido",
            "account.unique" => "Ya existe la cuenta",
        ];
    }
}
