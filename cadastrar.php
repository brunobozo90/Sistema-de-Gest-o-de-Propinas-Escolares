<?php
require_once 'includes/auth.php';
require_once 'includes/conexao.php';
require_once 'includes/functions.php';

$mensagem = '';
$tipo_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    
    try {
        if ($tipo === 'admin') {
            // Cadastrar administrador
            $nome = $_POST['nome'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($nome) || empty($username) || empty($password)) {
                throw new Exception("Todos os campos são obrigatórios!");
            }
            
            $senha_hash = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO users (nome, username, password) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $username, $senha_hash]);
            
            $mensagem = "Administrador cadastrado com sucesso!";
            $tipo_mensagem = "success";
            
        } elseif ($tipo === 'aluno') {
            // Cadastrar aluno
            $nome = $_POST['nome'] ?? '';
            $classe = $_POST['classe'] ?? '';
            $senha = $_POST['senha'] ?? '';
            
            if (empty($nome) || empty($classe)) {
                throw new Exception("Nome e classe são obrigatórios!");
            }
            
            // Se a senha não foi informada, usa o ID que será gerado
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO alunos (nome, classe, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $classe, $senha_hash]);
            
            $id_aluno = $pdo->lastInsertId();
            
            if (empty($senha)) {
                // Atualiza com a senha padrão (id do aluno) se não foi informada
                $senha_hash = password_hash($id_aluno, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE alunos SET senha = ? WHERE id = ?");
                $stmt->execute([$senha_hash, $id_aluno]);
            }
            
            $mensagem = "Aluno cadastrado com sucesso! Nº Processo: $id_aluno" . (empty($senha) ? " (Senha padrão: $id_aluno)" : "");
            $tipo_mensagem = "success";
        }
    } catch (PDOException $e) {
        $mensagem = "Erro ao cadastrar: " . $e->getMessage();
        $tipo_mensagem = "danger";
    } catch (Exception $e) {
        $mensagem = $e->getMessage();
        $tipo_mensagem = "danger";
    }
}

include 'includes/header.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">Cadastrar Usuários</h1>
    
    <?php if ($mensagem): ?>
        <div class="alert alert-<?php echo $tipo_mensagem; ?>">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>
    
    <ul class="nav nav-tabs mb-4" id="cadastroTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button">
                Administrador
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="aluno-tab" data-bs-toggle="tab" data-bs-target="#aluno" type="button">
                Aluno
            </button>
        </li>
    </ul>
    
    <div class="tab-content" id="cadastroTabContent">
        <div class="tab-pane fade show active" id="admin" role="tabpanel">
            <form method="POST">
                <input type="hidden" name="tipo" value="admin">
                
                <div class="mb-3">
                    <label for="nome_admin" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome_admin" name="nome" required>
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Cadastrar Administrador</button>
            </form>
        </div>
        
        <div class="tab-pane fade" id="aluno" role="tabpanel">
            <form method="POST">
                <input type="hidden" name="tipo" value="aluno">
                
                <div class="mb-3">
                    <label for="nome_aluno" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome_aluno" name="nome" required>
                </div>
                
                <div class="mb-3">
                    <label for="classe" class="form-label">Classe</label>
                    <select class="form-select" id="classe" name="classe" required>
                        <option value="">Selecione...</option>
                        <option value="0ª">0ª Classe</option>
                        <option value="1ª">1ª Classe</option>
                        <option value="2ª">2ª Classe</option>
                        <option value="3ª">3ª Classe</option>
                        <option value="4ª">4ª Classe</option>
                        <option value="5ª">5ª Classe</option>
                        <option value="6ª">6ª Classe</option>
                        <option value="7ª">7ª Classe</option>
                        <option value="8ª">8ª Classe</option>
                        <option value="9ª">9ª Classe</option>
                        <option value="10ª">10ª Classe</option>
                        <option value="11ª">11ª Classe</option>
                        <option value="12ª">12ª Classe</option>
                        <option value="13ª">13ª Classe</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="senha_aluno" class="form-label">Senha (deixe em branco para usar nº processo como senha)</label>
                    <input type="password" class="form-control" id="senha_aluno" name="senha">
                    <small class="text-muted">Se não informar, a senha será igual ao número de processo do aluno.</small>
                </div>
                
                <button type="submit" class="btn btn-primary">Cadastrar Aluno</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>