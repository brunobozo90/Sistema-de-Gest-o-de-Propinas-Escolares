<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($tipo === 'admin') {
        if (loginAdmin($username, $password)) {
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $erro = "Credenciais inválidas para administrador.";
        }
    } elseif ($tipo === 'aluno') {
        if (loginAluno($username, $password)) {
            header("Location: aluno/dashboard.php");
            exit();
        } else {
            $erro = "Número de processo ou senha inválidos.";
        }
    } else {
        $erro = "Tipo de login inválido.";
    }
}

include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-8 mx-auto text-center">
        <img src="assets/img/logo.png" alt="Logo da Escola" class="mb-4" style="max-height: 150px;">
        <h1 class="display-4">Bem-vindo ao Colégio Betânia</h1>
        <p class="lead">Sistema de Gestão de Propinas Escolares</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#aluno">Aluno</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#admin">Administrador</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                <?php endif; ?>
                
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="aluno">
                        <form method="POST">
                            <input type="hidden" name="tipo" value="aluno">
                            <div class="mb-3">
                                <label for="username" class="form-label">Número de Processo</label>
                                <input type="number" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <small class="text-muted">A senha inicial é o seu número de processo.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="admin">
                        <form method="POST">
                            <input type="hidden" name="tipo" value="admin">
                            <div class="mb-3">
                                <label for="admin_username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="admin_username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="admin_password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="admin_password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>