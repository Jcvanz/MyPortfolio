document.addEventListener('DOMContentLoaded', () => {

    // Inputs de Arquivos
    const inputsFile = document.querySelectorAll('input[type="file"]');

    inputsFile.forEach(input => {
        input.addEventListener('change', (e) => {
            const label = input.nextElementSibling;
            const file = e.target.files[0];

            if (file) {
                label.textContent = file.name;
            } else {
                label.textContent = 'Selecionar arquivo...';
            }
        })
    });

    // Formatador de input de telefone
    const phoneInput = document.getElementById('telefone');

    phoneInput.addEventListener('input', function () {
        let value = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
        let formattedValue = '';

        if (value.length >= 11) {
            // Formato final: (00)00000-0000
            formattedValue = value.replace(/(\d{2})(\d{4,5})(\d{4})/, '($1) $2-$3');
        } else {
            formattedValue = value.replace(/(\d{2})(\d{4,5})(\d{0,4})/, '($1) $2-$3');
        }
        this.value = formattedValue;
    });

    // Contagem de caracteres em Inputs Área de Texto
    const inputArea = document.querySelectorAll('.input_area');
    const charCount = document.querySelectorAll('.char_count');

    inputArea.forEach((input, index) => {
        input.addEventListener('input', function () {
            charCount[index].textContent = `${input.value.length}/1000 caracteres`;
        });
    });

    // Alternar visibilidade da senha
    const passwordToggles = document.querySelectorAll('.password-toggle');
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const iconEye = this.querySelector('.icon-eye');
            const iconEyeSlash = this.querySelector('.icon-eye-slash');

            if (input.type === 'password') {
                input.type = 'text';
                iconEye.classList.add('hidden');
                iconEyeSlash.classList.remove('hidden');
            } else {
                input.type = 'password';
                iconEye.classList.remove('hidden');
                iconEyeSlash.classList.add('hidden');
            }
        });
    });

    // AUTO-SAVE
    // Cria elemento de notificação "Salvando..."
    const saveToast = document.createElement('div');
    saveToast.className = 'fixed bottom-5 right-5 bg-green-600 text-white px-4 py-2 rounded-md shadow-lg transition-opacity duration-300 opacity-0 pointer-events-none z-50';
    saveToast.textContent = 'Alterações salvas!';
    document.body.appendChild(saveToast);

    function showToast(message = 'Alterações salvas!') {
        saveToast.textContent = message;
        saveToast.classList.remove('opacity-0');
        setTimeout(() => saveToast.classList.add('opacity-0'), 2500);
    }

    // Função que faz o envio do formulário via Fetch API (AJAX)
    const autoSaveForm = (formElement) => {
        const formData = new FormData(formElement);

        if (formData.has('telefone')) {
            const tel = formData.get('telefone');
            formData.set('telefone', tel.replace(/\D/g, ''));
        }

        fetch(formElement.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast();
                }
            })
            .catch(error => console.error('Erro no auto-save:', error));
    };

    // Pega todos os forms da página que possuem o atributo data-autosave e adiciona os eventos nos inputs
    const forms = document.querySelectorAll('form[data-autosave="true"]');
    forms.forEach(form => {
        // Pega todos inputs, textareas e selects dentro do form
        const inputs = form.querySelectorAll('input, textarea, select');

        inputs.forEach(input => {
            // Se for arquivo ou checkbox/radio, salva no momento que muda
            if (input.type === 'file' || input.type === 'checkbox' || input.type === 'radio') {
                input.addEventListener('change', () => autoSaveForm(form));
            } else {
                // Se for campo de texto normal, salva quando perde o foco (blur)
                input.addEventListener('blur', () => autoSaveForm(form));
            }
        });
    });

    // Adicionar tags de tecnologias no card
    window.addTag = () => {
        const container = document.getElementById('tags-container');
        const div = document.createElement('div');
        div.className = 'tag-item flex items-center gap-2 bg-zinc-800 px-3 py-1.5 rounded-lg border border-zinc-700 text-white shadow-sm';
        div.innerHTML = `
            <input type="text" name="system_status[]" placeholder="Ex: React" class="bg-transparent outline-none w-24 text-sm font-mono" />
            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-300 text-lg leading-none">&times;</button>
        `;
        container.appendChild(div);
    }

    // Remover tags de tecnologias no card
    window.removeTag = (button) => {
        button.parentElement.remove();
    }

});