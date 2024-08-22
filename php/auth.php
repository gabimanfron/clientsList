<?php

include ('../db/config.php'); // Inclui o arquivo de conexão com o banco de dados

// Recebe os dados do formulário de login
$username = $_POST['nome_usuario'];
$password = $_POST['senha'];

// Prepara a consulta SQL para buscar a senha do usuário
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username); // Bind do parâmetro username
$stmt->execute();
$stmt->store_result();

// Verifica se o nome de usuário foi encontrado
if ($stmt->num_rows === 1) {
    $stmt->bind_result($hashed_password); // Obtém a senha criptografada
    $stmt->fetch();

    // Verifica se a senha fornecida corresponde à senha armazenada
    if (password_verify($password, $hashed_password)) {
        // Login bem-sucedido, redireciona para o lista de clientes
        header('Location: clients.php');
        exit();
    } else {
        // Senha incorreta, redireciona de volta para a página de login com um erro
        header('Location: index.php?error=1');
        exit();
    }
} else {
    // Nome de usuário não encontrado, redireciona de volta para a página de login com um erro
    header('Location: index.php?error=1');
    exit();
}

$stmt->close(); // Fecha a declaração
$conn->close(); // Fecha a conexão com o banco de dados
?>
