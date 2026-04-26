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

                // Top Language Card (Simplificado: apenas pega a linguagem do repo mais recente ou principal)
                const mainLangs = repos.filter(r => r.language).map(r => r.language);
                if(mainLangs.length > 0) {
                    const topLang = [...new Set(mainLangs)].sort((a,b) => 
                        mainLangs.filter(v => v===b).length - mainLangs.filter(v => v===a).length
                    )[0];
                    
                    const langElement = document.getElementById("gh-language");
                    if (langElement) {
                        langElement.style.opacity = 0;
                        setTimeout(() => {
                            langElement.innerText = topLang;
                            langElement.style.transition = 'opacity 0.5s';
                            langElement.style.opacity = 1;
                        }, 500);
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
                        data: [75, 90, 75, 35, 95, 20], 
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
