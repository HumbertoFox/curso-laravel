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