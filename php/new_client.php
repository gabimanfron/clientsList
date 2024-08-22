<!--Código para coletar dados de novo cliente-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Novo Cliente</h1>
        
        <!-- Mensagens de erro ou sucesso -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <?php
                $error = $_GET['error'];
                if ($error == 'emptyfields') {
                    echo "Todos os campos são obrigatórios.";
                } elseif ($error == 'invalidemail') {
                    echo "Email inválido.";
                } elseif ($error == 'stmtexecute') {
                    echo "Erro ao adicionar cliente.";
                } elseif ($error == 'invalidrequest') {
                    echo "Solicitação inválida.";
                }
                ?>
            </div>
        <?php elseif (isset($_GET['success'])): ?>
            <div class="success-message">
                Cliente adicionado com sucesso!
            </div>
        <?php endif; ?>

        <!-- Formulário para adicionar novo cliente -->
        <form action="add_client.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required minlength="3" maxlength="100">
            
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" required minlength="5" maxlength="20">
            
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" required pattern="[0-9]{10,15}">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required>
            
            <button type="submit">Adicionar Cliente</button>
        </form>
    </div>
</body>
</html>
