<?php
//verificar possíveis erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['usuario_logado'])) {
    header("Location: contatos.php"); // Redirecionar para a página de contatos se já estiver logado
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
            'id_usuario' => obterIDUsuario($nomeUsuario),
            // Obter o ID do usuário
        ];
        header("Location: contatos.php"); // Redirecionar para a página de contatos após o login bem-sucedido
        exit();
    } else {
        $erro = "Credenciais inválidas. Tente novamente.";
    }
}

function autenticarUsuario($nomeUsuario, $senha)
{
    // Conexão com o banco de dados MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "";

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
    $username = "root";
    $password = "";
    $dbname = "";

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

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <title>Login</title>

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        /* Estilo para o link no rodapé */
        footer a {
            text-decoration: none;            
            color: #333;            
        }        
        footer a:hover {
            color: #007bff;            
        }
    </style>
</head>

<body>

    <!-- Formulário de login -->
    <div class="container mt-5">
        <div class="alert alert-info">
            <p class="text-center mb-0">
                Esse é um sistema de lista de contatos que permite cadastrar, atualizar e excluir contatos já
                cadastrados. Cada usuário possui sua lista exclusiva, portanto, pode realizar as alterações necessárias
                sem interferir na lista de outros usuários cadastrados no sistema.
            </p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <?php if (isset($erro)) { ?>
                            <div class="alert alert-danger">
                                <?= $erro; ?>
                            </div>
                        <?php } ?>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3">
                                <label for="nome_usuario" class="form-label">Nome de Usuário</label>
                                <input type="text" class="form-control" id="nome_usuario" name="nome_usuario">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
                <div class="mt-3">
                    <p>Não possui uma conta? <a href="cadastro.php">Cadastrar-se</a></p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <footer class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <p class="mb-2">Desenvolvido por:</p>
                <a href="https://github.com/felipe-ssantos/graduacao-time-line/tree/main/04-semestre-2023/desenvolvimento_web_servidor/pratique-un03"
                    class="text-decoration-none" target="_blank">
                    N.F.S.S | 4ª Semestre: Sistemas para Internet | 2023 ©
                </a>
                <hr>
                <p class="row justify-content-center"><br>Este sistema foi desenvolvido exclusivamente para fins
                    acadêmicos, como parte da disciplina de Desenvolvimento Web Servidor. Todas as informações contidas
                    nele são fictícias e destinam-se apenas a fins de teste. Por favor, esteja ciente de que, podem
                    haver a presença de erros no sistema.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>