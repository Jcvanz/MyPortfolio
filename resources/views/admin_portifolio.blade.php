@extends('layouts.layout_admin')

@section('content')
    
    <div class="bg-zinc-900 h-auto min-h-screen p-6 md:p-10 w-full">
        <div class="py-6 md:py-10 flex flex-col">
            <h1 class="text-base md:text-lg font-semibold text-zinc-400">Administração do Portifólio</h1>
            <p class="text-2xl md:text-3xl font-bold text-white">Bem-vindo {{ $user->name }}!</p>
        </div>

        <div class="flex flex-col gap-4 mb-6">
            <h2 class="text-base md:text-lg font-semibold text-zinc-400">Informações do Usuário</h2>
            <div class="p-4 md:p-10 bg-zinc-800 rounded-xl">
                <form 
                    action="{{ route('admin.update') }}" 
                    method="post" 
                    enctype="multipart/form-data" 
                    data-autosave="true"
                    class="grid grid-cols-4 gap-2 md:gap-4 mb-2"
                >
                    @csrf
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Nome",
                        'name' =>"name",
                        'id' =>"name",
                        'type' =>"text",
                        'value' => $user->name
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Profissão",
                        'name' =>"profissao",
                        'id' =>"profissao",
                        'type' =>"text",
                        'value' => $portfolio->profissao
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Título do Portfólio",
                        'name' =>"titulo",
                        'id' =>"titulo",
                        'type' =>"text",
                        'value' => $portfolio->titulo ?? 'Bem-vindo ao meu portfólio'
                    ])
                    <div class="col-span-4">
                        <label for="resumo" class="max-md:text-sm text-zinc-400">Resumo</label>
                        <textarea maxlength="1500" name="resumo" id="resumo" class="max-md:text-sm input_area w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 h-40 resize-none">{{ $portfolio->resumo }}</textarea>
                        <p class="char_count max-md:text-xs text-[12px] text-zinc-400">{{ strlen($portfolio->resumo) }}/1500 caracteres</p>
                    </div>
                    <div class="col-span-4">
                        <label for="logica_juridica_texto" class="max-md:text-sm text-zinc-400">Sobre Mim (Detalhado)</label>
                        <textarea maxlength="1500" name="logica_juridica_texto" id="logica_juridica_texto" class="max-md:text-sm input_area w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 h-40 resize-none">{{ $portfolio->logica_juridica_texto }}</textarea>
                        <p class="char_count max-md:text-xs text-[12px] text-zinc-400">{{ strlen($portfolio->logica_juridica_texto ?? '') }}/1500 caracteres</p>
                    </div>
                    
                    <div class="col-span-4 border border-zinc-800 rounded-xl p-4 bg-zinc-900/50">
                        <label class="max-md:text-sm text-zinc-400 block mb-3 font-semibold">System Status (Tags de Tecnologias no Card)</label>
                        <div id="tags-container" class="flex flex-wrap gap-3 mb-4">
                            @if($portfolio->system_status)
                                @foreach($portfolio->system_status as $tag)
                                    <div class="tag-item flex items-center gap-2 bg-zinc-800 px-3 py-1.5 rounded-lg border border-zinc-700 text-white shadow-sm">
                                        <input type="text" name="system_status[]" value="{{ $tag }}" class="bg-transparent outline-none w-24 text-sm font-mono" />
                                        <button type="button" onclick="removeTag(this)" class="text-red-400 hover:text-red-300 text-lg leading-none">&times;</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" onclick="addTag()" class="px-4 py-2 bg-zinc-800 hover:bg-cyan-900/30 text-cyan-400 hover:text-cyan-300 hover:border-cyan-500/50 rounded-lg border border-zinc-700 text-sm font-medium transition-all">+ Adicionar Tecnologia</button>
                    </div>
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-1",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Cidade",
                        'name' =>"cidade",
                        'id' =>"cidade",
                        'type' =>"text",
                        'value' => $portfolio->cidade
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-1",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Estado",
                        'name' =>"estado",
                        'id' =>"estado",
                        'type' =>"text",
                        'value' => $portfolio->estado
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-1",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Telefone",
                        'name' =>"telefone",
                        'id' =>"telefone",
                        'type' =>"text",
                        'value' => $portfolio->telefone
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-1",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"E-mail",
                        'name' =>"email",
                        'id' =>"email",
                        'type' =>"text",
                        'value' => $portfolio->email
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"LinkedIn",
                        'name' =>"linkedin",
                        'id' =>"linkedin",
                        'type' =>"text",
                        'value' => $portfolio->linkedin
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Github",
                        'name' =>"github",
                        'id' =>"github",
                        'type' =>"text",
                        'value' => $portfolio->github
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Outros links 1",
                        'name' =>"outros_links_1",
                        'id' =>"outros_links_1",
                        'type' =>"text",
                        'value' => $portfolio->outros_links_1
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Outros links 2",
                        'name' =>"outros_links_2",
                        'id' =>"outros_links_2",
                        'type' =>"text",
                        'value' => $portfolio->outros_links_2
                    ])
                    <div class="col-span-4 md:col-span-1">
                        <label for="curriculo" class="max-md:text-sm text-zinc-400 block mb-1">Currículo</label>
                        <input type="file" accept="application/pdf,application/docx" name="curriculo" id="curriculo" class="hidden">
                        <label for="curriculo" 
                            class="cursor-pointer max-md:text-sm flex items-center gap-2 px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-zinc-400 hover:bg-zinc-700 hover:text-white transition-colors w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <span id="curriculo-label" class="max-md:text-sm block truncate">{{ $portfolio->curriculo_name ?? 'Selecionar arquivo...' }}</span>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gerenciamento de Core Stacks -->
        <div class="flex flex-col gap-4 mb-12">
            <h2 class="text-base md:text-lg font-semibold text-zinc-400">Core Stacks (Slider)</h2>
            <div class="p-4 md:p-10 bg-zinc-800 rounded-xl">
                <!-- Adicionar nova Stack -->
                <form action="{{ route('admin.core-stack.store') }}" method="POST" class="grid grid-cols-4 gap-4 mb-8 border-b border-zinc-700 pb-8">
                    @csrf
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Nome da Stack",
                        'name' =>"name",
                        'id' =>"stack_name",
                        'type' =>"text",
                        'value' => ""
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Ícone SVG (URL do Devicon)",
                        'name' =>"icon",
                        'id' =>"stack_icon",
                        'type' =>"url",
                        'value' => ""
                    ])
                    <div class="col-span-4 flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer text-zinc-400 text-sm">
                            <input type="checkbox" name="invert" value="1" class="rounded border-zinc-700 bg-zinc-900">
                            Inverter cor (para temas escuros, útil para Github, NextJS, etc)
                        </label>
                        <button type="submit" class="px-6 py-2 bg-cyan-600 hover:bg-cyan-500 text-white rounded-md font-semibold transition">Adicionar Stack</button>
                    </div>
                </form>

                <!-- Listagem de Stacks -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($coreStacks as $stack)
                    <div class="bg-zinc-900 border border-zinc-700 rounded-xl p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="{{ $stack->icon }}" class="w-8 h-8 {{ $stack->invert ? 'invert opacity-80' : '' }}" alt="">
                            <span class="text-white font-medium">{{ $stack->name }}</span>
                        </div>
                        <form action="{{ route('admin.core-stack.destroy', $stack->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Tem certeza que deseja remover esta stack?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Gerenciamento de Experiências Profissionais -->
        <div class="flex flex-col gap-4 mb-12">
            <h2 class="text-base md:text-lg font-semibold text-zinc-400">Experiências Profissionais</h2>
            <div class="p-4 md:p-10 bg-zinc-800 rounded-xl">
                <!-- Adicionar nova Experiência -->
                <form action="{{ route('admin.experience.store') }}" method="POST" class="grid grid-cols-4 gap-4 mb-10 border-b border-zinc-700 pb-10">
                    @csrf
                    <div class="col-span-4">
                        <p class="text-sm text-zinc-500 mb-4">Preencha os campos abaixo para adicionar uma nova experiência. O campo "Fim" deixe em branco se for o emprego atual.</p>
                    </div>
                    <!-- Cargo -->
                    <div class="col-span-4 md:col-span-2">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Cargo *</label>
                        <input type="text" name="cargo" required placeholder="Ex: Desenvolvedor Full Stack"
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                    </div>
                    <!-- Empresa -->
                    <div class="col-span-4 md:col-span-2">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Empresa *</label>
                        <input type="text" name="empresa" required placeholder="Ex: Google"
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                    </div>
                    <!-- Local -->
                    <div class="col-span-4 md:col-span-2">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Local</label>
                        <input type="text" name="local" placeholder="Ex: São Paulo, SP (Remoto)"
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                    </div>
                    <!-- Tipo -->
                    <div class="col-span-4 md:col-span-2">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Modalidade</label>
                        <select name="tipo" class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                            <option value="">Selecione...</option>
                            <option value="CLT">CLT</option>
                            <option value="PJ">PJ</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Estágio">Estágio</option>
                            <option value="Voluntário">Voluntário</option>
                        </select>
                    </div>
                    <!-- Data Início -->
                    <div class="col-span-4 md:col-span-1">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Início *</label>
                        <input type="text" name="data_inicio" required placeholder="Ex: Jan 2023"
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                    </div>
                    <!-- Data Fim -->
                    <div class="col-span-4 md:col-span-1">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Fim <span class="text-zinc-600 text-xs">(vazio = Atual)</span></label>
                        <input type="text" name="data_fim" placeholder="Ex: Dez 2024"
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                    </div>
                    <!-- Ordem -->
                    <div class="col-span-4 md:col-span-1">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Ordem</label>
                        <input type="number" name="ordem" value="0" min="0"
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                    </div>
                    <!-- Tecnologias -->
                    <div class="col-span-4">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Tecnologias <span class="text-zinc-600 text-xs">(separadas por vírgula)</span></label>
                        <input type="text" name="tecnologias" placeholder="Ex: Laravel, Vue.js, MySQL, Docker"
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500">
                    </div>
                    <!-- Descrição -->
                    <div class="col-span-4">
                        <label class="max-md:text-sm text-zinc-400 block mb-1">Descrição <span class="text-zinc-600 text-xs">(cada linha vira um bullet point)</span></label>
                        <textarea name="descricao" rows="4" placeholder="Ex: Desenvolvi APIs RESTful com Laravel&#10;Integrei sistemas de pagamento&#10;Liderei equipe de 3 devs..."
                            class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 resize-none"></textarea>
                    </div>
                    <div class="col-span-4 flex justify-end mt-2">
                        <button type="submit" class="px-8 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-md font-semibold transition shadow-lg shadow-cyan-900/20">
                            Adicionar Experiência
                        </button>
                    </div>
                </form>

                <!-- Listagem de Experiências -->
                @if($experiences->isEmpty())
                    <p class="text-zinc-500 text-sm italic text-center py-4">Nenhuma experiência cadastrada ainda.</p>
                @else
                <div class="space-y-4">
                    @foreach($experiences as $exp)
                    <div class="bg-zinc-900/50 border border-zinc-700/50 rounded-xl p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <h3 class="text-white font-bold truncate">{{ $exp->cargo }}</h3>
                                @if(!$exp->data_fim)
                                    <span class="text-[10px] font-mono text-green-400 bg-green-400/10 px-2 py-0.5 rounded-full border border-green-400/20 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span> Atual
                                    </span>
                                @endif
                                @if($exp->tipo)
                                    <span class="text-[10px] font-mono text-blue-400 bg-blue-400/10 px-2 py-0.5 rounded-full border border-blue-400/20">{{ $exp->tipo }}</span>
                                @endif
                            </div>
                            <p class="text-cyan-400 text-sm">{{ $exp->empresa }}</p>
                            <p class="text-zinc-500 text-xs mt-0.5">{{ $exp->periodo }}{{ $exp->local ? ' · ' . $exp->local : '' }}</p>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <button type="button"
                                onclick="openEditExpModal({{ json_encode($exp) }})"
                                class="px-3 py-2 bg-zinc-800 hover:bg-cyan-900/30 text-cyan-400 hover:text-cyan-300 border border-zinc-700 hover:border-cyan-500/50 rounded-lg text-sm transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Editar
                            </button>
                            <form action="{{ route('admin.experience.destroy', $exp->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Remover esta experiência?')"
                                    class="px-3 py-2 bg-zinc-800 hover:bg-red-900/30 text-red-400 hover:text-red-300 border border-zinc-700 hover:border-red-500/50 rounded-lg text-sm transition-all flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Remover
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Gerenciamento de Projetos -->
        <div class="flex flex-col gap-4 mb-12">
            <h2 class="text-base md:text-lg font-semibold text-zinc-400">Meus Projetos</h2>
            <div class="p-4 md:p-10 bg-zinc-800 rounded-xl">
                <!-- Adicionar novo Projeto -->
                <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-4 gap-4 mb-10 border-b border-zinc-700 pb-10">
                    @csrf
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Título do Projeto",
                        'name' =>"title",
                        'id' =>"project_title",
                        'type' =>"text",
                        'value' => ""
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Tags (Separadas por vírgula)",
                        'name' =>"tags",
                        'id' =>"project_tags",
                        'type' =>"text",
                        'value' => "",
                        'placeholder' => "Ex: Laravel, React, MySQL"
                    ])
                    <div class="col-span-4">
                        <label for="project_description" class="max-md:text-sm text-zinc-400">Descrição do Projeto</label>
                        <textarea name="description" id="project_description" rows="3" class="max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 resize-none"></textarea>
                    </div>
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-3",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Link do Projeto/Repo",
                        'name' =>"link",
                        'id' =>"project_link",
                        'type' =>"text",
                        'value' => ""
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-1",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Capa do Projeto (Imagem)",
                        'name' =>"image",
                        'id' =>"project_image",
                        'type' =>"file",
                        'value' => ""
                    ])
                    <div class="col-span-4 flex justify-end mt-2">
                        <button type="submit" class="px-8 py-2.5 bg-cyan-600 hover:bg-cyan-500 text-white rounded-md font-semibold transition shadow-lg shadow-cyan-900/20">Publicar Projeto</button>
                    </div>
                </form>

                <!-- Listagem de Projetos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                    <div class="bg-zinc-900/50 border border-zinc-700/50 rounded-xl overflow-hidden group">
                        <div class="aspect-video w-full bg-zinc-800 relative overflow-hidden">
                            @if($project->image)
                                <img src="{{ $project->image }}" class="w-full h-full object-cover" alt="">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-600 italic text-sm">Sem imagem</div>
                            @endif
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                                <button type="button" 
                                    onclick="openEditProjectModal({{ json_encode($project) }})"
                                    class="bg-cyan-500 hover:bg-cyan-600 text-white p-2 rounded-lg transition" 
                                    title="Editar Projeto">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('admin.project.destroy', $project->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition" onclick="return confirm('Excluir projeto?')" title="Remover Projeto">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-white font-bold truncate">{{ $project->title }}</h3>
                            <p class="text-zinc-500 text-xs mt-1 line-clamp-2 h-8">{{ $project->description }}</p>
                            <div class="flex flex-wrap gap-1.5 mt-3">
                                @foreach($project->tags as $tag)
                                    <span class="text-[10px] bg-zinc-800 text-zinc-400 px-2 py-0.5 rounded border border-zinc-700">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        <!-- Segurança -->
        <div class="flex flex-col gap-4 mb-12">
            <h2 class="text-base md:text-lg font-semibold text-zinc-400">Segurança</h2>
            <div class="p-4 md:p-10 bg-zinc-800 rounded-xl">
                <form action="{{ route('admin.password.update') }}" method="POST" class="grid grid-cols-4 gap-4">
                    @csrf
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Nova Senha",
                        'name' =>"password",
                        'id' =>"password",
                        'type' =>"password",
                        'value' => ""
                    ])
                    @include('components_adm.input',[
                        'divClass' =>"col-span-4 md:col-span-2",
                        'labelClass' =>"max-md:text-sm text-zinc-400",
                        'inputClass' =>"max-md:text-sm w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Confirmar Nova Senha",
                        'name' =>"password_confirmation",
                        'id' =>"password_confirmation",
                        'type' =>"password",
                        'value' => ""
                    ])
                    <div class="col-span-4 flex justify-end">
                        <button type="submit" class="px-8 py-2.5 bg-red-600 hover:bg-red-500 text-white rounded-md font-semibold transition shadow-lg shadow-red-900/20">Alterar Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<!-- MODAL DE EDIÇÃO DE PROJETO -->
