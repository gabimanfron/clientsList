<?php
//Deleta o cliente do banco de dados
session_start();
require ('../db/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

//Codigo que é executado do mysql
$stmt = $pdo->prepare("DELETE FROM clients WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit();
?>
