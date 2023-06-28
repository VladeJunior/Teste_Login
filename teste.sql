-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Jun-2023 às 03:30
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `manufacturer_base`
--

CREATE TABLE `manufacturer_base` (
  `manufacture_id` int(11) NOT NULL,
  `manufacturer_name` varchar(255) DEFAULT NULL,
  `manufacturer_cnpj` varchar(14) NOT NULL,
  `manufacturer_fantasy_name` varchar(255) DEFAULT NULL,
  `manufacturer_social_name` varchar(255) DEFAULT NULL,
  `manufacturer_active` tinyint(1) DEFAULT NULL,
  `manufacturer_site` varchar(255) DEFAULT NULL,
  `manufacturer_country` varchar(255) DEFAULT NULL,
  `manufacturer_city` varchar(255) DEFAULT NULL,
  `manufacturer_bairro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `manufacturer_base`
--

INSERT INTO `manufacturer_base` (`manufacture_id`, `manufacturer_name`, `manufacturer_cnpj`, `manufacturer_fantasy_name`, `manufacturer_social_name`, `manufacturer_active`, `manufacturer_site`, `manufacturer_country`, `manufacturer_city`, `manufacturer_bairro`) VALUES
(39, 'Vladimir', '32006985000159', 'Vladimir Junior', 'Vladimir Junior LTDA', 1, 'www.google.com.br', 'Brasil', 'Americana', 'Parque das Nações'),
(40, 'Empresa 2', '32006985000116', 'Empresa 2 Teste', 'Empresa 2 Teste LTDA', 1, 'teste.com.br', 'Brasil', 'Americana', 'Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `manufacturer_base`
--
ALTER TABLE `manufacturer_base`
  ADD PRIMARY KEY (`manufacture_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `manufacturer_base`
--
ALTER TABLE `manufacturer_base`
  MODIFY `manufacture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
