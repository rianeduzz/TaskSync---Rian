<?php
include 'conexão.php';


if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conn->query("DELETE FROM tarefas WHERE id_tarefa = $id");
    header("Location: gerecialmento_de_tarefa.php");
    exit;
}


if (isset($_GET['mudar_status']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $novo_status = $_GET['mudar_status'];
    $stmt = $conn->prepare("UPDATE tarefas SET status=? WHERE id_tarefa=?");
    $stmt->bind_param("si", $novo_status, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: gerecialmento_de_tarefa.php");
    exit;
}


$colunas = [
    'a fazer' => [],
    'fazendo' => [],
    'concluido' => []
];
$res = $conn->query("SELECT t.*, u.nome FROM tarefas t JOIN usuarios u ON t.id_usuario = u.id_usuario ORDER BY t.data_cadastro DESC");
while ($row = $res->fetch_assoc()) {
    $colunas[$row['status']][] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gerenciamento.css">
</head>
<body>
    <header class="header-tasksync">
        <img src="./img/logo1.png" alt="Logo TaskSync" class="logo" width="80" height="60">
        <button class="menu-toggle" onclick="toggleMenu()">&#8942;</button>
        <nav class="menu-dropdown" id="menuDropdown">
            <a href="index.php">Início</a>
            <a href="cadastro_usuario.php">Cadastro de Usuário</a>
            <a href="cadastro_tarefa.php">Cadastro de Tarefa</a>
            <a href="gerecialmento_de_tarefa.php">Gerenciamento de Tarefas</a>
            <a href="visualizar_tarefa.php">Visualizar Tarefas por Usuário</a>
        </nav>
    </header>
    <h2 style="text-align:center;">Gerenciamento de Tarefas</h2>
    <div class="kanban-container">
        <?php foreach ($colunas as $status => $tarefas): ?>
            <div class="kanban-coluna">
                <h2><?= ucfirst($status) ?></h2>
                <?php foreach ($tarefas as $tarefa): ?>
                    <div class="kanban-card">
                        <strong><?= htmlspecialchars($tarefa['descricao']) ?></strong><br>
                        <small>Usuário: <?= htmlspecialchars($tarefa['nome']) ?></small><br>
                        <small>Setor: <?= htmlspecialchars($tarefa['setor']) ?></small><br>
                        <small>Prioridade: <?= htmlspecialchars($tarefa['prioridade']) ?></small><br>
                        <small>Data: <?= date('d/m/Y H:i', strtotime($tarefa['data_cadastro'])) ?></small>
                        <div class="card-actions">
                            <a href="gerecialmento_de_tarefa.php?excluir=<?= $tarefa['id_tarefa'] ?>" onclick="return confirm('Excluir tarefa?')">Excluir</a>
                            <a href="cadastro_tarefa.php?editar=<?= $tarefa['id_tarefa'] ?>">Editar</a>
                            <?php if ($status == 'a fazer'): ?>
                                <a href="?mudar_status=fazendo&id=<?= $tarefa['id_tarefa'] ?>">Fazer</a>
                            <?php elseif ($status == 'fazendo'): ?>
                                <a href="?mudar_status=concluido&id=<?= $tarefa['id_tarefa'] ?>">Concluir</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin:20px;">
        <a href="cadastro_tarefa.php">Cadastrar Nova Tarefa</a> | 
        <a href="visualizar_tarefa.php">Visualizar Tarefas por Usuário</a>
    </div>
    <script>
        function toggleMenu() {
            var menu = document.getElementById('menuDropdown');
            menu.classList.toggle('show');
        }
        window.onclick = function(event) {
            if (!event.target.matches('.menu-toggle')) {
                var dropdowns = document.getElementsByClassName("menu-dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>
