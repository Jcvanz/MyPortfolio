// Toggle de descrição em cards de projeto (Global com efeito Slide)
window.toggleDescription = function(btn, targetId) {
    const p = document.getElementById(targetId);
    const isClamped = p.classList.contains('line-clamp-4');
    const card = btn.closest('.group');
    const contentContainer = btn.closest('.z-20');
    const svg = btn.querySelector('svg');
    
    // Adiciona transição suave de altura se ainda não tiver
    card.style.transition = 'height 0.5s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.5s';

    if (isClamped) {
        
        // Prepara o terreno
        contentContainer.classList.remove('absolute', 'inset-0', 'justify-center');
        contentContainer.classList.add('relative', 'justify-start', 'z-30', 'p-10'); 
        p.classList.remove('line-clamp-4');
        
        // Calcula a altura
        const targetHeight = card.scrollHeight;
        
        // Reseta para a altura atual
        card.style.height = '320px';
        
        // Force reflow
        card.offsetHeight; 
        
        // Aplica a nova altura
        card.style.height = targetHeight + 'px';
        
        btn.querySelector('span').innerText = 'Ler menos';
        svg.classList.add('rotate-180');
    } else {
        
        card.style.height = '320px';
        
        setTimeout(() => {
            if (!p.classList.contains('line-clamp-4')) {
                p.classList.add('line-clamp-4');
                contentContainer.classList.add('absolute', 'inset-0', 'justify-center');
                contentContainer.classList.remove('relative', 'justify-start', 'z-30', 'p-10');
                card.style.height = ''; 
            }
        }, 500);

        btn.querySelector('span').innerText = 'Ler mais';
        svg.classList.remove('rotate-180');
    }
};

