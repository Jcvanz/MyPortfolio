@props(['title', 'description', 'image' => null, 'tags' => [], 'link' => '#'])

@php
    $slug = Str::slug($title);
    $tagsJson = json_encode($tags);
@endphp

<div
    class="project-card group relative w-full rounded-2xl overflow-hidden cursor-pointer border border-white/10 hover:border-cyan-500/50 shadow-lg hover:shadow-[0_0_30px_rgba(34,211,238,0.2)] bg-slate-900/50"
    style="height: 20rem; transition: border-color 0.5s ease, box-shadow 0.5s ease;"
    onclick="toggleMobileCard(this, event)"
    data-title="{{ $title }}"
    data-description="{{ $description }}"
    data-tags="{{ $tagsJson }}"
    data-link="{{ $link }}"
>
    <!-- Background Image or Gradient Placeholder -->
    @if($image)
        <img src="{{ $image }}" alt="{{ $title }}"
             class="absolute inset-0 w-full h-full object-cover opacity-70 card-img"
             style="transition: transform 0.7s ease, opacity 0.7s ease;">
    @else
        <div class="absolute inset-0 bg-linear-to-br from-slate-800 to-slate-900 card-bg"
             style="transition: transform 0.7s ease;">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(34,211,238,0.15)_0,transparent_100%)]"></div>
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-size-[20px_20px]"></div>
        </div>
    @endif

    <!-- Overlay -->
    <div class="card-overlay absolute inset-0 bg-slate-950/20 group-hover:bg-slate-950/80 backdrop-blur-[1px] group-hover:backdrop-blur-md"
         style="transition: background-color 0.5s ease, backdrop-filter 0.5s ease;"></div>

    <!-- Conteúdo Estático -->
    <div class="card-static absolute inset-0 p-6 flex flex-col justify-end opacity-100 group-hover:opacity-0 group-hover:-translate-y-4"
         style="transition: opacity 0.5s ease, transform 0.5s ease;">
        <h4 class="text-2xl font-bold text-white drop-shadow-lg">{{ $title }}</h4>
        <div class="w-12 h-1 bg-cyan-500 mt-3 rounded-full shadow-[0_0_10px_rgba(34,211,238,0.8)]"></div>
    </div>

    <!-- Conteúdo Revelado -->
    <div class="card-reveal absolute p-6 pb-14 flex flex-col justify-center h-full opacity-0 group-hover:opacity-100 z-20"
         style="transition: opacity 0.7s ease;">

        <h4 class="text-2xl font-bold text-cyan-400 mb-2 drop-shadow-[0_0_8px_rgba(34,211,238,0.4)]">{{ $title }}</h4>

        <div class="relative mb-4">
            <p class="text-gray-300 text-sm line-clamp-2 leading-relaxed">{{ $description }}</p>

            @if(strlen($description) > 80)
                <button
                    type="button"
                    onclick="event.stopPropagation(); openProjectPopover(this.closest('.project-card'))"
                    class="text-cyan-400 text-xs font-bold mt-1 hover:text-cyan-300 cursor-pointer flex items-center gap-1"
                    style="transition: color 0.2s ease;"
                >
                    <span>Ler mais</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            @endif
        </div>

        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
                <span class="px-2.5 py-1 text-[10px] font-mono text-cyan-200 bg-cyan-900/40 border border-cyan-500/30 rounded shadow-inner">
                    {{ $tag }}
                </span>
            @endforeach
        </div>

        <!-- Botão fixo no rodapé -->
        <a
            href="{{ $link }}"
            target="_blank"
            onclick="event.stopPropagation()"
            class="absolute bottom-5 left-6 inline-flex items-center gap-2 text-sm font-bold text-white hover:text-cyan-300 group/btn"
            style="transition: color 0.2s ease;"
        >
            Ver Projeto
            <svg class="w-4 h-4 group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 style="transition: transform 0.2s ease;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>

    <!-- Decorações nos cantos -->
    <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-cyan-500/0 group-hover:border-cyan-400/80 m-4 rounded-tl pointer-events-none card-corner-tl"
         style="transition: border-color 0.5s ease;"></div>
    <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-blue-500/0 group-hover:border-blue-400/80 m-4 rounded-br pointer-events-none card-corner-br"
         style="transition: border-color 0.5s ease;"></div>
