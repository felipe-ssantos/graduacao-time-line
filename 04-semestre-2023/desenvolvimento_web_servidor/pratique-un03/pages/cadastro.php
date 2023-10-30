<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Cadastro</title>
</head>

<body>
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
        <div class="container footer-master">
            <footer class="py-3 my-4">
                <div class="row justify-content-center">
                    <div class="text-center">
                        <p class="text-center text-muted">Develop by:</p>
                        <a href="https://github.com/felipe-ssantos/graduacao-time-line/tree/main/04-semestre-2023/desenvolvimento_web_servidor/pratique-un03"
                            class="text-decoration-none link-primary" target="_blank">
                            N.F.S.S ©
                            <?php echo date('Y'); ?>
                        </a>
                    </div>
                </div>
            </footer>
        </div>

        <!-- script sucess and danger -->
        <script src="script/sucess_danger.js"></script>
        <!-- script cadastro -->
        <?php
        include './scripts/pages/enviar_cadastro.php';
        ?>
</body>

</html>