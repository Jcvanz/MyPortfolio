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
    
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
        let formattedValue = '';

        if (value.length >= 11) {
            // Formato final: (00)00000-0000
            formattedValue = value.replace(/(\d{2})(\d{4,5})(\d{4})/,'($1) $2-$3');
        } else {
            formattedValue = value.replace(/(\d{2})(\d{4,5})(\d{0,4})/,'($1) $2-$3');
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
        toggle.addEventListener('click', function() {
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

});