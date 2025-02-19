<?php
require_once('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = intval($_POST['produto_id'] ?? 0);
    $tipo = htmlspecialchars($_POST['tipo'] ?? '');
    $quantidade = intval($_POST['quantidade'] ?? 0);

    if ($produto_id <= 0) {
        die("Selecione um produto válido.");
    }

    if ($quantidade <= 0) {
        die("A quantidade deve ser maior que zero.");
    }

    try {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO movimentacoes (produto_id, tipo, quantidade) VALUES (:produto_id, :tipo, :quantidade)");
        $stmt->execute([
            ':produto_id' => $produto_id,
            ':tipo' => $tipo,
            ':quantidade' => $quantidade
        ]);

        header('Location: ../public/movimentacoes.php?status=success');
        exit();
    } catch (PDOException $e) {
        die("Erro ao registrar movimentação: " . $e->getMessage());
    }
} else {
    die("Método de requisição inválido.");
}
?>