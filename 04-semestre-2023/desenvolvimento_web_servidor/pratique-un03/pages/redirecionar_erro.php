<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="10;url=https://nfssfacu.wuaze.com/contatos.php">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Erro no Cadastro</title>
</head>

<body style="background-color: #f5f5f5;">
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Erro no Cadastro</h1>
            <p class="lead">Desculpe, ocorreu um erro durante o processamento ou esse e-mail já foi cadastrado por outro
                usuário.</p>
            <p>Você será redirecionado para a página de contatos novamente em 10 segundos.</p>
            <a href="contatos.php" class="btn btn-primary">Clique aqui para ir à página de contatos</a>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>