document.addEventListener('DOMContentLoaded', () => {
    
    // Header scroll
    const headerSpacing = document.getElementById('header-spacing');
    const headerContainer = document.getElementById('header-container');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            headerSpacing.classList.replace('px-6', 'px-4');
            headerSpacing.classList.replace('py-4', 'py-6');

            headerContainer.classList.add('backdrop-blur-xl', 'bg-slate-900/70', 'border-cyan-500/30', 'shadow-[0_0_30px_rgba(34,211,238,0.15)]');
            headerContainer.classList.remove('bg-transparent', 'border-transparent');
        } else {
            headerSpacing.classList.replace('px-4', 'px-6');
            headerSpacing.classList.replace('py-6', 'py-4');

            headerContainer.classList.remove('backdrop-blur-xl', 'bg-slate-900/70', 'border-cyan-500/30', 'shadow-[0_0_30px_rgba(34,211,238,0.15)]');
            headerContainer.classList.add('bg-transparent', 'border-transparent');
        }
    });

    // Mobile Menu 
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileCloseBtn = document.getElementById('mobile-close-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileLinks = document.querySelectorAll('.mobile-link');

    const toggleMenu = () => {
        if (!mobileMenu) return;
        const isClosed = mobileMenu.classList.contains('opacity-0');
        if (isClosed) {
            mobileMenu.classList.remove('opacity-0', 'pointer-events-none');
            mobileMenu.classList.add('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = 'hidden'; // Evita scroll do fundo
        } else {
            mobileMenu.classList.add('opacity-0', 'pointer-events-none');
            mobileMenu.classList.remove('opacity-100', 'pointer-events-auto');
            document.body.style.overflow = '';
        }
    };

    if (mobileMenuBtn && mobileCloseBtn) {
        mobileMenuBtn.addEventListener('click', toggleMenu);
        mobileCloseBtn.addEventListener('click', toggleMenu);
        
        // Fecha o menu se clicar em algum link interno
        mobileLinks.forEach(link => {
            link.addEventListener('click', toggleMenu);
        });
    }

    // Scroll suave para links internos
    const smoothScroll = (target) => {
        const element = document.querySelector(target);
        if(element) {
            // Remove o hash da URL
            history.pushState('', '', window.location.pathname);
            // Calcula a posição final
            const targetPosition = element.getBoundingClientRect().top + window.scrollY - 100;
            const startPosition = window.scrollY;
            const distance = targetPosition - startPosition;
            const duration = 800; // Duração em ms
            let start = null;

            // Função de animação customizada
            window.requestAnimationFrame(function step(timestamp) {
                if (!start) start = timestamp;
                const progress = timestamp - start;
                
                // Função Easing (EaseInOutCubic) para ficar bem suave
                const easeInOutCubic = t => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
                
                const percentage = Math.min(progress / duration, 1);
                window.scrollTo(0, startPosition + distance * easeInOutCubic(percentage));
                
                if (progress < duration) {
                    window.requestAnimationFrame(step);
                }
            });
        }
    };

    // Scroll suave para links internos
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', (e) => {
            const target = link.getAttribute('href');
            // Verifica se é link interno (ex: #about)
            if (target.startsWith('#')) {
                e.preventDefault();
                smoothScroll(target);
            }
        });
    });

    // Detectar hash na URL ao carregar a página (ex: came via link externo ou reload na hash)
    const handleInitialHash = () => {
        const hash = window.location.hash;
        if (hash && hash.startsWith('#')) {
            // Adiciona um pequeno delay para garantir que tudo foi renderizado
            setTimeout(() => smoothScroll(hash), 200);
        }
    };

    handleInitialHash();
    window.addEventListener('hashchange', handleInitialHash);

    // Lógica de Copiar E-mail
    const emailBtn = document.getElementById('copy_email');
    
    const copyToClipboard = (email, btnElement) => {
        if (!email || !btnElement) return;

        navigator.clipboard.writeText(email).then(() => {
            const mailIcon = btnElement.querySelector('.icon-mail');
            const checkIcon = btnElement.querySelector('.icon-check');
            const title = btnElement.querySelector('.copy-text');
            const desc = btnElement.querySelector('.copy-desc');
            
            if (!mailIcon || !checkIcon || !title || !desc) return;

            // Troca visual para Sucesso
            mailIcon.classList.add('opacity-0', 'scale-50');
            checkIcon.classList.remove('opacity-0', 'scale-50');
            checkIcon.classList.add('opacity-100', 'scale-100');
            
            btnElement.classList.add('border-green-500/50', 'bg-green-500/10');
            
            const originalTitle = title.innerText;
            const originalDesc = desc.innerText;
            
            title.innerText = 'Copiado!';
            title.classList.replace('text-white', 'text-green-400');
            desc.innerText = email;
            
            // Volta ao normal depois de 3 segundos
            setTimeout(() => {
                mailIcon.classList.remove('opacity-0', 'scale-50');
                checkIcon.classList.add('opacity-0', 'scale-50');
                checkIcon.classList.remove('opacity-100', 'scale-100');
                
                btnElement.classList.remove('border-green-500/50', 'bg-green-500/10');
                
                title.innerText = originalTitle;
                title.classList.replace('text-green-400', 'text-white');
                desc.innerText = originalDesc;
            }, 3000);
        }).catch(err => {
            console.error('Erro ao copiar: ', err);
        });
    };

    if (emailBtn) {
        const email = emailBtn.getAttribute('data-email');
        emailBtn.addEventListener('click', () => copyToClipboard(email, emailBtn));
    }

    // Lógica de Flip para Projetos (Interativo)
    const projectCards = document.querySelectorAll('.flip-card');

    projectCards.forEach(card => {
        const back = card.querySelector('.flip-card-back');
        
        // Evento de Clique para Flip
        card.addEventListener('click', (e) => {
            // Evita que o clique conte como clique no link interno se estiverem sobrepostos
            if (!e.target.closest('a')) {
                card.classList.toggle('is-flipped');
            }
        });

        // Evento para fechar ao clicar fora
        document.addEventListener('click', (e) => {
            if (!card.contains(e.target) && card.classList.contains('is-flipped')) {
                card.classList.remove('is-flipped');
            }
        });
    });
});