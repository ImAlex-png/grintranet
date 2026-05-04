@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center space-x-2">
            <a href="{{ route('documentos.index') }}" class="text-blue-600 hover:underline">← Volver</a>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Nuevo Documento</h1>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8">
            <form action="{{ route('documentos.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                        <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                        @error('titulo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL del Recurso</label>
                            <input type="url" name="url" id="url" value="{{ old('url') }}" placeholder="https://..." required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                            @error('url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="tipo_archivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Archivo</label>
                            <select name="tipo_archivo" id="tipo_archivo" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                                <option value="">Selecciona un tipo</option>
                                <option value="Video" {{ old('tipo_archivo') == 'Video' ? 'selected' : '' }}>Video</option>
                                <option value="Documento" {{ old('tipo_archivo') == 'Documento' ? 'selected' : '' }}>Documento</option>
                                <option value="Presentación" {{ old('tipo_archivo') == 'Presentación' ? 'selected' : '' }}>Presentación</option>
                                <option value="Imagen" {{ old('tipo_archivo') == 'Imagen' ? 'selected' : '' }}>Imagen</option>
                                <option value="Otros" {{ old('tipo_archivo') == 'Otros' ? 'selected' : '' }}>Otros</option>
                            </select>
                            @error('tipo_archivo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 shadow-lg">
                            Guardar Documento
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
