document.addEventListener('DOMContentLoaded', function() {
    // Mostrar mensagens de sucesso/erro
    const alertas = document.querySelectorAll('.alert');
    alertas.forEach(alerta => {
        setTimeout(() => {
            alerta.style.transition = 'opacity 0.5s';
            alerta.style.opacity = '0';
            setTimeout(() => alerta.remove(), 500);
        }, 5000);
    });
    
    // Validação de formulários
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('[required]');
            let valido = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    valido = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (!valido) {
                e.preventDefault();
                
                // Criar alerta se não existir
                if (!this.querySelector('.alert')) {
                    const alerta = document.createElement('div');
                    alerta.className = 'alert alert-danger mb-3';
                    alerta.textContent = 'Por favor, preencha todos os campos obrigatórios.';
                    this.prepend(alerta);
                    
                    setTimeout(() => {
                        alerta.style.transition = 'opacity 0.5s';
                        alerta.style.opacity = '0';
                        setTimeout(() => alerta.remove(), 500);
                    }, 5000);
                }
            }
        });
    });
    
    // Remover classe de erro ao digitar
    document.querySelectorAll('[required]').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});