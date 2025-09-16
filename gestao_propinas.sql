-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Maio-2025 às 04:40
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestao_propinas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `classe` varchar(10) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `classe`, `senha`, `ativo`) VALUES
(106, 'Maria Santos', '6ª', '$2y$10$3P4xIfAImEn/kyxJT4oIBOJ1DpFvT6AUTntCuorf4u680T18N1Gbq', 1),
(107, 'Carlos Oliveira', '9ª', '$2y$10$Pen.yCaOORa2Jcre7BjeI.5rzV8bKi5Owk4SWiMd7BiwHtWYlfRNa', 1),
(108, 'Ana Pereira', '12ª', '$2y$10$GJaVKFNKUCkkCmNNpi/OX.aH2h1q4gZFxudNn4yuta.RSmU6hcfIy', 1),
(109, 'Pedro Costa', '8ª', '$2y$10$hDFwjwmZ7psCrWCpUPpw1ez9UYPA4qvIh5UEJBat11.DEuVYt127q', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ano_letivo`
--

CREATE TABLE `ano_letivo` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `ano_letivo`
--

INSERT INTO `ano_letivo` (`id`, `nome`, `inicio`, `fim`) VALUES
(1, '2024/2025', '2024-09-01', '2025-07-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `meses_letivo`
--

CREATE TABLE `meses_letivo` (
  `id` int(11) NOT NULL,
  `ano_letivo_id` int(11) NOT NULL,
  `mes` enum('Setembro','Outubro','Novembro','Dezembro','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho') NOT NULL,
  `ordem` int(11) NOT NULL,
  `exigido_para_exame` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `meses_letivo`
--

INSERT INTO `meses_letivo` (`id`, `ano_letivo_id`, `mes`, `ordem`, `exigido_para_exame`) VALUES
(1, 1, 'Setembro', 1, 0),
(2, 1, 'Outubro', 2, 0),
(3, 1, 'Novembro', 3, 0),
(4, 1, 'Dezembro', 4, 0),
(5, 1, 'Janeiro', 5, 0),
(6, 1, 'Fevereiro', 6, 0),
(7, 1, 'Março', 7, 0),
(8, 1, 'Abril', 8, 0),
(9, 1, 'Maio', 9, 0),
(10, 1, 'Junho', 10, 0),
(11, 1, 'Julho', 11, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `ano_letivo_id` int(11) NOT NULL,
  `mes_letivo_id` int(11) NOT NULL,
  `valor_pago` decimal(10,2) NOT NULL,
  `data_pagamento` datetime DEFAULT current_timestamp(),
  `confirmado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `aluno_id`, `ano_letivo_id`, `mes_letivo_id`, `valor_pago`, `data_pagamento`, `confirmado`) VALUES
(8, 106, 1, 1, 12000.00, '2025-05-01 22:15:03', 1),
(9, 106, 1, 2, 12000.00, '2025-05-01 22:23:56', 1),
(10, 107, 1, 1, 14000.00, '2025-05-01 23:22:35', 1),
(13, 107, 1, 2, 14000.00, '2025-05-01 23:23:38', 1),
(14, 107, 1, 3, 14000.00, '2025-05-01 23:25:32', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `propinas_classe`
--

CREATE TABLE `propinas_classe` (
  `id` int(11) NOT NULL,
  `classe` varchar(10) NOT NULL,
  `valor` decimal(10,2) NOT NULL COMMENT 'Valor em KZ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `propinas_classe`
--

INSERT INTO `propinas_classe` (`id`, `classe`, `valor`) VALUES
(1, 'iniciação', 5000.00),
(2, '1ª', 8000.00),
(3, '2ª', 8000.00),
(4, '3ª', 8000.00),
(5, '4ª', 8500.00),
(6, '5ª', 10000.00),
(7, '6ª', 12000.00),
(8, '7ª', 13000.00),
(9, '8ª', 13500.00),
(10, '9ª', 14000.00),
(11, '10ª', 15000.00),
(12, '11ª', 15500.00),
(13, '12ª', 16000.00),
(14, '13ª', 20000.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `username`, `password`) VALUES
(1, 'Bruno Bozo', 'admin', '$2y$10$SK31IHgLj3HlE1np7YGvtOZOMcWff..J2PwvSAqXZ6RUV8Zc8GmLe');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classe` (`classe`);

--
-- Índices para tabela `ano_letivo`
--
ALTER TABLE `ano_letivo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `meses_letivo`
--
ALTER TABLE `meses_letivo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ano_letivo_id` (`ano_letivo_id`,`mes`);

--
-- Índices para tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aluno_id` (`aluno_id`,`ano_letivo_id`,`mes_letivo_id`),
  ADD KEY `ano_letivo_id` (`ano_letivo_id`),
  ADD KEY `mes_letivo_id` (`mes_letivo_id`);

--
-- Índices para tabela `propinas_classe`
--
ALTER TABLE `propinas_classe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classe` (`classe`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de tabela `ano_letivo`
--
ALTER TABLE `ano_letivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `meses_letivo`
--
ALTER TABLE `meses_letivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `propinas_classe`
--
ALTER TABLE `propinas_classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `meses_letivo`
--
ALTER TABLE `meses_letivo`
  ADD CONSTRAINT `meses_letivo_ibfk_1` FOREIGN KEY (`ano_letivo_id`) REFERENCES `ano_letivo` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagamentos_ibfk_2` FOREIGN KEY (`ano_letivo_id`) REFERENCES `ano_letivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagamentos_ibfk_3` FOREIGN KEY (`mes_letivo_id`) REFERENCES `meses_letivo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
