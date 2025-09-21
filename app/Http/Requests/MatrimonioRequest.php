<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatrimonioRequest extends FormRequest
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
			'nombre' => 'required|string',
			'telefono_ella' => 'nullable|string',
			'telefono_el' => 'nullable|string',
			'fin_de_semana' => 'nullable|string',
			'cabeza_comunidad' => 'required|boolean',
			'equipo_post' => 'required|boolean',
			'cargo_post' => 'nullable|string',
			'direccion' => 'nullable|string',
			'colonia' => 'nullable|string',
			'ciudad' => 'nullable|string',
			'codigo_postal' => 'nullable|string',
			'cumpleaños_el' => 'nullable|string',
			'cumpleaños_ella' => 'nullable|string',
			'aniversario' => 'nullable|string',
			'numero_hijos' => 'nullable|integer|min:0',
			'hijos_solteros' => 'nullable|integer|min:0',
			'edades_hijos' => 'nullable|string',
			'comunidad_id' => 'nullable|exists:comunidades,id',
        ];
    }
}
