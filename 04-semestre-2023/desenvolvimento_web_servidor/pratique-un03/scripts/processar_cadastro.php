<?php
// Verificar possíveis erros
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o usuário está logado e obter o ID do usuário da sessão
    if (isset($_SESSION['usuario_logado']) && is_array($_SESSION['usuario_logado'])) {
        $idUsuario = $_SESSION['usuario_logado']['id_usuario'];

        // Coletar os dados do formulário
        $nomeContato = $_POST["nome_contato"];
        $sobrenomeContato = $_POST["sobrenome_contato"];
        $emailContato = $_POST["email_contato"];

        // Conexão com o banco de dados MySQL
        $servername = "localhost";
        $username = "usuario-banco";
        $password = "senha-banco";
        $dbname = "nome-banco";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Consulta SQL para verificar se o email já existe na tabela
        $sqlVerificarEmail = "SELECT COUNT(*) as count FROM contatos WHERE email = '$emailContato' AND id_usuario = $idUsuario";
        $resultVerificarEmail = $conn->query($sqlVerificarEmail);
        $rowVerificarEmail = $resultVerificarEmail->fetch_assoc();

        if ($rowVerificarEmail['count'] > 0) {
            // Se o email já existe na tabela, armazene a mensagem de erro em uma sessão
            $_SESSION['erro_cadastro'] = "Este email já foi cadastrado.";
            header("Location: PHP_pages_and_scripts/contatos.php");
            exit();
        } else {
            // Inicie o bloco try
            try {
                // Se o email não existe na tabela, insira o novo contato
                $sqlInserirContato = "INSERT INTO contatos (id_usuario, nome, sobrenome, email) VALUES ($idUsuario, '$nomeContato', '$sobrenomeContato', '$emailContato')";

                if ($conn->query($sqlInserirContato) === TRUE) {
                    // Redirecionar de volta para contatos.php após o cadastro bem-sucedido
                    header("Location: scripts/contatos.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Erro ao cadastrar o contato: " . $conn->error . "</div>";
                }
            } catch (mysqli_sql_exception $e) {
                // Em caso de exceção, redirecionar para a página de erro
                header("Location: scripts/redirecionar_erro.php");
                exit();
            }
            // Fim do bloco try
        }
    }
}
?>