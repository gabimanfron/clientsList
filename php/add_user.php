<?php
//Código para inclusão de novo usuário no banco de dados

include '../db/config.php'; // Inclui o arquivo de conexão com o banco de dados

// Recebe os dados do formulário de cadastro
$username = $_POST['nome_usuario'];
$password = $_POST['senha'];

// Verifica se o nome de usuário já existe
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username); // Bind do parâmetro username
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Usuário já existe, redireciona para a página de cadastro com um erro
    header('Location: new_user.php?error=1');
    exit();
}

// Criptografa a senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Código que é executad no mysql e insere o novo usuário no banco de dados
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password); // Bind dos parâmetros username e password

if ($stmt->execute()) {
    // Cadastro bem-sucedido, redireciona para a página de cadastro com sucesso
    header('Location: login.php?success=1');
} else {
    // Erro ao cadastrar, redireciona para a página de cadastro com um erro
    header('Location: new_user.php?error=1');
}

$stmt->close(); // Fecha a declaração
$conn->close(); // Fecha a conexão com o banco de dados
?>
