document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('cursor-canvas');
    const ctx = canvas.getContext('2d');

    let width = window.innerWidth;
    let height = window.innerHeight;
    canvas.width = width;
    canvas.height = height;

    let mouse = { x: width / 2, y: height / 2, moved: false };

    window.addEventListener('mousemove', e => {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
        mouse.moved = true;
    });
    window.addEventListener('mouseout', () => {
        mouse.moved = false; // Desconecta o cursor quando o mouse sai da tela
    });

    window.addEventListener('resize', () => {
        width = window.innerWidth;
        height = window.innerHeight;
        canvas.width = width;
        canvas.height = height;
    });

    // Cria as partículas espalhadas por toda a tela
    const particles = [];
    // Quantidade adaptativa baseada na área da tela para não pesar
    const numParticles = Math.min(Math.floor((width * height) / 10000), 100);

    for (let i = 0; i < numParticles; i++) {
        particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            vx: (Math.random() - 0.5) * 1.5, // Velocidade constante
            vy: (Math.random() - 0.5) * 1.5,
            size: Math.random() * 2 + 0.5
        });
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        // Move as partículas
        for (let i = 0; i < particles.length; i++) {
            let p = particles[i];
            p.x += p.vx;
            p.y += p.vy;

            // Rebate nas bordas da tela
            if (p.x < 0 || p.x > width) p.vx *= -1;
            if (p.y < 0 || p.y > height) p.vy *= -1;
        }

        // Desenha as conexões
        for (let i = 0; i < particles.length; i++) {
            let p = particles[i];

            // 1. Conecta o cursor às partículas próximas
            if (mouse.moved) {
                let dx = mouse.x - p.x;
                let dy = mouse.y - p.y;
                let distSq = dx * dx + dy * dy;

                // Alcance do cursor (raio de atração/conexão)
                if (distSq < 30000) {
                    ctx.beginPath();
                    ctx.moveTo(mouse.x, mouse.y);
                    ctx.lineTo(p.x, p.y);
                    // Ciano neon ligando ao cursor
                    ctx.strokeStyle = `rgba(6, 182, 212, ${(1 - distSq / 30000) * 0.6})`;
                    ctx.lineWidth = 1.2;
                    ctx.stroke();
                }
            }

            // 2. Conecta as partículas umas com as outras
            for (let j = i + 1; j < particles.length; j++) {
                let p2 = particles[j];
                let dx = p.x - p2.x;
                let dy = p.y - p2.y;
                let distSq = dx * dx + dy * dy;

                // Alcance entre partículas
                if (distSq < 15000) {
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(p2.x, p2.y);
                    // Azul sutil ligando partículas
                    ctx.strokeStyle = `rgba(59, 130, 246, ${(1 - distSq / 15000) * 0.25})`;
                    ctx.lineWidth = 0.8;
                    ctx.stroke();
                }
            }
        }

        // Desenha os pontos (partículas)
        for (let i = 0; i < particles.length; i++) {
            ctx.beginPath();
            ctx.arc(particles[i].x, particles[i].y, particles[i].size, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(14, 165, 233, 0.4)';
            ctx.fill();
        }

        requestAnimationFrame(animate);
    }

    animate();
});