-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 17-Jun-2022 às 20:20
-- Versão do servidor: 10.5.12-MariaDB
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sisbidi_heroku`
--
CREATE DATABASE IF NOT EXISTS `sisbidi_heroku` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `adm_heroku`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `EDITORA`
--

DROP TABLE IF EXISTS `EDITORA`;
CREATE TABLE `EDITORA` (
  `Cod_editora` int(11) NOT NULL,
  `Nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Endereco` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Telefone` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `EDITORA`
--

INSERT INTO `EDITORA` (`Cod_editora`, `Nome`, `Endereco`, `Telefone`) VALUES
(1, 'Editora 01', 'EndereÃ§o xfg', '1234567894');

-- --------------------------------------------------------

--
-- Estrutura da tabela `LIVRO`
--

DROP TABLE IF EXISTS `LIVRO`;
CREATE TABLE `LIVRO` (
  `Cod_livro` int(11) NOT NULL,
  `Titulo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Nome_autor_l` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Nome_editora_l` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `LIVRO`
--

INSERT INTO `LIVRO` (`Cod_livro`, `Titulo`, `Nome_autor_l`, `Nome_editora_l`) VALUES
(7, 'Titulo a', 'Autor 1', 'Editora 01'),
(8, 'Titulo 2a', 'Autor 2b', 'Editora 01'),
(9, 'Titulo 11', 'Autor 1', 'Editora 01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `LIVRO_AUTOR`
--

DROP TABLE IF EXISTS `LIVRO_AUTOR`;
CREATE TABLE `LIVRO_AUTOR` (
  `Cod_autor` int(11) NOT NULL,
  `Nome_autor` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `LIVRO_AUTOR`
--

INSERT INTO `LIVRO_AUTOR` (`Cod_autor`, `Nome_autor`) VALUES
(1, 'Autor 1'),
(4, 'Autor 2'),
(5, 'Autor 2b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `LIVRO_COPIAS`
--

DROP TABLE IF EXISTS `LIVRO_COPIAS`;
CREATE TABLE `LIVRO_COPIAS` (
  `Cod_livro` int(11) NOT NULL,
  `Cod_unidade` int(11) NOT NULL,
  `Qt_copia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `LIVRO_COPIAS`
--

INSERT INTO `LIVRO_COPIAS` (`Cod_livro`, `Cod_unidade`, `Qt_copia`) VALUES
(7, 1, 50),
(8, 1, 150),
(9, 1, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `LIVRO_EMPRESTIMO`
--

DROP TABLE IF EXISTS `LIVRO_EMPRESTIMO`;
CREATE TABLE `LIVRO_EMPRESTIMO` (
  `Cod_livro` int(11) NOT NULL,
  `Cod_unidade` int(11) NOT NULL,
  `Nr_cartao` int(11) NOT NULL,
  `Data_emprestimo` date NOT NULL,
  `Data_devolucao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `LIVRO_EMPRESTIMO`
--

INSERT INTO `LIVRO_EMPRESTIMO` (`Cod_livro`, `Cod_unidade`, `Nr_cartao`, `Data_emprestimo`, `Data_devolucao`) VALUES
(7, 1, 1, '2022-06-16', '2022-07-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `UNIDADE_BIBLIOTECA`
--

DROP TABLE IF EXISTS `UNIDADE_BIBLIOTECA`;
CREATE TABLE `UNIDADE_BIBLIOTECA` (
  `Cod_unidade` int(11) NOT NULL,
  `Nome_unidade` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Endereco` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `UNIDADE_BIBLIOTECA`
--

INSERT INTO `UNIDADE_BIBLIOTECA` (`Cod_unidade`, `Nome_unidade`, `Endereco`) VALUES
(1, 'Unidade 1', 'EndereÃ§o alterado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `USUARIO`
--

DROP TABLE IF EXISTS `USUARIO`;
CREATE TABLE `USUARIO` (
  `Num_cartao` int(11) NOT NULL,
  `Nome` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Endereco` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Telefone` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `USUARIO`
--

INSERT INTO `USUARIO` (`Num_cartao`, `Nome`, `Endereco`, `Telefone`) VALUES
(1, 'Izann Brum', 'casa do caralho', '6399958745'),
(2, 'JoaoCumelado', '103 Norte', '6399917444');

--
-- Ã�ndices para tabelas despejadas
--

--
-- Ã�ndices para tabela `EDITORA`
--
ALTER TABLE `EDITORA`
  ADD PRIMARY KEY (`Nome`),
  ADD UNIQUE KEY `Cod_editora` (`Cod_editora`),
  ADD UNIQUE KEY `Nome` (`Nome`);

--
-- Ã�ndices para tabela `LIVRO`
--
ALTER TABLE `LIVRO`
  ADD PRIMARY KEY (`Cod_livro`),
  ADD UNIQUE KEY `Cod_livro` (`Cod_livro`),
  ADD UNIQUE KEY `Titulo` (`Titulo`);

--
-- Ã�ndices para tabela `LIVRO_AUTOR`
--
ALTER TABLE `LIVRO_AUTOR`
  ADD PRIMARY KEY (`Nome_autor`),
  ADD UNIQUE KEY `Cod_autor` (`Cod_autor`),
  ADD UNIQUE KEY `Nome_autor` (`Nome_autor`);

--
-- Ã�ndices para tabela `LIVRO_COPIAS`
--
ALTER TABLE `LIVRO_COPIAS`
  ADD PRIMARY KEY (`Cod_livro`,`Cod_unidade`),
  ADD KEY `LIVRO_COPIAS_fk1` (`Cod_unidade`);

--
-- Ã�ndices para tabela `LIVRO_EMPRESTIMO`
--
ALTER TABLE `LIVRO_EMPRESTIMO`
  ADD PRIMARY KEY (`Cod_livro`,`Cod_unidade`,`Nr_cartao`),
  ADD KEY `LIVRO_EMPRESTIMO_fk1` (`Cod_unidade`),
  ADD KEY `LIVRO_EMPRESTIMO_fk2` (`Nr_cartao`);

--
-- Ã�ndices para tabela `UNIDADE_BIBLIOTECA`
--
ALTER TABLE `UNIDADE_BIBLIOTECA`
  ADD PRIMARY KEY (`Nome_unidade`),
  ADD UNIQUE KEY `Cod_unidade` (`Cod_unidade`),
  ADD UNIQUE KEY `Nome_unidade` (`Nome_unidade`);

--
-- Ã�ndices para tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`Nome`),
  ADD UNIQUE KEY `Num_cartao` (`Num_cartao`),
  ADD UNIQUE KEY `Nome` (`Nome`),
  ADD UNIQUE KEY `Telefone` (`Telefone`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `EDITORA`
--
ALTER TABLE `EDITORA`
  MODIFY `Cod_editora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `LIVRO`
--
ALTER TABLE `LIVRO`
  MODIFY `Cod_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `LIVRO_AUTOR`
--
ALTER TABLE `LIVRO_AUTOR`
  MODIFY `Cod_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `UNIDADE_BIBLIOTECA`
--
ALTER TABLE `UNIDADE_BIBLIOTECA`
  MODIFY `Cod_unidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `Num_cartao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- RestriÃ§Ãµes para despejos de tabelas
--

--
-- Limitadores para a tabela `LIVRO_COPIAS`
--
ALTER TABLE `LIVRO_COPIAS`
  ADD CONSTRAINT `LIVRO_COPIAS_fk0` FOREIGN KEY (`Cod_livro`) REFERENCES `LIVRO` (`Cod_livro`),
  ADD CONSTRAINT `LIVRO_COPIAS_fk1` FOREIGN KEY (`Cod_unidade`) REFERENCES `UNIDADE_BIBLIOTECA` (`Cod_unidade`);

--
-- Limitadores para a tabela `LIVRO_EMPRESTIMO`
--
ALTER TABLE `LIVRO_EMPRESTIMO`
  ADD CONSTRAINT `LIVRO_EMPRESTIMO_fk0` FOREIGN KEY (`Cod_livro`) REFERENCES `LIVRO` (`Cod_livro`),
  ADD CONSTRAINT `LIVRO_EMPRESTIMO_fk1` FOREIGN KEY (`Cod_unidade`) REFERENCES `UNIDADE_BIBLIOTECA` (`Cod_unidade`),
  ADD CONSTRAINT `LIVRO_EMPRESTIMO_fk2` FOREIGN KEY (`Nr_cartao`) REFERENCES `USUARIO` (`Num_cartao`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
