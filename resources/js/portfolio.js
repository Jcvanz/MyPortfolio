document.addEventListener('DOMContentLoaded', () => {
    const githubUsername = 'Jcvanz';

    // Animação de contador
    const animateValue = (id, start, end, duration) => {
        const obj = document.getElementById(id);
        if(!obj) return;
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Fetch User Data
    fetch(`https://api.github.com/users/${githubUsername}`)
        .then(response => response.json())
        .then(data => {
            if(data.public_repos !== undefined) {
                animateValue("gh-repos", 0, data.public_repos, 1500);
                animateValue("gh-followers", 0, data.followers, 1500);
            }
        })
        .catch(err => console.error('Erro ao buscar GitHub User:', err));

    // Fetch Repos for Stars and Languages
    fetch(`https://api.github.com/users/${githubUsername}/repos?per_page=100`)
        .then(response => response.json())
        .then(repos => {
            if(Array.isArray(repos)) {
                let totalStars = 0;
                let languages = {};
                let totalReposWithLang = 0;

                repos.forEach(repo => {
                    totalStars += repo.stargazers_count;
                    if(repo.language) {
                        languages[repo.language] = (languages[repo.language] || 0) + 1;
                        totalReposWithLang++;
                    }
                });

                animateValue("gh-stars", 0, totalStars, 1500);

                // Processar Top Language e Progress Bars
                if(Object.keys(languages).length > 0) {
                    // Converte em array, calcula % e ordena
                    let langArray = Object.keys(languages).map(lang => ({
                        name: lang,
                        count: languages[lang],
                        percent: (languages[lang] / totalReposWithLang) * 100
                    })).sort((a, b) => b.count - a.count);

                    // Atualizar "Top Linguagem" Card
                    const topLang = langArray[0].name;
                    const langElement = document.getElementById("gh-language");
                    if (langElement) {
                        langElement.style.opacity = 0;
                        setTimeout(() => {
                            langElement.innerText = topLang;
                            langElement.style.transition = 'opacity 0.5s';
                            langElement.style.opacity = 1;
                        }, 500);
                    }

                    // Renderizar Progress Bars de Linguagens (Top 5)
                    const langsContainer = document.getElementById('gh-langs-container');
                    if (langsContainer) {
                        let html = '';
                        const colors = ['bg-cyan-400', 'bg-blue-500', 'bg-green-400', 'bg-yellow-400', 'bg-purple-500'];
                        
                        langArray.slice(0, 5).forEach((lang, index) => {
                            const color = colors[index % colors.length];
                            html += `
                                <div class="group/bar">
                                    <div class="flex justify-between text-xs font-mono text-gray-400 mb-1.5 transition-colors group-hover/bar:text-white">
                                        <span>${lang.name}</span>
                                        <span class="text-${color.split('-')[1]}-400">${lang.percent.toFixed(1)}%</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden shadow-inner">
                                        <div class="h-full ${color} rounded-full relative shadow-[0_0_10px_currentColor]" style="width: 0%; transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.2}s" data-width="${lang.percent}%">
                                            <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        
                        langsContainer.innerHTML = html;

                        // Acionar animação de crescimento das barras
                        setTimeout(() => {
                            langsContainer.querySelectorAll('[data-width]').forEach(el => {
                                el.style.width = el.getAttribute('data-width');
                            });
                        }, 100);
                    }
                }
            }
        })
        .catch(err => console.error('Erro ao buscar GitHub Repos:', err));

    // Skill Radar Chart Initialization
    let skillsChart = null;

    setTimeout(() => {
        if(typeof Chart !== 'undefined') {
            const canvas = document.getElementById('skillsRadar');
            if (!canvas) return;
            
            const ctxRadar = canvas.getContext('2d');
            
            // Destrói instância existente para evitar bugs de re-renderização
            if (skillsChart) {
                skillsChart.destroy();
            }
            
            const gradient = ctxRadar.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(34, 211, 238, 0.6)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.1)');
            
            skillsChart = new Chart(ctxRadar, {
                type: 'radar',
                data: {
                    labels: ['Backend', 'Frontend', 'Bancos de Dados', 'Arquitetura', 'Soft Skills', 'Deploy'],
                    datasets: [{
                        label: 'Proficiência',
                        data: [75, 90, 75, 35, 95, 55], 
                        backgroundColor: gradient,
                        borderColor: 'rgba(34, 211, 238, 0.8)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(34, 211, 238, 1)',
                        pointBorderColor: '#fff',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: { color: 'rgba(255, 255, 255, 0.1)' },
                            grid: { color: 'rgba(255, 255, 255, 0.1)', circular: true },
                            suggestedMin: 0,
                            suggestedMax: 100,
                            ticks: { display: false, stepSize: 20 },
                            pointLabels: { 
                                color: '#cbd5e1', 
                                font: { family: 'monospace', size: 10 } 
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        }
    }, 500);
});
