document.addEventListener('DOMContentLoaded', () => {
    console.log('Sistema de Estoque Carregado');

    const movimentacaoForm = document.querySelector("form");
    
    movimentacaoForm.addEventListener('submit', (e) => {
        alert("Movimentação registrada com sucesso!");
    });
});
