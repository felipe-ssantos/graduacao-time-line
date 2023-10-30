<?php

    //verificar possíveis erros
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Verificação do envio do formulário de cadastro de usuário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coletar os dados do formulário
        $nomeUsuario = $_POST["nome_usuario"];
        $email = $_POST["email"];
        $confirmarEmail = $_POST["confirmar_email"];
        $senha = $_POST["senha"];
        $confirmarSenha = $_POST["confirmar_senha"];

    // Verificar se os campos obrigatórios não estão vazios
    if (empty($nomeUsuario) || empty($email) || empty($confirmarEmail) || empty($senha) || empty($confirmarSenha)) {
        echo "<p class='alert alert-danger', style='text-align:center;'>Por favor, preencha todos os campos obrigatórios.</p>";
    } elseif ($email !== $confirmarEmail) {
        echo "<p class='alert alert-danger', style='text-align:center;'>Os endereços de email não coincidem. Tente novamente.</p>";
    } elseif ($senha !== $confirmarSenha) {
        echo "<p class='alert alert-danger', style='text-align:center;'>As senhas não coincidem. Tente novamente.</p>";
    } else {

        // Conexão com o banco de dados MySQL
        $servername = "localhost";
        $username = "usuario-banco";
        $password = "senha-banco";
        $dbname = "nome-banco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Verificar se o e-mail já está registrado
        $sql_verificar_email = "SELECT id_usuario FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql_verificar_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p class='alert alert-danger', style='text-align:center;'>Este e-mail já está cadastrado. Por favor, use outro.</p>";
        } else {
            // Hash da senha com atributo 'bcrypt'
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

            // Consulta SQL para inserir o novo usuário na tabela "usuarios"
            $sql = "INSERT INTO usuarios (nome_usuario, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nomeUsuario, $email, $senhaHash);

            if ($stmt->execute()) {
                // Redirecionar para a página de login (index.php) após o cadastro bem-sucedido
                header("Location: ../index.php");
                echo "<p class='alert alert-success', style='text-align:center;'>Cadastro do usuário realizado com sucesso!</p>";
                exit;
            } else {
                echo "<p class='alert alert-danger', style='text-align:center;'>Erro ao cadastrar o usuário: </p>" . $stmt->error;
            }

            // Fechar a conexão com o banco de dados
            $stmt->close();
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }
}
?>