<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

redirectIfNotAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pagamento_id'])) {
    if (confirmarPagamento($_POST['pagamento_id'])) {
        $_SESSION['sucesso'] = "Pagamento confirmado com sucesso!";
    } else {
        $_SESSION['erro'] = "Erro ao confirmar pagamento.";
    }
}

// Redirecionar de volta para a página de origem
$referer = $_SERVER['HTTP_REFERER'] ?? 'alunos.php';
header("Location: $referer");
exit();
?>