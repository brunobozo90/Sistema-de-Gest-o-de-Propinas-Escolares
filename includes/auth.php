<?php
session_start();
require_once 'conexao.php';

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function isAlunoLoggedIn() {
    return isset($_SESSION['aluno_id']);
}

function redirectIfNotAdmin() {
    if (!isAdminLoggedIn()) {
        header("Location: ../login.php");
        exit();
    }
}

function redirectIfNotAluno() {
    if (!isAlunoLoggedIn()) {
        header("Location: ../login.php");
        exit();
    }
}

function loginAdmin($username, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nome'] = $admin['nome'];
        return true;
    }
    return false;
}

function loginAluno($id, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = ? AND ativo = TRUE");
    $stmt->execute([$id]);
    $aluno = $stmt->fetch();
    
    if ($aluno && password_verify($password, $aluno['senha'])) {
        $_SESSION['aluno_id'] = $aluno['id'];
        $_SESSION['aluno_nome'] = $aluno['nome'];
        $_SESSION['aluno_classe'] = $aluno['classe'];
        return true;
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>