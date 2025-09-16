<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Propinas Escolares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/propinas_escolar/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/propinas_escolar/index.php">
                <img style="background-color: #f8f9fa; width: 50px; height: 50px;" src="/propinas_escolar/assets/img/logo1.jfif" alt="">
                Colégio Betânia
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isAdminLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/propinas_escolar/admin/dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/propinas_escolar/admin/alunos.php">Alunos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/propinas_escolar/logout.php">Sair</a>
                        </li>
                    <?php elseif (isAlunoLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/propinas_escolar/aluno/dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/propinas_escolar/aluno/alterar_senha.php">Alterar Senha</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/propinas_escolar/logout.php">Sair</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/propinas_escolar/login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">