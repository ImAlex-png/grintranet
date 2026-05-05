<div class="bg-[#1e293b] shadow-xl rounded-xl overflow-hidden border border-slate-700">
    <table class="min-w-full divide-y divide-slate-700">
        <thead class="bg-slate-800/50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider cursor-pointer hover:text-sky-400 transition-colors sortable-header group" data-sort="nombre">
                    <div class="flex items-center gap-1.5">
                         Nombre
                        <span class="flex flex-col">
                            @if(request('sort') == 'nombre')
                                <svg class="w-3 h-3 {{ request('direction') == 'asc' ? 'rotate-180' : '' }} text-sky-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            @else
                                <svg class="w-3 h-3 text-slate-600 group-hover:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                            @endif
                        </span>
                    </div>
                </th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider cursor-pointer hover:text-sky-400 transition-colors sortable-header group" data-sort="tipo">
                    <div class="flex items-center gap-1.5">
                        Tipo
                        <span class="flex flex-col">
                            @if(request('sort') == 'tipo')
                                <svg class="w-3 h-3 {{ request('direction') == 'asc' ? 'rotate-180' : '' }} text-sky-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            @else
                                <svg class="w-3 h-3 text-slate-600 group-hover:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                            @endif
                        </span>
                    </div>
                </th>
                <th class="px-6 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider cursor-pointer hover:text-sky-400 transition-colors sortable-header group" data-sort="documentos_count">
                    <div class="flex items-center gap-1.5">
                        Documentos vinculados
                        <span class="flex flex-col">
                            @if(request('sort') == 'documentos_count')
                                <svg class="w-3 h-3 {{ request('direction') == 'asc' ? 'rotate-180' : '' }} text-sky-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            @else
                                <svg class="w-3 h-3 text-slate-600 group-hover:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                            @endif
                        </span>
                    </div>
                </th>
                <th class="px-6 py-3 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700">
            @forelse($categorias as $categoria)
                <tr class="hover:bg-slate-700/30 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-gray-900 dark:text-white">
                            {{ $categoria->nombre }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ 
                            $categoria->tipo === 'departamento' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' : 
                            ($categoria->tipo === 'curso' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400') 
                        }}">
                            {{ ucfirst(str_replace('_', ' ', $categoria->tipo)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $categoria->documentos_count }} documentos
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('categorias.edit', $categoria) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">No hay categorías que coincidan con la búsqueda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 ajax-pagination">
    {{ $categorias->links() }}
</div>
