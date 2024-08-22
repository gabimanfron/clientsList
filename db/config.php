<?php
// Código de conexão com banco de dados 
$host = 'localhost';
$db = 'desafio_smartdata';
$user = 'root'; // padrão do WampServer
$pass = ''; // padrão do WampServer

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
