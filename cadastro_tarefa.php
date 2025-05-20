<?php
include 'conexão.php';

$mensagem = "";
$usuarios = [];
$result = $conn->query("SELECT id_usuario, nome FROM usuarios ORDER BY nome");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"];
    $descricao = trim($_POST["descricao"]);
    $setor = trim($_POST["setor"]);
    $prioridade = $_POST["prioridade"];

    if ($id_usuario && $descricao && $setor && $prioridade) {
        $stmt = $conn->prepare("INSERT INTO tarefas (id_usuario, descricao, setor, prioridade) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_usuario, $descricao, $setor, $prioridade);
        if ($stmt->execute()) {
            $mensagem = "Tarefa cadastrada com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar tarefa.";
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
    <title>Cadastro de Tarefa</title>
    <link rel="stylesheet" href="css/tarefas.css">
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
    <div class="cadastro-tarefa-container">
        <h2>Cadastro de Tarefa</h2>
        <?php if ($mensagem) echo "<p>$mensagem</p>"; ?>
        <form method="post">
            <label>Usuário Responsável:</label>
            <select name="id_usuario" required>
                <option value="">Selecione</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['nome']) ?></option>
                <?php endforeach; ?>
            </select>
            <label>Descrição:</label>
            <textarea name="descricao" required></textarea>
            <label>Setor:</label>
            <input type="text" name="setor" required>
            <label>Prioridade:</label>
            <select name="prioridade" required>
                <option value="">Selecione</option>
                <option value="baixa">Baixa</option>
                <option value="media">Média</option>
                <option value="alta">Alta</option>
            </select>
            <button type="submit">Cadastrar Tarefa</button>
        </form>
        <a href="./gerecialmento_de_tarefa.php">Ir para Gerenciamento de Tarefas</a>
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
