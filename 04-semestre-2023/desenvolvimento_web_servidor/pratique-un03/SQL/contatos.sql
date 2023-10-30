-- phpMyAdmin SQL Dump
-- https://www.phpmyadmin.net/
-- Versão do PHP: 8.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lista_contatos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `sobrenome`, `email`, `id_usuario`) VALUES
(18, 'Amanda', 'Nogueira', 'contato@example.com', 3),
(37, 'Joao', 'Fernandes da Silva', 'contato@example.com', 5),
(52, 'teste', 'Lorem xyz', 'contato@example.com', 1),
(61, 'Teste5', 'Teste5', 'contato@example.com', 4),
(71, 'shereck', 'fiona', 'contato@example.com', 6),
(113, 'testexyz', 'xyz', 'contato@example.com', 1),
(115, 'Tristonho', 'da Silva', 'contato@example.com', 1),
(116, 'ciclano', 'jose', 'contato@example.com', 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_contatos_usuarios` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `contatos`
--
ALTER TABLE `contatos`
  ADD CONSTRAINT `fk_contatos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
