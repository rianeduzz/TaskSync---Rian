# TaskSync

TaskSync é uma aplicação web simples para gerenciamento de tarefas, voltada para empresas que atuam no ramo de projetos. Permite cadastrar usuários, cadastrar e gerenciar tarefas, visualizar tarefas por status (Kanban) e por usuário.

## Como usar

1. **Importe o banco de dados**
   - No XAMPP/phpMyAdmin, importe o arquivo `database.sql` para criar o banco `tasksync`.

2. **Inicie o servidor local**
   - Inicie o Apache e o MySQL pelo XAMPP.

3. **Acesse o sistema**
   - Coloque a pasta do projeto em `htdocs` (ex: `c:\xampp\htdocs\TaskSync - Rian\`).
   - No navegador, acesse:  
     `http://localhost/TaskSync - Rian/index.php`

4. **Funcionalidades**
   - **Cadastro de Usuário:** Cadastre novos colaboradores.
   - **Cadastro de Tarefa:** Registre tarefas e vincule a um usuário.
   - **Gerenciamento de Tarefas:** Visualize, edite, exclua e altere o status das tarefas em um quadro Kanban.
   - **Visualizar Tarefas por Usuário:** Veja todas as tarefas de cada usuário em formato de tabela.

5. **Usuário de Teste**
   - O sistema não possui autenticação/login.
   - Basta cadastrar qualquer usuário para testar.

6. **Bibliotecas**
   - Não é necessário instalar nenhuma biblioteca extra.
   - O sistema utiliza apenas PHP, MySQL e CSS puro.

7. **Estrutura de Pastas**
   - `css/` - Arquivos de estilo (um para cada página)
   - `img/` - Logo do sistema
   - `docs/` - DER, caso de uso, documentação
   - Arquivos `.php` - Telas e funcionalidades do sistema

8. **Observações**
   - Todos os campos de cadastro são obrigatórios.
   - As tarefas aparecem em colunas separadas por status no Kanban.
   - O menu superior permite navegar entre todas as páginas.
   - O site é responsivo e pode ser usado em dispositivos móveis.

---

**Qualquer dúvida, consulte os arquivos na pasta `docs/` para ver o DER e o diagrama de caso de uso.**
