<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'url' => 'required|url|max:255',
            'etiquetas' => 'nullable|string', // Lo recibiremos como string separado por comas
        ];
    }
}
