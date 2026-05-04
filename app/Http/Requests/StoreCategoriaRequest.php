<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('categoria') ? $this->route('categoria')->id : null;

        return [
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $id,
            'tipo' => 'required|string|in:departamento,curso,tipo_documento',
        ];
    }
}
