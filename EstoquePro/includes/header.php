<?php
session_start();
define('BASE_URL', 'http://localhost/projeto_pessoal/EstoquePro-1/EstoquePro');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstoquePro</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>../assets/css/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Estoque Web</h1>
            <nav class="nav">
                <ul>
                    <li><a href="<?= BASE_URL ?>/public/index.php">Início</a></li>
                    <li><a href="<?= BASE_URL ?>/public/cadastro_produto.php">Cadastrar Produto</a></li>
                    <li><a href="<?= BASE_URL ?>/public/movimentacoes.php">Movimentações</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">