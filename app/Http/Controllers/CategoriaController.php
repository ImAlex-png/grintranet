<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Categoria::withCount('documentos');

        // Búsqueda
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'LIKE', "%{$buscar}%")
                  ->orWhere('tipo', 'LIKE', "%{$buscar}%");
            });
        }

        // Filtro por Tipo
        if ($request->filled('tipos')) {
            $query->whereIn('tipo', $request->tipos);
        }

        // Ordenación
        $sortField = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        
        $allowedSorts = ['nombre', 'tipo', 'created_at', 'documentos_count'];
        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $direction);
        }

        $categorias = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('categorias._table', compact('categorias'))->render();
        }

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(StoreCategoriaRequest $request)
    {
        Categoria::create($request->validated());
        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function show(Categoria $categoria)
    {
        $categoria->load('documentos');
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(StoreCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->documentos()->detach();
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente.');
    }
}
