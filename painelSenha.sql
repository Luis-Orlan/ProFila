-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jul-2022 às 05:27
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_painelsenha`
--
CREATE DATABASE IF NOT EXISTS `db_painelsenha` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_painelsenha`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_atendimentosenha`
--

CREATE TABLE `tb_atendimentosenha` (
  `as_ID` int(11) NOT NULL,
  `as_NumeroMesa` int(11) NOT NULL,
  `as_Setor` varchar(30) NOT NULL,
  `as_NivelPrioridade` int(11) NOT NULL,
  `as_SenhaPainel` varchar(5) NOT NULL,
  `as_TempoMesa` int(11) NOT NULL,
  `as_DataHora` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `as_IP_Local_Senha_Gerada` varchar(15) DEFAULT NULL,
  `as_IP_Local_Senha_Atendida` varchar(15) DEFAULT NULL,
  `as_StatusAloca` int(11) NOT NULL,
  `as_Chamadas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_atendimentosenha`
--

INSERT INTO `tb_atendimentosenha` (`as_ID`, `as_NumeroMesa`, `as_Setor`, `as_NivelPrioridade`, `as_SenhaPainel`, `as_TempoMesa`, `as_DataHora`, `as_IP_Local_Senha_Gerada`, `as_IP_Local_Senha_Atendida`, `as_StatusAloca`, `as_Chamadas`) VALUES
(1, 9, 'Geral', 1, 'A9758', 0, '2022-07-26 22:45:42', '::1', '::1', 4, 1),
(2, 3, 'Geral', 1, 'A7364', 0, '2022-07-26 22:49:39', '::1', '::1', 4, 1),
(3, 3, 'Geral', 1, 'A4397', 0, '2022-07-26 22:59:40', '::1', '0', 4, 2),
(16, 0, 'Geral', 1, 'A5274', 0, '2022-07-27 00:24:11', '::1', '::1', 3, 0),
(18, 2, 'Geral', 2, 'A9267', 0, '2022-07-27 00:23:30', '127.0.0.1', '::1', 3, 3),
(19, 2, 'Geral', 2, 'A5897', 0, '2022-07-27 00:24:09', '127.0.0.1', '::1', 3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_mesaatendimento`
--

