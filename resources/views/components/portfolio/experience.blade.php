@if($experiences->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 md:px-6 py-6 relative z-10">

    {{-- Cabeçalho --}}
    <div class="flex items-center gap-3 mb-12">
        <svg class="w-8 h-8 text-white flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
        </svg>
        <h3 class="text-white text-xl md:text-2xl font-mono uppercase tracking-widest">
            Experiência <span class="text-white font-bold">Profissional</span>
        </h3>
        <div class="h-px bg-linear-to-r from-gray-500/50 to-transparent flex-1 ml-4"></div>
    </div>

    {{-- Tabs de navegação --}}
    <div class="flex flex-wrap gap-2 mb-10" id="exp-tabs" role="tablist">
        @foreach($experiences as $index => $exp)
        <button
            id="tab-{{ $exp->id }}"
            role="tab"
            aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
            aria-controls="panel-{{ $exp->id }}"
            onclick="switchExpTab({{ $exp->id }})"
            class="exp-tab relative px-4 py-2 rounded-xl font-mono text-sm transition-all duration-300 border
                   {{ $index === 0
                       ? 'bg-cyan-500/10 border-cyan-400/50 text-cyan-300 shadow-[0_0_14px_rgba(34,211,238,0.15)]'
                       : 'bg-white/5 border-white/10 text-gray-400 hover:border-white/30 hover:text-white' }}"
        >
            {{-- Indicador ativo --}}
            <span class="exp-tab-indicator absolute -bottom-px left-1/2 -translate-x-1/2 w-4 h-0.5 rounded-full bg-cyan-400 transition-all duration-300
                         {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"></span>
            {{ $exp->empresa }}
        </button>
        @endforeach
    </div>

    {{-- Painéis de conteúdo --}}
    <div class="relative" id="exp-panels">
        @foreach($experiences as $index => $exp)
        <div
            id="panel-{{ $exp->id }}"
            role="tabpanel"
            aria-labelledby="tab-{{ $exp->id }}"
            class="exp-panel {{ $index !== 0 ? 'hidden' : '' }}"
        >
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                {{-- Coluna Esquerda: Metadados --}}
                <div class="lg:col-span-2 space-y-4">
                    {{-- Card principal de info --}}
                    <div class="group relative p-6 rounded-2xl bg-white/5 border border-white/10 hover:border-cyan-400/30 transition-all duration-300 backdrop-blur-sm overflow-hidden">
                        <div class="absolute inset-0 bg-cyan-500/0 group-hover:bg-cyan-500/[0.03] transition-colors duration-500 rounded-2xl pointer-events-none"></div>

                        {{-- Cargo --}}
                        <h4 class="text-xl font-bold text-white mb-1 leading-tight">{{ $exp->cargo }}</h4>

                        {{-- Empresa --}}
                        <p class="text-cyan-400 font-mono text-sm mb-4">{{ $exp->empresa }}</p>

                        {{-- Separador decorativo --}}
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-1.5 h-1.5 rounded-full bg-cyan-400/70"></div>
                            <div class="h-px bg-white/10 flex-1"></div>
                            <div class="w-1 h-1 rounded-full bg-white/20"></div>
                        </div>

                        {{-- Metadados em lista --}}
                        <ul class="space-y-3">
                            {{-- Período --}}
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex-shrink-0">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <div>
                                    <span class="text-xs text-gray-500 font-mono uppercase tracking-wider block">Período</span>
                                    <span class="text-white text-sm">{{ $exp->periodo }}</span>
                                    @if(!$exp->data_fim)
                                        <span class="ml-2 inline-flex items-center gap-1 text-[10px] font-mono text-green-400 bg-green-400/10 px-1.5 py-0.5 rounded-full border border-green-400/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                            Atual
                                        </span>
                                    @endif
                                </div>
                            </li>

                            {{-- Local --}}
                            @if($exp->local)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex-shrink-0">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </span>
                                <div>
                                    <span class="text-xs text-gray-500 font-mono uppercase tracking-wider block">Local</span>
                                    <span class="text-white text-sm">{{ $exp->local }}</span>
                                </div>
                            </li>
                            @endif

                            {{-- Tipo --}}
                            @if($exp->tipo)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex-shrink-0">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </span>
                                <div>
                                    <span class="text-xs text-gray-500 font-mono uppercase tracking-wider block">Modalidade</span>
                                    <span class="text-white text-sm">{{ $exp->tipo }}</span>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>

                    {{-- Tecnologias utilizadas --}}
                    @if($exp->tecnologias && count($exp->tecnologias) > 0)
                    <div class="p-5 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                        <p class="text-xs text-gray-500 font-mono uppercase tracking-widest mb-3">Tecnologias</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($exp->tecnologias as $tech)
                            <span class="text-xs font-mono px-2.5 py-1 rounded-lg bg-blue-500/10 border border-blue-400/20 text-blue-300">
                                {{ $tech }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Coluna Direita: Descrição com timeline decorativa --}}
                <div class="lg:col-span-3">
                    <div class="relative p-6 md:p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-white/20 transition-all duration-300 backdrop-blur-sm h-full">

                        {{-- Pontos decorativos no canto --}}
                        <div class="absolute top-4 right-4 flex gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-red-400/40"></div>
                            <div class="w-2 h-2 rounded-full bg-yellow-400/40"></div>
                            <div class="w-2 h-2 rounded-full bg-green-400/40"></div>
                        </div>

                        <p class="text-xs text-gray-500 font-mono uppercase tracking-widest mb-5">// descrição</p>

                        @if($exp->descricao)
                        {{-- Renderiza cada linha como um item de "bullet" --}}
                        <div class="space-y-4">
                            @foreach(explode("\n", $exp->descricao) as $linha)
                                @if(trim($linha))
                                <div class="flex gap-3 group/item">
                                    <div class="flex flex-col items-center mt-1.5 flex-shrink-0">
                                        <div class="w-2 h-2 rounded-full border-2 border-cyan-400/60 group-hover/item:bg-cyan-400 group-hover/item:border-cyan-400 transition-all duration-200"></div>
                                        <div class="w-px flex-1 bg-white/5 mt-1"></div>
                                    </div>
                                    <p class="text-gray-300 text-sm leading-relaxed pb-4 group-hover/item:text-white transition-colors duration-200">{{ trim($linha) }}</p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500 text-sm italic">Nenhuma descrição cadastrada.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</section>
@endif
