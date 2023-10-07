<?php
//verificar possíveis erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Verificar se o usuário não está autenticado
if (!isset($_SESSION['usuario_logado']) || !is_array($_SESSION['usuario_logado'])) {
    // Se não estiver autenticado, redirecione para a página de login
    header("Location: index.php");
    exit();
}

// Obtém o ID do usuário a partir da sessão
$idUsuario = $_SESSION['usuario_logado']['id_usuario'];

// Conexão com o banco de dados MySQL
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Defina a codificação de caracteres para UTF-8
$conn->set_charset("utf8mb4");

// Verificar se há uma mensagem de erro na sessão
if (isset($_SESSION['erro_cadastro'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['erro_cadastro'] . "</div>";

    // Limpar a sessão para que a mensagem não seja exibida novamente
    unset($_SESSION['erro_cadastro']);
}

// Verificação do envio do formulário de exclusão
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_excluir"])) {
    $idExcluir = $_POST["id_excluir"];

    // Consulta SQL para verificar se o ID existe antes de excluir
    $sqlVerificarID = "SELECT COUNT(*) as count FROM contatos WHERE id = $idExcluir AND id_usuario = $idUsuario";
    $resultVerificarID = $conn->query($sqlVerificarID);
    $rowVerificarID = $resultVerificarID->fetch_assoc();

    if ($rowVerificarID['count'] > 0) {
        // Verifica primeiro se o ID existe na tabela, para depois realizar a exclusão.
        $sqlExcluir = "DELETE FROM contatos WHERE id = $idExcluir AND id_usuario = $idUsuario";
        if ($conn->query($sqlExcluir) === TRUE) {
            echo "<div class='alert alert-success'>Contato excluído com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao excluir o contato: " . $conn->error . "</div>";
        }
    } else {
        // Caso o ID não exista na tabela, exiba uma mensagem de erro
        echo "<div class='alert alert-danger'>ID de contato não encontrado.</div>";
    }
}

// Verificação do envio do formulário de atualização
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $idAtualizar = $_POST["id"];
    $novoNome = $_POST["novo_nome"];
    $novoSobrenome = $_POST["novo_sobrenome"];
    $novoEmail = $_POST["novo_email"];

    // Consulta SQL para verificar se o ID existe antes de atualizar
    $sqlVerificarID = "SELECT COUNT(*) as count FROM contatos WHERE id = $idAtualizar AND id_usuario = $idUsuario";
    $resultVerificarID = $conn->query($sqlVerificarID);
    $rowVerificarID = $resultVerificarID->fetch_assoc();

    if ($rowVerificarID['count'] > 0) {
        // Se o ID existe na tabela, então podemos prosseguir com a atualização
        $sqlAtualizar = "UPDATE contatos SET nome = '$novoNome', sobrenome = '$novoSobrenome', email = '$novoEmail' WHERE id = $idAtualizar AND id_usuario = $idUsuario";
        if ($conn->query($sqlAtualizar) === TRUE) {
            echo "<div class='alert alert-success'>Contato atualizado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar o contato: " . $conn->error . "</div>";
        }
    } else {
        // Se o ID não existe na tabela, exiba uma mensagem de erro
        echo "<div class='alert alert-danger'>ID de contato não encontrado.</div>";
    }
}

// Verificação do envio do formulário de cadastro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome_contato"]) && isset($_POST["sobrenome_contato"]) && isset($_POST["email_contato"])) {
    $nomeContato = $_POST["nome_contato"];
    $sobrenomeContato = $_POST["sobrenome_contato"];
    $emailContato = $_POST["email_contato"];

    // Consulta SQL para verificar se o email já existe na tabela
    $sqlVerificarEmail = "SELECT COUNT(*) as count FROM contatos WHERE email = '$emailContato' AND id_usuario = $idUsuario";
    $resultVerificarEmail = $conn->query($sqlVerificarEmail);
    $rowVerificarEmail = $resultVerificarEmail->fetch_assoc();

    if ($rowVerificarEmail['count'] > 0) {
        // Se o email já existe na tabela, exiba uma mensagem de erro
        echo "<div id='mensagemErro' class='alert alert-danger' style='display:none;'>Este email já foi cadastrado.</div>";
    } else {
        // Se o email não existe na tabela, insira o novo contato
        $sqlInserirContato = "INSERT INTO contatos (id_usuario, nome, sobrenome, email) VALUES ($idUsuario, '$nomeContato', '$sobrenomeContato', '$emailContato')";
        if ($conn->query($sqlInserirContato) === TRUE) {
            echo "<div class='alert alert-success'>Contato cadastrado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao cadastrar o contato: " . $conn->error . "</div>";
        }
    }
}

