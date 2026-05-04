<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoInstitucional extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentoInstitucionalFactory> */
    use HasFactory;

    protected $table = 'documentos_institucionales';

    protected $fillable = [
        'titulo',
        'descripcion',
        'url',
        'tipo_archivo',
    ];
}
