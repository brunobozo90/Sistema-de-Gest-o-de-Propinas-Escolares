<?php
require_once 'conexao.php';

function getAnoLetivoAtivo() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM ano_letivo ORDER BY inicio DESC LIMIT 1");
    return $stmt->fetch();
}

function getMesesLetivo($ano_letivo_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM meses_letivo WHERE ano_letivo_id = ? ORDER BY ordem");
    $stmt->execute([$ano_letivo_id]);
    return $stmt->fetchAll();
}

function getPagamentosAluno($aluno_id, $ano_letivo_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT p.*, m.mes 
        FROM pagamentos p 
        JOIN meses_letivo m ON p.mes_letivo_id = m.id 
        WHERE p.aluno_id = ? AND p.ano_letivo_id = ?
        ORDER BY m.ordem
    ");
    $stmt->execute([$aluno_id, $ano_letivo_id]);
    return $stmt->fetchAll();
}

function getProximoMesAPagar($aluno_id, $ano_letivo_id, $classe) {
    global $pdo;
    
    // Obter valor da propina para a classe
    $valor_propina = getPropinaClasse($classe);
    
    // Determinar até qual mês o aluno deve pagar
    $meses_necessarios = in_array($classe, ['6ª', '9ª', '12ª']) ? 11 : 10;
    
    // Verificar qual foi o último mês pago
    $stmt = $pdo->prepare("
        SELECT m.ordem 
        FROM pagamentos p 
        JOIN meses_letivo m ON p.mes_letivo_id = m.id 
        WHERE p.aluno_id = ? AND p.ano_letivo_id = ? AND p.confirmado = TRUE
        ORDER BY m.ordem DESC 
        LIMIT 1
    ");
    $stmt->execute([$aluno_id, $ano_letivo_id]);
    $ultimo_pago = $stmt->fetch();
    
    $proxima_ordem = $ultimo_pago ? $ultimo_pago['ordem'] + 1 : 1;
    
    // Verificar se já pagou todos os meses necessários
    if ($proxima_ordem > $meses_necessarios) {
        return null;
    }
    
    // Obter o próximo mês a pagar
    $stmt = $pdo->prepare("
        SELECT m.* 
        FROM meses_letivo m
        WHERE m.ano_letivo_id = ? AND m.ordem = ?
    ");
    $stmt->execute([$ano_letivo_id, $proxima_ordem]);
    $proximo_mes = $stmt->fetch();
    
    if ($proximo_mes) {
        $proximo_mes['valor_propina'] = $valor_propina;
    }
    
    return $proximo_mes;
}

function registrarPagamento($aluno_id, $ano_letivo_id, $mes_letivo_id) {
    global $pdo;
    
    // Obter a classe do aluno e o valor correspondente
    $stmt = $pdo->prepare("
        SELECT a.classe, pc.valor 
        FROM alunos a
        JOIN propinas_classe pc ON a.classe = pc.classe
        WHERE a.id = ?
    ");
    $stmt->execute([$aluno_id]);
    $dados = $stmt->fetch();
    
    if (!$dados) {
        return false;
    }
    
    $valor_propina = $dados['valor'];
    
    $stmt = $pdo->prepare("
        INSERT INTO pagamentos 
        (aluno_id, ano_letivo_id, mes_letivo_id, valor_pago, confirmado) 
        VALUES (?, ?, ?, ?, FALSE)
    ");
    return $stmt->execute([$aluno_id, $ano_letivo_id, $mes_letivo_id, $valor_propina]);
}

function confirmarPagamento($pagamento_id) {
    global $pdo;
    
    $stmt = $pdo->prepare("
        UPDATE pagamentos SET confirmado = TRUE 
        WHERE id = ?
    ");
    return $stmt->execute([$pagamento_id]);
}

function alterarSenhaAluno($aluno_id, $nova_senha) {
    global $pdo;
    
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("
        UPDATE alunos SET senha = ? 
        WHERE id = ?
    ");
    return $stmt->execute([$senha_hash, $aluno_id]);
}

function getAlunosEmDia($ano_letivo_id) {
    global $pdo;
    
    // Alunos que pagaram todos os meses necessários para sua classe
    $stmt = $pdo->prepare("
        SELECT a.id, a.nome, a.classe, 
               COUNT(p.id) as meses_pagos,
               SUM(CASE WHEN p.confirmado = TRUE THEN 1 ELSE 0 END) as meses_confirmados
        FROM alunos a
        LEFT JOIN pagamentos p ON a.id = p.aluno_id AND p.ano_letivo_id = ?
        GROUP BY a.id
        HAVING meses_confirmados >= CASE 
            WHEN a.classe IN ('6ª', '9ª', '12ª') THEN 11 
            ELSE 10 
        END OR a.id IS NULL
    ");
    $stmt->execute([$ano_letivo_id]);
    return $stmt->fetchAll();
}

function getAlunosDevedores($ano_letivo_id) {
    global $pdo;
    
    // Alunos que não pagaram todos os meses necessários para sua classe
    $stmt = $pdo->prepare("
        SELECT a.id, a.nome, a.classe, 
               COUNT(p.id) as meses_pagos,
               SUM(CASE WHEN p.confirmado = TRUE THEN 1 ELSE 0 END) as meses_confirmados
        FROM alunos a
        LEFT JOIN pagamentos p ON a.id = p.aluno_id AND p.ano_letivo_id = ?
        GROUP BY a.id
        HAVING meses_confirmados < CASE 
            WHEN a.classe IN ('6ª', '9ª', '12ª') THEN 11 
            ELSE 10 
        END OR COUNT(p.id) = 0
    ");
    $stmt->execute([$ano_letivo_id]);
    return $stmt->fetchAll();
}

function getTotalAlunos() {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM alunos WHERE ativo = TRUE");
    return $stmt->fetch()['total'];
}

function getUltimosPagamentos() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT p.*, a.nome as aluno_nome, m.mes 
        FROM pagamentos p
        JOIN alunos a ON p.aluno_id = a.id
        JOIN meses_letivo m ON p.mes_letivo_id = m.id
        ORDER BY p.data_pagamento DESC
        LIMIT 5
    ");
    return $stmt->fetchAll();
}

function getPropinaClasse($classe) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT valor FROM propinas_classe WHERE classe = ?");
    $stmt->execute([$classe]);
    $result = $stmt->fetch();
    return $result ? $result['valor'] : 10000.00; // Valor padrão se não encontrado
}

function formatarKz($valor) {
    return number_format($valor, 2, ',', '.') . ' KZ';
}

?>