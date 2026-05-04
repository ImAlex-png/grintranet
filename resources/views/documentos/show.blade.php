@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <a href="{{ route('documentos.index') }}" class="text-blue-600 hover:underline">← Volver</a>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Detalle del Documento</h1>
            </div>
            @role('admin')
            <a href="{{ route('documentos.edit', $documento) }}" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-200 transition">Editar</a>
            @endrole
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8">
            <div class="mb-6">
                <h2 class="text-sm uppercase tracking-widest text-gray-500 mb-1">Título</h2>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $documento->titulo }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-sm uppercase tracking-widest text-gray-500 mb-1">Descripción</h2>
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $documento->descripcion ?: 'Sin descripción.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-sm uppercase tracking-widest text-gray-500 mb-1">Tipo de Archivo</h2>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-bold">{{ $documento->tipo_archivo }}</span>
                </div>
                <div>
                    <h2 class="text-sm uppercase tracking-widest text-gray-500 mb-1">Fecha de Registro</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ $documento->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="border-t pt-6 flex justify-center">
                <a href="{{ $documento->url }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-full transition duration-300 shadow-xl flex items-center space-x-2">
                    <span>Acceder al Recurso Externo</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
