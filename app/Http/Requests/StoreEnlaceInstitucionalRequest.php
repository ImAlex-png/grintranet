<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnlaceInstitucionalRequest extends FormRequest
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
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id',
        ];
    }
}
