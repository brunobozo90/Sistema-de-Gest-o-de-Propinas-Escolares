<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

redirectIfNotAdmin();

$ano_letivo = getAnoLetivoAtivo();
$alunos_em_dia = getAlunosEmDia($ano_letivo['id']);
$alunos_devedores = getAlunosDevedores($ano_letivo['id']);

include '../includes/header.php';
?>

<h1 class="mb-4">Gestão de Alunos</h1>

<ul class="nav nav-tabs mb-4" id="alunosTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="devedores-tab" data-bs-toggle="tab" data-bs-target="#devedores" type="button" role="tab">
            Alunos Devedores (<?php echo count($alunos_devedores); ?>)
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="em-dia-tab" data-bs-toggle="tab" data-bs-target="#em-dia" type="button" role="tab">
            Alunos em Dia (<?php echo count($alunos_em_dia); ?>)
        </button>
    </li>
</ul>

<div class="tab-content" id="alunosTabContent">
    <div class="tab-pane fade show active" id="devedores" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nº Processo</th>
                        <th>Nome</th>
                        <th>Classe</th>
                        <th>Meses Pagos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunos_devedores as $aluno): ?>
                        <tr>
                            <td><?php echo $aluno['id']; ?></td>
                            <td><?php echo $aluno['nome']; ?></td>
                            <td><?php echo $aluno['classe']; ?></td>
                            <td><?php echo $aluno['meses_confirmados']; ?></td>
                            <td>
                                <a href="perfil_aluno.php?id=<?php echo $aluno['id']; ?>" class="btn btn-sm btn-primary">Ver</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="em-dia" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nº Processo</th>
                        <th>Nome</th>
                        <th>Classe</th>
                        <th>Meses Pagos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alunos_em_dia as $aluno): ?>
                        <tr>
                            <td><?php echo $aluno['id']; ?></td>
                            <td><?php echo $aluno['nome']; ?></td>
                            <td><?php echo $aluno['classe']; ?></td>
                            <td><?php echo $aluno['meses_confirmados']; ?></td>
                            <td>
                                <a href="perfil_aluno.php?id=<?php echo $aluno['id']; ?>" class="btn btn-sm btn-primary">Ver</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>