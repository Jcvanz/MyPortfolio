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
                @include('components_adm.input',[
                    'divClass' =>"text-white",
                    'labelClass' =>"text-zinc-400 md:text-base text-sm",
                    'inputClass' =>"w-full px-4 py-2 md:py-3 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500",
                    'label' =>"Senha",
                    'name' =>"password",
                    'id' =>"password",
                    'type' =>"password"
                ])
                <button type="submit" class="cursor-pointer w-full px-4 py-2 md:py-3 border border-zinc-700 rounded-md bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-zinc-500 hover:bg-zinc-800 transition-colors duration-200">
                    Entrar
                </button>
            </form>

        </div>
        
    </div>
@endsection