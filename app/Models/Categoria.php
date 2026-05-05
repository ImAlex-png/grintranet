<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'tipo'];

    public function documentos()
    {
        return $this->belongsToMany(DocumentoInstitucional::class, 'documento_categoria', 'categoria_id', 'documento_id');
    }
}
