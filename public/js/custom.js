// GET do Seletor Valor
const inputValor = document.getElementById('valor');

// Aguardando o Usuário digitar no Campo valor
if (inputValor) {
    inputValor.addEventListener('input', () => {
        // Removendo caracteres diferentes de Número
        let valueValor = inputValor.value.replace(/[^\d]/g, '');

        // Remove virgula se estiver vazio
        if (valueValor.length === 0) {
            inputValor.value = '';
            return;
        };
        // Adicionando mascara na Milhar
        let formatValor = (valueValor.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valueValor.slice(-2);

        // Adicionando mascara no Centavo
        formatValor = formatValor.slice(0, -2) + ',' + formatValor.slice(-2);

        // Adicionando a mascara no Input Valor
        inputValor.value = formatValor;
    });
};

// Receba o seletor apagar e percorrer a lista de registro
document.querySelectorAll('.btnDelete').forEach(function (button) {

    // Aguardar o clique do usuário no botão apagar
    button.addEventListener('click', function (event) {

        // Bloquear o recarregamento da página
        event.preventDefault();

        // Receber o atributo que possui o ID do Registro que deve ser Excluído
        let deleteId = button.getAttribute('data-delete-id');
        
        Swal.fire({
            title: 'Tem Certeza?',
            text: "Você Não poderá Reverter Isso!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#0D6EFD',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#DC3545',
            confirmButtonText: 'Sim, excluir!'
        }).then((result) => {
            // Carregar a página responsável em excluir se o usuário confirmar a exclusão
            if (result.isConfirmed) {
                document.getElementById(`formExcluir${deleteId}`).submit();
            };
        });

    });
});