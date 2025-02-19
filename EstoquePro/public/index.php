<?php

require_once('../config/db.php');
require_once('../includes/header.php');

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo '<div class="alert success">Produto cadastrado com sucesso!</div>';
    } elseif ($_GET['status'] === 'error') {
        echo '<div class="alert error">Erro ao cadastrar o produto.</div>';
    }
}

$db = Database::getInstance();
$stmt = $db->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <h2>Produtos em Estoque</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Fornecedor</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($produtos)): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Nenhum produto cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['nome'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($produto['categoria'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($produto['quantidade'] ?? 'N/A') ?></td>
                        <td>R$ <?= number_format($produto['preco'] ?? 0, 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($produto['fornecedor'] ?? 'N/A') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once('../includes/footer.php'); ?>