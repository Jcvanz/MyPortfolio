@props(['coreStacks' => []])

<section id="about" class="w-full relative z-10 py-16 bg-slate-900/30 border-y border-white/5 backdrop-blur-md mt-10">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="flex items-center gap-3 mb-12">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
            <h3 class="text-white text-xl md:text-2xl font-mono uppercase tracking-widest">Core <span class="text-cyan-400">Stacks</span></h3>
            <div class="h-px bg-linear-to-r from-cyan-500/50 to-transparent flex-1 ml-4"></div>
        </div>

        <div class="relative w-full overflow-hidden py-5 flex group">
            <div class="absolute inset-y-0 left-0 w-24 md:w-40 bg-linear-to-r from-slate-900 to-transparent z-20 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-24 md:w-40 bg-linear-to-l from-slate-900 to-transparent z-20 pointer-events-none"></div>

            @php
                $stacks = $coreStacks;
            @endphp
            
            @for ($i = 0; $i < 4; $i++)
            <div class="flex animate-marquee shrink-0 gap-6 px-3 group-hover:[animation-play-state:paused]" {!! $i > 0 ? 'aria-hidden="true"' : '' !!}>
                @foreach($stacks as $stack)
                <div class="w-64 shrink-0">
                    <div class="group/card relative p-6 h-36 rounded-2xl bg-white/5 border border-white/10 hover:border-cyan-400/50 hover:bg-slate-800/80 transition-all duration-500 flex flex-col items-center justify-center backdrop-blur-md shadow-lg hover:shadow-[0_0_25px_rgba(34,211,238,0.2)] transform hover:-translate-y-2 cursor-default gap-3">
                        <div class="absolute inset-0 bg-cyan-500/0 group-hover/card:bg-cyan-500/5 transition-colors duration-500 rounded-2xl blur-xl pointer-events-none"></div>
                        
                        <!-- Icon -->
                        <img src="{{ $stack->icon }}" alt="{{ $stack->name }}" class="w-12 h-12 object-contain transition-transform duration-300 group-hover/card:scale-110 group-hover/card:drop-shadow-[0_0_8px_rgba(34,211,238,0.5)] {{ $stack->invert ? 'invert opacity-80' : '' }}">
                        
                        <h4 class="text-lg font-bold text-gray-400 group-hover/card:text-white transition-colors duration-300 z-10 text-center tracking-wide">
                            {{ $stack->name }}
                        </h4>
                        <div class="absolute -bottom-0.5 -right-0.5 w-6 h-6 border-b-2 border-r-2 border-cyan-500/0 group-hover/card:border-cyan-400/80 transition-all duration-500 rounded-br-2xl pointer-events-none"></div>
                        <div class="absolute -top-0.5 -left-0.5 w-6 h-6 border-t-2 border-l-2 border-blue-500/0 group-hover/card:border-blue-400/80 transition-all duration-500 rounded-tl-2xl pointer-events-none"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endfor
        </div>
    </div>
</section>
