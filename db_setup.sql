-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS gestao_propinas;
USE gestao_propinas;

-- Tabela de usuários admin
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabela de alunos
CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    classe VARCHAR(10) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    ativo BOOLEAN DEFAULT TRUE,
    INDEX (classe)
) AUTO_INCREMENT=100;

-- Tabela de ano letivo
CREATE TABLE ano_letivo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(20) NOT NULL,
    inicio DATE NOT NULL,
    fim DATE NOT NULL
);

-- Tabela de meses letivos
CREATE TABLE meses_letivo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ano_letivo_id INT NOT NULL,
    mes ENUM('Setembro', 'Outubro', 'Novembro', 'Dezembro', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho') NOT NULL,
    ordem INT NOT NULL,
    exigido_para_exame BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (ano_letivo_id) REFERENCES ano_letivo(id) ON DELETE CASCADE,
    UNIQUE KEY (ano_letivo_id, mes)
);

-- Tabela de pagamentos
CREATE TABLE pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    ano_letivo_id INT NOT NULL,
    mes_letivo_id INT NOT NULL,
    valor_pago DECIMAL(10,2) NOT NULL,
    data_pagamento DATETIME DEFAULT CURRENT_TIMESTAMP,
    confirmado BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE,
    FOREIGN KEY (ano_letivo_id) REFERENCES ano_letivo(id) ON DELETE CASCADE,
    FOREIGN KEY (mes_letivo_id) REFERENCES meses_letivo(id) ON DELETE CASCADE,
    UNIQUE KEY (aluno_id, ano_letivo_id, mes_letivo_id)
);

-- Inserir dados de exemplo
-- Admin
INSERT INTO users (nome, username, password) VALUES 
('Administrador', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- password = "2020"

-- Ano letivo
INSERT INTO ano_letivo (nome, inicio, fim) VALUES 
('2024/2025', '2024-09-01', '2025-07-31');

-- Meses letivos para 2024/2025
INSERT INTO meses_letivo (ano_letivo_id, mes, ordem, exigido_para_exame) VALUES 
(1, 'Setembro', 1, FALSE),
(1, 'Outubro', 2, FALSE),
(1, 'Novembro', 3, FALSE),
(1, 'Dezembro', 4, FALSE),
(1, 'Janeiro', 5, FALSE),
(1, 'Fevereiro', 6, FALSE),
(1, 'Março', 7, FALSE),
(1, 'Abril', 8, FALSE),
(1, 'Maio', 9, FALSE),
(1, 'Junho', 10, FALSE),
(1, 'Julho', 11, TRUE);

-- Alunos de exemplo
INSERT INTO alunos (nome, classe, senha) VALUES 
('João Silva', '5ª', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- password = "100"
('Maria Santos', '6ª', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- password = "101"
('Carlos Oliveira', '9ª', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- password = "102"
('Ana Pereira', '12ª', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- password = "103"
('Pedro Costa', '8ª', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- password = "104"

-- Pagamentos de exemplo
INSERT INTO pagamentos (aluno_id, ano_letivo_id, mes_letivo_id, valor_pago, confirmado) VALUES 
(100, 1, 1, 50.00, TRUE),
(100, 1, 2, 50.00, TRUE),
(101, 1, 1, 50.00, TRUE),
(101, 1, 2, 50.00, TRUE),
(101, 1, 3, 50.00, TRUE),
(102, 1, 1, 50.00, TRUE),
(103, 1, 1, 50.00, FALSE);