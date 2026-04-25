<header id="main-header" class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-out px-0 py-0 flex justify-end md:block pointer-events-none">
    <div class="px-4 md:px-6 py-4 transition-all duration-500 ease-out pointer-events-auto" id="header-spacing">
        <div id="header-container" class="max-w-7xl mx-auto bg-transparent transition-all duration-500 flex items-center justify-between rounded-full px-4 md:px-6 py-2 md:py-4 border border-transparent w-auto md:w-full">
            <!-- Nav -->
            <nav class="hidden md:flex space-x-8">
                <a href="#about" class="text-gray-300 hover:text-cyan-400 transition-colors duration-300 font-medium tracking-wide relative group">
                    Sobre
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-cyan-400 transition-all duration-300 group-hover:w-full shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                </a>
                <a href="#projects" class="text-gray-300 hover:text-cyan-400 transition-colors duration-300 font-medium tracking-wide relative group">
                    Projetos
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-cyan-400 transition-all duration-300 group-hover:w-full shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                </a>
                <a href="#contact" class="text-gray-300 hover:text-cyan-400 transition-colors duration-300 font-medium tracking-wide relative group">
                    Contato
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-cyan-400 transition-all duration-300 group-hover:w-full shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                </a>
            </nav>
            
            <div class="hidden md:block">
                <a href="#contact" class="px-5 py-2 rounded-full border border-cyan-400 text-cyan-400 hover:bg-cyan-400 hover:text-slate-900 transition-all duration-300 shadow-[0_0_10px_rgba(34,211,238,0.2)] hover:shadow-[0_0_20px_rgba(34,211,238,0.6)] font-semibold tracking-wide">
                    Let's Talk
                </a>
            </div>

            <!-- Hamburger Button for Mobile -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-300 hover:text-cyan-400 focus:outline-none transition-colors w-10 h-10 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-slate-950/95 backdrop-blur-2xl z-[100] flex flex-col items-center justify-center opacity-0 pointer-events-none transition-all duration-500">
        <!-- Close Button -->
        <button id="mobile-close-btn" class="absolute top-6 right-6 text-gray-400 hover:text-cyan-400 p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Links -->
        <nav class="flex flex-col items-center space-y-8">
            <a href="#about" class="mobile-link text-2xl text-gray-300 hover:text-cyan-400 font-medium tracking-widest uppercase transition-colors">Sobre</a>
            <a href="#projects" class="mobile-link text-2xl text-gray-300 hover:text-cyan-400 font-medium tracking-widest uppercase transition-colors">Projetos</a>
            <a href="#contact" class="mobile-link text-2xl text-gray-300 hover:text-cyan-400 font-medium tracking-widest uppercase transition-colors">Contato</a>
            
            <a href="#contact" class="mobile-link mt-8 px-8 py-3 rounded-full border border-cyan-400 text-cyan-400 hover:bg-cyan-400 hover:text-slate-900 transition-all shadow-[0_0_15px_rgba(34,211,238,0.2)] font-semibold tracking-widest uppercase">
                Let's Talk
            </a>
        </nav>
    </div>
</header>