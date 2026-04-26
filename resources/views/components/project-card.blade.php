@props(['title', 'description', 'image' => null, 'tags' => [], 'link' => '#'])

<div class="group relative w-full h-80 rounded-2xl overflow-hidden cursor-pointer border border-white/10 hover:border-cyan-500/50 transition-all duration-500 shadow-lg hover:shadow-[0_0_30px_rgba(34,211,238,0.2)] bg-slate-900/50">
    
    <!-- Background Image or Gradient Placeholder -->
    @if($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:rotate-1 opacity-70 group-hover:opacity-30">
    @else
        <div class="absolute inset-0 bg-linear-to-br from-slate-800 to-slate-900 transition-transform duration-700 group-hover:scale-110">
            <!-- Placeholder pattern -->
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(34,211,238,0.15)_0,transparent_100%)]"></div>
            <!-- Linhas de grade futuristas -->
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-size-[20px_20px]"></div>
        </div>
    @endif

    <!-- Overlay escura que surge no hover -->
    <div class="absolute inset-0 bg-slate-950/20 group-hover:bg-slate-950/80 transition-all duration-500 backdrop-blur-[1px] group-hover:backdrop-blur-md"></div>

    <!-- Conteúdo Estático (Sempre Visível, mas some/sobe no hover) -->
    <div class="absolute inset-0 p-6 flex flex-col justify-end transition-all duration-500 group-hover:-translate-y-4 opacity-100 group-hover:opacity-0">
        <h4 class="text-2xl font-bold text-white drop-shadow-lg">{{ $title }}</h4>
        <div class="w-12 h-1 bg-cyan-500 mt-3 rounded-full shadow-[0_0_10px_rgba(34,211,238,0.8)]"></div>
    </div>

    <!-- Conteúdo Revelado (Oculto por padrão, desliza para cima no hover) -->
    <div class="absolute inset-0 p-6 flex flex-col justify-center translate-y-8 group-hover:translate-y-0 transition-all duration-500 opacity-0 group-hover:opacity-100 z-20">
        <h4 class="text-2xl font-bold text-cyan-400 mb-2 drop-shadow-[0_0_8px_rgba(34,211,238,0.4)]">{{ $title }}</h4>
        
        <div class="relative mb-4">
            <p id="desc-{{ Str::slug($title) }}" class="text-gray-300 text-sm line-clamp-4 leading-relaxed transition-all duration-300">
                {{ $description }}
            </p>
            @if(strlen($description) > 120)
                <button type="button" 
                    onclick="toggleDescription(this, 'desc-{{ Str::slug($title) }}')"
                    class="text-cyan-400 text-xs font-bold mt-1 hover:text-cyan-300 transition-colors cursor-pointer flex items-center gap-1">
                    <span>Ler mais</span>
                    <svg class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            @endif
        </div>
        
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach($tags as $tag)
                <span class="px-2.5 py-1 text-[10px] font-mono text-cyan-200 bg-cyan-900/40 border border-cyan-500/30 rounded shadow-inner">
                    {{ $tag }}
                </span>
            @endforeach
        </div>

        <a href="{{ $link }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-white hover:text-cyan-300 transition-colors w-max group/btn">
            Ver Projeto
            <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </a>
    </div>

    <!-- Decorações Futuristas nos cantos (Crosshairs) -->
    <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-cyan-500/0 group-hover:border-cyan-400/80 transition-all duration-500 m-4 rounded-tl pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-blue-500/0 group-hover:border-blue-400/80 transition-all duration-500 m-4 rounded-br pointer-events-none"></div>
</div>
