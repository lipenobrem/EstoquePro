<?php
require_once('../includes/header.php');
?>

<div class="card">
    <h2>Cadastrar Novo Produto</h2>
    <form action="<?= BASE_URL ?>/processamentos/processa_cadastro.php" method="POST">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="categoria">Categoria:</label>
        <input type="text" id="categoria" name="categoria" required>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" min="1" required>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" min="0.01" required>

        <label for="fornecedor">Fornecedor:</label>
        <input type="text" id="fornecedor" name="fornecedor" required>

        <button type="submit">Cadastrar Produto</button>
    </form>
</div>

<?php require_once('../includes/footer.php'); ?>