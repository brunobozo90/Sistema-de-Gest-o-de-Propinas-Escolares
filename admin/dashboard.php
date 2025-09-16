<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

redirectIfNotAdmin();

$ano_letivo = getAnoLetivoAtivo();
$total_alunos = getTotalAlunos();
$ultimos_pagamentos = getUltimosPagamentos();
$alunos_em_dia = getAlunosEmDia($ano_letivo['id']);
$alunos_devedores = getAlunosDevedores($ano_letivo['id']);

include '../includes/header.php';
?>

<h1 class="mb-4">Dashboard Administrativo</h1>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Alunos em Dia</h5>
                <p class="card-text display-4"><?php echo count($alunos_em_dia); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-danger h-100">
            <div class="card-body">
                <h5 class="card-title">Alunos Devedores</h5>
                <p class="card-text display-4"><?php echo count($alunos_devedores); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Total de Alunos</h5>
                <p class="card-text display-4"><?php echo $total_alunos; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Últimos Pagamentos</h5>
            </div>
            <div class="card-body">
                <?php if ($ultimos_pagamentos): ?>
                    <div class="list-group">
                        <?php foreach ($ultimos_pagamentos as $pagamento): ?>
                            <a href="perfil_aluno.php?id=<?php echo $pagamento['aluno_id']; ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1"><?php echo $pagamento['aluno_nome']; ?></h6>
                                    <small><?php echo date('d/m/Y H:i', strtotime($pagamento['data_pagamento'])); ?></small>
                                </div>
                                <p class="mb-1"><?php echo $pagamento['mes']; ?> - <?php echo formatarKz($pagamento['valor_pago']); ?></p>
                                <small class="<?php echo $pagamento['confirmado'] ? 'text-success' : 'text-warning'; ?>">
                                    <?php echo $pagamento['confirmado'] ? 'Confirmado' : 'Pendente'; ?>
                                </small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Nenhum pagamento recente.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Alunos com Pagamentos Pendentes</h5>
            </div>
            <div class="card-body">
                <?php if ($alunos_devedores): ?>
                    <div class="list-group">
                        <?php foreach ($alunos_devedores as $aluno): ?>
                            <a href="perfil_aluno.php?id=<?php echo $aluno['id']; ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1"><?php echo $aluno['nome']; ?></h6>
                                    <small><?php echo $aluno['classe']; ?></small>
                                </div>
                                <p class="mb-1"><?php echo $aluno['meses_confirmados']; ?> meses confirmados</p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Todos os alunos estão em dia com os pagamentos.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>