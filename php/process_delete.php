<?php
// Código para exclusão de cliente

include '../db/config.php';

$id = $_GET['id'];

// Código que é executado no mysql e deleta o cliente no banco de dados
$stmt = $conn->prepare("DELETE FROM clients WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: clients.php?success=1');
} else {
    header('Location: clients.php?error=1');
}

$stmt->close();
$conn->close();
?>
