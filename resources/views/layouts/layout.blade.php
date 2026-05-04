<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth scroll-pt-24">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Julio Cesar</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/particles.js'])
</head>
<body class="bg-slate-950">
    <!-- Background Div para o Cursor de Grafo -->
    <canvas id="cursor-canvas" class="fixed top-0 left-0 w-full h-full pointer-events-none z-0"></canvas>
    
    <div class="relative z-10">
        @include('components.header')
        @yield('content')
    </div>

    <footer class="bg-slate-950 relative z-10 w-full flex justify-center py-10 border-t border-cyan-500/30 backdrop-blur-md shadow-[0_0_20px_rgba(34,211,238,0.15)]">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-gray-400 text-sm text-center">
                Desenvolvido por Julio Cesar
            </p>
        </div>
    </footer>

    @if(request()->routeIs('portifolio'))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endif
</body>
</html>