</div>

@once
<style>
    /* Mobile: card-active simula hover */
    @media (hover: none) {
        .project-card.card-active {
            border-color: rgba(34,211,238,0.5) !important;
            box-shadow: 0 0 30px rgba(34,211,238,0.2) !important;
        }
        .project-card.card-active .card-overlay {
            background-color: rgba(2, 6, 23, 0.80) !important;
            backdrop-filter: blur(8px) !important;
        }
        .project-card.card-active .card-static {
            opacity: 0 !important;
        }
        .project-card.card-active .card-reveal {
            opacity: 1 !important;
        }
        .project-card.card-active .card-img {
            transform: scale(1.10) rotate(1deg) !important;
            opacity: 0.30 !important;
        }
        .project-card.card-active .card-bg {
            transform: scale(1.10) !important;
        }
        .project-card.card-active .card-corner-tl {
            border-color: rgba(34,211,238,0.8) !important;
        }
        .project-card.card-active .card-corner-br {
            border-color: rgba(59,130,246,0.8) !important;
        }
    }

    /* Popover global */
    #project-popover {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.25s ease;
    }
    #project-popover.is-open {
        pointer-events: auto;
        opacity: 1;
    }
    #project-popover .pop-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(2, 6, 23, 0.75);
        backdrop-filter: blur(6px);
    }
    #project-popover .pop-card {
        position: relative;
        width: 100%;
        max-width: 36rem;
        border-radius: 1rem;
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(15, 23, 42, 0.92);
        backdrop-filter: blur(24px);
        box-shadow: 0 0 60px rgba(34,211,238,0.12), 0 25px 50px rgba(0,0,0,0.5);
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        transform: scale(0.92) translateY(14px);
        transition: transform 0.32s cubic-bezier(0.34,1.56,0.64,1);
    }
    #project-popover.is-open .pop-card {
        transform: scale(1) translateY(0);
    }
    body.popover-open {
        overflow: hidden;
    }
</style>

