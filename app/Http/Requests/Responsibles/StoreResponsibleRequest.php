<?php

namespace App\Http\Requests\Responsibles;

use App\Models\Responsible;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResponsibleRequest extends FormRequest
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
        return [
            "name" => ["required",Rule::unique(Responsible::class)],
            "account" => ["required",Rule::unique(Responsible::class)],
        ];
    }

    public function messages()
    {
        return [
            "name.unique" => "Ya existe el responsable",
            "name.required" => "El campo nombre es requerido",
            "account.required" => "El campo Cuenta Asociada es requerido",
            "account.unique" => "Ya existe la cuenta",
        ];
    }

}
