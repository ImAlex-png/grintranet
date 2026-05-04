<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DocumentoInstitucional;
use App\Http\Requests\StoreDocumentoInstitucionalRequest;
use App\Http\Requests\UpdateDocumentoInstitucionalRequest;
use Illuminate\Http\Request;

class DocumentoInstitucionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = DocumentoInstitucional::latest()->paginate(10);
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentoInstitucionalRequest $request)
    {
        DocumentoInstitucional::create($request->validated());

        return redirect()->route('documentos.index')
            ->with('success', 'Documento creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentoInstitucional $documento)
    {
        return view('documentos.show', compact('documento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentoInstitucional $documento)
    {
        return view('documentos.edit', compact('documento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentoInstitucionalRequest $request, DocumentoInstitucional $documento)
    {
        $documento->update($request->validated());

        return redirect()->route('documentos.index')
            ->with('success', 'Documento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentoInstitucional $documento)
    {
        $documento->delete();

        return redirect()->route('documentos.index')
            ->with('success', 'Documento eliminado correctamente.');
    }
}
