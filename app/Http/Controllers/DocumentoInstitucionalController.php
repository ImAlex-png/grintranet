<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DocumentoInstitucional;
use App\Models\Etiqueta;
use App\Models\Categoria;
use App\Http\Requests\StoreDocumentoInstitucionalRequest;
use App\Http\Requests\UpdateDocumentoInstitucionalRequest;
use Illuminate\Http\Request;

class DocumentoInstitucionalController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentoInstitucional::with(['etiquetas', 'categorias']);

        // Búsqueda general
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('titulo', 'like', "%{$buscar}%")
                  ->orWhere('descripcion', 'like', "%{$buscar}%")
                  ->orWhereHas('categorias', function($q) use ($buscar) {
                      $q->where('nombre', 'like', "%{$buscar}%");
                  })
                  ->orWhereHas('etiquetas', function($q) use ($buscar) {
                      $q->where('nombre', 'like', "%{$buscar}%");
                  });
            });
        }

        // Filtro categorías (multiple)
        if ($request->filled('categorias')) {
            $query->whereHas('categorias', function($q) use ($request) {
                $q->whereIn('categorias.id', (array) $request->categorias);
            });
        }

        // Filtro etiquetas (multiple)
        if ($request->filled('etiquetas')) {
            $query->whereHas('etiquetas', function($q) use ($request) {
                $q->whereIn('etiquetas.id', (array) $request->etiquetas);
            });
        }

        // Ordenación
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['titulo', 'created_at', 'updated_at'];
        
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->latest();
        }

        $documentos = $query->paginate(10)->withQueryString();
        $todasCategorias = Categoria::orderBy('nombre')->get();
        $todasEtiquetas = Etiqueta::orderBy('nombre')->get();

        return view('documentos.index', compact('documentos', 'todasCategorias', 'todasEtiquetas'));
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
