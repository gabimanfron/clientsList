<?php
// Código para editar dados do cliente

include '../db/config.php'; // Conexão com o banco de dados

// Função para sanitizar e validar dados
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $nome = sanitizeInput($_POST['nome']);
    $documento = sanitizeInput($_POST['documento']);
    $telefone = sanitizeInput($_POST['telefone']);
    $email = sanitizeInput($_POST['email']);
    $endereco = sanitizeInput($_POST['endereco']);

    // Validações básicas
    if (empty($nome) || empty($documento) || empty($telefone) || empty($email) || empty($endereco)) {
        header('Location: edit_client.php?id=' . $id . '&error=emptyfields');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: edit_client.php?id=' . $id . '&error=invalidemail');
        exit;
    }

    // Prepara e executa a query
    $stmt = $conn->prepare("UPDATE clients SET name = ?, document = ?, phone = ?, email = ?, address = ? WHERE id = ?");
    if ($stmt === false) {
        die("Erro ao preparar a query: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $nome, $documento, $telefone, $email, $endereco, $id);

    if ($stmt->execute()) {
        header('Location: clients.php?success=1');
    } else {
        header('Location: edit_client.php?id=' . $id . '&error=stmtexecute');
    }

    $stmt->close();
    $conn->close();
} else {
    // Caso o formulário não seja enviado via POST
    header('Location: clients.php?error=invalidrequest');
    exit;
}
?>
