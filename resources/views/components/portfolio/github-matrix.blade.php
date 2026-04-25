<section class="max-w-7xl mx-auto px-4 md:px-6 py-24 relative z-10">
    <div class="flex items-center gap-3 mb-12">
        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
        </svg>
        <h3 class="text-white text-xl md:text-2xl font-mono uppercase tracking-widest">GitHub <span class="text-white font-bold">Matrix</span></h3>
        <div class="h-px bg-linear-to-r from-gray-500/50 to-transparent flex-1 ml-4"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="gh-stats-grid">
        <!-- Repositórios -->
        <div class="group relative p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-white/40 transition-all duration-300 backdrop-blur-sm overflow-hidden flex flex-col justify-center items-center text-center">
            <div class="absolute inset-0 bg-white/0 group-hover:bg-white/5 transition-colors duration-500 rounded-2xl pointer-events-none"></div>
            <div class="text-gray-400 font-mono text-sm uppercase tracking-widest mb-2">Repositórios</div>
            <div class="text-4xl font-bold text-white" id="gh-repos">--</div>
        </div>

        <!-- Stars -->
        <div class="group relative p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-yellow-400/50 transition-all duration-300 backdrop-blur-sm overflow-hidden flex flex-col justify-center items-center text-center">
            <div class="absolute inset-0 bg-yellow-500/0 group-hover:bg-yellow-500/5 transition-colors duration-500 rounded-2xl pointer-events-none"></div>
            <div class="font-mono text-sm uppercase tracking-widest mb-2 text-yellow-500/70">Estrelas</div>
            <div class="text-4xl font-bold text-yellow-400" id="gh-stars">--</div>
        </div>

        <!-- Seguidores -->
        <div class="group relative p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-blue-400/50 transition-all duration-300 backdrop-blur-sm overflow-hidden flex flex-col justify-center items-center text-center">
            <div class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/5 transition-colors duration-500 rounded-2xl pointer-events-none"></div>
            <div class="font-mono text-sm uppercase tracking-widest mb-2 text-blue-500/70">Seguidores</div>
            <div class="text-4xl font-bold text-blue-400" id="gh-followers">--</div>
        </div>

        <!-- Linguagem Top -->
        <div class="group relative p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-green-400/50 transition-all duration-300 backdrop-blur-sm overflow-hidden flex flex-col justify-center items-center text-center">
            <div class="absolute inset-0 bg-green-500/0 group-hover:bg-green-500/5 transition-colors duration-500 rounded-2xl pointer-events-none"></div>
            <div class="font-mono text-sm uppercase tracking-widest mb-2 text-green-500/70">Top Linguagem</div>
            <div class="text-3xl font-bold text-green-400 mt-1" id="gh-language">--</div>
        </div>
    </div>

    <!-- Detalhamento Avançado: Barras de Linguagem + Stats Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        
        <!-- Progress Bars de Linguagens -->
        <div class="group relative p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-cyan-400/50 transition-all duration-300 backdrop-blur-sm overflow-hidden">
            <div class="absolute inset-0 bg-cyan-500/0 group-hover:bg-cyan-500/5 transition-colors duration-500 rounded-2xl pointer-events-none"></div>
            <div class="font-mono text-sm uppercase tracking-widest mb-6 text-cyan-400 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                Linguagens por Repositório
            </div>
            
            <div id="gh-langs-container" class="space-y-4">
                <!-- Skeleton Loading -->
                <div class="animate-pulse flex space-x-4">
                    <div class="flex-1 space-y-4 py-1">
                        <div class="h-2 bg-white/10 rounded w-3/4"></div>
                        <div class="h-2 bg-white/10 rounded w-full"></div>
                        <div class="h-2 bg-white/10 rounded w-5/6"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GitHub Readme Stats Card (Geral) -->
        <div class="group relative p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-blue-400/50 transition-all duration-300 backdrop-blur-sm overflow-hidden flex flex-col items-center justify-center">
            <div class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/5 transition-colors duration-500 rounded-2xl pointer-events-none"></div>
            <img src="https://github-readme-stats.vercel.app/api?username=Jcvanz&show_icons=true&theme=vision-friendly-dark&hide_border=true&bg_color=00000000&text_color=9ca3af&title_color=3b82f6&icon_color=22d3ee" alt="GitHub Stats" class="w-full drop-shadow-[0_0_15px_rgba(59,130,246,0.1)] transition-transform duration-500 group-hover:scale-105">
        </div>

    </div>
</section>
