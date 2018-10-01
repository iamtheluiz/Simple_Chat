-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 01-Out-2018 às 22:54
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `db_chat`
--
CREATE DATABASE IF NOT EXISTS `db_chat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `db_chat`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_chat`
--

CREATE TABLE IF NOT EXISTS `tb_chat` (
  `cd_chat` int(11) NOT NULL AUTO_INCREMENT,
  `tx_chat` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `dt_chat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_login` int(11) NOT NULL,
  PRIMARY KEY (`cd_chat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_chat_privado`
--

CREATE TABLE IF NOT EXISTS `tb_chat_privado` (
  `cd_chat_privado` int(11) NOT NULL AUTO_INCREMENT,
  `id_privado` int(11) NOT NULL,
  `tx_msg` varchar(1000) COLLATE utf8mb4_bin NOT NULL,
  `dt_chat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_login` int(11) NOT NULL,
  PRIMARY KEY (`cd_chat_privado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_login`
--

CREATE TABLE IF NOT EXISTS `tb_login` (
  `cd_login` int(11) NOT NULL AUTO_INCREMENT,
  `tx_login` varchar(80) NOT NULL,
  `tx_pass` varchar(260) NOT NULL,
  PRIMARY KEY (`cd_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_privado`
--

CREATE TABLE IF NOT EXISTS `tb_privado` (
  `cd_privado` int(11) NOT NULL AUTO_INCREMENT,
  `id_login1` int(11) NOT NULL,
  `id_login2` int(11) NOT NULL,
  PRIMARY KEY (`cd_privado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
