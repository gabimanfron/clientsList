<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
        include '../db/config.php';

        // Verifica se o parâmetro 'id' está presente na URL
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: clients.php?error=invalidid');
            exit;
        }

        $id = $_GET['id'];
        
        // Código que seleciona o cliente para edição no banco de dados
        $stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se o cliente foi encontrado
        if ($result->num_rows === 0) {
            header('Location: clients.php?error=clientnotfound');
            exit;
        }

        $cliente = $result->fetch_assoc();
    ?>

    <div class="container">
        <h1>Editar Cliente</h1>

        <!-- Mensagens de erro ou sucesso -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <?php
                $error = $_GET['error'];
                if ($error == 'clientnotfound') {
                    echo "Cliente não encontrado.";
                } elseif ($error == 'invalidid') {
                    echo "ID inválido.";
                } elseif ($error == 'emptyfields') {
                    echo "Todos os campos são obrigatórios.";
                } elseif ($error == 'invalidemail') {
                    echo "Email inválido.";
                } elseif ($error == 'stmtexecute') {
                    echo "Erro ao atualizar cliente.";
                }
                ?>
            </div>
        <?php elseif (isset($_GET['success'])): ?>
            <div class="success-message">
                Cliente atualizado com sucesso!
            </div>
        <?php endif; ?>

        <!-- Formulário para edição/atualização de dados do cliente -->
        <form action="process_edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['id']); ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['name']); ?>" required minlength="3" maxlength="100">
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" value="<?php echo htmlspecialchars($cliente['document']); ?>" required minlength="5" maxlength="20">
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($cliente['phone']); ?>" required pattern="[0-9]{10,15}">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($cliente['address']); ?>" required>
            <button type="submit">Atualizar Cliente</button>
        </form>
    </div>

    <?php
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
