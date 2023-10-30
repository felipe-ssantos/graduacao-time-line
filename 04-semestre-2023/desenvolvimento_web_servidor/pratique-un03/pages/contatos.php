<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="contatos.css">
    <title>Contatos</title>
</head>

<body>
    <!-- Barra de pesquisar -->
    <div class="container">
        <div class="mt-5">
            <h2>Pesquisar Contatos</h2>
            <p>Use o campo abaixo para pesquisar contatos na tabela:</p>
            <div class="mb-3">
                <input type="text" class="form-control" id="pesquisarContatos" size="10"
                    placeholder="Pesquisar contatos">
            </div>
        </div>
    </div>

    <br>
    <hr>
    <div class="container mx-auto">
        <h2 class="mt-5">Formulário de atualização</h2>
        <p>Escolha o respectivo <strong>ID</strong> que deseja alterar. Em seguida, digite os novos dados que deseja
            atualizar.
            Ao realizar as alterações necessárias, clique em 'Atualizar', e os dados serão atualizados na tabela acima.
            <br>
            <strong>Caso queira alterar apenas um campo como, por exemplo, 'nome' digite o respectivo 'ID' é o novo
                nome, depois clique em atualizar.</strong>
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
            <button type="submit" class="btn btn-primary" style="margin: 0.3125em 0 0.625em 0;">Atualizar</button>
        </form>
        <hr>

        <!-- Cadastrar novo contato -->
        <div class="mt-5">
            <h2>Cadastrar novo contato</h2>
            <p>Caso seja um novo usuário sua lista estará em branco, portanto, é necessário cadastrar novos contatos.
            </p>

            <form method="post" action="processar_cadastro.php" onsubmit="return validarFormulario();">
                <div class="mb-3">
                    <label for="nome_contato" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome_contato" name="nome_contato" required>
                </div>
                <div class="mb-3">
                    <label for "sobrenome_contato" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome_contato" name="sobrenome_contato" required>
                </div>
                <div class="mb-3">
                    <label for="email_contato" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email_contato" name="email_contato" required>
                </div>
                <button type="submit" class="btn btn-primary" style="margin: 0.3125em 0 0.625em 0;">Cadastrar
                    Contato</button>
            </form>
        </div>
        <hr>
    </div>

    <!-- scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- script pesquisar -->
    <script src="scripts/pesquisa_contatos.js"></script>
    <!-- script sucess and danger -->
    <script src="scripts/sucess_danger.js"></script>
    <!-- validação nome e sobrenome formulário cadastrar novo contato -->
    <script src="script/validacao_name.js"></script>

    <div class="container footer-master">
        <footer class="py-3 my-4">
            <div class="row justify-content-center">
                <div class="text-center">
                    <p class="text-center text-muted">Develop by:</p>
                    <a href="https://github.com/felipe-ssantos/graduacao-time-line/tree/main/04-semestre-2023/desenvolvimento_web_servidor/pratique-un03"
                        class="text-decoration-none link-primary" target="_blank">
                        N.F.S.S © <?php echo date('Y'); ?>
                    </a>
                </div>
            </div>
        </footer>
    </div>



    <?php
        include'table_contatos.php';
    ?>

</body>

</html>