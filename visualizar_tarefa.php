<?php
include 'conexão.php';

$usuarios = [];
$res = $conn->query("SELECT * FROM usuarios ORDER BY nome");
while ($u = $res->fetch_assoc()) {
    $usuarios[$u['id_usuario']] = $u['nome'];
}

$tarefas = [];
$res = $conn->query("SELECT t.*, u.nome FROM tarefas t JOIN usuarios u ON t.id_usuario = u.id_usuario ORDER BY u.nome, t.data_cadastro DESC");
while ($row = $res->fetch_assoc()) {
    $tarefas[$row['id_usuario']][] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Tarefas por Usuário</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vizualizar.css">
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
    <div class="visualizar-container">
        <h2>Tarefas por Usuário</h2>
        <?php foreach ($usuarios as $id_usuario => $nome): ?>
            <h3><?= htmlspecialchars($nome) ?></h3>
            <table class="visualizar-table">
                <tr>
                    <th>Descrição</th>
                    <th>Setor</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th>Data Cadastro</th>
                </tr>
                <?php if (!empty($tarefas[$id_usuario])): ?>
                    <?php foreach ($tarefas[$id_usuario] as $tarefa): ?>
                        <tr>
                            <td><?= htmlspecialchars($tarefa['descricao']) ?></td>
                            <td><?= htmlspecialchars($tarefa['setor']) ?></td>
                            <td><?= htmlspecialchars($tarefa['prioridade']) ?></td>
                            <td><?= htmlspecialchars($tarefa['status']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($tarefa['data_cadastro'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">Nenhuma tarefa cadastrada.</td></tr>
                <?php endif; ?>
            </table>
        <?php endforeach; ?>
        <div style="text-align:center;margin:20px;">
            <a href="./gerecialmento_de_tarefa.php">Voltar ao Gerenciamento</a>
        </div>
    </div>
    <footer class="footer-tasksync">
        <p>
            TaskSync é uma aplicação para gerenciamento de tarefas, criada para facilitar o controle e a organização de projetos em empresas.<br>
            Desenvolvida para apoiar equipes e setores na distribuição e acompanhamento das atividades.
        </p>
    </footer>
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
