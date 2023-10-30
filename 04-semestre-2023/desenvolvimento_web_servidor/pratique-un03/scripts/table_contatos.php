<?php
//Verificar possíveis erros
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

session_start();

// Verificar se o usuário não está autenticado
if (!isset($_SESSION['usuario_logado']) || !is_array($_SESSION['usuario_logado'])) {
    header("Location: index.php"); // Redireciona para a página de login se não estiver autenticado
    exit();
}

$idUsuario = $_SESSION['usuario_logado']['id_usuario'];

/* Conexão com banco de dados. */
$servername = "localhost";
$username = "usuario-banco";
$password = "senha-banco";
$dbname = "nome-banco";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão com o banco de dados
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// Exiba uma mensagem de erro de cadastro, se houver, e depois remove a mensagem da sessão.
if (isset($_SESSION['erro_cadastro'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['erro_cadastro'] . "</div>";
    unset($_SESSION['erro_cadastro']);
}

// Lógica para exclusão de contato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_excluir"])) {
    $idExcluir = $_POST["id_excluir"];

    $sqlVerificarID = "SELECT COUNT(*) as count FROM contatos WHERE id = $idExcluir AND id_usuario = $idUsuario";
    $resultVerificarID = $conn->query($sqlVerificarID);
    $rowVerificarID = $resultVerificarID->fetch_assoc();

    if ($rowVerificarID['count'] > 0) {
        // Se o ID do contato existe, execute a consulta SQL para excluir o contato
        $sqlExcluir = "DELETE FROM contatos WHERE id = $idExcluir AND id_usuario = $idUsuario";
        if ($conn->query($sqlExcluir) === TRUE) {
            echo "<div class='alert alert-success'>Contato excluído com sucesso!</div>";
        } else {
            // Se o ID do contato não existe, exiba uma mensagem de erro
            echo "<div class='alert alert-danger'>Erro ao excluir o contato: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>ID de contato não encontrado.</div>";
    }
}

// Lógica para atualização de contato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $idAtualizar = $_POST["id"];
    $novoNome = $_POST["novo_nome"];
    $novoSobrenome = $_POST["novo_sobrenome"];
    $novoEmail = $_POST["novo_email"];
    $erro = ''; // Variável para armazenar mensagens de erro

    // Verificar se o ID do contato existe
    $sqlVerificarID = "SELECT COUNT(*) as count, email FROM contatos WHERE id = $idAtualizar AND id_usuario = $idUsuario";
    $resultVerificarID = $conn->query($sqlVerificarID);
    $rowVerificarID = $resultVerificarID->fetch_assoc();

    if ($rowVerificarID['count'] > 0) {
        $setClauses = array();

        // Verificar se um novo nome ou sobrenome foi fornecido e, se sim, atualizar o nome no banco de dados.
        if (!empty($novoNome)) {
            $setClauses[] = "nome = '$novoNome'";
        }

        if (!empty($novoSobrenome)) {
            $setClauses[] = "sobrenome = '$novoSobrenome'";
        }
        //fim condicao verificar 'nome e sobrenome'

        if (!empty($novoEmail)) {
            // Verificar se o novo email é diferente do email atual
            if ($novoEmail != $rowVerificarID['email']) {
                // Verificar se o novo email já existe na tabela para o usuário atual
                $sqlVerificarEmail = "SELECT COUNT(*) as count FROM contatos WHERE email = '$novoEmail' AND id_usuario = $idUsuario";
                $resultVerificarEmail = $conn->query($sqlVerificarEmail);
                $rowVerificarEmail = $resultVerificarEmail->fetch_assoc();

                if ($rowVerificarEmail['count'] == 0) {
                    // Se o email não pertence a outro contato, atualize o campo desejado
                    $setClauses[] = "email = '$novoEmail'";
                } else {
                    // Se o email pertence a outro contato na tabela, defina uma mensagem de erro
                    $erro = "Este email já pertence a outro contato na tabela.";
                }
            } else {
                // Se o email é o mesmo que o email atual, defina uma mensagem de erro
                $erro = "O email atualizado é igual ao email existente na tabela.";
            }
        }

        if (empty($erro)) {
            // Se não houver erros ou se apenas nome, sobrenome ou email for atualizado, construa a consulta SQL de atualização
            $sqlAtualizar = "UPDATE contatos SET " . implode(', ', $setClauses) . " WHERE id = $idAtualizar AND id_usuario = $idUsuario";

            if ($conn->query($sqlAtualizar) === TRUE) {
                echo "<div class='alert alert-success'>Contato atualizado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao atualizar o contato: " . $conn->error . "</div>";
            }
        } else {
            // Exibir mensagem de erro para o usuário
            echo "<div class='alert alert-danger'>$erro</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>ID de contato não encontrado.</div>";
    }
}


// Lógica para cadastro de novo contato
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
        echo "<div id='mensagemErro' class='alert alert-danger' style='display:none;'>Este email já está cadastrado na tabela.</div>";
    } else {
        // Se o email não existe na tabela, insira um novo contato
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
/* Cabeçalho da tabela para listar os contatos */
echo "<h1 style='text-align: center; margin: 1.25em 0 1.25em 0; font-family: 'Roboto', sans-serif; font-weight: 700;'>Lista de contatos cadastrados</h1>";
echo "<div class='table-responsive'>";
echo "<div id='contatos-table-container' style='max-height: 400px; height: 400px; overflow-y: auto;'>"; /* barra de rolagem na tabela */
echo "<table class='table table-bordered'>";
echo "<thead class='table-dark cabecalho-tabela'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nome</th>";
echo "<th>Sobrenome</th>";
echo "<th>Email</th>";
echo "<th>Deseja excluir contatos?</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

/* Loop para exibir os contatos na tabela com opção de exclusão */
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

echo "</tbody></table></div></div></div>";

//Formulário do botão para sair do sistema
echo '
    <div class="container">
        <div class="logout-button">
            <form method="post" action="logout.php">
                <button type="submit" class="btn btn-danger">Sair do sistema</button>
            </form>
        </div> 
    </div>   
';

$conn->close();
?>