<div id="editProjectModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-800 w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-6 border-b border-zinc-800 flex items-center justify-between">
            <h3 class="text-xl font-bold text-white">Editar Projeto</h3>
            <button onclick="closeEditProjectModal()" class="text-zinc-500 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form id="editProjectForm" action="" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Título</label>
                    <input type="text" name="title" id="edit_title" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Tags (Sugerido: Separar por vírgula)</label>
                    <input type="text" name="tags" id="edit_tags" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
            </div>

            <div class="mb-4">
                <label class="text-sm text-zinc-400 block mb-1">Descrição</label>
                <textarea name="description" id="edit_description" rows="4" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none resize-none"></textarea>
            </div>

            <div class="mb-6">
                <label class="text-sm text-zinc-400 block mb-1">Link do Projeto</label>
                <input type="text" name="link" id="edit_link" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
            </div>

            <div class="mb-6 flex flex-col gap-3">
                <label class="text-sm text-zinc-400 block mb-1">Capa do Projeto</label>
                <div class="flex items-center gap-4">
                    <div id="edit_image_preview" class="w-24 h-16 bg-zinc-800 rounded border border-zinc-700 overflow-hidden flex items-center justify-center text-[10px] text-zinc-600 italic">
                        Sem imagem
                    </div>
                    <div class="flex flex-col gap-2 flex-1">
                        <input type="file" name="image" class="text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-800 file:text-zinc-300 hover:file:bg-zinc-700">
                        <label class="flex items-center gap-2 text-xs text-red-400 cursor-pointer">
                            <input type="checkbox" name="remove_image" value="1" class="rounded border-zinc-700 bg-zinc-800">
                            Remover imagem atual
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-zinc-800">
                <button type="button" onclick="closeEditProjectModal()" class="px-6 py-2 bg-zinc-800 text-zinc-300 rounded-lg hover:bg-zinc-700 transition">Cancelar</button>
                <button type="submit" class="px-8 py-2 bg-cyan-600 text-white rounded-lg font-bold hover:bg-cyan-500 transition shadow-lg shadow-cyan-900/20">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL DE EDIÇÃO DE EXPERIÊNCIA -->
