<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

redirectIfNotAluno();

$aluno_id = $_SESSION['aluno_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha_atual = $_POST['senha_atual'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    
    // Verificar senha atual
    $stmt = $pdo->prepare("SELECT senha FROM alunos WHERE id = ?");
    $stmt->execute([$aluno_id]);
    $aluno = $stmt->fetch();
    
    if (!password_verify($senha_atual, $aluno['senha'])) {
        $erro = "A senha atual está incorreta.";
    } elseif ($nova_senha !== $confirmar_senha) {
        $erro = "As novas senhas não coincidem.";
    } elseif (strlen($nova_senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        if (alterarSenhaAluno($aluno_id, $nova_senha)) {
            $_SESSION['sucesso'] = "Senha alterada com sucesso!";
            header("Location: dashboard.php");
            exit();
        } else {
            $erro = "Erro ao alterar senha. Tente novamente.";
        }
    }
}

include '../includes/header.php';
?>

<h1 class="mb-4">Alterar Senha</h1>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="senha_atual" class="form-label">Senha Atual</label>
                        <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
                    </div>
                    <div class="mb-3">
                        <label for="nova_senha" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
                        <small class="text-muted">Mínimo de 6 caracteres.</small>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar Nova Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Alterar Senha</button>
                        <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>