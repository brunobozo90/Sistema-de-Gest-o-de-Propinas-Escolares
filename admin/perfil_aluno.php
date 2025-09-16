<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

redirectIfNotAdmin();

if (!isset($_GET['id'])) {
    header("Location: alunos.php");
    exit();
}

$aluno_id = $_GET['id'];
$ano_letivo = getAnoLetivoAtivo();
$meses_letivo = getMesesLetivo($ano_letivo['id']);
$pagamentos = getPagamentosAluno($aluno_id, $ano_letivo['id']);

// Obter dados do aluno
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ?");
$stmt->execute([$aluno_id]);
$aluno = $stmt->fetch();

if (!$aluno) {
    header("Location: alunos.php");
    exit();
}

include '../includes/header.php';
?>

<h1 class="mb-4">Perfil do Aluno</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Informações do Aluno</h5>
                <p class="card-text">
                    <strong>Nº Processo:</strong> <?php echo $aluno['id']; ?><br>
                    <strong>Nome:</strong> <?php echo $aluno['nome']; ?><br>
                    <strong>Classe:</strong> <?php echo $aluno['classe']; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Pagamentos - <?php echo $ano_letivo['nome']; ?></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mês</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($meses_letivo as $mes): 
                                $pago = false;
                                $pagamento_mes = null;
                                
                                foreach ($pagamentos as $pagamento) {
                                    if ($pagamento['mes_letivo_id'] == $mes['id']) {
                                        $pago = true;
                                        $pagamento_mes = $pagamento;
                                        break;
                                    }
                                }
                                
                                // Verificar se este mês é necessário para o aluno
                                $necessario = true;
                                if (!in_array($aluno['classe'], ['6ª', '9ª', '12ª']) && $mes['mes'] == 'Julho') {
                                    $necessario = false;
                                }
                            ?>
                                <tr class="<?php echo $necessario ? '' : 'table-secondary'; ?>">
                                    <td><?php echo $mes['mes']; ?></td>
                                    <td>
                                        <?php 
                                        if ($pago && $pagamento_mes) {
                                            echo formatarKz($pagamento_mes['valor_pago']);
                                        } else {
                                            echo formatarKz(getPropinaClasse($aluno['classe']));
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $pago ? date('d/m/Y', strtotime($pagamento_mes['data_pagamento'])) : '-'; ?></td>
                                    <td>
                                        <?php if ($pago): ?>
                                            <span class="badge bg-<?php echo $pagamento_mes['confirmado'] ? 'success' : 'warning'; ?>">
                                                <?php echo $pagamento_mes['confirmado'] ? 'Confirmado' : 'Pendente'; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Não pago</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($pago && !$pagamento_mes['confirmado']): ?>
                                            <form method="POST" action="confirmar_pagamento.php" class="d-inline">
                                                <input type="hidden" name="pagamento_id" value="<?php echo $pagamento_mes['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-success">Confirmar</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="alunos.php" class="btn btn-secondary">Voltar</a>

<?php include '../includes/footer.php'; ?>