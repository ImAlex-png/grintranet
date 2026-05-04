@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('documentos.index') }}" class="text-blue-600 hover:bg-blue-50 p-2 rounded-full transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Detalle del Documento</h1>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('documentos.edit', $documento) }}" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg font-semibold hover:bg-indigo-200 transition">Editar</a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-10 border border-gray-100 dark:border-gray-700">
            <div class="mb-8">
                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400 text-xs font-bold uppercase rounded-lg mb-2 inline-block tracking-wider">
                    {{ $documento->tipo_archivo }}
                </span>
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white leading-tight mt-2">{{ $documento->titulo }}</h2>
            </div>

            <div class="mb-8">
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Descripción</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 whitespace-pre-line">{{ $documento->descripcion ?: 'No hay descripción disponible para este documento.' }}</p>
            </div>

            <div class="mb-8">
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Etiquetas</h2>
                <div class="flex flex-wrap gap-3 mt-3">
                    @forelse($documento->etiquetas as $etiqueta)
                        <a href="{{ route('etiquetas.show', $etiqueta) }}" class="px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 text-sm font-bold rounded-xl border border-indigo-100 dark:border-indigo-800 hover:scale-105 transition transform">
                            #{{ $etiqueta->nombre }}
                        </a>
                    @empty
                        <span class="text-gray-400 italic text-sm">Este documento no tiene etiquetas asociadas.</span>
                    @endforelse
                </div>
            </div>

            <div class="pt-10 border-t border-gray-100 dark:border-gray-700 mt-10">
                <a href="{{ $documento->url }}" target="_blank" class="flex items-center justify-center space-x-3 w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-5 px-8 rounded-2xl transition duration-300 shadow-xl hover:shadow-blue-500/30 transform hover:-translate-y-1">
                    <span class="text-xl">Acceder al Documento</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
