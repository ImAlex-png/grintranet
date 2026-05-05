<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Http\Requests\StoreEtiquetaRequest;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::withCount('documentos')->latest()->paginate(10);
        return view('etiquetas.index', compact('etiquetas'));
    }

    public function create()
    {
        return view('etiquetas.create');
    }

    public function store(StoreEtiquetaRequest $request)
    {
        Etiqueta::create($request->validated());
        return redirect()->route('etiquetas.index')->with('success', 'Etiqueta creada.');
    }

    public function show(Etiqueta $etiqueta)
    {
        $etiqueta->load('documentos');
        return view('etiquetas.show', compact('etiqueta'));
    }

    public function edit(Etiqueta $etiqueta)
    {
        return view('etiquetas.edit', compact('etiqueta'));
    }

    public function update(StoreEtiquetaRequest $request, Etiqueta $etiqueta)
    {
        $etiqueta->update($request->validated());
        return redirect()->route('etiquetas.index')->with('success', 'Etiqueta actualizada.');
    }

    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->documentos()->detach();
        $etiqueta->delete();
        return redirect()->route('etiquetas.index')->with('success', 'Etiqueta eliminada.');
    }
}
