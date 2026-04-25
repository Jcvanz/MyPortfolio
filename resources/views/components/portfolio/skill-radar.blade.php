@props(['portfolio' => null])

<section class="max-w-7xl mx-auto px-4 md:px-6 pb-16 pt-10 mt-8 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        
        <!-- Info Texto / Perfil Profissional -->
        <div class="space-y-6 order-2 lg:order-1">
            <div class="space-y-2">
                <h3 class="text-3xl md:text-4xl text-white font-bold leading-tight"><span class="text-transparent bg-clip-text bg-linear-to-r from-cyan-400 to-blue-500">Sobre</span></h3>
                @if($portfolio && ($portfolio->cidade || $portfolio->estado))
                    <div class="flex items-center gap-2 text-cyan-400/80 font-mono text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>{{ $portfolio->cidade }}{{ $portfolio->cidade && $portfolio->estado ? ', ' : '' }}{{ $portfolio->estado }}</span>
                    </div>
                @endif
            </div>
            
            <div class="border-l-2 border-cyan-500/50 pl-5 space-y-4 text-gray-400 leading-relaxed text-lg">
                @if($portfolio && $portfolio->logica_juridica_texto)
                    {!! nl2br(e($portfolio->logica_juridica_texto)) !!}
                @else
                    <p>Gaúcho de origem, mas com o código enraizado em Blumenau, Santa Catarina. Aos 22 anos, minha trajetória é marcada por uma transição decidida para a tecnologia. Atualmente no 7º semestre de Ciência da Computação na FURB, atuo como Desenvolvedor Fullstack, unindo o rigor acadêmico com a agilidade do mercado.</p>
                    <p>Minha base técnica foi lapidada em programas como o Entra21 (React Native), mas minha visão vai além das telas. A experiência anterior no Direito e os estágios no setor público (Fórum e Prefeitura) me deram uma capacidade analítica diferenciada para entender regras de negócio complexas e processos estruturados antes mesmo de transformá-los em software escalável.</p>
                @endif
            </div>

            <div class="flex flex-wrap gap-3 pt-4">
                <span class="px-4 py-1.5 rounded-full border border-cyan-500/20 bg-cyan-500/5 text-xs font-mono text-cyan-300 shadow-[0_0_10px_rgba(34,211,238,0.1)]">Resolução de Problemas</span>
                <span class="px-4 py-1.5 rounded-full border border-cyan-500/20 bg-cyan-500/5 text-xs font-mono text-cyan-300 shadow-[0_0_10px_rgba(34,211,238,0.1)]">Pensamento Analítico</span>
                <span class="px-4 py-1.5 rounded-full border border-cyan-500/20 bg-cyan-500/5 text-xs font-mono text-cyan-300 shadow-[0_0_10px_rgba(34,211,238,0.1)]">Foco em Performance</span>
            </div>
        </div>

        <!-- Chart Container -->
        <div class="group relative p-8 rounded-2xl bg-slate-900/40 border border-white/5 backdrop-blur-md overflow-hidden hover:border-cyan-500/30 transition-all duration-500 shadow-2xl order-1 lg:order-2">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(34,211,238,0.05)_0,transparent_100%)] pointer-events-none"></div>
            
            <h4 class="text-cyan-400 font-mono tracking-widest uppercase mb-2 text-center text-sm">Radar de Skills</h4>
            <p class="text-gray-500 text-xs text-center mb-8 font-mono">Análise de Proficiência Estratégica</p>
            
            <div class="w-full max-w-[320px] mx-auto aspect-square relative z-10">
                <canvas id="skillsRadar"></canvas>
            </div>
            
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-cyan-500/10 rounded-full blur-[50px] pointer-events-none"></div>
        </div>
    </div>
</section>
