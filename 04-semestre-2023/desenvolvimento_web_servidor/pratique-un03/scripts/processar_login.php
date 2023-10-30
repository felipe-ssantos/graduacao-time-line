<?php

//SSL
if ($_SERVER['HTTPS'] != 'on') {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

//verificar possíveis erros
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['usuario_logado'])) {
    header("Location: scripts/contatos.php"); // Redirecionar para a página de contatos se já estiver logado
    exit();
}

// Se o formulário de login for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeUsuario = $_POST["nome_usuario"];
    $senha = $_POST["senha"];

    // Autenticação segura
    if (autenticarUsuario($nomeUsuario, $senha)) {
        $_SESSION['usuario_logado'] = [
            'nome_usuario' => $nomeUsuario,
            'id_usuario' => obterIDUsuario($nomeUsuario), // Obter o ID do usuário
        ];
        header("Location: PHP_pages_and_scripts/contatos.php"); // Redirecionar para a página de contatos após o login bem-sucedido
        exit();
    } else {
        $erro = "Credenciais inválidas. Tente novamente.";
    }
}

function autenticarUsuario($nomeUsuario, $senha)
{
    // Conexão com o banco de dados MySQL
    $servername = "localhost";
    $username = "usuario-banco";
    $password = "senha-banco";
    $dbname = "nome-banco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta SQL preparada para verificar as credenciais
    $sql = "SELECT senha FROM usuarios WHERE nome_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nomeUsuario);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashSenhaArmazenada = $row["senha"];

        // Verifica a senha com hash
        if (password_verify($senha, $hashSenhaArmazenada)) {
            // As credenciais são válidas?
            return true;
        }
    }

    // As credenciais são inválidas.
    return false;
}

function obterIDUsuario($nomeUsuario)
{
    // Conexão com o banco de dados MySQL
    $servername = "localhost";
    $username = "usuario-banco";
    $password = "senha-banco";
    $dbname = "nome-banco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta SQL preparada para obter o ID do usuário
    $sql = "SELECT id_usuario FROM usuarios WHERE nome_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nomeUsuario);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row["id_usuario"];
    }

    return null;
    
}
?>