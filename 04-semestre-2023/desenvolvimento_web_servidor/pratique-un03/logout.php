<?php

//verificar possíveis erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Destruir a sessão atual
session_destroy();

// Redirecionar para a página de login (index.php ou qualquer outra página de login)
header("Location: /index.php");
exit;
?>
