@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Nueva Categoría</h1>
            <a href="{{ route('categorias.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition">
                &larr; Volver
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
            <form action="{{ route('categorias.store') }}" method="POST" class="p-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nombre de la Categoría</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Ej: Departamento de Matemáticas" required>
                        @error('nombre')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tipo" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipo de Categoría</label>
                        <select name="tipo" id="tipo" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
                            <option value="">Selecciona un tipo...</option>
                            <option value="departamento" {{ old('tipo') == 'departamento' ? 'selected' : '' }}>Departamento</option>
                            <option value="curso" {{ old('tipo') == 'curso' ? 'selected' : '' }}>Curso</option>
                            <option value="tipo_documento" {{ old('tipo') == 'tipo_documento' ? 'selected' : '' }}>Tipo de Documento</option>
                        </select>
                        @error('tipo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl transition duration-300 shadow-lg transform hover:-translate-y-1">
                            Guardar Categoría
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
