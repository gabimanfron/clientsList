<!--Código para cadastro de novo usuário-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Inclui o arquivo CSS para estilização -->
</head>
<body>
    <div class="logincontainer">
        <h2>Cadastro de Usuário</h2>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Erro! Usuário já cadastrado no Sistema.</p>'; // Mensagem de erro
        } elseif (isset($_GET['success'])) {
            echo '<p class="success">Usuário cadastrado com sucesso!</p>'; // Mensagem de sucesso
        }
        ?>
        <!--Form para coleta de dados de cadastro-->
        <form action="add_user.php" method="post">
            <label for="nome_usuario">Nome de Usuário:</label>
            <input type="text" id="nome_usuario" name="nome_usuario" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Cadastrar</button>
        </form>
        <a href="index.php">Já possui conta? Clique para Login</a>
    </div>
</body>
</html>
