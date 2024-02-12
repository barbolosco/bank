-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 05, 2024 alle 09:32
-- Versione del server: 8.0.30
-- Versione PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_ccgroup3`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `TCategorieMovimenti`
--

CREATE TABLE `TCategorieMovimenti` (
  `CategoriaMovimentoID` int NOT NULL,
  `NomeCategoria` text NOT NULL,
  `Tipologia` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `TCategorieMovimenti`
--

INSERT INTO `TCategorieMovimenti` (`CategoriaMovimentoID`, `NomeCategoria`, `Tipologia`) VALUES
(1, 'Opening a current account', 'Income'),
(2, 'Incoming Bank Transfer', 'Income'),
(3, 'Outgoing Bank Transfer', 'Expenditure'),
(4, 'Cash Withdrawal', 'Expenditure'),
(5, 'Bill Payment', 'Expenditure'),
(6, 'Recharge', 'Expenditure'),
(7, 'ATM Deposit', 'Income'),
(8, 'Payments', 'Expenditure'),
(9, 'Emolument Credit', 'Income'),
(10, 'Loans', 'Expenditure'),
(11, 'Mortgages', 'Expenditure');

-- --------------------------------------------------------

--
-- Struttura della tabella `TConticorrenti`
--

CREATE TABLE `TConticorrenti` (
  `ContoCorrenteID` int NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `CognomeTitolare` text NOT NULL,
  `NomeTitolare` text NOT NULL,
  `NumeroTelefono` text,
  `DataApertura` text NOT NULL,
  `IBAN` char(27) DEFAULT NULL,
  `RegistrazioneConfermata` bit(1) DEFAULT b'0',
  `Token` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `TConticorrenti`
--

INSERT INTO `TConticorrenti` (`ContoCorrenteID`, `Email`, `Password`, `CognomeTitolare`, `NomeTitolare`, `NumeroTelefono`, `DataApertura`, `IBAN`, `RegistrazioneConfermata`, `Token`) VALUES
(1, 'example@email.com', 'cctcgl2tCQJ0.', 'Does', 'Johns', '123456789', '2023-05-26', 'IT1234567890121346802457249', b'1', 'token123'),
(2, 'example10@email.com', 'ccgja.tF8Bbgs', 'Federico', 'Rossi', '136792468', '2023-05-26', 'IT1236567890144496014412023', b'1', '3c79e1b2'),
(3, 'example12@email.com', 'password1234RA', 'Mattia', 'Pasquino', '136992468', '2023-05-26', 'IT1238567890321350194231434', b'0', NULL),
(32, 'messinadenaro41222@gmail.com', 'ccQcJBhrmLfrU', 'alzari', 'muhammed', '', '2023-06-05', NULL, b'0', 'UDlFQbGhtS'),
(9, 'genol.libera66@gmail.com', 'ccw.BJKHiMQn2', 'Libero', 'Genoveffa', '1229222378', '2023-06-04', NULL, b'0', '6ItBNSumZk'),
(5, 'fobewe3964@vaband.com', 'ccvU/YgxmzK2.', 'Rossi', 'Marco', '1249102999', '2023-06-04', NULL, b'0', 'edzZFwooum'),
(6, 'fobewe3954@vaband.com', 'ccvU/YgxmzK2.', 'Verdi', 'Nick', '1233102378', '2023-06-04', NULL, b'0', 'sR1ElsAqnW'),
(16, 'mirkocampa17@gmail.com', 'ccRudwPqajVA.', 'Campagnaro', 'Mirko', '', '2023-06-05', NULL, b'1', 'meWcIU97mL'),
(35, 'nicotumma03@gmail.com', 'ccxfeqn3mGBdU', 'Tommasin', 'Nicolò', '3931105612', '2023-06-06', 'IT51PZXVB368802313238', b'1', 'NZqd1zdhUN');

-- --------------------------------------------------------

--
-- Struttura della tabella `TIndirizziIp`
--

CREATE TABLE `TIndirizziIp` (
  `IDIp` int NOT NULL,
  `IndirizzoIp` varchar(15) DEFAULT NULL,
  `DataOraAccesso` datetime DEFAULT NULL,
  `IsBlackListed` tinyint(1) DEFAULT NULL,
  `ContoCorrenteID` int DEFAULT NULL,
  `GuaranteedAccess` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `TIndirizziIp`
--

INSERT INTO `TIndirizziIp` (`IDIp`, `IndirizzoIp`, `DataOraAccesso`, `IsBlackListed`, `ContoCorrenteID`, `GuaranteedAccess`) VALUES
(1, '192.168.0.1', '2023-05-26 10:00:00', 0, 1, 1),
(2, '192.168.0.5', '2023-05-29 16:30:00', 0, 1, 1),
(3, '192.168.0.6', '2023-05-30 11:15:00', 1, 3, 0),
(4, '192.168.0.8', '2023-06-01 14:00:00', 0, 1, 1),
(5, '192.168.0.9', '2023-06-02 17:20:00', 1, 1, 0),
(6, '192.168.0.10', '2023-06-03 10:10:00', 0, 1, 1),
(7, '192.168.0.11', '2023-06-04 09:30:00', 1, 1, 0),
(8, '192.168.0.12', '2023-06-05 15:40:00', 0, 1, 0),
(9, '192.168.0.13', '2023-06-06 12:00:00', 0, 1, 0),
(10, '192.168.0.14', '2023-06-07 13:50:00', 1, 1, 0),
(11, '192.168.0.15', '2023-06-08 16:15:00', 0, 1, 1),
(12, '192.168.0.16', '2023-06-09 11:25:00', 1, 1, 0),
(13, '192.168.0.17', '2023-06-10 10:35:00', 0, 3, 1),
(14, '192.168.0.1', '2023-06-10 10:35:00', 0, 1, 0),
(15, '192.168.0.1', '2023-06-10 10:35:10', 0, 1, 0),
(16, '192.168.0.100', '2023-06-10 10:35:00', 0, 1, 0),
(17, '192.168.0.100', '2023-06-10 10:35:30', 0, 1, 0),
(18, '192.168.0.100', '2023-06-10 10:35:40', 0, 1, 0),
(19, '192.168.0.150', '2023-06-10 10:35:00', 0, 1, 0),
(20, '192.168.0.150', '2023-06-10 10:35:10', 0, 1, 0),
(21, '192.168.0.150', '2023-06-10 10:35:20', 0, 1, 0),
(22, '192.168.0.150', '2023-06-10 10:35:50', 1, 1, 0),
(23, '151.44.52.43', '2023-05-31 17:18:11', 0, 1, 1),
(24, '151.44.52.43', '2023-05-31 17:23:29', 0, 3, 1),
(25, '151.44.52.43', '2023-05-31 17:24:04', 0, 1, 0),
(26, '151.44.52.43', '2023-05-31 17:28:51', 0, 1, 0),
(27, '151.44.52.43', '2023-05-31 17:29:06', 0, 1, 1),
(28, '89.97.206.30', '2023-06-01 10:37:52', 0, 1, 1),
(29, '89.39.107.197', '2023-06-01 12:45:20', 0, 1, 0),
(30, '89.39.107.197', '2023-06-01 12:45:36', 0, 3, 0),
(31, '89.39.107.197', '2023-06-01 12:45:51', 0, 1, 1),
(32, '89.39.107.197', '2023-06-01 12:50:51', 0, 1, 1),
(33, '89.97.206.30', '2023-06-01 12:55:45', 0, 1, 1),
(34, '89.39.107.197', '2023-06-01 12:58:46', 0, 1, 1),
(35, '89.39.107.197', '2023-06-01 15:20:37', 0, 1, 1),
(36, '89.39.107.197', '2023-06-01 15:20:59', 0, 1, 1),
(37, '89.39.107.197', '2023-06-01 15:27:44', 0, 1, 0),
(38, '89.39.107.197', '2023-06-01 15:27:51', 0, 1, 0),
(39, '89.39.107.197', '2023-06-01 15:27:57', 0, 1, 0),
(40, '89.39.107.197', '2023-06-01 15:28:05', 0, 1, 0),
(41, '89.39.107.197', '2023-06-01 15:28:19', 0, 1, 0),
(42, '89.39.107.197', '2023-06-01 15:28:52', 0, 1, 0),
(43, '89.39.107.197', '2023-06-01 15:29:23', 0, 1, 0),
(44, '89.39.107.197', '2023-06-01 15:30:18', 0, 1, 0),
(45, '89.39.107.197', '2023-06-01 15:30:49', 0, 1, 0),
(46, '89.39.107.197', '2023-06-01 15:31:21', 0, 1, 0),
(47, '89.39.107.197', '2023-06-01 15:31:52', 0, 1, 0),
(48, '89.39.107.197', '2023-06-01 15:32:23', 0, 1, 0),
(49, '89.39.107.197', '2023-06-01 15:32:54', 0, 1, 0),
(50, '89.39.107.197', '2023-06-01 15:33:25', 0, 1, 0),
(51, '89.39.107.197', '2023-06-01 15:34:26', 0, 1, 0),
(52, '151.36.80.114', '2023-06-01 17:16:33', 0, 1, 0),
(53, '151.36.80.114', '2023-06-01 17:16:38', 0, 1, 0),
(54, '151.36.80.114', '2023-06-01 17:16:49', 0, 1, 0),
(55, '151.36.80.114', '2023-06-01 17:17:22', 0, 1, 0),
(56, '151.36.80.114', '2023-06-01 17:17:53', 0, 1, 0),
(57, '151.36.80.114', '2023-06-01 17:18:24', 0, 1, 0),
(58, '151.36.80.114', '2023-06-01 17:18:55', 0, 1, 0),
(59, '151.36.80.114', '2023-06-01 17:19:26', 0, 1, 0),
(60, '151.36.80.114', '2023-06-01 17:19:56', 0, 1, 0),
(61, '151.36.80.114', '2023-06-01 17:20:31', 0, 1, 0),
(62, '151.36.80.114', '2023-06-01 17:21:02', 0, 1, 0),
(63, '151.36.80.114', '2023-06-01 17:21:33', 0, 1, 0),
(64, '151.36.80.114', '2023-06-01 17:25:48', 0, 1, 0),
(65, '151.36.80.114', '2023-06-01 17:25:57', 0, 1, 0),
(66, '151.36.80.114', '2023-06-01 17:26:05', 0, 1, 0),
(67, '80.70.116.160', '2023-06-02 10:30:23', 0, 1, 0),
(68, '80.70.116.160', '2023-06-02 10:30:32', 0, 1, 0),
(69, '80.70.116.160', '2023-06-02 10:34:16', 0, 1, 0),
(70, '80.70.116.160', '2023-06-02 10:34:30', 0, 1, 0),
(71, '80.70.116.160', '2023-06-02 10:34:37', 0, 1, 0),
(72, '80.70.116.160', '2023-06-02 10:34:44', 0, 1, 0),
(73, '80.70.116.160', '2023-06-02 10:34:52', 0, 1, 0),
(74, '80.70.116.160', '2023-06-02 10:35:23', 0, 1, 0),
(75, '89.39.107.195', '2023-06-02 10:36:40', 0, 1, 0),
(76, '89.39.107.195', '2023-06-02 10:51:32', 0, 1, 0),
(77, '89.39.107.195', '2023-06-02 10:51:42', 0, 1, 0),
(78, '89.39.107.195', '2023-06-02 10:51:52', 1, 1, 0),
(79, '143.244.44.167', '2023-06-02 10:56:50', 0, 1, 0),
(80, '143.244.44.167', '2023-06-02 10:56:56', 0, 1, 0),
(81, '143.244.44.167', '2023-06-02 10:57:11', 0, 1, 1),
(82, '143.244.44.167', '2023-06-02 10:57:21', 1, 1, 0),
(83, '185.107.56.154', '2023-06-02 11:23:53', 0, 1, 0),
(84, '185.107.56.154', '2023-06-02 11:24:03', 0, 1, 0),
(85, '185.107.56.154', '2023-06-02 11:24:15', 0, 1, 1),
(86, '185.107.56.154', '2023-06-02 12:02:58', 1, 1, 0),
(87, '185.107.56.166', '2023-06-02 12:03:44', 0, 1, 0),
(88, '185.107.56.166', '2023-06-02 12:03:55', 0, 1, 1),
(89, '169.150.196.134', '2023-06-02 12:09:58', 0, 1, 0),
(90, '169.150.196.134', '2023-06-02 12:10:04', 0, 1, 0),
(91, '169.150.196.134', '2023-06-02 12:10:08', 0, 1, 0),
(92, '169.150.196.134', '2023-06-02 12:10:15', 1, 1, 0),
(93, '146.70.202.37', '2023-06-02 12:25:34', 0, 1, 0),
(94, '146.70.202.37', '2023-06-02 12:25:42', 0, 1, 0),
(95, '146.70.202.37', '2023-06-02 12:25:49', 0, 1, 1),
(180, '212.8.253.156', '2023-06-04 13:59:46', 0, 1, 1),
(103, '212.8.253.163', '2023-06-02 20:26:50', 0, 1, 1),
(102, '212.8.253.163', '2023-06-02 20:26:32', 0, 1, 0),
(101, '146.70.202.37', '2023-06-02 20:25:30', 1, 1, 0),
(179, '212.8.253.156', '2023-06-04 13:56:18', 0, 1, 1),
(178, '212.8.253.156', '2023-06-04 13:47:51', 0, 1, 1),
(177, '212.8.253.163', '2023-06-04 13:17:22', 0, 1, 1),
(176, '212.8.253.163', '2023-06-04 13:15:36', 0, 1, 1),
(181, '212.8.253.156', '2023-06-04 14:39:57', 0, 1, 1),
(182, '212.8.253.156', '2023-06-04 14:52:17', 0, 1, 1),
(183, '212.8.253.156', '2023-06-04 14:59:12', 0, 1, 1),
(184, '212.8.253.156', '2023-06-04 16:02:59', 0, 1, 1),
(185, '212.8.253.156', '2023-06-04 16:03:24', 0, 1, 1),
(186, '212.8.253.156', '2023-06-04 16:06:25', 0, 1, 1),
(189, '212.8.253.156', '2023-06-04 17:15:32', 0, 3, 1),
(188, '37.162.84.190', '2023-06-04 16:56:20', 0, 3, 1),
(190, '212.8.253.156', '2023-06-04 17:18:48', 0, 1, 1),
(191, '212.8.253.156', '2023-06-04 17:21:01', 0, 3, 1),
(192, '212.8.253.156', '2023-06-04 17:26:09', 0, 1, 1),
(193, '212.8.253.156', '2023-06-04 17:38:03', 0, 1, 1),
(194, '185.178.12.206', '2023-06-04 17:56:16', 0, 1, 1),
(195, '185.178.12.206', '2023-06-04 17:58:37', 0, 1, 1),
(196, '185.178.12.206', '2023-06-04 18:02:18', 0, 1, 1),
(197, '185.178.12.206', '2023-06-04 18:09:11', 0, 1, 1),
(198, '185.178.12.206', '2023-06-04 19:17:02', 0, 1, 1),
(199, '185.178.12.206', '2023-06-04 19:21:17', 0, 1, 1),
(200, '185.178.12.206', '2023-06-04 19:27:07', 0, 1, 1),
(201, '185.178.12.206', '2023-06-04 19:29:11', 0, 1, 1),
(202, '185.178.12.206', '2023-06-04 19:52:08', 0, 1, 1),
(203, '185.178.12.206', '2023-06-04 19:53:47', 0, 1, 1),
(204, '80.70.118.145', '2023-06-04 20:41:41', 0, 1, 0),
(205, '80.70.118.145', '2023-06-04 20:44:40', 0, 1, 1),
(206, '149.34.244.176', '2023-06-04 21:02:04', 0, 1, 1),
(207, '80.70.118.145', '2023-06-04 23:38:31', 0, 1, 0),
(208, '80.70.118.145', '2023-06-04 23:38:42', 1, 1, 0),
(209, '149.34.244.176', '2023-06-04 23:44:17', 0, 1, 1),
(210, '149.34.244.176', '2023-06-04 23:52:18', 0, 1, 1),
(211, '37.162.84.190', '2023-06-05 00:31:36', 0, 14, 0),
(212, '89.39.107.196', '2023-06-05 08:47:38', 0, 1, 0),
(213, '89.39.107.196', '2023-06-05 08:47:52', 0, 1, 1),
(214, '89.39.107.196', '2023-06-05 08:50:10', 0, 1, 1),
(215, '89.39.107.196', '2023-06-05 09:12:38', 0, 1, 1),
(216, '89.39.107.196', '2023-06-05 09:14:28', 0, 1, 1),
(217, '2.41.155.31', '2023-06-05 09:26:30', 0, 1, 1),
(218, '89.39.107.196', '2023-06-05 09:43:59', 1, 16, 0),
(242, '79.50.56.238', '2023-06-05 22:31:04', 0, 1, 0),
(220, '89.39.107.198', '2023-06-05 10:23:20', 0, 1, 1),
(221, '2.41.155.31', '2023-06-05 10:42:15', 0, 1, 1),
(222, '2.41.155.31', '2023-06-05 10:42:51', 0, 1, 1),
(223, '89.39.107.198', '2023-06-05 11:52:01', 0, 1, 0),
(224, '89.39.107.198', '2023-06-05 11:56:38', 0, 2, 0),
(225, '89.39.107.198', '2023-06-05 11:57:19', 1, 2, 0),
(226, '212.8.250.236', '2023-06-05 11:59:43', 0, 2, 0),
(227, '212.8.250.236', '2023-06-05 12:00:12', 0, 2, 1),
(228, '212.8.250.236', '2023-06-05 16:53:38', 0, 1, 0),
(229, '212.8.250.236', '2023-06-05 16:54:13', 1, 1, 0),
(230, '185.177.126.135', '2023-06-05 16:55:06', 0, 1, 0),
(231, '185.177.126.135', '2023-06-05 16:57:43', 0, 1, 0),
(232, '185.177.126.135', '2023-06-05 16:59:28', 0, 1, 1),
(233, '185.177.126.135', '2023-06-05 17:13:28', 0, 1, 1),
(241, '37.162.129.234', '2023-06-05 17:41:53', 0, 1, 0),
(238, '37.162.129.234', '2023-06-05 17:29:15', 0, 1, 0),
(237, '37.162.129.234', '2023-06-05 17:29:02', 0, 1, 0),
(243, '212.8.253.162', '2023-06-05 23:37:53', 0, 1, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `TMovimentiContoCorrente`
--

CREATE TABLE `TMovimentiContoCorrente` (
  `MovimentoID` int NOT NULL,
  `ContoCorrenteID` int NOT NULL,
  `Data` date NOT NULL,
  `Importo` float NOT NULL,
  `Saldo` float NOT NULL,
  `CategoriaMovimentoID` int DEFAULT NULL,
  `DescrizioneEstesa` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `TMovimentiContoCorrente`
--

INSERT INTO `TMovimentiContoCorrente` (`MovimentoID`, `ContoCorrenteID`, `Data`, `Importo`, `Saldo`, `CategoriaMovimentoID`, `DescrizioneEstesa`) VALUES
(1, 1, '2023-04-26', 0, 0, 1, 'Apertura Conto Corrente'),
(2, 1, '2023-04-26', 1000, 0, 7, 'Versamento Bancomat iniziale'),
(3, 1, '2023-05-07', 50, 950, 8, 'Spesa al supermercato'),
(4, 1, '2023-05-27', 100.5, 849.5, 8, 'Spesa supermercato'),
(5, 1, '2023-05-29', 50.75, 798.75, 8, 'Biglietto autobus'),
(6, 1, '2023-05-30', 200, 998.75, 9, 'Stipendio mensile'),
(7, 1, '2023-06-03', 80.3, 918.45, 5, 'Pagamento utenza gas'),
(8, 1, '2023-06-20', 200, 1118.45, 2, 'Bonifico in Entrata di Giulio Milano'),
(9, 1, '2023-07-02', 700, 418.45, 11, 'Mutuo auto'),
(10, 1, '2023-07-04', 100, 518.45, 7, 'Versamento Bancomat'),
(11, 2, '2023-05-31', 0, 0, 1, 'Apertura Conto Corrente'),
(12, 2, '2023-06-01', 250, 250, 7, 'Versamento Bancomat iniziale'),
(27, 1, '2023-06-03', 50, 458.45, 3, 'Bonifico in Uscita in favore di Rossi \r\n Causale: prova2'),
(28, 2, '2023-06-03', 50, 310, 2, 'Bonifico in Entrata fatto da John \r\n Causale: prova2'),
(26, 2, '2023-06-03', 10, 260, 2, 'Bonifico in Entrata fatto da John \r\n Causale: prova1'),
(25, 1, '2023-06-03', 10, 508.45, 3, 'Bonifico in Uscita in favore di Rossi \r\n Causale: prova1'),
(29, 2, '2023-06-03', 30, 280, 3, 'Bonifico in Uscita in favore di John \r\n Causale: Prova3 ritorno'),
(30, 1, '2023-06-03', 30, 488.45, 2, 'Bonifico in Entrata fatto da John \r\n Causale: Prova3 ritorno'),
(46, 2, '2023-06-03', 10, 270, 3, 'Bonifico in Uscita in favore di gino \r\n Causale: prova uscita vile denaro'),
(44, 1, '2023-06-03', 10, 478.45, 6, 'Recharge of the 3342167832 With Phone Carrier: Tim'),
(47, 2, '2023-06-03', 20, 250, 3, 'Bonifico in Uscita in favore di John \r\n Causale: Provacompleta'),
(48, 1, '2023-06-03', 20, 498.45, 2, 'Bonifico in Entrata fatto da John \r\n Causale: Provacompleta'),
(49, 2, '2023-06-03', 70, 180, 3, 'Bonifico in Uscita in favore di John \r\n Causale: prova completa2'),
(50, 1, '2023-06-03', 70, 568.45, 2, 'Bonifico in Entrata fatto da John \r\n Causale: prova completa2'),
(51, 2, '2023-06-03', 10, 170, 3, 'Bonifico in Uscita in favore di gino \r\n Causale: provacompleta2'),
(54, 1, '2023-06-05', 10, 558.45, 6, 'Recharge of the 3432256761 With Phone Carrier: Tre'),
(55, 1, '2023-06-05', 10, 548.45, 6, 'Recharge of the 3432256761 With Phone Carrier: Tre'),
(56, 1, '2023-06-05', 5, 543.45, 6, 'Recharge of the 3342167832 With Phone Carrier: Iliad'),
(57, 1, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(58, 2, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(59, 3, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(60, 32, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(61, 9, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(62, 5, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(63, 6, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(64, 16, '2023-06-06', 0, 0, 1, 'Opening a current account'),
(65, 35, '2023-06-06', 0, 0, 1, 'Opening a current account');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `TCategorieMovimenti`
--
ALTER TABLE `TCategorieMovimenti`
  ADD PRIMARY KEY (`CategoriaMovimentoID`);

--
-- Indici per le tabelle `TConticorrenti`
--
ALTER TABLE `TConticorrenti`
  ADD PRIMARY KEY (`ContoCorrenteID`);

--
-- Indici per le tabelle `TIndirizziIp`
--
ALTER TABLE `TIndirizziIp`
  ADD PRIMARY KEY (`IDIp`),
  ADD KEY `ContoCorrenteID` (`ContoCorrenteID`);

--
-- Indici per le tabelle `TMovimentiContoCorrente`
--
ALTER TABLE `TMovimentiContoCorrente`
  ADD PRIMARY KEY (`MovimentoID`),
  ADD KEY `ContoCorrenteID` (`ContoCorrenteID`),
  ADD KEY `CategoriaMovimentoID` (`CategoriaMovimentoID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `TCategorieMovimenti`
--
ALTER TABLE `TCategorieMovimenti`
  MODIFY `CategoriaMovimentoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `TConticorrenti`
--
ALTER TABLE `TConticorrenti`
  MODIFY `ContoCorrenteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT per la tabella `TIndirizziIp`
--
ALTER TABLE `TIndirizziIp`
  MODIFY `IDIp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT per la tabella `TMovimentiContoCorrente`
--
ALTER TABLE `TMovimentiContoCorrente`
  MODIFY `MovimentoID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;