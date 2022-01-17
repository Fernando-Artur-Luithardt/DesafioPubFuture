-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Jan-2022 às 00:50
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fernando_pubfuture`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE `conta` (
  `id` int(11) NOT NULL,
  `saldo` double DEFAULT 0,
  `tipoDeConta` int(11) DEFAULT NULL,
  `nomeBanco` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `codConta` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id`, `saldo`, `tipoDeConta`, `nomeBanco`, `userId`, `codConta`) VALUES
(1, -100, 1, 260, 1, 12345),
(2, 100, 1, 260, 1, 123456);

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(11) NOT NULL,
  `valor` double DEFAULT 0,
  `dataPrevista` timestamp NULL DEFAULT NULL,
  `dataEntrada` timestamp NULL DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `contaId` int(11) DEFAULT NULL,
  `codConta` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `tipoDespesa` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id`, `valor`, `dataPrevista`, `dataEntrada`, `descricao`, `contaId`, `codConta`, `ativo`, `tipoDespesa`) VALUES
(1, -90, '0000-00-00 00:00:00', '2022-01-15 03:00:00', 'energia', 1, 12345, 0, 1),
(2, -70, '0000-00-00 00:00:00', '2022-01-15 03:00:00', 'agua', 1, 12345, 0, 1),
(3, -70, '0000-00-00 00:00:00', '2022-01-16 03:00:00', 'alimentação', 1, 12345, 0, 7),
(4, -70, '0000-00-00 00:00:00', '2022-01-17 03:00:00', 'alimentação', 1, 12345, 0, 7),
(5, -70, '0000-00-00 00:00:00', '2022-01-18 03:00:00', 'alimentação', 1, 12345, 0, 7),
(6, -70, '0000-00-00 00:00:00', '2022-01-19 03:00:00', 'alimentação', 1, 12345, 0, 7),
(7, -70, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'alimentação', 1, 12345, 0, 7),
(8, -70, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'alimentação', 1, 12345, 0, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `valor` double DEFAULT 0,
  `dataPrevista` timestamp NULL DEFAULT NULL,
  `dataEntrada` timestamp NULL DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `contaId` int(11) DEFAULT NULL,
  `codConta` int(11) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `tipoReceita` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`id`, `valor`, `dataPrevista`, `dataEntrada`, `descricao`, `contaId`, `codConta`, `ativo`, `tipoReceita`) VALUES
(1, 3000, '0000-00-00 00:00:00', '2022-01-15 03:00:00', 'salário', 1, 12345, 0, 1),
(2, 3000, '0000-00-00 00:00:00', '2022-02-15 03:00:00', 'salário', 1, 12345, 0, 1),
(3, 3000, '0000-00-00 00:00:00', '2022-03-15 03:00:00', 'salário', 1, 12345, 0, 1),
(4, 3000, '0000-00-00 00:00:00', '2022-04-15 03:00:00', 'salário', 1, 12345, 0, 1),
(5, 3000, '0000-00-00 00:00:00', '2022-05-15 03:00:00', 'salário', 1, 12345, 0, 1),
(6, 3000, '0000-00-00 00:00:00', '2022-06-15 03:00:00', 'salário', 1, 12345, 0, 1),
(7, 3000, '0000-00-00 00:00:00', '2022-07-15 03:00:00', 'salário', 1, 12345, 0, 1),
(8, 3000, '0000-00-00 00:00:00', '2022-08-15 03:00:00', 'salário', 1, 12345, 0, 1),
(9, 3000, '0000-00-00 00:00:00', '2022-09-15 03:00:00', 'salário', 1, 12345, 0, 1),
(10, 3000, '0000-00-00 00:00:00', '2022-10-15 03:00:00', 'salário', 1, 12345, 0, 1),
(11, 3000, '0000-00-00 00:00:00', '2022-01-15 03:00:00', 'salário', 1, 12345, 0, 1),
(12, 100, '0000-00-00 00:00:00', '2022-01-15 03:00:00', 'investimento', 1, 12345, 0, 2),
(13, 100, '0000-00-00 00:00:00', '2022-01-16 03:00:00', 'investimento', 1, 12345, 0, 2),
(14, 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'investimento', 1, 12345, 0, 2),
(15, 100, '0000-00-00 00:00:00', '2022-01-17 03:00:00', 'investimento', 1, 12345, 0, 2),
(16, 100, '0000-00-00 00:00:00', '2022-01-18 03:00:00', 'investimento', 1, 12345, 0, 2),
(17, 100, '0000-00-00 00:00:00', '2022-01-19 03:00:00', 'investimento', 1, 12345, 0, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(120) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `senha`) VALUES
(1, 'PUBFUTURE', '84ccff2b41e60e6da96ce9814c90264d');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contaId` (`contaId`);

--
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contaId` (`contaId`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conta`
--
ALTER TABLE `conta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
