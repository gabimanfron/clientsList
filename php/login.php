<?php
//Código para verfificação de dados de login
include ('../db/config.php');


$username = $_POST['nome_usuario'];
$password = $_POST['senha'];

//Código que verifica os dados do usuário no banco de dados mysql
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Login bem-sucedido
        header('Location: clients.php');
        exit();
    } else {
        // Senha incorreta
        header('Location: index.php?error=1');
        exit();
    }
} else {
    // Usuário não encontrado
    header('Location: index.php?error=1');
    exit();
}

$stmt->close();
$conn->close();
?>