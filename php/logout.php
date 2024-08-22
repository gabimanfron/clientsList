<?php
session_start();
session_unset();
session_destroy();
//Encerra a sessão e redireciona para a pagina de login
header('Location: index.php');
exit();
?>
