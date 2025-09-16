<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

redirectIfNotAluno();

if (!isset($_GET['mes_id'])) {
    header("Location: dashboard.php");
    exit();
}

$mes_id = $_GET['mes_id'];
$aluno_id = $_SESSION['aluno_id'];
$classe = $_SESSION['aluno_classe'];
$ano_letivo = getAnoLetivoAtivo();

// Verificar se este é realmente o próximo mês a pagar
$proximo_mes = getProximoMesAPagar($aluno_id, $ano_letivo['id'], $classe);
if (!$proximo_mes || $proximo_mes['id'] != $mes_id) {
    $_SESSION['erro'] = "Você só pode pagar os meses na ordem correta.";
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (registrarPagamento($aluno_id, $ano_letivo['id'], $mes_id)) {
        $_SESSION['sucesso'] = "Pagamento registrado com sucesso! Aguarde confirmação.";
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Erro ao registrar pagamento. Tente novamente.";
    }
}

include '../includes/header.php';
?>

<h1 class="mb-4">Registrar Pagamento</h1>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Aluno</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['aluno_nome']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mês</label>
                        <input type="text" class="form-control" value="<?php echo $proximo_mes['mes']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" value="<?php echo isset($proximo_mes['valor_propina']) ? formatarKz($proximo_mes['valor_propina']) : formatarKz(getPropinaClasse($_SESSION['aluno_classe'])); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Método de Pagamento</label>
                        <select class="form-select">
                            <option>Transferência Bancária</option>
                            <option>Dinheiro (na secretaria)</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Confirmar Pagamento</button>
                        <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>