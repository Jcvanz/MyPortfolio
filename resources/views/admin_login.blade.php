@extends('layouts.layout_admin')

@section('content')
    <div class="bg-zinc-900 w-full min-h-screen h-auto p-4 md:p-10 flex items-center">
       
        <div class="bg-zinc-800 w-full max-w-lg mx-auto flex flex-col p-4 md:p-10 rounded-xl">
            <div class="flex flex-col items-center">
                <h1 class="md:text-lg text-base font-semibold text-zinc-400">Login</h1>
                <p class="md:text-3xl text-xl font-bold text-white mb-4">Bem-vindo!</p>
            </div>
            <form action="" method="post" class="flex flex-col gap-4">
                @csrf
                @include('components_adm.input',[
                    'divClass' =>"",
                    'labelClass' =>"text-zinc-400 md:text-base text-sm",
                    'inputClass' =>"w-full px-4 py-2 md:py-3 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                    'label' =>"Email",
                    'name' =>"email",
                    'id' =>"email",
                    'type' =>"email"
                ])
                <div class="relative">
                    @include('components_adm.input',[
                        'divClass' =>"text-white",
                        'labelClass' =>"text-zinc-400 md:text-base text-sm",
                        'inputClass' =>"w-full px-4 py-2 md:py-3 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                        'label' =>"Senha",
                        'name' =>"password",
                        'id' =>"password",
                        'type' =>"password"
                    ])
                    <button type="button" class="password-toggle absolute right-3 bottom-2.5 text-zinc-500 hover:text-zinc-300 transition-colors" data-target="password">
                        <svg class="icon-eye w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg class="icon-eye-slash w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.976 9.976 0 012.146-3.525m7.83-4.638A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-2.105-2.105L15 15m0 0L13.02 13.02M9 9l1.98 1.98M9 9L3 3"/></svg>
                    </button>
                </div>
                <button type="submit" class="cursor-pointer w-full px-4 py-2 md:py-3 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 hover:bg-zinc-800 transition-colors duration-200">
                    Entrar
                </button>
            </form>

        </div>
        
    </div>
@endsection