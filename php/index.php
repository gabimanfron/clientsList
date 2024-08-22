<!--Códigos de página de login-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link para o arquivo CSS -->
</head>
<body>
    <div class="logincontainer">
        <h2>Login</h2>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Usuário ou senha inválidos</p>';
        }
        ?>
        <!--Form para coleta de dados de login-->
        <form action="login.php" method="post">
            <label for="nome_usuario">Nome de Usuário:</label>
            <input type="text" id="nome_usuario" name="nome_usuario" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="new_user.php">Ainda não tem conta? Cadastre-se</a><!--Link que vai direto para a página de cadastro-->
    </div>
</body>
</html>
