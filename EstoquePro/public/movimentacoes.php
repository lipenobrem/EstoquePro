<?php
require_once('../config/db.php');
require_once('../includes/header.php');

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo '<div class="alert success">Movimentação registrada com sucesso!</div>';
    } elseif ($_GET['status'] === 'error') {
        echo '<div class="alert error">Erro ao registrar a movimentação.</div>';
    }
}

$db = Database::getInstance();
$stmt = $db->query("SELECT id, nome FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="card">
    <h2>Registrar Movimentação</h2>
    <form action="../processamentos/processa_movimentacao.php" method="POST">
        <label for="produto_id">Produto:</label>
        <select id="produto_id" name="produto_id" required>
            <option value="">Selecione um produto</option>
            <?php foreach ($produtos as $produto): ?>
                <option value="<?= $produto['id'] ?>"><?= htmlspecialchars($produto['nome']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="tipo">Tipo de Movimentação:</label>
        <select id="tipo" name="tipo" required>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" min="1" required><br><br>

        <button type="submit">Registrar Movimentação</button>
    </form>
</div>

<div class="card">
    <h2>Gráfico de Movimentações</h2>
    <canvas id="movimentacoesChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php

$stmt = $db->query("
    SELECT
        DATE_FORMAT(data_movimentacao, '%Y-%m') AS mes,
        SUM(CASE WHEN tipo = 'entrada' THEN quantidade ELSE 0 END) AS entradas,
        SUM(CASE WHEN tipo = 'saida' THEN quantidade ELSE 0 END) AS saidas
    FROM
        movimentacoes
    GROUP BY
        mes
    ORDER BY
        mes
");
$dadosMovimentacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$entradas = [];
$saidas = [];

foreach ($dadosMovimentacoes as $dado) {
    $labels[] = $dado['mes'];
    $entradas[] = $dado['entradas'];
    $saidas[] = $dado['saidas'];
}
?>

<script>
    const movimentacoesData = {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Entradas',
            data: <?= json_encode($entradas) ?>,
            borderColor: '#27ae60',
            fill: false
        }, {
            label: 'Saídas',
            data: <?= json_encode($saidas) ?>,
            borderColor: '#e74c3c',
            fill: false
        }]
    };

    const ctx = document.getElementById('movimentacoesChart').getContext('2d');
    const movimentacoesChart = new Chart(ctx, {
        type: 'line',
        data: movimentacoesData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        echo '<div class="alert success">Movimentação registrada com sucesso!</div>';
    } elseif ($_GET['status'] === 'error') {
        echo '<div class="alert error">Erro ao registrar a movimentação.</div>';
    }
}
?>

<?php require_once('../includes/footer.php'); ?>