<?php
include 'conexão.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $setor = trim($_POST["setor"]);

    if ($nome && $setor) {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, setor) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $setor);
        if ($stmt->execute()) {
            $mensagem = "Usuário cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar usuário.";
        }
        $stmt->close();
    } else {
        $mensagem = "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="./css/cadastro.css">
    <link rel="stylesheet" href="css/style.css">
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
    <div class="cadastro-container">
        <h2>Cadastro de Usuário</h2>
        <?php if ($mensagem) echo "<p>$mensagem</p>"; ?>
        <form method="post">
            <label>Nome:</label>
            <input type="text" name="nome" required>
            <label>Setor:</label>
            <input type="text" name="setor" required>
            <button type="submit">Cadastrar</button>
        </form>
        <a href="cadastro_tarefa.php">Ir para Cadastro de Tarefas</a>
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
