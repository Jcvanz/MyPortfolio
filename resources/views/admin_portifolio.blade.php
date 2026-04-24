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
                    <div class="col-span-4">
                        <label for="resumo" class="max-md:text-sm text-zinc-400">Resumo</label>
                        <textarea maxlength="1000" name="resumo" id="resumo" class="max-md:text-sm input_area w-full px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 h-40 resize-none">{{ $portfolio->resumo }}</textarea>
                        <p class="char_count max-md:text-xs text-[12px] text-zinc-400">{{ strlen($portfolio->resumo) }}/1000 caracteres</p>
                    </div>
                    @include('components_adm.input',[
                        'divClass' =>"col-span-3 md:col-span-2",
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

        <div class="flex flex-col gap-4">
            <h2 class="text-base md:text-lg font-semibold text-zinc-400">Banners</h2>
            <div class="p-4 md:p-10 bg-zinc-800 rounded-xl">
                <form 
                    action="{{ route('admin.update') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    data-autosave="true"
                    class="grid grid-cols-4 gap-4 mb-2"
                >
                    @csrf
                    <div class="col-span-4 md:col-span-1 relative">
                        <label for="banner_home" class="max-md:text-sm text-zinc-400 block mb-1">Banner Home</label>
                        <input type="file" accept="image/png, image/jpeg" name="banner_home" id="banner_home" class="hidden">
                        <label for="banner_home" 
                            class="cursor-pointer max-md:text-sm flex items-center gap-2 px-4 py-2 border border-zinc-700 rounded-md bg-zinc-900 text-zinc-400 hover:bg-zinc-700 hover:text-white transition-colors w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <span id="banner_home-label" class="max-md:text-sm block truncate">{{ $portfolio->banner_home ? 'Imagem já enviada (clique para alterar)' : 'Selecionar arquivo...' }}</span>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection