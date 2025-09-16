<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

redirectIfNotAluno();

$aluno_id = $_SESSION['aluno_id'];
$classe = $_SESSION['aluno_classe'];
$ano_letivo = getAnoLetivoAtivo();
$meses_letivo = getMesesLetivo($ano_letivo['id']);
$pagamentos = getPagamentosAluno($aluno_id, $ano_letivo['id']);
$proximo_mes = getProximoMesAPagar($aluno_id, $ano_letivo['id'], $classe);

include '../includes/header.php';
?>

<h1 class="mb-4">Bem-vindo, <?php echo htmlspecialchars($_SESSION['aluno_nome']); ?></h1>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Meus Pagamentos - <?php echo htmlspecialchars($ano_letivo['nome']); ?></h5>
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
                                if (!in_array($classe, ['6ª', '9ª', '12ª']) && $mes['mes'] == 'Julho') {
                                    $necessario = false;
                                }
                            ?>
                                <tr class="<?php echo $necessario ? '' : 'table-secondary'; ?>">
                                    <td><?php echo htmlspecialchars($mes['mes']); ?></td>
                                    <td>
                                        <?php 
                                        if ($pago && $pagamento_mes) {
                                            echo formatarKz($pagamento['valor_pago']);
                                        } else {
                                            echo formatarKz(getPropinaClasse($classe));
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        if ($pago && $pagamento_mes) {
                                            echo date('d/m/Y', strtotime($pagamento_mes['data_pagamento']));
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($pago && $pagamento_mes): ?>
                                            <span class="badge bg-<?php echo $pagamento_mes['confirmado'] ? 'success' : 'warning'; ?>">
                                                <?php echo $pagamento_mes['confirmado'] ? 'Confirmado' : 'Pendente de confirmação'; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Não pago</span>
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
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Próximo Pagamento</h5>
                <?php if ($proximo_mes && isset($proximo_mes['valor_propina'])): ?>
                    <p class="card-text">
                        <strong>Mês:</strong> <?php echo $proximo_mes['mes']; ?><br>
                        <strong>Valor:</strong> <?php echo formatarKz($proximo_mes['valor_propina']); ?>
                    </p>
                    <a href="pagar.php?mes_id=<?php echo $proximo_mes['id']; ?>" class="btn btn-primary">Pagar Agora</a>
                <?php else: ?>
                    <p class="card-text">Todos os pagamentos necessários já foram realizados.</p>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informações</h5>
                <p class="card-text">
                    <strong>Nº Processo:</strong> <?php echo htmlspecialchars($aluno_id); ?><br>
                    <strong>Classe:</strong> <?php echo htmlspecialchars($classe); ?><br>
                    <strong>Valor da Propina:</strong> <?php echo formatarKz(getPropinaClasse($classe)); ?> por mês
                </p>
                <a href="alterar_senha.php" class="btn btn-secondary">Alterar Senha</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>