<div id="editExpModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-800 w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-6 border-b border-zinc-800 flex items-center justify-between">
            <h3 class="text-xl font-bold text-white">Editar Experiência</h3>
            <button onclick="closeEditExpModal()" class="text-zinc-500 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form id="editExpForm" action="" method="POST" class="p-6 overflow-y-auto max-h-[75vh]">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Cargo *</label>
                    <input type="text" name="cargo" id="exp_edit_cargo" required class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Empresa *</label>
                    <input type="text" name="empresa" id="exp_edit_empresa" required class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Local</label>
                    <input type="text" name="local" id="exp_edit_local" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Modalidade</label>
                    <select name="tipo" id="exp_edit_tipo" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                        <option value="">Selecione...</option>
                        <option value="CLT">CLT</option>
                        <option value="PJ">PJ</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Estágio">Estágio</option>
                        <option value="Voluntário">Voluntário</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Início *</label>
                    <input type="text" name="data_inicio" id="exp_edit_data_inicio" required placeholder="Ex: Jan 2023" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Fim <span class="text-zinc-600 text-xs">(vazio = Atual)</span></label>
                    <input type="text" name="data_fim" id="exp_edit_data_fim" placeholder="Ex: Dez 2024" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div class="col-span-2 md:col-span-1">
                    <label class="text-sm text-zinc-400 block mb-1">Ordem</label>
                    <input type="number" name="ordem" id="exp_edit_ordem" min="0" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
                <div class="col-span-2">
                    <label class="text-sm text-zinc-400 block mb-1">Tecnologias <span class="text-zinc-600 text-xs">(separadas por vírgula)</span></label>
                    <input type="text" name="tecnologias" id="exp_edit_tecnologias" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none">
                </div>
            </div>

            <div class="mb-4">
                <label class="text-sm text-zinc-400 block mb-1">Descrição <span class="text-zinc-600 text-xs">(cada linha vira um bullet point)</span></label>
                <textarea name="descricao" id="exp_edit_descricao" rows="5" class="w-full px-4 py-2 bg-zinc-800 border border-zinc-700 rounded-lg text-white focus:ring-2 focus:ring-cyan-500 outline-none resize-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-zinc-800">
                <button type="button" onclick="closeEditExpModal()" class="px-6 py-2 bg-zinc-800 text-zinc-300 rounded-lg hover:bg-zinc-700 transition">Cancelar</button>
                <button type="submit" class="px-8 py-2 bg-cyan-600 text-white rounded-lg font-bold hover:bg-cyan-500 transition shadow-lg shadow-cyan-900/20">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>

