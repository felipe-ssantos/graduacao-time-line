<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratique - Formulário - Unidade 01 - DWS</title>
</head>
<!-- RA:2022133807 -->

<body>
<header>
    <h1>Formulário Inteligente</h1>
</header>

    <?php
    session_start();
    $perguntas = ['Qual seu nome?', 'Qual o seu curso?', 'Qual sua cor favorita?', 'Em que semestre você está?'];

    if (!isset($_SESSION['respostas'])) {
        $_SESSION['respostas'] = array();
    }

    if (isset($_POST['count'])) {
        $_SESSION['respostas'][$_POST['count']] = $_POST['resposta'];

        if (count($perguntas) == $_POST['count'] + 1) {
            header('Location: resultado.php');
            exit(); // Adicionado para evitar que o script continue a ser executado
        }
    }

    $index = isset($_POST['count']) ? (int)$_POST['count'] + 1 : 0;
    ?>

    <form method="post">
        <h2><?php echo $perguntas[$index] ?></h2>
        <input type="text" name="resposta" style="width: 50%; height: 20px">
        <br><br>
        <input type="submit" name="acao" value="Enviar resposta e ir para próxima pergunta!">
        <input type="hidden" name="count" value="<?php echo $index; ?>">
    </form>
</body>

</html>