<?php
define('BASE_URL', 'http://localhost/projeto_pessoal/EstoquePro-1/EstoquePro');

require_once('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = htmlspecialchars($_POST['nome'] ?? '');
    $categoria = htmlspecialchars($_POST['categoria'] ?? '');
    $quantidade = intval($_POST['quantidade'] ?? 0);
    $preco = floatval($_POST['preco'] ?? 0);
    $fornecedor = htmlspecialchars($_POST['fornecedor'] ?? '');

    if (empty($nome)) {
        die("O nome do produto é obrigatório.");
    }

    if ($quantidade <= 0) {
        die("A quantidade deve ser maior que zero.");
    }

    if ($preco <= 0) {
        die("O preço deve ser maior que zero.");
    }

    try {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO produtos (nome, categoria, quantidade, preco, fornecedor) VALUES (:nome, :categoria, :quantidade, :preco, :fornecedor)");
        $stmt->execute([
            ':nome' => $nome,
            ':categoria' => $categoria,
            ':quantidade' => $quantidade,
            ':preco' => $preco,
            ':fornecedor' => $fornecedor
        ]);

        header('Location: ' . BASE_URL . '/public/index.php?status=success');
        exit();
    } catch (PDOException $e) {
        die("Erro ao cadastrar produto: " . $e->getMessage());
    }
} else {
    die("Método de requisição inválido.");
}
?>