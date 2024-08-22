<?php
// Adicionando novo cliente ao banco de dados

include '../db/config.php'; // Conexão com o banco de dados

// Função para sanitizar e validar dados
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = sanitizeInput($_POST['nome']);
    $documento = sanitizeInput($_POST['documento']);
    $telefone = sanitizeInput($_POST['telefone']);
    $email = sanitizeInput($_POST['email']);
    $endereco = sanitizeInput($_POST['endereco']);

    // Validações básicas
    if (empty($nome) || empty($documento) || empty($telefone) || empty($email) || empty($endereco)) {
        header('Location: new_client.php?error=emptyfields');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: new_client.php?error=invalidemail');
        exit;
    }

    // Prepara e executa a query
    $stmt = $conn->prepare("INSERT INTO clients (name, document, phone, email, address) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erro ao preparar a query: " . $conn->error);
    }

    $stmt->bind_param("sssss", $nome, $documento, $telefone, $email, $endereco);

    if ($stmt->execute()) {
        // Cadastro bem-sucedido, redireciona para a página de listagem de clientes atualizada
        header('Location: clients.php?success=1');
    } else {
        // Erro ao cadastrar, redireciona para a página de cadastro com um erro
        header('Location: new_client.php?error=stmtexecute');
    }

    $stmt->close();
    $conn->close();
} else {
    // Caso o formulário não seja enviado via POST
    header('Location: new_client.php?error=invalidrequest');
    exit;
}
?>
