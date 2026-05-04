<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DocumentoInstitucional;
use App\Models\Etiqueta;
use App\Http\Requests\StoreDocumentoInstitucionalRequest;
use App\Http\Requests\UpdateDocumentoInstitucionalRequest;
use Illuminate\Http\Request;

class DocumentoInstitucionalController extends Controller
{
    public function index()
    {
        $documentos = DocumentoInstitucional::with('etiquetas')->latest()->paginate(10);
        return view('documentos.index', compact('documentos'));
    }

    public function create()
    {
        $etiquetas = Etiqueta::all();
        $categorias = Categoria::all();
        return view('documentos.create', compact('etiquetas', 'categorias'));
    }

    public function store(StoreDocumentoInstitucionalRequest $request)
    {
        $documento = DocumentoInstitucional::create($request->validated());
        
        if ($request->has('etiquetas')) {
            $documento->etiquetas()->sync($request->etiquetas);
        }

        if ($request->has('categorias')) {
            $documento->categorias()->sync($request->categorias);
        }

        return redirect()->route('documentos.index')
            ->with('success', 'Documento creado correctamente.');
    }

    public function show(DocumentoInstitucional $documento)
    {
        return view('documentos.show', compact('documento'));
    }

    public function edit(DocumentoInstitucional $documento)
    {
        $etiquetas = Etiqueta::all();
        $categorias = Categoria::all();
        return view('documentos.edit', compact('documento', 'etiquetas', 'categorias'));
    }

    public function update(UpdateDocumentoInstitucionalRequest $request, DocumentoInstitucional $documento)
    {
        $documento->update($request->validated());
        
        if ($request->has('etiquetas')) {
            $documento->etiquetas()->sync($request->etiquetas);
        }

        if ($request->has('categorias')) {
            $documento->categorias()->sync($request->categorias);
        }

        return redirect()->route('documentos.index')
            ->with('success', 'Documento actualizado correctamente.');
    }

    public function destroy(DocumentoInstitucional $documento)
    {
        $documento->etiquetas()->detach();
        $documento->categorias()->detach();
        $documento->delete();

        return redirect()->route('documentos.index')
            ->with('success', 'Documento eliminado correctamente.');
    }
}