<script>
// === MODAL DE PROJETO ===
function openEditProjectModal(project) {
    document.getElementById('edit_title').value = project.title || '';
    document.getElementById('edit_tags').value  = Array.isArray(project.tags) ? project.tags.join(', ') : (project.tags || '');
    document.getElementById('edit_description').value = project.description || '';
    document.getElementById('edit_link').value  = project.link || '';

    const preview = document.getElementById('edit_image_preview');
    preview.innerHTML = project.image
        ? `<img src="${project.image}" class="w-full h-full object-cover">`
        : 'Sem imagem';

    const baseUrl = '{{ url("admin/project") }}';
    document.getElementById('editProjectForm').action = `${baseUrl}/${project.id}`;

    const modal = document.getElementById('editProjectModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditProjectModal() {
    const modal = document.getElementById('editProjectModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// === MODAL DE EXPERIÊNCIA ===
function openEditExpModal(exp) {
    document.getElementById('exp_edit_cargo').value       = exp.cargo        || '';
    document.getElementById('exp_edit_empresa').value     = exp.empresa      || '';
    document.getElementById('exp_edit_local').value       = exp.local        || '';
    document.getElementById('exp_edit_tipo').value        = exp.tipo         || '';
    document.getElementById('exp_edit_data_inicio').value = exp.data_inicio  || '';
    document.getElementById('exp_edit_data_fim').value    = exp.data_fim     || '';
    document.getElementById('exp_edit_ordem').value       = exp.ordem        ?? 0;
    document.getElementById('exp_edit_descricao').value   = exp.descricao    || '';
    document.getElementById('exp_edit_tecnologias').value = Array.isArray(exp.tecnologias)
        ? exp.tecnologias.join(', ')
        : (exp.tecnologias || '');

    const baseUrl = '{{ url("admin/experience") }}';
    document.getElementById('editExpForm').action = `${baseUrl}/${exp.id}`;

    const modal = document.getElementById('editExpModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditExpModal() {
    const modal = document.getElementById('editExpModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Fechar modais ao clicar fora
document.getElementById('editProjectModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditProjectModal();
});
document.getElementById('editExpModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditExpModal();
});
</script>