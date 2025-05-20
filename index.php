<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>TaskSync - Início</title>
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
    <div class="index-container">
        <h1>TaskSync</h1>
        <a href="cadastro_usuario.php">Cadastro de Usuário</a>
        <a href="cadastro_tarefa.php">Cadastro de Tarefa</a>
        <a href="gerecialmento_de_tarefa.php">Gerenciamento de Tarefas</a>
        <a href="visualizar_tarefa.php">Visualizar Tarefas por Usuário</a>
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
