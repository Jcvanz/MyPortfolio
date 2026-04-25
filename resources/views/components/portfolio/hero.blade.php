@props(['portfolio'])

<div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between min-h-[calc(100vh-8rem)] px-4 md:px-6">
    
    <div class="w-full md:w-1/2 space-y-4 md:space-y-6 z-10 relative">
        <h2 class="text-cyan-400 font-medium tracking-widest uppercase text-xs md:text-sm flex items-center gap-2">
            <span class="w-6 md:w-8 h-px bg-cyan-400"></span>
            {{ $portfolio->titulo ?? 'Bem-vindo ao meu portfólio' }}
        </h2>
        
        <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold text-white leading-tight">
            Olá, eu sou <br>
            <span class="text-transparent bg-clip-text bg-linear-to-r from-cyan-400 to-blue-600">
                {{ $portfolio->name ?? 'Desenvolvedor' }}
            </span>
        </h1>
        
        <h3 class="text-xl sm:text-2xl md:text-3xl text-gray-300 font-light flex items-center gap-3">
            <svg class="w-5 md:w-6 h-5 md:h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            {{ $portfolio->profissao ?? 'Full Stack Developer' }}
        </h3>
        
        <p class="text-gray-400 text-base md:text-lg max-w-lg leading-relaxed border-l-2 border-gray-800 pl-4">
            {{ $portfolio->resumo ?? 'Construindo soluções digitais inovadoras e experiências web incríveis. Transformo ideias em código limpo e escalável.' }}
        </p>
        
        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4 md:pt-6 w-full sm:w-auto">
            <a href="#contact" class="w-full sm:w-auto text-center px-8 py-3 rounded-full bg-cyan-500 text-slate-950 font-bold hover:bg-cyan-400 transition-all duration-300 shadow-[0_0_15px_rgba(34,211,238,0.4)] hover:shadow-[0_0_25px_rgba(34,211,238,0.6)] hover:-translate-y-1">
                Entrar em Contato
            </a>
            
            @if($portfolio && $portfolio->curriculo_name)
            <a href="{{ $portfolio->curriculo }}" download="{{ $portfolio->curriculo_name }}" class="w-full sm:w-auto justify-center px-8 py-3 rounded-full border border-gray-700 text-gray-300 hover:border-cyan-400 hover:text-cyan-400 transition-all duration-300 flex items-center gap-2 hover:-translate-y-1 bg-white/5 backdrop-blur-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Baixar CV
            </a>
            @endif
        </div>
    </div>

    <div class="w-full md:w-1/2 flex justify-center md:justify-end mt-12 md:mt-0 relative z-10 perspective-1000">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-cyan-500/20 rounded-full blur-[100px] pointer-events-none animate-pulse"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/4 -translate-y-1/4 w-64 h-64 bg-blue-600/20 rounded-full blur-[80px] pointer-events-none"></div>
        
        <div class="relative w-80 h-96 rounded-2xl border border-white/10 bg-slate-900/40 backdrop-blur-xl p-6 flex flex-col justify-between overflow-hidden group hover:border-cyan-500/50 transition-all duration-700 shadow-2xl transform hover:-rotate-y-2 hover:rotate-x-2 hover:scale-105">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-cyan-400/50 shadow-[0_0_15px_rgba(34,211,238,1)] animate-[scan_3s_ease-in-out_infinite]"></div>
            
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-linear-to-br from-cyan-500/20 to-blue-600/20 flex items-center justify-center border border-cyan-500/30 shadow-[0_0_10px_rgba(34,211,238,0.2)]">
                    <span class="text-cyan-400 font-bold text-xl">🚀</span>
                </div>
                <div class="text-right">
                    <div class="text-cyan-400 font-mono text-[10px] tracking-widest uppercase">System Status</div>
                    <div class="text-white text-xs font-semibold flex items-center gap-2 justify-end mt-1 bg-white/5 px-2 py-1 rounded border border-white/5">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse shadow-[0_0_5px_rgba(34,197,94,0.8)]"></span>
                        Online & Ready
                    </div>
                </div>
            </div>
            
            <div class="space-y-3 relative z-10">
                <div class="text-gray-400 text-xs font-mono uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Core Stack
                </div>
                <div class="flex flex-wrap gap-2">
                    @if($portfolio && $portfolio->system_status)
                        @foreach($portfolio->system_status as $tag)
                            <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-white/5 border border-white/10 text-gray-300 hover:text-cyan-400 hover:border-cyan-400/50 transition-colors cursor-default">{{ $tag }}</span>
                        @endforeach
                    @else
                        <span class="px-2.5 py-1 rounded text-[10px] font-mono bg-white/5 border border-white/10 text-gray-300">Nenhuma tag cadastrada</span>
                    @endif
                </div>
            </div>
            
            <div class="h-24 w-full border border-white/5 rounded bg-black/40 p-3 font-mono text-[10px] text-green-400/70 overflow-hidden relative shadow-inner">
                <div class="absolute inset-0 bg-linear-to-b from-transparent to-black/80 pointer-events-none z-10"></div>
                <div class="relative z-0">
                    > root@portfolio:~# init<br>
                    <span class="text-gray-500">> Loading skills... [OK]</span><br>
                    <span class="text-gray-500">> Fetching repos... [OK]</span><br>
                    <span class="text-cyan-400">> Awaiting connection...</span><span class="animate-pulse">_</span>
                </div>
            </div>
        </div>
    </div>
</div>