// Consulta SQL para selecionar todos os registros da tabela "contatos" do usuário
$sql = "SELECT * FROM contatos WHERE id_usuario = '$idUsuario'";
$result = $conn->query($sql);

// Exibir tabela de contatos
echo "<h1 style='text-align: center; margin: 20px 0 20px 0; font-family: \"Roboto\", sans-serif; font-weight: 700;'>Lista de contatos cadastrados</h1>";
echo "<table class='table table-bordered'>";
echo "<thead class='table-dark'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nome</th>";
echo "<th>Sobrenome</th>";
echo "<th>Email</th>";
echo "<th>Deseja excluir contatos?</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["nome"] . "</td>";
    echo "<td>" . $row["sobrenome"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>";
    echo "<form method='post' action='{$_SERVER['PHP_SELF']}'>";
    echo "<input type='hidden' name='id_excluir' value='{$row["id"]}'>";
    echo "<button type='submit' class='btn btn-danger'>Excluir</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</tbody></table>";

// Exibe o botão "Sair do sistema"
echo '
 <div class="logout-button">
    <form method="post" action="logout.php">
        <button type="submit" class="btn btn-danger">Sair do sistema</button>
    </form>
</div>    
';

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Contatos</title>

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

        /* botão de logout */
        .logout-button {
            margin: 0 0 10px 20px;
        }

        .logout-button button {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <br>
    <hr>
    <div class="container mx-auto">
        <h2 class="mt-5">Formulário de atualização</h2>
        <p>Escolha o respectivo <strong>ID</strong> que deseja alterar. Em seguida, digite os novos dados que deseja
            atualizar.
            Ao realizar as alterações necessárias, clique em 'Atualizar', e os dados serão atualizados na tabela acima.
            <br>
            <i>As alterações realizadas na tabela serão refletidas após <strong>0,5 segundos.</strong></i>
            <br>
            <strong>Todos os campos do formulário de atualização devem ser preenchidos. Caso contrário, o campo não
                preenchido ficará em branco na tabela.</strong>
        </p>
        <!-- Formulário para atualizar dados da lista de contatos -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="id" class="form-label">ID do Contato</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="novo_nome" class="form-label">Novo Nome</label>
                <input type="text" class="form-control" id="novo_nome" name="novo_nome">
            </div>
            <div class="mb-3">
                <label for="novo_sobrenome" class="form-label">Novo Sobrenome</label>
                <input type="text" class="form-control" id="novo_sobrenome" name="novo_sobrenome">
            </div>
            <div class="mb-3">
                <label for="novo_email" class="form-label">Novo Email</label>
                <input type="text" class="form-control" id="novo_email" name="novo_email">
            </div>
            <button type="submit" class="btn btn-primary" style="margin: 5px 0 10px 0;">Atualizar</button>
        </form>
        <hr>

        <!-- Cadastrar novo contato -->
        <div class="mt-5">
            <h2>Cadastrar novo contato</h2>
            <p>Caso seja um novo usuário sua lista estará em branco, portanto, é necessário cadastrar novos contatos.
            </p>

            <form method="post" action="processar_cadastro.php">
                <div class="mb-3">
                    <label for="nome_contato" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome_contato" name="nome_contato" required>
                </div>
                <div class="mb-3">
                    <label for="sobrenome_contato" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome_contato" name="sobrenome_contato" required>
                </div>
                <div class="mb-3">
                    <label for="email_contato" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email_contato" name="email_contato" required>
                </div>
                <button type="submit" class="btn btn-primary" style="margin: 5px 0 10px 0;">Cadastrar Contato</button>
            </form>

        </div>
        <hr>
    </div>

    <!-- scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Função para ocultar mensagens de sucesso ou erro após 5 segundos
        setTimeout(function () {
            var sucessoDiv = document.querySelector('.alert-success');
            var erroDiv = document.querySelector('.alert-danger');

            if (sucessoDiv) {
                sucessoDiv.style.display = 'none';
            }

            if (erroDiv) {
                erroDiv.style.display = 'none';
            }
        }, 2000);
    </script>

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