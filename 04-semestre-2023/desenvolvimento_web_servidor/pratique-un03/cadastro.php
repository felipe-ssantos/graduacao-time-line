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
        echo "Por favor, preencha todos os campos obrigatórios.";
    } elseif ($email !== $confirmarEmail) {
        echo "Os endereços de email não coincidem. Tente novamente.";
    } elseif ($senha !== $confirmarSenha) {
        echo "As senhas não coincidem. Tente novamente.";
    } else {

        // Conexão com o banco de dados MySQL
        $servername = "localhost";
        $username = "";
        $password = "";
        $dbname = "";

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
                header("Location: index.php");
                echo "Cadastro do usuário realizado com sucesso!";
                exit;
            } else {
                echo "Erro ao cadastrar o usuário: " . $stmt->error;
            }

            // Fechar a conexão com o banco de dados
            $stmt->close();
        }
        
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <title>Cadastro</title>
</head>

<body>
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
    </style>

    <!-- Formulário de cadastro -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Cadastro</div>
                    <div class="card-body">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3">
                                <label for="nome_usuario" class="form-label">Nome de Usuário</label>
                                <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_email" class="form-label">Confirmar Email</label>
                                <input type="email" class="form-control" id="confirmar_email" name="confirmar_email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
                <div class="mt-3">
                    <p>Já possui uma conta? <a href="index.php">Faça login</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>