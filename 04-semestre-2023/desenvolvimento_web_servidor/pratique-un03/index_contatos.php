<!DOCTYPE html>
<html lang="pt-BR">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Contatos</title>
</head>
<!-- Matrícula: 2022133807 -->
<body>
    <h1>Lista de Contatos</h1>

    <?php
    // Conexão com o banco de dados MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, "contatos");

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta SQL para selecionar todos os registros da tabela "contatos"
    $sql = "SELECT * FROM contatos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibindo tabela, para saber quem está cadastro e realizar a atualização.
        echo "<table class='table table-bordered'>
            <thead class='table-dark'>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nome"] . "</td>
                <td>" . $row["sobrenome"] . "</td>
                <td>" . $row["email"] . "</td>
            </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Não há contatos cadastrados.";
    }

    ?>

    <div class="container mx-auto">
        <h2 class="mt-5">Formulário de Atualização</h2>
        <p>Escolha o respectivo <strong>ID</strong> que deseja alterar. Em seguida, escolha o respectivo campo que deseja
            alterar.
            Ao realizar as alterações necessárias, clique em atualizar e o dado será atualizado na tabela acima.
            <p><i>Para verificar se atualizou aperte a tecla de atalho <strong>F5.</strong></i></p>
        </p>
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
    </div>

    <!-- scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    // Verificação do envio do formulário de atualização
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $novoNome = $_POST["novo_nome"];
        $novoSobrenome = $_POST["novo_sobrenome"];
        $novoEmail = $_POST["novo_email"];

        // Consulta SQL para atualizar os campos desejados
        if (!empty($novoNome)) {
            $sql = "UPDATE contatos SET nome = '$novoNome' WHERE id = $id";
            $conn->query($sql);
        }

        if (!empty($novoSobrenome)) {
            $sql = "UPDATE contatos SET sobrenome = '$novoSobrenome' WHERE id = $id";
            $conn->query($sql);
        }

        if (!empty($novoEmail)) {
            $sql = "UPDATE contatos SET email = '$novoEmail' WHERE id = $id";
            $conn->query($sql);
        }

        echo "Atualização realizada com sucesso!";
    }

    $conn->close();
    ?>
</body>
<!-- Matrícula: 2022133807 -->
</html>