CREATE TABLE `tb_mesaatendimento` (
  `ma_ID` int(11) NOT NULL,
  `ma_SenhaAlocada` varchar(5) NOT NULL,
  `ma_Mesa` int(11) NOT NULL,
  `ma_Setor` varchar(30) NOT NULL,
  `ma_TempoMesa` int(11) NOT NULL,
  `ma_DataHora` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ma_IP_Local_OpenMesa` varchar(15) NOT NULL,
  `ma_IP_Local_CloseMesa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_mesaatendimento`
--

INSERT INTO `tb_mesaatendimento` (`ma_ID`, `ma_SenhaAlocada`, `ma_Mesa`, `ma_Setor`, `ma_TempoMesa`, `ma_DataHora`, `ma_IP_Local_OpenMesa`, `ma_IP_Local_CloseMesa`) VALUES
(1, '0', 1, 'Geral', 0, '2022-07-27 00:22:29', '127.0.0.1', '::1'),
(2, '1', 2, 'Geral', 0, '2022-07-27 00:24:11', '::1', '::1'),
(3, '0', 3, 'Geral', 0, '2022-07-26 23:54:10', '127.0.0.1', '::1'),
(4, '0', 4, 'Geral', 0, '2022-07-27 00:16:11', '127.0.0.1', '::1'),
(5, '0', 5, 'Geral', 0, '2022-07-20 16:49:04', '127.0.0.1', '127.0.0.1'),
(6, '0', 6, 'Geral', 0, '2022-07-26 12:55:52', '127.0.0.1', '127.0.0.1'),
(7, '0', 7, 'Geral', 0, '2022-07-25 15:28:51', '::1', '::1'),
(8, '0', 8, 'Geral', 0, '2022-07-20 10:30:17', '127.0.0.1', '127.0.0.1'),
(9, '0', 9, 'Geral', 0, '2022-07-26 22:48:49', '::1', '::1'),
(10, '0', 10, 'Geral', 0, '2022-07-20 16:54:40', '127.0.0.1', '127.0.0.1'),
(11, '0', 1, 'PAT', 0, '2022-07-18 00:43:09', '192.168.15.4', '192.168.15.4'),
(12, '0', 2, 'PAT', 0, '2022-07-17 23:15:02', '127.0.0.1', '127.0.0.1'),
(13, '0', 3, 'PAT', 0, '2022-07-26 12:54:40', '::1', '::1'),
(14, '0', 4, 'PAT', 0, '2022-07-17 23:15:02', '127.0.0.1', '127.0.0.1'),
(15, '0', 5, 'PAT', 0, '2022-07-17 23:15:02', '127.0.0.1', '127.0.0.1'),
(16, '0', 6, 'PAT', 0, '2022-07-20 10:29:38', '127.0.0.1', '127.0.0.1'),
(17, '0', 7, 'PAT', 0, '2022-07-17 23:15:02', '127.0.0.1', '127.0.0.1'),
(18, '0', 8, 'PAT', 0, '2022-07-17 23:15:02', '127.0.0.1', '127.0.0.1'),
(19, '0', 9, 'PAT', 0, '2022-07-20 16:38:11', '127.0.0.1', '127.0.0.1'),
(20, '0', 10, 'PAT', 0, '2022-07-20 16:36:57', '127.0.0.1', '127.0.0.1'),
(21, '0', 1, 'Bolsa do Povo', 0, '2022-07-20 16:15:19', '127.0.0.1', '127.0.0.1'),
(22, '0', 2, 'Bolsa do Povo', 0, '2022-07-20 10:14:46', '::1', '::1'),
(23, '0', 3, 'Bolsa do Povo', 0, '2022-07-20 09:52:54', '::1', '::1'),
(24, '0', 4, 'Bolsa do Povo', 0, '2022-07-20 02:10:36', '::1', '::1'),
(25, '0', 5, 'Bolsa do Povo', 0, '2022-07-19 16:16:44', '127.0.0.1', '127.0.0.1'),
(26, '0', 6, 'Bolsa do Povo', 0, '2022-07-17 23:18:14', '127.0.0.1', '127.0.0.1'),
(27, '0', 7, 'Bolsa do Povo', 0, '2022-07-17 23:18:14', '127.0.0.1', '127.0.0.1'),
(28, '0', 8, 'Bolsa do Povo', 0, '2022-07-17 23:18:14', '127.0.0.1', '127.0.0.1'),
(29, '0', 9, 'Bolsa do Povo', 0, '2022-07-17 23:18:14', '127.0.0.1', '127.0.0.1'),
(30, '0', 10, 'Bolsa do Povo', 0, '2022-07-20 16:27:40', '127.0.0.1', '127.0.0.1'),
(31, '0', 1, 'Desenvolvimento Social', 0, '2022-07-20 10:38:52', '127.0.0.1', '127.0.0.1'),
(32, '0', 1, 'Saude', 0, '2022-07-20 15:52:26', '127.0.0.1', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL,
  `USER_Nome` varchar(80) NOT NULL,
  `USER_Email` varchar(60) NOT NULL,
  `USER_Login` varchar(20) NOT NULL,
  `USER_Senha` varchar(40) NOT NULL,
  `USER_ImagemPerfil` varchar(100) NOT NULL,
  `USER_NivelAcesso` int(11) NOT NULL,
  `USER_Status` int(11) NOT NULL,
  `USER_IP` varchar(200) NOT NULL,
  `USER_DataHora` datetime NOT NULL DEFAULT current_timestamp(),
  `USER_NavegadorSistema` varchar(200) NOT NULL,
  `USER_ID_Loja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`USER_ID`, `USER_Nome`, `USER_Email`, `USER_Login`, `USER_Senha`, `USER_ImagemPerfil`, `USER_NivelAcesso`, `USER_Status`, `USER_IP`, `USER_DataHora`, `USER_NavegadorSistema`, `USER_ID_Loja`) VALUES
(8, 'PRODESP', 'PRODESP', '4', 'e31eec9f955bdb67f3512444dea3bb99ee2fbaf8', 'imagemDefault.png', 2, 1, '::1', '2021-10-20 23:48:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 11),
(10, 'Orlan Rocha', 'orlan.rocha', '4', '4082d6e1974adbe546afab423af09ed2c06de9c5', 'imagemDefault.png', 2, 1, '127.0.0.1', '2021-11-06 21:19:40', 'Mozila FireFox', 11);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_atendimentosenha`
--
ALTER TABLE `tb_atendimentosenha`
  ADD PRIMARY KEY (`as_ID`);

--
-- Índices para tabela `tb_mesaatendimento`
--
ALTER TABLE `tb_mesaatendimento`
  ADD PRIMARY KEY (`ma_ID`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_atendimentosenha`
--
ALTER TABLE `tb_atendimentosenha`
  MODIFY `as_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_mesaatendimento`
--
ALTER TABLE `tb_mesaatendimento`
  MODIFY `ma_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