<script>
    // ── Cria o popover global no <body> na primeira chamada ──
    function getOrCreatePopover() {
        let pop = document.getElementById('project-popover');
        if (pop) return pop;

        pop = document.createElement('div');
        pop.id = 'project-popover';
        pop.setAttribute('role', 'dialog');
        pop.setAttribute('aria-modal', 'true');
        pop.innerHTML = `
            <div class="pop-backdrop" id="pop-backdrop"></div>
            <div class="pop-card">
                <div style="position:absolute;top:0;left:2rem;right:2rem;height:1px;background:linear-gradient(to right,transparent,rgba(34,211,238,0.5),transparent);border-radius:99px;"></div>

                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;">
                    <div>
                        <h4 id="pop-title" style="font-size:1.25rem;font-weight:700;color:#22d3ee;text-shadow:0 0 16px rgba(34,211,238,0.4);"></h4>
                        <div style="width:2.5rem;height:2px;background:#22d3ee;margin-top:0.5rem;border-radius:99px;box-shadow:0 0 8px rgba(34,211,238,0.8);"></div>
                    </div>
                    <button id="pop-close" type="button" aria-label="Fechar"
                        style="flex-shrink:0;width:2rem;height:2rem;border-radius:50%;border:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;color:#9ca3af;cursor:pointer;background:transparent;transition:all 0.2s ease;"
                        onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,0.3)';this.style.background='rgba(255,255,255,0.05)'"
                        onmouseout="this.style.color='#9ca3af';this.style.borderColor='rgba(255,255,255,0.1)';this.style.background='transparent'"
                    >
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <p id="pop-desc" style="color:#d1d5db;font-size:0.875rem;line-height:1.75;"></p>

                <div id="pop-tags" style="display:flex;flex-wrap:wrap;gap:0.5rem;"></div>

                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:0.5rem;border-top:1px solid rgba(255,255,255,0.05);">
                    <a id="pop-link" href="#" target="_blank"
                        style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.625rem 1.25rem;border-radius:0.75rem;background:rgba(34,211,238,0.1);border:1px solid rgba(34,211,238,0.3);color:#22d3ee;font-size:0.875rem;font-weight:700;text-decoration:none;transition:all 0.25s ease;"
                        onmouseover="this.style.background='rgba(34,211,238,0.2)';this.style.borderColor='rgba(34,211,238,0.7)';this.style.boxShadow='0 0 16px rgba(34,211,238,0.2)'"
                        onmouseout="this.style.background='rgba(34,211,238,0.1)';this.style.borderColor='rgba(34,211,238,0.3)';this.style.boxShadow='none'"
                    >
                        Ver Projeto
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <button id="pop-close-2" type="button" style="font-size:0.75rem;color:#6b7280;background:transparent;border:none;cursor:pointer;transition:color 0.2s ease;"
                        onmouseover="this.style.color='#d1d5db'" onmouseout="this.style.color='#6b7280'"
                    >Fechar</button>
                </div>

                <div style="position:absolute;top:0;left:0;width:1.25rem;height:1.25rem;border-top:2px solid rgba(34,211,238,0.6);border-left:2px solid rgba(34,211,238,0.6);border-radius:4px 0 0 0;margin:0.75rem;pointer-events:none;"></div>
                <div style="position:absolute;bottom:0;right:0;width:1.25rem;height:1.25rem;border-bottom:2px solid rgba(59,130,246,0.6);border-right:2px solid rgba(59,130,246,0.6);border-radius:0 0 4px 0;margin:0.75rem;pointer-events:none;"></div>
            </div>
        `;

        document.body.appendChild(pop);

        // Eventos de fechar
        pop.querySelector('#pop-backdrop').addEventListener('click', closeProjectPopover);
        pop.querySelector('#pop-close').addEventListener('click', closeProjectPopover);
        pop.querySelector('#pop-close-2').addEventListener('click', closeProjectPopover);

        return pop;
    }

    function openProjectPopover(card) {
        const title = card.dataset.title;
        const desc  = card.dataset.description;
        const tags  = JSON.parse(card.dataset.tags || '[]');
        const link  = card.dataset.link;

        const pop = getOrCreatePopover();

        // Preenche conteúdo
        pop.querySelector('#pop-title').textContent = title;
        pop.querySelector('#pop-desc').textContent  = desc;
        pop.querySelector('#pop-link').href         = link;

        const tagsEl = pop.querySelector('#pop-tags');
        tagsEl.innerHTML = tags.map(t =>
            `<span style="padding:0.25rem 0.625rem;font-size:0.625rem;font-family:monospace;color:#a5f3fc;background:rgba(8,51,68,0.5);border:1px solid rgba(34,211,238,0.3);border-radius:0.25rem;">${t}</span>`
        ).join('');

        // Abre
        pop.classList.add('is-open');
        document.body.classList.add('popover-open');

        // ESC
        document._popEsc = (e) => { if (e.key === 'Escape') closeProjectPopover(); };
        document.addEventListener('keydown', document._popEsc);
    }

    function closeProjectPopover() {
        const pop = document.getElementById('project-popover');
        if (!pop) return;
        pop.classList.remove('is-open');
        document.body.classList.remove('popover-open');
        if (document._popEsc) {
            document.removeEventListener('keydown', document._popEsc);
        }
    }

    // ── Toggle mobile (toque) ──
    function toggleMobileCard(card, event) {
        if (window.matchMedia('(hover: none)').matches) {
            const isActive = card.classList.contains('card-active');
            document.querySelectorAll('.project-card.card-active').forEach(c => c.classList.remove('card-active'));
            if (!isActive) card.classList.add('card-active');
        }
    }

    // Fecha ao tocar fora (mobile)
    document.addEventListener('click', function(e) {
        if (window.matchMedia('(hover: none)').matches) {
            if (!e.target.closest('.project-card')) {
                document.querySelectorAll('.project-card.card-active').forEach(c => c.classList.remove('card-active'));
            }
        }
    });
</script>
@endonce
