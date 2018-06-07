-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Giu 07, 2018 alle 16:29
-- Versione del server: 10.1.33-MariaDB
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appkato-DB`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `iscritti`
--

CREATE TABLE `iscritti` (
  `ID_iscritto` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Ospite` smallint(6) NOT NULL DEFAULT '0',
  `Proprietario` smallint(6) NOT NULL DEFAULT '0',
  `Stato` smallint(6) NOT NULL DEFAULT '0',
  `AuthPrivacy` smallint(6) NOT NULL DEFAULT '0',
  `AuthMarketing` smallint(6) NOT NULL DEFAULT '0',
  `AuthPush` tinyint(4) NOT NULL DEFAULT '0',
  `Telefono` varchar(255) NOT NULL,
  `Data-inserimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Immagine` varchar(200) NOT NULL,
  `Note` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `iscritti`
--

INSERT INTO `iscritti` (`ID_iscritto`, `Nome`, `Email`, `Password`, `Ospite`, `Proprietario`, `Stato`, `AuthPrivacy`, `AuthMarketing`, `AuthPush`, `Telefono`, `Data-inserimento`, `Immagine`, `Note`) VALUES
(3, 'Guiggi', 'info@orlandoguiggi.it', 'ffac224fd48c201e2ee0062ca5ddd206', 1, 0, 0, 1, 1, 0, '123123123', '2018-05-15 12:50:28', '', '<p>&nbsp;das ad asdas dsadasd</p>\r\n'),
(5, 'Filippo', 'f.colca@piucommunication.com', '31f17d0937946da06e9648dbe01bfec9', 0, 1, 1, 0, 0, 0, '23423423', '2018-05-15 13:04:34', '', '<p>asd asd sad asdasdas</p>\r\n'),
(6, 'pluto', 'pluto@kato.it', 'c6009f08fc5fc6385f1ea1f5840e179f', 0, 1, 1, 0, 0, 0, '', '2018-05-15 16:23:17', '', ''),
(8, '', 'ff@kato.it', '633de4b0c14ca52ea2432a3c8a5c4c31', 1, 0, 1, 0, 0, 0, '', '2018-05-25 11:06:58', '', ''),
(9, '', 'tommasovogel@gmail.com', '9be84fb621a6cb88d78fcacef475c1e0', 1, 0, 1, 0, 0, 0, '', '2018-06-05 13:00:52', '', ''),
(19, 'orlando', 'o@gmail.com', 'd95679752134a2d9eb61dbd7b91c4bcc', 0, 1, 2, 1, 0, 0, '345544', '2018-06-07 16:20:53', '', ''),
(20, 'Gabriele', 'g@gmail.com', 'b2f5ff47436671b6e533d8dc3614845d', 0, 1, 2, 1, 1, 0, '45676', '2018-06-07 16:28:25', '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `macchine`
--

CREATE TABLE `macchine` (
  `ID_macchina` int(11) NOT NULL,
  `ID_iscritto` int(11) NOT NULL,
  `Modello` varchar(255) NOT NULL,
  `Seriale` varchar(255) NOT NULL,
  `Data_inserimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `macchine`
--

INSERT INTO `macchine` (`ID_macchina`, `ID_iscritto`, `Modello`, `Seriale`, `Data_inserimento`, `Note`) VALUES
(5, 19, 'fffhjh', 'gfdr123', '2018-06-07 16:20:53', ''),
(6, 19, 'gfhhv', '3456gtr', '2018-06-07 16:20:53', ''),
(7, 20, 'Gab123', '23455gffgg', '2018-06-07 16:28:25', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `officine`
--

CREATE TABLE `officine` (
  `ID_item` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Dealer` smallint(6) NOT NULL DEFAULT '0',
  `Officina` smallint(6) NOT NULL DEFAULT '0',
  `Stato` smallint(6) NOT NULL DEFAULT '0',
  `AuthPrivacy` smallint(6) NOT NULL DEFAULT '0',
  `AuthMarketing` smallint(6) NOT NULL DEFAULT '0',
  `Latitudine` double DEFAULT NULL,
  `Longitudine` double DEFAULT NULL,
  `Indirizzo` varchar(255) NOT NULL,
  `Citta` varchar(255) NOT NULL,
  `CAP` varchar(255) NOT NULL,
  `Nazione` varchar(255) NOT NULL,
  `Telefono` varchar(255) NOT NULL,
  `Fax` varchar(255) NOT NULL,
  `Data-inserimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Immagine` varchar(200) NOT NULL,
  `Note` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `officine`
--

INSERT INTO `officine` (`ID_item`, `Nome`, `Email`, `Password`, `Dealer`, `Officina`, `Stato`, `AuthPrivacy`, `AuthMarketing`, `Latitudine`, `Longitudine`, `Indirizzo`, `Citta`, `CAP`, `Nazione`, `Telefono`, `Fax`, `Data-inserimento`, `Immagine`, `Note`) VALUES
(9, 'Officina Meccanica Giuli', 'giuligianpi@virgilio.it', '', 0, 1, 1, 1, 1, 42.7571947, 11.1156294, 'VIA DEI BARBERI LOC. PODERINA', 'Grosseto', '58100', 'Italia', '0564 409276', '', '2018-05-28 15:06:40', '', ''),
(10, 'Sacchetti Santi S.N.C. di Sacchetti S.&C.', 'Sacchettisanti@gmail.com', '', 0, 1, 1, 0, 0, 43.6159034, 11.4782638, 'Via Petrarca, 77', 'Figline Val D\'Arno', '50063', 'Italia', '055 953146', '', '2018-05-28 16:37:07', '', ''),
(11, 'Varet Srl', 'officinavaret@gmail.com', '', 0, 1, 1, 1, 1, 43.4983453, 11.1072482, 'LocalitÃ  Cusona', 'San Gimignano', '53037', 'Italia', '0577 1741435', '0577 1741413', '2018-05-29 12:31:56', '', ''),
(12, 'Bonari Alessandro - Multiservice di Bravi Iliano & C.', 'lucchesimeccanica@virgilio.it', '', 0, 1, 1, 1, 1, 44.1187945, 10.4060015, 'Via Enrico Fermi, 16', 'Castelnuovo di Garfagnana', '55032', 'Italia', '0583 62285', '0583 65152', '2018-05-29 12:35:31', '', ''),
(13, 'A & I D.O.O.', 'info@gehl.si', '', 1, 0, 1, 1, 1, 46.0500959, 14.4574715, 'BRDNIKOVA, 40', 'Ljublijana', '1000 SI', 'Slovenia', '003861 2561430', '003861 2561430', '2018-05-29 16:09:50', '', ''),
(15, 'G.M.V. Agricenter', 'alessandro.giani@gmvagricenter.it', '', 1, 0, 1, 1, 1, 44.0203871, 10.5149381, 'Via Provinciale', 'Borgo a Mozzano', '55023', 'Italia', '055 8218413', '055 8218463', '2018-05-30 13:05:22', '', '<p>Miniescavatori - Skid loader - Minidumper - Crawler Carrier - Martelli idraulici -</p>\r\n');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_category`
--

CREATE TABLE `tbl_category` (
  `ID` int(11) NOT NULL,
  `Type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Note` text COLLATE latin1_general_ci NOT NULL,
  `Layout` int(11) DEFAULT '1',
  `Data_layout` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ID_padre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `tbl_category`
--

INSERT INTO `tbl_category` (`ID`, `Type`, `Note`, `Layout`, `Data_layout`, `ID_padre`) VALUES
(1, 'CAT', '', 1, '', 0),
(2, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(269, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(270, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(271, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(272, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(273, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(274, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(275, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270),
(276, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270),
(277, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(278, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(279, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(280, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(281, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(282, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(283, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(284, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(285, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(286, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(287, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(288, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 2),
(289, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(290, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(291, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(292, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(293, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(294, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(295, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(296, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(297, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(298, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(299, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 271),
(300, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 302),
(301, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 302),
(302, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(303, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 302),
(304, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 272),
(305, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 272),
(306, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 272),
(307, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270),
(308, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270),
(309, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270),
(310, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270),
(311, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270),
(312, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 270);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_config`
--

CREATE TABLE `tbl_config` (
  `ID` int(11) NOT NULL,
  `Lingua_predefinita` varchar(50) NOT NULL,
  `Lingue` varchar(100) NOT NULL,
  `Footer_txt` text NOT NULL,
  `Claim_txt` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabella configurazioni globali sito';

--
-- Dump dei dati per la tabella `tbl_config`
--

INSERT INTO `tbl_config` (`ID`, `Lingua_predefinita`, `Lingue`, `Footer_txt`, `Claim_txt`) VALUES
(1, 'en-EN', 'en-EN,it-IT,fr-FR,de-DE,es-ES', '\r\n', '\r\n');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `ID_image` int(11) NOT NULL,
  `ID_item` int(11) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Tag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_global_role`
--

CREATE TABLE `tbl_global_role` (
  `RoleID` int(11) NOT NULL,
  `Role_Name` varchar(100) NOT NULL DEFAULT '',
  `Role_Description` longtext,
  `icona` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabella relativa ai ruoli dell'' utente in un gruppo';

--
-- Dump dei dati per la tabella `tbl_global_role`
--

INSERT INTO `tbl_global_role` (`RoleID`, `Role_Name`, `Role_Description`, `icona`) VALUES
(1, 'SuperAdmin', 'Utente che pu?? fare tutto', 'img/ico_superadmin.gif'),
(2, 'Admin', NULL, 'img/ico_admin.gif'),
(3, 'Admin_settore', NULL, 'img/ico_admin_settore.gif'),
(4, 'User', NULL, 'img/ico_user.gif');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_global_user`
--

CREATE TABLE `tbl_global_user` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL DEFAULT '0',
  `Nome` varchar(100) NOT NULL DEFAULT '',
  `Cognome` varchar(100) NOT NULL DEFAULT '',
  `Note` text,
  `Email` varchar(100) NOT NULL DEFAULT '',
  `Username` varchar(50) NOT NULL DEFAULT '',
  `Password` varchar(50) NOT NULL DEFAULT '',
  `Telefono` int(11) DEFAULT '0',
  `Accettata` tinyint(4) NOT NULL DEFAULT '0',
  `Data_Inserimento` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Immagine` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabella relativa ai dettagli dell'' utente';

--
-- Dump dei dati per la tabella `tbl_global_user`
--

INSERT INTO `tbl_global_user` (`UserID`, `RoleID`, `Nome`, `Cognome`, `Note`, `Email`, `Username`, `Password`, `Telefono`, `Accettata`, `Data_Inserimento`, `Immagine`) VALUES
(4, 1, 'Orlando', 'Guiggi', '', 'o.guiggi@piucommunication.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 2147483647, 1, '0000-00-00 00:00:00', '67606-thumb_behance.jpg'),
(5, 2, 'AlephAdmin', '', '', 'laura.chiriac@noesis.technology', 'AlephAdm1n((', 'eb6c3f4f6b144b52258f54e591406a25', 0, 1, '0000-00-00 00:00:00', '56022-profile-alephzero.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_group_menu`
--

CREATE TABLE `tbl_group_menu` (
  `ID_menu` int(11) NOT NULL,
  `Voce_menu` varchar(255) NOT NULL DEFAULT '',
  `Descrizione` varchar(255) NOT NULL DEFAULT '',
  `Link` varchar(255) NOT NULL DEFAULT '',
  `ID_ruolo` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabella delle voci del menu associate al ruolo' PACK_KEYS=0;

--
-- Dump dei dati per la tabella `tbl_group_menu`
--

INSERT INTO `tbl_group_menu` (`ID_menu`, `Voce_menu`, `Descrizione`, `Link`, `ID_ruolo`) VALUES
(1, 'GESTIONE UTENTI', 'Gestione utenti SuperAdmin', 'gestione_utenti.php', 1),
(2, 'GESTIONE PRODOTTI', 'galleria prodotti', 'visual_gallery.php', 1),
(3, 'GESTIONE CATEGORIE', 'Voci categorie ricorsive (menu)', 'visual_menu.php', 1),
(5, 'RICHIESTE PASSWORD', 'Richieste password area download', 'richieste_password.php', 1),
(6, 'NEWLETTER', 'Newsletter Ceccotti', 'newsletter.php', 1),
(7, 'IMG HOME PAGE', 'gestione immagini home page', 'visual_imghome.php', 1),
(8, 'IMG INTRO', 'Galleria immagini iniziali', 'visual_imgintro.php', 1),
(9, 'GESTIONE DOWNLOAD', 'gestione download file in ftp', 'visual_download.php', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_items`
--

CREATE TABLE `tbl_items` (
  `ID_item` int(11) NOT NULL,
  `ID_cat` int(11) NOT NULL COMMENT 'Chiave esterna tbl_category',
  `Titolo` varchar(255) NOT NULL,
  `Sottotitolo` varchar(255) NOT NULL,
  `Descrizione` text NOT NULL,
  `Immagine` varchar(255) NOT NULL,
  `Lingua` varchar(50) NOT NULL,
  `Attiva` int(11) NOT NULL DEFAULT '0',
  `Pubblica` int(11) NOT NULL DEFAULT '0',
  `Ordine` int(11) NOT NULL DEFAULT '0',
  `Evidenza` int(11) NOT NULL DEFAULT '0',
  `Data_creazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Data_modifica` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Attributi` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tbl_items`
--

INSERT INTO `tbl_items` (`ID_item`, `ID_cat`, `Titolo`, `Sottotitolo`, `Descrizione`, `Immagine`, `Lingua`, `Attiva`, `Pubblica`, `Ordine`, `Evidenza`, `Data_creazione`, `Data_modifica`, `Attributi`) VALUES
(2, 2, 'Mini excavators', '', '<p>Operation in confined spaces</p>\r\n', '82158-VFourHD30-02-fronte-3-4.jpg', 'en-EN', 1, 1, 10, 0, '2016-11-23 15:59:02', '2018-05-31 09:06:50', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(1, 1, 'Catalog', '', '', '', 'en-EN', 1, 1, 0, 0, '2016-11-23 16:00:09', '0000-00-00 00:00:00', ''),
(13, 270, 'Skid Loaders', '', '<p>Functionality and versatility to the ninth power</p>\r\n', '74465-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'en-EN', 1, 1, 50, 0, '2018-05-21 07:28:27', '2018-06-01 09:37:32', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(14, 271, 'Mini-dumpers', '', '<p class=\"p1\"><span style=\"line-height: 1.6em;\">Versatile. In every situation</span></p>\r\n', '17581-Carry110-trilaterale-dx-3-4-retro.jpg', 'en-EN', 1, 1, 20, 0, '2018-05-21 08:21:34', '2018-05-31 11:04:17', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(15, 270, 'Skid loader', '', '<p>Funzionalit&agrave; e versatilit&agrave; all&rsquo;ennesima potenza</p>\r\n', '', 'it-IT', 1, 1, 50, 0, '2018-05-21 08:24:31', '2018-06-01 09:37:58', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(16, 1, 'Catalogo', '', '', '', 'it-IT', 1, 1, 0, 0, '2018-05-21 08:58:09', '0000-00-00 00:00:00', ''),
(17, 1, 'Catálogo', '', '', '', 'es-ES', 1, 1, 0, 0, '2018-05-21 09:02:36', '0000-00-00 00:00:00', ''),
(18, 1, 'Catalogue', '', '', '', 'fr-FR', 1, 1, 0, 0, '2018-05-21 09:04:05', '0000-00-00 00:00:00', ''),
(19, 1, 'Katalog', '', '', '', 'de-DE', 1, 1, 0, 0, '2018-05-21 09:04:29', '0000-00-00 00:00:00', ''),
(11, 269, '9VXE', '', '<p><strong>Where others cannot reach</strong></p>\r\n\r\n<p>The micro-excavator 9VXE, the new ultra-compact model, utilizes the technology of higher class machines.&nbsp;</p>\r\n\r\n<p>Power and speed of excavation are assured when working in confined spaces: in small restructuring works, in excavation and maintenance of sewers, in tunnels where larger machines cannot work, and also in the gardening and nursery sectors.</p>\r\n', '49259-VXEHD09-02-3-4fronte-sx_mini.jpg', 'en-EN', 1, 1, 10, 0, '2018-05-16 08:05:29', '2018-05-31 15:16:53', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(12, 2, 'Mini escavatori', '', '<p>Operativit&agrave; in spazi ristretti</p>\r\n', '', 'it-IT', 1, 1, 10, 0, '2018-05-16 09:01:28', '2018-05-31 14:36:35', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(20, 272, 'Crawler Carriers', '', '<p>Sturdy, powerful, easy to use</p>\r\n', '10997-IC120-2.jpg', 'en-EN', 1, 1, 40, 0, '2018-05-21 13:27:01', '2018-06-01 09:11:34', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(21, 271, 'Minidumper', '', '<p>Versatili, in ogni situazione</p>\r\n', '', 'it-IT', 1, 1, 30, 0, '2018-05-21 13:36:51', '2018-05-31 15:26:34', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(22, 272, 'Crawler Carriers', '', '<p>Robusti e potenti e facili da usare</p>\r\n', '', 'it-IT', 1, 1, 40, 0, '2018-05-21 13:37:16', '2018-06-01 09:08:16', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(29, 269, '9VXE', '', '<p><strong>Pour aller o&ugrave; les autres ne vont pas</strong></p>\r\n\r\n<p>La 9VXE, mod&egrave;le ultra-compact, poss&egrave;de la technologie des machines de classe sup&eacute;rieure.</p>\r\n\r\n<p>La puissance et la vitesse d&rsquo;excavation sont garanties dans les espaces limit&eacute;s: lors de petites r&eacute;novations, lors d&rsquo;op&eacute;rations d&rsquo;excavation et d&rsquo;entretien des &eacute;gouts, dans les tunnels o&ugrave; les machines plus imposantes ne peuvent pas travailler, mais aussi dans le secteur des espaces verts.</p>\r\n', '37889-VXEHD09-02-3-4fronte-sx_mini.jpg', 'fr-FR', 1, 1, 10, 0, '2018-05-30 14:44:52', '2018-06-01 14:10:49', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(23, 269, '9VXE', '', '<p><strong>Dove gli altri non arrivano</strong></p>\r\n\r\n<p>Il microescavatore 9VXE, modello ultracompatto, impiega la tecnologia delle macchine di classe superiore.</p>\r\n\r\n<p>Potenza e velocit&agrave; di scavo sono assicurate quando si lavora in spazi limitati: nelle piccole ristrutturazioni, in operazioni di scavo e manutenzione di fognature, nei tunnel dove macchine&nbsp;pi&ugrave; grandi non possono operare, ma anche nel settore del giardinaggio e della vivaistica.</p>\r\n', '70842-VXEHD09-02-3-4fronte-sx_mini.jpg', 'it-IT', 1, 1, 10, 0, '2018-05-22 14:38:02', '2018-06-01 14:10:31', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(26, 2, 'Mini-Pelles', '', '<p>Pour espaces restreints</p>\r\n', '47393-VFourHD30-02-fronte-3-4.jpg', 'fr-FR', 1, 1, 10, 0, '2018-05-30 14:40:54', '2018-05-31 14:36:50', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(27, 2, 'Minibagger', '', '<p>Arbeit auf beengtem Raum</p>\r\n', '59422-VFourHD30-02-fronte-3-4.jpg', 'de-DE', 1, 1, 10, 0, '2018-05-30 14:42:27', '2018-05-31 14:37:04', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(28, 2, 'Miniexcavadoras', '', '<p>Operatividad en espacios estrechos</p>\r\n', '11078-VFourHD30-02-fronte-3-4.jpg', 'es-ES', 1, 1, 10, 0, '2018-05-30 14:43:29', '2018-05-31 14:37:21', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(24, 273, 'ITEM ITA NEWS', '', '<p>lorem ipsum</p>\r\n', '', 'it-IT', 0, 1, 20, 0, '2018-05-25 09:08:26', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"3.0 - 8.5 ton\";}'),
(25, 274, '12VXE', '', '<p class=\"p1\"><strong>Small and powerful</strong></p>\r\n\r\n<p class=\"p2\">The 12VXE is a completely new concept: small enough to pass through a door, but also robust enough to do jobs above its category. An exceptional machine!</p>\r\n\r\n<p class=\"p2\">With its 9.5 kW engine and digging depth of 2010 mm, it handles heavy work in the most challenging conditions with ease.</p>\r\n', '34432-VXEHD12-03-3-4fronte-sx_mini.jpg', 'en-EN', 1, 1, 20, 0, '2018-05-30 13:36:42', '2018-05-30 15:02:15', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(30, 269, '9VXE', '', '<p><strong>Wo andere nicht hinkommen</strong></p>\r\n\r\n<p>Der Minibagger 9VXE, ein superkompaktes Modell, setzt die Technologie von Maschinen h&ouml;herer Klassen ein.</p>\r\n\r\n<p>Grableistung und-geschwindigkeit sind die Vorteile dieser Maschine bei der Arbeit auf beengtem Raum: bei kleinen Renovierungsarbeiten, Grabungen und der Reinigung von Kanalisationen, in Tunnels, wo gr&ouml;&szlig;ere Maschinen nicht hinkommen, aber auch f&uuml;r die G&auml;rtnerei und in Pflanzenschulen.</p>\r\n', '68899-VXEHD09-02-3-4fronte-sx_mini.jpg', 'de-DE', 1, 1, 10, 0, '2018-05-30 14:58:30', '2018-06-01 14:11:14', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(31, 274, '12VXE', '', '<p><strong>Piccolo e potente</strong></p>\r\n\r\n<p>Nuovissimo il miniescavatore 12VXE: abbastanza piccolo da valicare porte, tanto solido da svolgere il lavoro di modelli di categoria superiore. Una macchina straordinaria. Alimentato da un motore da 9,5 kW, con una profondit&agrave; di scavo di 2010 mm, &egrave; in grado di effettuare i lavori pi&ugrave; gravosinegli ambienti pi&ugrave; difficili.</p>\r\n', '85075-VXEHD12-03-3-4fronte-sx_mini.jpg', 'it-IT', 1, 1, 20, 0, '2018-05-30 14:59:43', '2018-06-01 14:12:14', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(32, 269, '9VXE', '', '<p class=\"p1\" style=\"line-height: 20.8px;\"><strong>All&iacute; donde otros no llegan</strong></p>\r\n\r\n<p class=\"p1\"><span style=\"line-height: 1.6em;\">La miniexcavadora 9VXE, modelo ultracompacto, emplea la tecnolog&iacute;a de las m&aacute;quinas de clase superior. La potencia y la velocidad de excavaci&oacute;n est&aacute;n aseguradas incluso cuando se trabaja con poco espacio: en peque&ntilde;as rehabilitaciones, en excavaciones y mantenimiento del alcantarillado, en t&uacute;neles donde no pueden trabajar m&aacute;quinas mayores, y tambi&eacute;n en el sector jardiner&iacute;a y viveros.</span></p>\r\n', '', 'es-ES', 0, 1, 10, 0, '2018-05-30 15:03:49', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(33, 269, '9VXE', '', '<p><strong>All&iacute; donde otros no llegan</strong></p>\r\n\r\n<p>La miniexcavadora 9VXE, modelo ultracompacto, emplea la tecnolog&iacute;a de las m&aacute;quinas de clase superior.</p>\r\n\r\n<p>La potencia y la velocidad de excavaci&oacute;n est&aacute;n aseguradas incluso cuando se trabaja con poco espacio: en peque&ntilde;as rehabilitaciones, en excavaciones y mantenimiento del alcantarillado, en t&uacute;neles donde no pueden trabajar m&aacute;quinas mayores, y tambi&eacute;n en el sector jardiner&iacute;a y viveros.</p>\r\n', '21017-VXEHD09-02-3-4fronte-sx_mini.jpg', 'es-ES', 1, 1, 10, 0, '2018-05-30 15:08:46', '2018-06-01 14:11:37', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(34, 275, 'Prova', '', '<p>ads asdad as</p>\r\n', '', 'en-EN', 0, 1, 0, 0, '2018-05-30 15:52:23', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(35, 276, 'Prova titolo', '', '<p>asd asd asd asd asdas</p>\r\n', '', 'en-EN', 0, 1, 0, 0, '2018-05-30 16:01:23', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(36, 274, '12VXE', '', '<p><strong>Petite et puissante</strong></p>\r\n\r\n<p>Tout nouveau la mini-pelle 12VXE: assez petite pour franchir une porte, assez solide pour ex&eacute;cuter le travail d&rsquo;une machine plus puissante. Une machine extraordinaire.</p>\r\n\r\n<p>Aliment&eacute;e par un moteur de 9,5 kW &agrave;, avec une capacit&eacute; de creusage de 2010 mm, elle peut effectuer les travaux les plus lourds dans les espaces les plus restreints.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '11281-VXEHD12-03-3-4fronte-sx_mini.jpg', 'fr-FR', 1, 1, 20, 0, '2018-05-31 08:53:37', '2018-06-01 14:12:37', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(37, 274, '12VXE', '', '<p><strong>Klein und leistungsstark</strong></p>\r\n\r\n<p>Der neue Minibagger 12VXE: klein genug, um durch T&uuml;r&ouml;ffnungen fahren zu k&ouml;nnen, robust genug, um Arbeiten von Modellen der h&ouml;heren Klassen ausf&uuml;hren zu k&ouml;nnen. Eine &uuml;berragende Maschine.</p>\r\n\r\n<p>Angetrieben von einem Motor mit 9,5 kW, mit einer Grabtiefe von 2010 mm, imstande, Schwerstarbeit in problematischem Gel&auml;nde auszuf&uuml;hren.</p>\r\n', '16216-VXEHD12-03-3-4fronte-sx_mini.jpg', 'de-DE', 1, 1, 20, 0, '2018-05-31 08:54:12', '2018-06-01 14:13:19', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(38, 274, '12VXE', '', '<p class=\"p1\"><strong>Peque&ntilde;a y potente</strong></p>\r\n\r\n<p class=\"p2\">Nueva miniexcavadora 12VXE: suficientemente peque&ntilde;a para atravesar</p>\r\n\r\n<p class=\"p2\">puertas, suficientemente s&oacute;lida para realizar el trabajo de modelos de categor&iacute;a superior.<br />\r\nUna m&aacute;quina extraordinaria. Alimentada por un motor de 9,5 kW, con una profundidad de excavaci&oacute;n de 2010 mm, puede realizar los trabajos m&aacute;s exigidos en los entornos m&aacute;s dif&iacute;ciles.</p>\r\n', '7409-VXEHD12-03-3-4fronte-sx_mini.jpg', 'es-ES', 1, 1, 20, 0, '2018-05-31 08:54:48', '2018-06-01 14:13:34', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(39, 277, '17VXE', '', '<p><strong>Where others cannot reach</strong></p>\r\n\r\n<p>The mini-excavator 17VXE, the new ultra-compact model, utilizes the technology of higher class machines.</p>\r\n\r\n<p>Power and speed of digging are assured when working in confined spaces: in small restructuring work, in excavations and in maintenance of sewerage systems, in tunnels where larger machines cannot operate, but also in the gardening and nursery sectors.</p>\r\n', '93970-VXEHD17-01-3-4fronte-sx_mini.jpg', 'en-EN', 1, 1, 30, 0, '2018-05-31 09:13:06', '2018-05-31 15:10:50', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(40, 277, '17VXE', '', '<p><strong>Dove altri non arrivano</strong></p>\r\n\r\n<p>Il miniescavatore 17VXE, modello ultracompatto, impiega la tecnologia delle macchine di classe superiore.</p>\r\n\r\n<p>Potenza e velocit&agrave; di scavo sono assicurate quando si lavora in spazi limitati: nelle piccole ristrutturazioni, in operazioni di scavo e manutenzione di fognature, nei tunnel dove macchine&nbsp;pi&ugrave; grandi non possono operare, ma anche nel settore del giardinaggio e della vivaistica.</p>\r\n', '93970-VXEHD17-01-3-4fronte-sx_mini.jpg', 'it-IT', 1, 1, 30, 0, '2018-05-31 09:15:27', '2018-05-31 15:11:40', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(41, 277, '17VXE', '', '<p><strong>O&ugrave; les autres ne r&eacute;ussissent pas</strong></p>\r\n\r\n<p>La mini-pelle 17VXE, mod&egrave;le ultra-compact, b&eacute;n&eacute;ficie de la technologie des machines de classe sup&eacute;rieure.</p>\r\n\r\n<p>La puissance et la vitesse de creusage sont assur&eacute;es lors de travaux dans des espaces limit&eacute;s, petites r&eacute;novations, les op&eacute;ration de creusage et d&rsquo;entretien des &eacute;gouts, dans les tunnels o&ugrave; les machines plus imposantes ne peuvent pas travailler, mais aussi dans le secteur des espaces verts.</p>\r\n', '93970-VXEHD17-01-3-4fronte-sx_mini.jpg', 'fr-FR', 1, 1, 30, 0, '2018-05-31 09:21:12', '2018-05-31 15:15:04', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(125, 299, 'Carry110', 'Cassone trilaterale', '<p><strong>Ideale per il trasporto di materiale ingombrante</strong></p>\r\n\r\n<p>Progettata per cantieri edili, stradali, la versione con cassone trilaterale Ã¨ ideale per trasportare e scaricare materiali per il consolidamento di strade, con la possibilitÃ  di scaricare anche parzialmente nei punti interessati senza dover eseguire manovre di posizionamento. Questo accessorio non Ã¨ adatto al trasporto di materiale sabbioso o di terriccio a grana fine.\r\nDimensioni interne del pianale di scarico 1300 x 970 x 350 mm (P x L x H). Disponibile con presa di forza idraulica ausiliare mono/bidirezionale.</p>', '21490-Carry110-trilaterale-dx-3-4-retro.jpg', 'it-IT', 1, 1, 110, 0, '2018-05-31 15:50:20', '2018-05-31 16:09:27', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(42, 277, '17VXE', '', '<p><strong>Wo andere nicht hinkommen</strong></p>\r\n\r\n<p>Der Minibagger 17VXE, ein Modell in sehr kompakter Bauweise, setzt die Technologie von Maschinen h&ouml;herer Klassen ein.</p>\r\n\r\n<p>Grableistung und -geschwindigkeit sind die Vorteile dieser&nbsp;Maschine bei der Arbeit auf beengtem Raum: bei kleinen Renovierungsarbeiten, Grabungen&nbsp;und der Reinigung von Kanalisationen, in Tunnels, wo gr&ouml;&szlig;ere Maschinen nicht hinkommen,&nbsp;aber auch f&uuml;r die G&auml;rtnerei und in Pflanzenschulen.</p>\r\n', '93970-VXEHD17-01-3-4fronte-sx_mini.jpg', 'de-DE', 1, 1, 30, 0, '2018-05-31 09:23:02', '2018-05-31 15:13:20', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(44, 278, '17VXT', '', '<p><strong>Top performance</strong></p>\r\n\r\n<p>The 17VXT has an operating weight of 1730 kg and, thanks to its arm length of 1200 mm,vit reaches a digging depth of 2360 mm. The double travelling speed (2.1-4.1 km / h) provides great agility and great manoeuvrability.</p>\r\n\r\n<p>Great advantages in landfill operations, using the dozer blade.</p>\r\n', '53361-17VXT-dx_mini.jpg', 'en-EN', 1, 1, 40, 0, '2018-05-31 09:28:23', '2018-05-31 15:07:54', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(43, 277, '17VXE', '', '<p><strong>All&iacute; donde otros no llegan</strong></p>\r\n\r\n<p>La miniexcavadora 17VXE, modelo ultracompacto, emplea la tecnolog&iacute;a de las m&aacute;quinas de clase superior.&nbsp;</p>\r\n\r\n<p>La potencia y la velocidad de excavaci&oacute;n est&aacute;n aseguradas incluso cuando se trabaja con poco espacio: en peque&ntilde;as rehabilitaciones, en excavaciones y mantenimiento del alcantarillado, en t&uacute;neles donde no pueden trabajar m&aacute;quinas mayores, y tambi&eacute;n en el sector jardiner&iacute;a y viveros.</p>\r\n', '93970-VXEHD17-01-3-4fronte-sx_mini.jpg', 'es-ES', 1, 1, 30, 0, '2018-05-31 09:24:51', '2018-05-31 15:12:43', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(45, 278, '17VXT', '', '<p><strong>Prestazioni al top</strong></p>\r\n\r\n<p>Il 17VXT ha peso operativo di 1730 kg e grazie alla lunghezza di 1200 mm del braccio, raggiunge<br />\r\nla profondit&agrave; di scavo di 2360 mm.</p>\r\n\r\n<p>La doppia velocit&agrave; di traslazione (2,1-4,1 km/h) consente agilit&agrave;&nbsp;e manovrabilit&agrave; elevatissime.</p>\r\n\r\n<p>Grandi vantaggi nelle operazioni di reinterro con la lama dozer.</p>\r\n', '53361-17VXT-dx_mini.jpg', 'it-IT', 1, 1, 40, 0, '2018-05-31 09:31:50', '2018-05-31 15:08:29', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(46, 278, '17VXT', '', '<p><strong>Prestations au top</strong></p>\r\n\r\n<p>La 17VXT a un poids en marche de 1730 kg et gr&acirc;ce &agrave; la longueur de son bras, 1200 mm,&nbsp;elle peut atteindre une profondeur de creusage de 2360 mm.</p>\r\n\r\n<p>La double vitesse de translation&nbsp;(2,1-4,1 km / h) permet une grande souplesse et manoeuvrabilit&eacute;.</p>\r\n\r\n<p>Cela repr&eacute;sente de grands avantages lors d&rsquo;op&eacute;rations d&rsquo;ensevelissements avec la lame.</p>\r\n', '53361-17VXT-dx_mini.jpg', 'fr-FR', 1, 1, 40, 0, '2018-05-31 09:32:51', '2018-05-31 15:09:28', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(47, 278, '17VXT', '', '<p><strong>&Uuml;berragende Leistungen</strong></p>\r\n\r\n<p>Der 17VXT hat ein Betriebsgewicht von 1730 kg und dank einer L&auml;nge des Stiels von&nbsp;1200 mm kann er eine Grabtiefe von 2360 mm erreichen.</p>\r\n\r\n<p>Die zweifache Schwenkgeschwindigkeit (2,1-4,1 km / h) steht f&uuml;r h&ouml;chste Wendigkeit&nbsp;und Man&ouml;vrierf&auml;higkeit.</p>\r\n\r\n<p>Vorteilhaftes Arbeiten mit dem Planierschild.</p>\r\n', '53361-17VXT-dx_mini.jpg', 'de-DE', 1, 1, 40, 0, '2018-05-31 09:33:53', '2018-05-31 15:10:07', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(48, 278, '17VXT', '', '<p class=\"p1\"><strong>M&aacute;ximas prestaciones</strong></p>\r\n\r\n<p class=\"p2\">La excavadora 17VXT tiene un peso operativo de 1730 kg y gracias a la longitud de 1200 mm del brazo alcanza una profundidad de excavaci&oacute;n de 2360 mm.</p>\r\n\r\n<p class=\"p2\">Las dos velocidades de traslaci&oacute;n (2,1-4,1 km / h) permiten una agilidad y una maniobrabilidad muy elevadas.</p>\r\n\r\n<p class=\"p2\">Grandes ventajas en las operaciones de rellenado con la cuchilla dozer.</p>\r\n', '53361-17VXT-dx_mini.jpg', 'es-ES', 1, 1, 40, 0, '2018-05-31 09:35:02', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(49, 279, '19VXT', '', '<p><strong>Technological innovation and operational comfort</strong></p>\r\n\r\n<p>Ideal for working in confined spaces and on rough terrain, thanks to a variable gauge (from 980 to 1300 mm) operated by an electrical control on the blade control lever, it provides extraordinary versatility and great operating stability.</p>\r\n\r\n<p>With an operating weight of 1745 kg, dual travelling speed&nbsp;(2.1-4.1 km / h) and a digging depth of 2460 mm, the 19VXT is at the top of its category.</p>\r\n', '99239-VXTHD19-02-3-4-fronte-sx_mini.jpg', 'en-EN', 1, 1, 50, 0, '2018-05-31 09:36:52', '2018-05-31 15:04:12', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(50, 279, '19VXT', '', '<p><strong>Innovazione tecnologica e comfort operativo</strong></p>\r\n\r\n<p>Ideale per operare in ambienti ristretti e accidentati, grazie al telaio estensibile (da 980 a 1300 mm) azionato da un comando elettrico posizionato sulla leva di comando della lama, consente una elevata versatilit&agrave; e grande stabilit&agrave; operativa.&nbsp;</span></p>\r\n\r\n<p>Con peso operativo di 1745 kg, doppia velocit&agrave; di traslazione (2,1-4,1 km/h) e una profondit&agrave; di scavo di 2460 mm il 19VXT si pone al top della sua categoria.</span></p>\r\n', '99239-VXTHD19-02-3-4-fronte-sx_mini.jpg', 'it-IT', 1, 1, 50, 0, '2018-05-31 09:38:03', '2018-05-31 15:05:25', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(51, 279, '19VXT', '', '<p><strong>Innovation technologique et confort de travail</strong></p>\r\n\r\n<p>Id&eacute;al pour les lieux &eacute;troits et accident&eacute;s, sa voie variable (de 980 &agrave; 1300 mm) mise en marche par une commande &eacute;lectrique situ&eacute;e sur le levier de commande de la lame permet une tr&egrave;s grande polyvalence et une stabilit&eacute; de travail.</p>\r\n\r\n<p>Avec une poids en marche de 1745 kg, une double vitesse d&rsquo;avancement (2,1-4,1 km / h) et une profondeur de creusage de 2460 mm, la 19VXT est au top de sa cat&eacute;gorie.</p>\r\n', '99239-VXTHD19-02-3-4-fronte-sx_mini.jpg', 'fr-FR', 1, 1, 50, 0, '2018-05-31 09:38:47', '2018-05-31 15:25:21', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(52, 279, '19VXT', '', '<p><strong>Technologische Innovation und Einsatzkomfort</strong></p>\r\n\r\n<p>Ideal f&uuml;r den Einsatz bei beengten Platzverh&auml;ltnissen und schwierigem Boden dank dem&nbsp;ausfahrbaren Unterwagen (von 980 bis 1300 mm), der elektrisch vom Steuerhebel des Schilds&nbsp;aus bet&auml;tigt wird und h&ouml;chste Vielseitigkeit und Standfestigkeit bietet.</p>\r\n\r\n<p>Mit einem Betriebsgewicht&nbsp;von 1745 kg, zweifacher Schwenkgeschwindigkeit (2,1-4,1 km / h) und einer Grabtiefe von<br />\r\n2460 mm stellt der 19VXT sich an die Spitze seiner Klasse.</p>\r\n', '99239-VXTHD19-02-3-4-fronte-sx_mini.jpg', 'de-DE', 1, 1, 50, 0, '2018-05-31 09:40:54', '2018-05-31 15:06:52', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(53, 279, '19VXT', '', '<p class=\"p1\"><strong>Innovaci&oacute;n tecnol&oacute;gica y confort operativo</strong></p>\r\n\r\n<p class=\"p2\"><span class=\"s1\">Ideal para trabajar en espacios estrechos y accidentados, gracias al chasis extensible (de 980 a&nbsp;1300 mm), accionado por un mando el&eacute;ctrico situado en la palanca de mando de la cuchilla,&nbsp;permite una elevada versatilidad y una gran estabilidad operativa. </span></p>\r\n\r\n<p class=\"p2\"><span class=\"s1\">Con un peso operativo de&nbsp;1745 kg, dos velocidades de traslaci&oacute;n (2,1-4,1 km / h) y una profundidad de excavaci&oacute;n de<br />\r\n2460 mm, la excavadora 19VXT se coloca a la cabeza de su categor&iacute;a.</span></p>\r\n', '99239-VXTHD19-02-3-4-fronte-sx_mini.jpg', 'es-ES', 1, 1, 50, 0, '2018-05-31 09:50:50', '2018-05-31 11:21:09', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(54, 280, '27V4', '', '<p><strong>KATO technology</strong></p>\r\n\r\n<p>Thanks to zero tail swing technology, it is possible to dig and load in complete safety, even close to walls or in restricted areas. Swing speed of 9 rpm, enables higher performance.</p>\r\n\r\n<p>Max. bucket digging force 21.0 kN. Shibura S773L-C engine.</p>\r\n', '96724-27V4_COP_mini.jpg', 'en-EN', 1, 1, 60, 0, '2018-05-31 09:53:04', '2018-05-31 15:02:03', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(55, 280, '27V4', '', '<p><strong>Tecnologia KATO</strong></p>\r\n\r\n<p>La rotazione entro la sagoma dei cingoli facilita operazioni di scavo e di carico anche in prossimit&agrave; di muri o luoghi con poco spazio a disposizione. La velocit&agrave; di rotazione di 9 giri/min consente maggiori performance durante il lavoro. Forza di strappo al dente benna 21,0 kN.</p>\r\n\r\n<p>Motore SHIBAURA S773-C.</p>\r\n', '96724-27V4_COP_mini.jpg', 'it-IT', 1, 1, 60, 0, '2018-05-31 09:54:33', '2018-05-31 15:02:21', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(56, 280, '27V4', '', '<p><strong>Technologie KATO</strong></p>\r\n\r\n<p>La rotation &agrave; l&rsquo;int&eacute;rieure des chenilles facilite les op&eacute;rations d&rsquo;excavation et de chargement, m&ecirc;me &agrave; proximit&eacute; de murs ou d&rsquo;endroits exigus. La vitesse de rotation de 9 rpm garantit de meilleures performances de travail.</p>\r\n\r\n<p>La force de creusage du godet est de 21 kN. Motore SHIBAURA S773-C.</p>\r\n', '96724-27V4_COP_mini.jpg', 'fr-FR', 1, 1, 60, 0, '2018-05-31 09:55:05', '2018-05-31 15:02:41', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(57, 280, '27V4', '', '<p><strong>Technologie KATO</strong></p>\r\n\r\n<p>Die Drehung innerhalb der Fahrwerkbreite erleichtert Aushub- und Ladearbeiten in der N&auml;he von Mauern oder bei beengtem Raum. Die Drehgeschwindigkeit von 9 rpm erlaubt h&ouml;here Arbeitsleistungen.</p>\r\n\r\n<p>Rei&szlig;kraft am L&ouml;ffelzahn 21,0 kN. Motor SHIBAURA S773-C.</p>\r\n', '96724-27V4_COP_mini.jpg', 'de-DE', 1, 1, 60, 0, '2018-05-31 09:55:38', '2018-05-31 15:03:17', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(58, 280, '27V4', '', '<p><strong>Tecnolog&iacute;a KATO</strong></p>\r\n\r\n<p>La rotaci&oacute;n dentro del g&aacute;libo de las orugas facilita las operaciones de excavaci&oacute;n&nbsp;y de carga, incluso cerca de paredes o en lugares con poco espacio. La velocidad&nbsp;de rotaci&oacute;n de 9 rpm permite obtener mayores prestaciones durante el trabajo.<br />\r\nFuerza de arranque en diente de cuchara de 21,0 kN. Motor SHIBAURA S773-C.</p>\r\n', '96724-27V4_COP_mini.jpg', 'es-ES', 1, 1, 60, 0, '2018-05-31 09:56:16', '2018-05-31 15:03:31', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(59, 281, '30V4', '', '<p><strong>Technological innovation and power</strong></p>\r\n\r\n<p>Zero tail swing technology allows digging and loading in complete safety, even close to walls or places with little room available. Yanmar 3TNV88 engine.</p>\r\n\r\n<p>Max. bucket digging force 29.1 kN.</p>\r\n', '2291-VFourHD30-02-fronte-3-4.jpg', 'en-EN', 1, 1, 70, 0, '2018-05-31 09:57:19', '2018-05-31 14:58:01', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(60, 281, '30V4', '', '<p><strong>Innovazione tecnologica e forza</strong></p>\r\n\r\n<p>Grazie al telaio posteriore che ruota entro la sagoma dei cingoli &egrave; possibile effettuare in piena sicurezza le operazioni di scavo e di carico anche in prossimit&agrave; di muri o luoghi con poco spazio&nbsp;a disposizione.</p>\r\n\r\n<p>Motore Yanmar 3TNV88.</p>\r\n\r\n<p>Forza di strappo al dente di 29,1 kN.</p>\r\n', '2291-VFourHD30-02-fronte-3-4.jpg', 'it-IT', 1, 1, 70, 0, '2018-05-31 09:58:58', '2018-05-31 14:59:52', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(126, 299, 'Carry110', 'Tribenne', '<p><strong>IdÃ©al pour le transport de matÃ©riels encombrants</strong></p>\r\n<p>EtudiÃ© pour les chantiers de construction, ou routiers, la version avec tribenne est idÃ©ale \r\npour transporter et dÃ©charger des matÃ©riels dÃ©liÃ©s pour la consolidation des routes, en laissant \r\nla possibilitÃ© de dÃ©charger mÃªme partiellement dans les lieux voulus sans devoir faire de manoeuvres \r\nspÃ©ciales. Les dimensions du plateau de chargement sont 1300 x 970 x 350 mm (P x L x H). \r\nDisponible avec une prise de force auxiliaire hydraulique mono/bidirectionnelle.</p>', '21490-Carry110-trilaterale-dx-3-4-retro.jpg', 'fr-FR', 1, 1, 110, 0, '2018-05-31 16:11:50', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(61, 281, '30V4', '', '<p><strong>L&rsquo;innovation technologique et la force</strong></p>\r\n\r\n<p>Gr&acirc;ce au train arri&egrave;re qui tourne &agrave; l&rsquo;int&eacute;rieure des chenilles, il est possible d&rsquo;effectuer des op&eacute;rations&nbsp; de creusage et de chargement en toute s&eacute;curit&eacute; &agrave; proximit&eacute; de murs ou d&rsquo;endroits exigus.</p>\r\n\r\n<p>Moteur Yanmar 3TNV88.</p>\r\n\r\n<p>La force de creusage est de 29,1 kN.</p>\r\n', '2291-VFourHD30-02-fronte-3-4.jpg', 'fr-FR', 1, 1, 70, 0, '2018-05-31 09:59:56', '2018-05-31 15:00:18', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(62, 281, '30V4', '', '<p><strong>Technologische Innovation und Kraft</strong></p>\r\n\r\n<p>Da das Fahrzeug beim Drehen nicht &uuml;ber die Fahrwerkbreite hinausragt, sind Aushub-<br />\r\nund Ladearbeiten auch in der N&auml;he von Mauern oder bei beengtem Raum unter&nbsp;Sicherheitsbedingungen m&ouml;glich.</p>\r\n\r\n<p>Motor Yanmar 3TNV88.</p>\r\n\r\n<p>Losbrechkraft des L&ouml;ffels von 29,1 kN.</p>\r\n', '2291-VFourHD30-02-fronte-3-4.jpg', 'de-DE', 1, 1, 70, 0, '2018-05-31 10:01:07', '2018-05-31 15:00:43', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(63, 281, '30V4', '', '<p><strong>Innovaci&oacute;n tecnol&oacute;gica y fuerza</strong></p>\r\n\r\n<p>Gracias al chasis trasero que gira dentro del g&aacute;libo de las orugas es posible efectuar operaciones de excavaci&oacute;n y carga en plena seguridad, incluso cerca de paredes o en lugares con poco espacio.</p>\r\n\r\n<p>Motor Yanmar 3TNV88.</p>\r\n\r\n<p>Fuerza de penetraci&oacute;n en la cuchara de 29,1 kN.</p>\r\n', '2291-VFourHD30-02-fronte-3-4.jpg', 'es-ES', 1, 1, 70, 0, '2018-05-31 10:02:12', '2018-05-31 15:01:14', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(64, 282, '35N4', '', '<p class=\"p1\"><strong>The front-line device</strong></p>\r\n\r\n<p class=\"p2\">35N4 is environmentally friendly and safety conscious Standard mini-excavator.</p>\r\n\r\n<p class=\"p2\">The latest model of clean engine is compliant with gas emission for EC Stage IIIA.&nbsp;</p>\r\n\r\n<p class=\"p2\">35N4 provides superior performance and preeminent stability and workability.</p>\r\n', '4227-35N4_cabin_3-4-dx-yellow.jpg', 'en-EN', 1, 1, 80, 0, '2018-05-31 10:03:53', '2018-05-31 10:04:21', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(65, 282, '35N4', '', '<p><strong>Tradizionale con massime performance</strong></p>\r\n\r\n<p>Il miniescavatore tradizionale 35N4 &egrave; ecologico e garantisce standards di sicurezza.&nbsp;</p>\r\n\r\n<p>L&rsquo;ultimo modello di motore pulito &egrave; conforme per le emissioni di gas CE Stage IIIA.&nbsp;</p>\r\n\r\n<p>Prestazioni superiori e stabilit&agrave; sopra ogni aspettativa.</p>\r\n', '4227-35N4_cabin_3-4-dx-yellow.jpg', 'it-IT', 1, 1, 80, 0, '2018-05-31 10:05:00', '2018-05-31 14:58:48', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(66, 282, '35N4', '', '<p class=\"p1\"><strong>Traditionnelle avec des performances maximales</strong></p>\r\n\r\n<p class=\"p2\">La mini-pelle traditionnelle 35N est &eacute;cologique et garantit tous les standards de s&eacute;curit&eacute;.<br />\r\nLe dernier mod&egrave;le de moteur propre est conforme &agrave; la norme CE IIIA sur les &eacute;missions de gaz.<br />\r\nLes prestations et la stabilit&eacute; sont au-del&agrave; de toutes les attentes.</p>\r\n', '4227-35N4_cabin_3-4-dx-yellow.jpg', 'fr-FR', 1, 1, 80, 0, '2018-05-31 10:05:33', '2018-05-31 11:19:23', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(67, 282, '35N4', '', '<p class=\"p1\"><strong>Der Traditionelle mit H&ouml;chstleistungen</strong></p>\r\n\r\n<p class=\"p2\">Der traditionelle Minibagger 35N4 ist umweltfreundlich und gew&auml;hrleistet h&ouml;chste Sicherheitsstandards.</p>\r\n\r\n<p class=\"p2\">Die Abgasemissionen des letzten umweltschonenden Motormodells erf&uuml;llen die Anforderungen&nbsp;f&uuml;r Stufe IIIA der EU-Abgasnorm. H&ouml;here Leistungen und Stabilit&auml;t weit &uuml;ber allen Erwartungen.</p>\r\n', '4227-35N4_cabin_3-4-dx-yellow.jpg', 'de-DE', 1, 1, 80, 0, '2018-05-31 10:06:06', '2018-05-31 11:19:18', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(68, 282, '35N4', '', '<p><strong>Tradicional con m&aacute;ximo redimiento</strong></p>\r\n\r\n<p>La miniexcavadora tradicional 35N4, cuida el medio ambiente y cumple con todos&nbsp;los est&aacute;ndares de seguridad.</p>\r\n\r\n<p>Equipada con motor limpio de &uacute;ltima generaci&oacute;n&nbsp;cumpliendo con la normativa de emisi&oacute;n de gases CE Stage IIIA.</p>\r\n\r\n<p>Rendimiento&nbsp;muy superior y con una estabilidad que supera todas las expectativas.</p>\r\n', '4227-35N4_cabin_3-4-dx-yellow.jpg', 'es-ES', 1, 1, 80, 0, '2018-05-31 10:06:53', '2018-05-31 14:57:18', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(69, 283, '35V4', '', '<p><strong>Maximum stability and operation</strong></p>\r\n\r\n<p>The zero tail swing technology makes it possible to dig and load in complete safety, even close to walls or in restricted spaces. Yanmar 3TNV88 engine.</p>\r\n\r\n<p>The variable gauge 1550-1800 mm, the only one in its category, considerably increases stability when digging at the side, making it possible to work, even in particularly difficult conditions.</p>\r\n', '32854-35v4-yellow_mini.jpg', 'en-EN', 1, 1, 90, 0, '2018-05-31 10:08:31', '2018-05-31 14:53:46', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(70, 283, '35V4', '', '<p><strong>Operativit&agrave; e stabilit&agrave;</strong></p>\r\n\r\n<p>Rotazione entro la sagoma dei cingoli e carro estensibile garantiscono operazioni di scavo e di carico anche in prossimit&agrave; di muri.</p>\r\n\r\n<p>Motore Yanmar 3TNV88. Il carro allargabile di 1550-1800 mm, unico nella sua categoria, incrementa notevolmente la stabilit&agrave; nello scavo laterale consentendo di lavorare anche in condizioni particolarmente difficili.</p>\r\n\r\n<p>Forza di strappo al dente benna di 29,1kN.</p>\r\n', '32854-35v4-yellow_mini.jpg', 'it-IT', 1, 1, 90, 0, '2018-05-31 10:09:28', '2018-05-31 14:54:22', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(71, 283, '35V4', '', '<p><strong>Fonctionnelle et stable</strong></p>\r\n\r\n<p>La rotation &agrave; l&rsquo;int&eacute;rieure des chenilles et la voie variable permettent de r&eacute;aliser des travaux de creusage et de chargement &agrave; proximit&eacute; de murs. Moteur Yanmar 3TNV88.</p>\r\n\r\n<p>La largeur de la voie variable de 1550 &agrave; 1800 mm, unique dans sa cat&eacute;gorie, augmente de mani&egrave;re significative la stabilit&eacute; lors de travaux d&rsquo;excavation permettant ainsi de travailler dans des conditions difficiles.</p>\r\n', '32854-35v4-yellow_mini.jpg', 'fr-FR', 1, 1, 90, 0, '2018-05-31 10:13:16', '2018-05-31 14:56:28', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(72, 283, '35V4', '', '<p><strong>Einsatzf&auml;higkeit und Stabilit&auml;t</strong></p>\r\n\r\n<p>Die Drehung innerhalb des Profils der Raupenketten und der verbreiterbare Unterwagen erlauben Aushub- und Ladearbeiten auch in der N&auml;he von Mauern. Motor Yanmar 3TNV88.<br />\r\nDas in der Breite von 1550 bis 1800 mm verstellbare Fahrwerk, einzigartig in seiner Klasse,&nbsp;erh&ouml;ht betr&auml;chtlich die Stabilit&auml;t bei seitlichen Grabarbeiten und erm&ouml;glicht den Betrieb selbst&nbsp;unter besonders schwierigen Einsatzbedingungen.</p>\r\n', '32854-35v4-yellow_mini.jpg', 'de-DE', 1, 1, 90, 0, '2018-05-31 10:14:15', '2018-05-31 14:56:49', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(73, 283, '35V4', '', '<p class=\"p1\"><strong>Operatividad y estabilidad</strong></p>\r\n\r\n<p class=\"p2\">La rotaci&oacute;n dentro del g&aacute;libo de las orugas y el carro extensible garantizan operaciones de excavaci&oacute;n y carga, incluso cerca de paredes. Motor Yanmar 3TNV88.</p>\r\n\r\n<p class=\"p2\">El carro extensible&nbsp;de 1550-1800 mm, &uacute;nico en su categor&iacute;a, aumenta considerablemente la estabilidad en la excavaci&oacute;n lateral con lo cual es posible trabajar tambi&eacute;n en condiciones especialmente dif&iacute;ciles.</p>\r\n', '32854-35v4-yellow_mini.jpg', 'es-ES', 1, 1, 90, 0, '2018-05-31 10:16:06', '2018-05-31 11:18:37', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(74, 284, '45V4', '', '<p><strong>Maximum performance</strong></p>\r\n\r\n<p>Thanks to zero tail swing technology it is possible to dig and load in complete safety, even close to walls or in restricted spaces. KUBOTA V2403-DI-EDM engine, max. bucket digging force 31.0 kN.</p>\r\n\r\n<p>Swing speed of 9.3 rpm enables optimum performance during all operations.</p>\r\n', '50096-45v4_3-4-Yellow_mini.jpg', 'en-EN', 1, 1, 100, 0, '2018-05-31 10:17:52', '2018-05-31 14:48:13', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(75, 284, '45V4', '', '<p><strong>Maximum performance</strong></p>\r\n\r\n<p>Thanks to zero tail swing technology it is possible to dig and load in complete safety, even close to walls or in restricted spaces. KUBOTA V2403-DI-EDM engine, max. bucket digging force 31.0 kN.</p>\r\n\r\n<p>Swing speed of 9.3 rpm enables optimum performance during all operations.</p>\r\n', '50096-45v4_3-4-Yellow_mini.jpg', 'it-IT', 1, 1, 100, 0, '2018-05-31 10:21:27', '2018-05-31 14:49:13', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(76, 284, '45V4', '', '<p><strong>Performances maximales</strong></p>\r\n\r\n<p>Les op&eacute;rations de creusage et de chargement &agrave; proximit&eacute; de murs ou dans des endroits exigus sont possibles gr&acirc;ce &agrave; la rotation &agrave; l&rsquo;int&eacute;rieure des chenilles.</p>\r\n\r\n<p>Moteur Kubota V2403 -DI- EDM. La force de creusage est de 31 kN.</p>\r\n\r\n<p>La vitesse de rotation de 9,3 tours/min assure un rendement de travail effectif.</p>\r\n', '50096-45v4_3-4-Yellow_mini.jpg', 'fr-FR', 1, 1, 100, 0, '2018-05-31 10:23:04', '2018-05-31 14:52:33', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(77, 284, '45V4', '', '<p class=\"p1\"><strong>H&ouml;chstleistungen</strong></p>\r\n\r\n<p class=\"p2\">Aushub- und Ladearbeiten auch in der N&auml;he von Mauern und an Orten&nbsp;mit begrenztem Platzangebot dank der Drehung innerhalb der Fahrwerkbreite.</p>\r\n\r\n<p class=\"p2\">Motor KUBOTA V2403-DI-EDM, Ausbrechkraft am L&ouml;ffelzahn 31,0 kN.</p>\r\n\r\n<p class=\"p2\">Die Drehgeschwindigkeit von 9,3 rpm erlaubt optimale Arbeitsleistungen.</p>\r\n', '50096-45v4_3-4-Yellow_mini.jpg', 'de-DE', 1, 1, 100, 0, '2018-05-31 10:24:03', '2018-05-31 11:17:54', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(78, 284, '45V4', '', '<p><strong>M&aacute;ximas prestaciones</strong></p>\r\n\r\n<p>Operaciones de excavaci&oacute;n y carga incluso cerca de paredes o en lugares con&nbsp;poco espacio, gracias a la rotaci&oacute;n dentro del g&aacute;libo. Motor KUBOTA V2403-DI-EDM&nbsp;y fuerza de arranque en diente de cuchara de 31,0 kN.</p>\r\n\r\n<p>La velocidad de rotaci&oacute;n&nbsp;de 9,3 rpm permite obtener &oacute;ptimas prestaciones durante el trabajo.</p>\r\n', '50096-45v4_3-4-Yellow_mini.jpg', 'es-ES', 1, 1, 100, 0, '2018-05-31 10:24:58', '2018-05-31 14:51:58', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(79, 285, '55V4', '', '<p><strong>Reliable</strong></p>\r\n\r\n<p>High performance and full dependability, but also an exceptional level of operational safety and easy maintenance. Operation in confined spaces is excellent thanks to zero-tail swing technology. KUBOTA V2403-DI-EDM engine, max. bucket digging force 31.0 kN.</p>\r\n\r\n<p>Swing speed of 9.3 rpm ensures higher performance during work cycles.</p>\r\n', '32129-55v4_3-4dxfronte-yellow.jpg', 'en-EN', 1, 1, 110, 0, '2018-05-31 10:26:49', '2018-05-31 14:45:12', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(80, 285, '55V4', '', '<p><strong>Accessibilit&agrave; e affidabilit&agrave;</strong></p>\r\n\r\n<p>Elevate performances, massima affidabilit&agrave; e sicurezza operativa.&nbsp;</p>\r\n\r\n<p>Accessibilit&agrave; e facilit&agrave; di manutenzione. Operativit&agrave; in spazi ristretti grazie al telaio posteriore che ruota entro la sagoma dei cingoli. Motore KUBOTA V2403-DI-EDM. Forza di strappo al dente benna 31,0 kN. La velocit&agrave; di rotazione di 9,3 rpm consente maggiori performance durante il lavoro.</p>\r\n', '32129-55v4_3-4dxfronte-yellow.jpg', 'it-IT', 1, 1, 110, 0, '2018-05-31 10:27:38', '2018-05-31 14:46:21', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(81, 285, '55V4', '', '<p><strong>Accessibilit&eacute; et fiabilit&eacute;</strong></p>\r\n\r\n<p>Haute performance, fiabilit&eacute; et s&eacute;curit&eacute; en fonctionnement. Accessibilit&eacute; et facilit&eacute; d&rsquo;entretien.<br />\r\nLes op&eacute;rations dans les espaces exigus sont possibles gr&acirc;ce au train arri&egrave;re qui tourne &agrave;<br />\r\nl&rsquo;int&eacute;rieure des chenilles. Moteur Kubota V2403 -DI- EDM, la force de creusage est de 31 kN.<br />\r\nLa vitesse de rotation de 9,3 tours/min assure un rendement de travail effectif.</p>\r\n', '32129-55v4_3-4dxfronte-yellow.jpg', 'fr-FR', 1, 1, 110, 0, '2018-05-31 10:28:49', '2018-05-31 14:46:46', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(82, 285, '55V4', '', '<p><strong>Zug&auml;nglichkeit und Zuverl&auml;ssigkeit</strong></p>\r\n\r\n<p>Hohe Leistungen, maximale Zuverl&auml;ssigkeit und Betriebssicherheit. Zug&auml;nglichkeit und<br />\r\neinfache Wartung. Betrieb auf engstem Raum dank der Drehung des Fahrzeughecks innerhalb<br />\r\nder Fahrwerkbreite. Motor KUBOTA V2403-DI-EDM, Rei&szlig;kraft am L&ouml;ffelzahn 31,0 kN.<br />\r\nDie Drehgeschwindigkeit von 9,3 rpm erlaubt h&ouml;here Arbeitsleistungen.</p>\r\n', '32129-55v4_3-4dxfronte-yellow.jpg', 'de-DE', 1, 1, 110, 0, '2018-05-31 10:29:20', '2018-05-31 14:47:09', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(83, 285, '55V4', '', '<p><strong>Accesibilidad y fiabilidad</strong></p>\r\n\r\n<p>Elevadas prestaciones, m&aacute;xima fiabilidad y seguridad operativa. Accesibilidad y f&aacute;cil&nbsp;ejecuci&oacute;n del mantenimiento. Operatividad en espacios reducidos gracias al chasis&nbsp;trasero que gira dentro del g&aacute;libo de las orugas. Motor KUBOTA V2403-DI-EDM y fuerza&nbsp;de arranque en diente de cuchara de 31,0 kN.</p>\r\n\r\n<p>La velocidad de rotaci&oacute;n de 9,3 rpm&nbsp;permite obtener mayores prestaciones durante el trabajo.</p>\r\n', '32129-55v4_3-4dxfronte-yellow.jpg', 'es-ES', 1, 1, 110, 0, '2018-05-31 10:30:10', '2018-05-31 14:47:31', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(84, 286, '55N4', '', '<p><strong>Top of the range performance</strong></p>\r\n\r\n<p>The high-power engine, combined with a hydraulic system featuring variable displacement pumps, offers top-of-the-range performance.</p>\r\n\r\n<p>Bucket digging force of 36.3 kN translates into maximum digging capability, even on particularly compacted ground.</p>\r\n', '37470-55N4_3-4_dx_cover-yellow_mini.jpg', 'en-EN', 1, 1, 120, 0, '2018-05-31 10:30:56', '2018-05-31 14:42:39', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(85, 286, '55N4', '', '<p><strong>Prestazioni al top della categoria</strong></p>\r\n\r\n<p>Il motore di elevata potenza YANMAR 4TNV98C-PIK combinato con un impianto idraulico con pompe a portata variabile consente l&rsquo;ottenimento di prestazioni al top di categoria.</p>\r\n\r\n<p>Una forza di strappo al dente di 36,3 kN si traduce nella massima facilit&agrave; di scavo anche in terreni particolarmente compatti.</p>\r\n', '37470-55N4_3-4_dx_cover-yellow_mini.jpg', 'it-IT', 1, 1, 120, 0, '2018-05-31 10:32:21', '2018-05-31 14:42:02', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(86, 286, '55N4', '', '<p><strong>Prestations au top de sa cat&eacute;gorie</strong></p>\r\n\r\n<p>La puissance du moteur et la pompe hydraulique &agrave; d&eacute;bit variable, permettent des prestations&nbsp;au top de sa cat&eacute;gorie.</p>\r\n\r\n<p>La force de p&eacute;n&eacute;tration du godet de 36,3 kN, se traduit par la tr&egrave;s grande facilit&eacute; de creusage m&ecirc;me sur des terrains particuli&egrave;rement compacts.</p>\r\n', '37470-55N4_3-4_dx_cover-yellow_mini.jpg', 'fr-FR', 1, 1, 120, 0, '2018-05-31 10:33:10', '2018-05-31 14:43:14', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(87, 286, '55N4', '', '<p><strong>Leistungen an der Spitze der Kategorie</strong></p>\r\n\r\n<p>F&uuml;r &uuml;berlegene Leistungen sorgen der leistungsstarke Motor und eine Hydraulikanlage mit Verstellpumpen.</p>\r\n\r\n<p>Durch die hohe Eindringkraft des L&ouml;ffels von 36,3 kN lassen sich auch Grabungsarbeiten in besonders harten B&ouml;den m&uuml;helos ausf&uuml;hren.</p>\r\n', '37470-55N4_3-4_dx_cover-yellow_mini.jpg', 'de-DE', 1, 1, 120, 0, '2018-05-31 10:34:12', '2018-05-31 14:43:55', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(88, 286, '55N4', '', '<p><strong>M&aacute;ximas prestaciones en su categor&iacute;a</strong></p>\r\n\r\n<p>Con un motor de elevada potencia y combinado con un circuito hidr&aacute;ulico con bombas de caudal variable, permiten obtener el m&aacute;ximo rendimiento de su categor&iacute;a.</p>\r\n\r\n<p>Con una fuerza de excavaci&oacute;n&nbsp;de 36,3 kN, conseguimos excavar con facilidad, incluso en los terrenos m&aacute;s compactos.</p>\r\n', '37470-55N4_3-4_dx_cover-yellow_mini.jpg', 'es-ES', 1, 1, 120, 0, '2018-05-31 10:35:01', '2018-05-31 14:44:43', 'a:1:{s:4:\"tonn\";s:14:\"3.5 - 5.5 Tons\";}'),
(89, 287, '60V4', '', '<p><strong>Top of the range performance</strong></p>\r\n\r\n<p>The high-power engine, combined with a hydraulic system featuring variable displacement&nbsp;pumps, offers top-of-the-range performance.</p>\r\n\r\n<p>Max. bucket digging force of 36.3 kN translates&nbsp;into maximum digging capability, even on particularly compacted ground.</p>\r\n', '66571-60v4-yellow.jpg', 'en-EN', 1, 1, 130, 0, '2018-05-31 10:39:51', '2018-05-31 14:39:46', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(91, 287, '60V4', '', '<p><strong>Massima operativit&agrave;</strong></p>\r\n\r\n<p>Il motore di elevata potenza combinato con un impianto idraulico con pompe a portata variabile consente prestazioni al top di categoria.</p>\r\n\r\n<p>Una forza di strappo al dente di 41,2 kN si traduce nella massima facilit&agrave; di scavo anche in terreni particolarmente compatti.</p>\r\n', '66571-60v4-yellow.jpg', 'it-IT', 1, 1, 130, 0, '2018-05-31 10:42:03', '2018-05-31 14:40:11', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(90, 287, '60V4', '', '<p><strong>M&aacute;xima operatividad</strong></p>\r\n\r\n<p>El motor de elevada potencia, combinado con un circuito hidr&aacute;ulico con bombas de caudal&nbsp;variable, permite obtener prestaciones al m&aacute;ximo de su categor&iacute;a.</p>\r\n\r\n<p>La fuerza de penetraci&oacute;n&nbsp;en la cuchara de 41,2 kN facilita la excavaci&oacute;n incluso en los terrenos m&aacute;s compactos.</p>\r\n', '66571-60v4-yellow.jpg', 'es-ES', 1, 1, 130, 0, '2018-05-31 10:40:47', '2018-05-31 14:41:25', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(92, 287, '60V4', '', '<p><strong>Performances maximales</strong></p>\r\n\r\n<p>Le moteur de puissance &eacute;lev&eacute; combin&eacute; au syst&egrave;me hydraulique &eacute;quip&eacute; de pompes &agrave; d&eacute;bit variable permet d&rsquo;obtenir des prestations au top de cette cat&eacute;gorie.</p>\r\n\r\n<p>La force de creusage est de 41,2 kN ce qui permet de travailler facilement m&ecirc;me sur des terrains particuli&egrave;rement compacts.</p>\r\n', '66571-60v4-yellow.jpg', 'fr-FR', 1, 1, 130, 0, '2018-05-31 10:42:38', '2018-05-31 14:40:31', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(93, 287, '60V4', '', '<p><strong>Maximale Einsatzf&auml;higkeit</strong></p>\r\n\r\n<p>F&uuml;r Spitzenleitungen der Klasse sorgen der leistungsstarke Motor und eine Hydraulikanlage mit Verstellpumpen.</p>\r\n\r\n<p>Dank der hohen Eindringkraft des L&ouml;ffels von 41,2 kN lassen sich Grabungsarbeiten selbst in besonders harten B&ouml;den m&uuml;helos ausf&uuml;hren.</p>\r\n', '66571-60v4-yellow.jpg', 'de-DE', 1, 1, 130, 0, '2018-05-31 10:43:26', '2018-05-31 14:40:51', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(94, 288, '85V4', '', '<p><strong>Maximum performances in confined spaces</strong></p>\r\n<p>The midi-excavator 85V4 is synonymous with power and stability.</p>\r\n<p>Thanks to the rear frame, it is possible to dig and load in complete safety even close to walls or places with little room available.</p>\r\n<p>The speed of rotation of 9 rpm enables optimum performance during work.</p>\r\n', '47715-85V4_3-4_fronte-yellow.jpg', 'en-EN', 1, 1, 140, 0, '2018-05-31 10:46:21', '2018-05-31 14:20:46', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(95, 288, '85V4', '', '<p><strong>Prestazioni massime in luoghi angusti</strong></p>\r\n\r\n<p>Il miniescavatore 85V4 &egrave; sinonimo di potenza e stabilit&agrave;.</p>\r\n\r\n<p>Grazie al telaio posteriore &egrave; possibile effettuare in piena sicurezza le operazioni di scavo e di carico anche in prossimit&agrave; di muri o luoghi con poco spazio a disposizione.</p>\r\n\r\n<p>La velocit&agrave; di rotazione di 9 giri/min combinata ad una forza&nbsp;di strappo al dente di ben 55 kN consentono ottime performance durante il lavoro.</p>\r\n', '47715-85V4_3-4_fronte-yellow.jpg', 'it-IT', 1, 1, 140, 0, '2018-05-31 10:47:59', '2018-05-31 14:38:03', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(96, 288, '85V4', '', '<p><strong>Prestations maximales dans les lieux &eacute;troits</strong></p>\r\n\r\n<p>La mini-pelle 85V4 est synonyme de puissance et de stabilit&eacute;.</p>\r\n\r\n<p>Gr&acirc;ce &agrave; son ch&acirc;ssis arri&egrave;re,&nbsp;il est possible d&rsquo;effectuer en toute s&eacute;curit&eacute; les op&eacute;rations de creusage et de chargement&nbsp;pr&egrave;s des murs, ou dans des lieux &eacute;troits.</p>\r\n\r\n<p>La vitesse de rotation de 9 tr/min permet des performances optimales durant le travail.</p>\r\n', '47715-85V4_3-4_fronte-yellow.jpg', 'fr-FR', 1, 1, 140, 0, '2018-05-31 10:48:49', '2018-05-31 14:38:40', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(97, 288, '85V4', '', '<p>Zeigt h&ouml;chste Leistungen in stark beengten Bereichen</p>\r\n\r\n<p>Der Mittelbagger 85V4 ist Synonym f&uuml;r Leistung und Stabilit&auml;t. Der Fahrer kann in v&ouml;lliger&nbsp;Sicherheit Grab- und Beladungsarbeiten auch an Mauern oder auf beengtem Raum ausf&uuml;hren.&nbsp;</p>\r\n\r\n<p>Die Drehzahl von 9 rpm erm&ouml;glicht h&ouml;here Arbeitsleistungen.</p>\r\n', '47715-85V4_3-4_fronte-yellow.jpg', 'de-DE', 1, 1, 140, 0, '2018-05-31 10:49:34', '2018-05-31 14:39:00', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}'),
(98, 288, '85V4', '', '<p><strong>Prestaciones m&aacute;ximas en lugares angostos</strong></p>\r\n\r\n<p>La miniexcavadora 85V4 es sin&oacute;nimo de potencia y estabilidad.</p>\r\n\r\n<p>Gracias al chasis&nbsp;trasero es posible efectuar operaciones de excavaci&oacute;n y carga en plena seguridad,&nbsp;incluso cerca de paredes o en espacios estrechos.</p>\r\n\r\n<p>La velocidad de rotaci&oacute;n&nbsp;de 9 rpm permite excelentes prestaciones durante el trabajo.</p>\r\n', '47715-85V4_3-4_fronte-yellow.jpg', 'es-ES', 1, 1, 140, 0, '2018-05-31 10:50:28', '2018-05-31 14:39:23', 'a:1:{s:4:\"tonn\";s:14:\"3.0 - 8.5 Tons\";}');
INSERT INTO `tbl_items` (`ID_item`, `ID_cat`, `Titolo`, `Sottotitolo`, `Descrizione`, `Immagine`, `Lingua`, `Attiva`, `Pubblica`, `Ordine`, `Evidenza`, `Data_creazione`, `Data_modifica`, `Attributi`) VALUES
(99, 289, 'Carry105', 'Tipping bucket with self-loading shovel', '<p><strong>Agility and versatility</strong></p>\r\n\r\n<p>The new Carry 105 mini-dumper is a highly agile and versatile machine, designed for handling materials in warehouses and greenhouses and especially suitable for nurseries and agricultural use.</p>\r\n', '2168-Carry105-dx-3-4-retro.jpg', 'en-EN', 1, 1, 10, 0, '2018-05-31 12:43:43', '2018-05-31 15:37:33', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(121, 303, 'IC35', '', '<p><strong>Powerful and sturdy</strong></p>\r\n\r\n<p>Power to accomplish hard work. Exceptionally easy to use, with an extremely sturdy structure and easy to maintain.</p>\r\n', '93598-IC35-3-4-front-dx.jpg', 'en-EN', 1, 1, 30, 0, '2018-05-31 15:42:26', '2018-05-31 15:42:48', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(100, 271, 'Mini-Transporteurs', '', '<p>Polyvalents dans toutes situations</p>\r\n', '17581-Carry110-trilaterale-dx-3-4-retro.jpg', 'fr-FR', 1, 1, 20, 0, '2018-05-31 12:46:34', '2018-05-31 15:26:17', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(101, 271, 'Minidumper', '', '<p>Vielseitig In allen Situationen</p>\r\n', '17581-Carry110-trilaterale-dx-3-4-retro.jpg', 'de-DE', 1, 1, 20, 0, '2018-05-31 12:47:36', '2018-05-31 15:24:19', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(102, 271, 'Minidumper', '', '<p>Versatilidad. En cualquier situaci&oacute;n.</p>\r\n', '17581-Carry110-trilaterale-dx-3-4-retro.jpg', 'es-ES', 1, 1, 20, 0, '2018-05-31 12:48:20', '2018-05-31 15:27:28', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(103, 289, 'Carry105', 'cassone con pala', '<p><strong>Agilit&agrave; e versatilit&agrave;</strong></p>\r\n\r\n<p>Il nuovo minidumper Carry 105 &egrave; agile e versatile, sviluppato per venire&nbsp;incontro alle esigenze di movimentazione di materiale all&rsquo;interno di capannoni&nbsp;<span style=\"line-height: 1.6em;\">o serre, particolarmente indicato per utilizzi nella vivaistica e in agricoltura.</span></p>\r\n', '2168-Carry105-dx-3-4-retro.jpg', 'it-IT', 1, 1, 10, 0, '2018-05-31 12:50:43', '2018-05-31 15:51:45', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(104, 289, 'Carry105', 'Benne et pelle', '<p><strong>Souplesse et polyvalence</strong></p>\r\n\r\n<p>Le mini-transporteur Carry 105 est souple et polyvalent. Con&ccedil;u pour pallier&nbsp;&agrave; tous les d&eacute;placements de mat&eacute;riels &agrave; l&rsquo;int&eacute;rieur d&rsquo;hangars ou de serres,&nbsp;particuli&egrave;rement indiqu&eacute; pour les travaux d&rsquo;espaces verts ou dans l&rsquo;agriculture.</p>\r\n', '2168-Carry105-dx-3-4-retro.jpg', 'fr-FR', 1, 1, 10, 0, '2018-05-31 12:51:57', '2018-05-31 15:59:41', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(105, 289, 'Carry105', 'Kippmulde mit Schaufel', '<p><strong>Wendigkeit und Vielseitigkeit</strong></p>\r\n\r\n<p>Der neue Minidumper Carry 105 ist wendig und vielseitig, eigens f&uuml;r die besonderen Anforderungen des Materialumschlags in Werkhallen oder Gew&auml;chsh&auml;usern ausgelegt und somit besonders f&uuml;r den Einsatz in Pflanzenschulen und in der Landwirtschaft bestimmt.</p>\r\n', '2168-Carry105-dx-3-4-retro.jpg', 'de-DE', 1, 1, 10, 0, '2018-05-31 12:52:45', '2018-05-31 16:01:50', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(106, 289, 'Carry105', 'Tolva con pala autocargable', '<p><strong>Agilidad y versatilidad</strong></p>\r\n\r\n<p>El nuevo minidumper Carry 105 es &aacute;gil y vers&aacute;til, desarrollado para responder a las exigencias de manutenci&oacute;n de material en naves industriales o invernaderos, particularmente indicado para el uso en viveros y en agricultura.</p>\r\n', '2168-Carry105-dx-3-4-retro.jpg', 'es-ES', 1, 1, 10, 0, '2018-05-31 12:53:37', '2018-05-31 15:55:09', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(107, 290, 'Carry105', 'Dump platform with opening sides', '<p><strong>Speed and adaptability</strong></p>\r\n\r\n<p>The version of the Carry 105 mini-dumper with a dump platform with opening sides that are ideal for loading bulky material and handling materials in warehouses and greenhouses and especially suitable for nurseries and agricultural use.</p>\r\n', '1216-Carry105-pianale-dx.jpg', 'en-EN', 1, 1, 20, 0, '2018-05-31 13:13:43', '2018-05-31 15:36:59', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(108, 291, 'Carry105 Electripower', 'Tipping bucket with self-loading shovel', '<p><strong>Ecological without compromise</strong></p>\r\n\r\n<p>The electric power Carry105 mini-dumper, is the ideal solution to satisfy the requirements of materials handling in closed spaces such as green-houses, it is ideally suited for nurseries&nbsp;and in agriculture and for all sensitive places such as schools, hospitals and in rooms with&nbsp;little ventilation, it is eco friendly, being electric, with no noise or gas fumes.</p>\r\n', '2581-Carry105ep-dx-3-4-retro-ribalt-NEW.jpg', 'en-EN', 1, 1, 30, 0, '2018-05-31 13:16:30', '2018-05-31 15:36:16', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(109, 292, 'Carry107', 'Tipping bucket with self-loading shovel', '<p><strong>Fast, safe, tireless</strong></p>\r\n\r\n<p>The Carry 107 mini-dumper is the ideal solution to transport and handle&nbsp;various types of materials on site particularly in areas where access is difficult.</p>\r\n\r\n<p>Variable gauge from 760 to 1060 mm for greater stability.&nbsp;</p>\r\n\r\n<p>The self-loading shovel can transfer all sorts of material, such as rubble, earth,&nbsp;and aggregate, into the skip quickly and safely, with minimum operator effort.</p>\r\n', '85493-CARRY107-01-laterale-dx-pedanaopen.jpg', 'en-EN', 1, 1, 40, 0, '2018-05-31 13:18:23', '2018-05-31 15:35:31', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(110, 293, 'Carry107', 'Concrete mixer with self-loading shovel', '<p><strong>Snappy, ideal on site</strong></p>\r\n\r\n<p>The Carry 107 mini-dumper is fitted with a concrete mixer, it then becomes irreplaceable friend on site to mix sand and aggregate quickly, safely and without any effort from the operator.</p>\r\n\r\n<p>Tank/yield total capacity, 250/190 litres. Variable gauge, from 760 to 1060 mm, for greater stability.</p>\r\n', '25108-Carry107-betoniera-dx-3-4-retro.jpg', 'en-EN', 1, 1, 50, 0, '2018-05-31 13:21:54', '2018-05-31 15:34:08', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(111, 294, 'Carry107', 'Dump platform with opening sides', '<p><strong>Extremely versatile</strong></p>\r\n\r\n<p>This version of the Carry 107 mini-dumper, with a dump platform with opening sides&nbsp;is the ideal solution for transporting and handling bulky material on site, quickly,&nbsp;safely and with minimum effort for the operator.</p>\r\n\r\n<p>Dimensions of the platform&nbsp;990 x 790 x 200 / 1240 x 1290 mm (sides closed / sides open) (D x L x H).</p>\r\n\r\n<p>Variable gauge, from 760 to 1060 mm, for greater stability.</p>\r\n', '73296-Carry107-pianale-dx-3-4-retro.jpg', 'en-EN', 1, 1, 60, 0, '2018-05-31 13:25:27', '2018-05-31 15:33:25', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(122, 302, 'Transporteurs', '', '<p>Robustes, puissantes et faciles &agrave; utiliser</p>\r\n', '76234-IC35-3-4-front-dx.jpg', 'fr-FR', 1, 1, 30, 0, '2018-05-31 15:45:30', '2018-05-31 15:45:43', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(112, 295, 'Carry107', 'Levelling blade', '<p><strong>Perfect for levelling</strong></p>\r\n\r\n<p>The Carry 107 mini-dumper, version with levelling blade is suited for levelling soil and mixes.</p>\r\n\r\n<p>The angle on both sides of 30&deg; makes it perfect for clearing snow.</p>\r\n\r\n<p>The load-bearing frame,&nbsp;made as a containing platform, enables transportation of various tools, when being used as&nbsp;a &ldquo;snow plough&rdquo; including bags of salt for melting ice.</p>\r\n', '28981-Carry107-lama-neve-dx-3-4-fronte-B.jpg', 'en-EN', 1, 1, 70, 0, '2018-05-31 13:27:54', '2018-06-01 08:12:38', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(113, 296, 'Carry107ht', 'Tipping bucket with self-loading shovel', '<p><strong>Even more versatile</strong></p>\r\n\r\n<p>The brand new Carry 107ht model in the standard skip + self-loading shovel with variable gauge, from 760 to 1060 mm version, is ideal for transporting and handling materials. The &ldquo;hi-tip&rdquo; kit helps empty the skip from the top at the desired places, it reaches a maximum unloading height of 1600 mm. This version enables emptying material both directly onto a truck and into specific skips. In the &ldquo;hi-tip&rdquo; configuration, the raised position of the skip limits the use of the machine to flat and smooth surfaces.</p>\r\n', '86613-Carry107ht-scaricamento.jpg', 'en-EN', 1, 1, 80, 0, '2018-05-31 13:30:15', '2018-05-31 15:30:35', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(123, 302, 'Dumper', '', '<p>Robust, leistungsf&auml;hig und bedienerfreundlich</p>\r\n', '76234-IC35-3-4-front-dx.jpg', 'de-DE', 1, 1, 30, 0, '2018-05-31 15:47:11', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(114, 297, 'Carry110', 'Tipping bucket with self-loading shovel', '<p><strong>A broad range of accessories</strong></p>\r\n\r\n<p>Designed for building sites, roads, nurseries and all those situations where handling small&nbsp;and medium quantities of material is necessary in confined spaces.</p>\r\n\r\n<p>Available with a&nbsp;one/two-way auxiliary hydraulic power take-off, it can be quickly fitted with a wide range&nbsp;of replaceable attachments.</p>\r\n\r\n<p>This equipment is indispensable in aiding the bigger&nbsp;construction equipment in moving large quantities of material.</p>\r\n', '75249-Carry110-sx-3-4-fronte.jpg', 'en-EN', 1, 1, 90, 0, '2018-05-31 13:32:48', '2018-05-31 15:29:51', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(115, 298, 'Carry110', 'Concrete mixer with self-loading shovel', '<p><strong>Mixing within the reach of a mini-dumper</strong></p>\r\n\r\n<p>Designed for building sites, roads and all those situations where it is necessary to mix small quantities of building materials and to transport them to site. Tank/yield total capacity,&nbsp;of 350 / 280 litres. Available, with a one/two-way auxiliary hydraulic power take-off.</p>\r\n', '9516-Carry110-betoniera-sx-3-4-fronte.jpg', 'en-EN', 1, 1, 100, 0, '2018-05-31 13:34:22', '2018-05-31 15:28:39', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(124, 302, 'Dumper', '', '<p>Resistentes, potentes y f&aacute;ciles de usar</p>\r\n', '76234-IC35-3-4-front-dx.jpg', 'es-ES', 1, 1, 30, 0, '2018-05-31 15:48:02', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(116, 299, 'Carry110', 'Trilateral dump platform', '<p><strong>Ideal for transporting bulky material</strong></p>\r\n\r\n<p>Designed for building sites and roads, this version with a trilateral dump platform is ideal for transporting and unloading loose materials used for road construction.</p>\r\n\r\n<p>Dimensions of the unloading bed 1300 x 970 x 350 mm (D x L x H). Available with one/two-way auxiliary hydraulic power take-off.</p>\r\n', '21490-Carry110-trilaterale-dx-3-4-retro.jpg', 'en-EN', 1, 1, 110, 0, '2018-05-31 13:36:15', '2018-05-31 15:26:57', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(120, 302, 'Dumper', '', '<p>Versatili, potenti, robusti per ogni utilizzo e su ogni terreno</p>\r\n', '76234-IC35-3-4-front-dx.jpg', 'it-IT', 1, 1, 30, 0, '2018-05-31 14:18:20', '2018-05-31 15:45:58', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(117, 300, 'Carry150', '', '<p><strong>Versatility for all needs</strong></p>\r\n\r\n<p>Tracked dumper with hydrostatic transmission having 2 independent circuits with variable displacement axial piston pump and two speeds axial piston motor for each track.</p>\r\n\r\n<p>Central driving seat at rear side of the machine, cushioned and adjustable, with easy access from both sides.</p>\r\n', '31099-Carry150_3-4-retro.jpg', 'en-EN', 1, 1, 10, 0, '2018-05-31 13:40:32', '2018-05-31 15:40:27', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(118, 301, 'Carry250', '', '<p><strong>All terrains tracked dumper</strong></p>\r\n\r\n<p>Tracked dumper with hydrostatic transmission having 2 independent circuits with variable displacement axial piston pump and two speeds axial piston motor for each track.</p>\r\n\r\n<p>Chassis with modular structure composed of a tractor unit set up on a unifi ed frame apt&nbsp;to receive various attachments. undercarriage with oscillating axles and rubber tracks,&nbsp;suitable for high speeds. The considerable ground clearance allows the easy motion&nbsp;even on dirt patches and on rough terrains.</p>\r\n', '53455-Carry250_3-4-fronte.jpg', 'en-EN', 1, 1, 20, 0, '2018-05-31 13:41:46', '2018-05-31 15:39:30', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(119, 302, 'Dumper', '', '<p>Versatile, powerful and sturdy&nbsp;for every type of use&nbsp;and&nbsp;for all terrains</p>\r\n', '76234-IC35-3-4-front-dx.jpg', 'en-EN', 1, 1, 30, 0, '2018-05-31 13:52:23', '2018-05-31 14:19:40', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(127, 299, 'Carry110', 'Dreiseitige Kippmulde', '<p><strong>Ideal f&uuml;r den Transport von sperrigem Material</strong></p>\r\n\r\n<p>Besonders f&uuml;r den Transport von Baumaterial und sperrigem Material geeignet sowie f&uuml;r den Transport und das Ausladen von Sch&uuml;ttgut im Stra&szlig;enbau, mit der M&ouml;glichkeit, an verschiedenen Stellen Teilladungen aussch&uuml;tten zu k&ouml;nnen, ohne Positionierungsman&ouml;ver ausf&uuml;hren zu m&uuml;ssen. Abmessungen der Pritsche 1300 x 970 x 350 (T x L x H).</p>\r\n\r\n<p>Dieses Modell hat eine hydraulische mono-/bidirektionale Zusatzzapfwelle.</p>\r\n', '21490-Carry110-trilaterale-dx-3-4-retro.jpg', 'de-DE', 1, 1, 110, 0, '2018-05-31 16:13:41', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(128, 299, 'Carry110', 'Tolva de descarga trilateral', '<p><strong>Ideal para el transporte de material voluminoso</strong></p>\r\n\r\n<p>Dise&ntilde;ada para obras de construcci&oacute;n y obras viales, la versi&oacute;n con tolva de descarga trilateral resulta ideal para transportar y descargar materiales sueltos para la consolidaci&oacute;n de carreteras, con la posibilidad de una descarga parcial en los puntos deseados sin tener que ejecutar maniobras de posicionamiento. Medidas de la plataforma de descarga 1300 x 970 x 350 mm (P x L x H).</p>\r\n\r\n<p>Disponible con toma de fuerza hidr&aacute;ulica auxiliar mono/bidireccional.</p>\r\n', '21490-Carry110-trilaterale-dx-3-4-retro.jpg', 'es-ES', 1, 1, 110, 0, '2018-05-31 16:15:27', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(129, 298, 'Carry110', 'Betoniera con pala', '<p>Il mescolamento a portata di minidumper</p>\r\n\r\n<p>Progettata per cantieri edili, stradali e per tutte quelle situazioni dov&rsquo;&egrave; necessario impastare ridotte quantit&agrave; di conglomerati per edilizia e trasportarli sul luogo di utilizzo. Capacit&agrave; totale vasca/resa 350/280 litri.</p>\r\n\r\n<p>Disponibile con presa di forza idraulica ausiliare mono/bidirezionale.</p>\r\n', '9516-Carry110-betoniera-sx-3-4-fronte.jpg', 'it-IT', 1, 1, 100, 0, '2018-05-31 16:17:34', '2018-05-31 16:17:55', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(130, 298, 'Carry110', 'BÃ©tonniÃ¨re et pelle', '<p><strong>Le malaxage &agrave; port&eacute;e du mini-transporteur</strong></p>\r\n\r\n<p>Etudi&eacute; pour les chantiers de construction, ou routiers, et pour toutes les situations o&ugrave; il est n&eacute;cessaire de malaxer de petites quantit&eacute;s de conglom&eacute;r&eacute;s pour la construction et les transporter sur les lieux d&rsquo;utilisation. La capacit&eacute; totale cuve/rendement est de 350/280 l.</p>\r\n\r\n<p>Disponible avec une prise de force auxiliaire hydraulique mono/bidirectionnelle.</p>\r\n', '9516-Carry110-betoniera-sx-3-4-fronte.jpg', 'fr-FR', 1, 1, 100, 0, '2018-05-31 16:19:50', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(131, 298, 'Carry110', 'Betonmischer mit Schaufel', '<p>Betonmischen mit dem Minidumper</p>\r\n<p>Das Ger&auml;t eignet sich f&uuml;r das Mischen von kleinen Mengen Beton f&uuml;r das Bauwesen und f&uuml;r den Transport an den Bestimmungsort. Gesamtkapazit&auml;t der Wanne/Ausbeute 350/280 Liter.</p>\r\n<p>Dieses Modell hat eine hydraulische mono-/bidirektionale Zusatzzapfwelle.</p>\r\n', '9516-Carry110-betoniera-sx-3-4-fronte.jpg', 'de-DE', 1, 1, 100, 0, '2018-05-31 16:21:28', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(132, 298, 'Carry110', 'Hormigonera con pala', '<p><strong>La mezcla al alcance del minidumper</strong></p>\r\n\r\n<p>Dise&ntilde;ada para obras de construcci&oacute;n, obras viales y cualquier situaci&oacute;n que requiera amasar cantidades reducidas de conglomerados para la construcci&oacute;n y transportarlos al lugar de uso. Capacidad total de la cuba/rendimiento 350/280 litros.</p>\r\n\r\n<p>Disponible con toma de fuerza hidr&aacute;ulica auxiliar mono/bidireccional.</p>\r\n', '9516-Carry110-betoniera-sx-3-4-fronte.jpg', 'es-ES', 1, 1, 100, 0, '2018-05-31 16:23:00', '2018-05-31 16:23:16', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(133, 297, 'Carry110', 'cassone con pala', '<p><strong>Un&rsquo;ampia gamma di accessori</strong></p>\r\n\r\n<p>Progettata per cantieri edili, stradali, per la vivaistica e per tutte quelle situazioni dov&rsquo;&egrave; necessaria la movimentazione in spazi ristretti di piccole e medie quantit&agrave; di materiale. Disponibile con presa di forza idraulica ausiliare mono/bidirezionale, &egrave; in grado di dotarsi di un&rsquo;ampia gamma di accessori sostituibili velocemente. Mezzo indispensabile in ausilio di macchine movimento terra pi&ugrave; grandi per lo smistamento di importanti quantit&agrave; di materiale.</p>\r\n', '75249-Carry110-sx-3-4-fronte.jpg', 'it-IT', 1, 1, 90, 0, '2018-06-01 07:23:53', '2018-06-01 07:24:24', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(134, 297, 'Carry110', 'Benne et pelle', '<p><strong>Une large gamme d&rsquo;accessoires</strong></p>\r\n\r\n<p>Etudi&eacute; pour les chantiers de construction ou routiers, pour les espaces verts et pour toutes les situations o&ugrave; le d&eacute;placement de petites et moyennes quantit&eacute;s de mat&eacute;riels dans des espaces &eacute;troits est n&eacute;cessaire. Disponible avec une prise de force auxiliaire hydraulique mono/bidirectionnelle, il est possible d&rsquo;adapter rapidement une large gamme d&rsquo;accessoires.</p>\r\n\r\n<p>Il est indispensable au c&ocirc;t&eacute; d&rsquo;autres machines TP pour le tri d&rsquo;importantes quantit&eacute;s de mat&eacute;riels.</p>\r\n', '75249-Carry110-sx-3-4-fronte.jpg', 'fr-FR', 1, 1, 90, 0, '2018-06-01 07:53:35', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(135, 297, 'Carry110', 'Kippmulde mit Schaufel', '<p><strong>Ein breites Zubeh&ouml;rangebot</strong></p>\r\n\r\n<p>Eigens f&uuml;r Baustellen und Stra&szlig;enbaustellen, Pflanzenschulen und andere Sektoren entwickelt, wo der Materialtransport kleiner bis mittlerer Mengen auf beengtem Raum erfolgt. Dieses Modell hat eine mono-/bidirektionale Zusatzzapfwelle und kann dank einer Schnellwechseleinrichtung mit einer Vielzahl von Ger&auml;ten ausgestattet werden.</p>\r\n\r\n<p>Eine n&uuml;tzliche Zusatzmaschine f&uuml;r gr&ouml;&szlig;ere Erdbewegungsger&auml;te f&uuml;r den Transport von gro&szlig;en Materialaufkommen.</p>\r\n', '75249-Carry110-sx-3-4-fronte.jpg', 'de-DE', 1, 1, 90, 0, '2018-06-01 07:58:56', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(136, 297, 'Carry110', 'Tolva con pala autocargable', '<p><strong>Una amplia gama de accesorios</strong></p>\r\n\r\n<p>Dise&ntilde;ada para obras de construcci&oacute;n, obras viales, viveros y cualquier situaci&oacute;n que requiera desplazamientos de cantidades de material peque&ntilde;as o medianas en espacios estrechos. Disponible con toma de fuerza hidr&aacute;ulica auxiliar mono/bidireccional, puede dotarse de una gran variedad de accesorios de r&aacute;pida sustituci&oacute;n.</p>\r\n\r\n<p>Indispensable para auxiliar m&aacute;quinas de movimiento de tierra mayores durante la clasificaci&oacute;n de grandes cantidades de material.</p>\r\n', '75249-Carry110-sx-3-4-fronte.jpg', 'es-ES', 1, 1, 90, 0, '2018-06-01 08:00:32', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(137, 296, 'Carry107ht', 'Cassone con pala', '<p><strong>Ancora pi&ugrave; versatile</strong></p>\r\n\r\n<p>Il modello Carry 107ht, versione standard cassone con pala autocaricante, con carro estensibile da 760 a 1060 mm, &egrave; ideale per il trasporto e la movimentazione di materiale.</p>\r\n\r\n<p>Il kit &ldquo;hi-tip&rdquo; aiuta a svuotare dall&rsquo;alto il cassone nei punti desiderati, raggiungendo un&rsquo;altezza massima di scarico di 1600 mm.</p>\r\n\r\n<p>Questa versione permette di svuotare il materiale sia direttamente sul camion che negli appositi cassoni di raccolta.</p>\r\n\r\n<p>La posizione del cassone rialzato rende la macchina idonea a lavorare su superfici pianeggianti o moderatamente sconnesse.</p>\r\n', '86613-Carry107ht-scaricamento.jpg', 'it-IT', 1, 1, 80, 0, '2018-06-01 08:02:41', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(138, 296, 'Carry107ht', 'Benne et pelle', '<p><strong>Encore plus polyvalent</strong></p>\r\n\r\n<p>Le 107 HT, standard avec benne et pelle chargeuse et la voie variable de 760 &agrave; 1060 mm, est id&eacute;al pour le transport et le d&eacute;placement des mat&eacute;riels.</p>\r\n\r\n<p>Le kit &laquo; hi-tip &raquo; permet de vider la benne par le haut o&ugrave; l&rsquo;on veut, &agrave; une hauteur maximale de 1600 mm.</p>\r\n\r\n<p>Cette version permet de vider le mat&eacute;riel directement dans le camion, ou dans les caissons de ramassage.</p>\r\n\r\n<p>Avec la benne relev&eacute;e la machine est id&eacute;ale pour travailler sur des surfaces plates ou peu bossel&eacute;es.</p>\r\n', '86613-Carry107ht-scaricamento.jpg', 'fr-FR', 1, 1, 80, 0, '2018-06-01 08:04:09', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(139, 296, 'Carry107ht', 'Kippmulde mit Schaufel', '<p><strong>Noch vielseitiger</strong></p>\r\n\r\n<p>Das Modell Carry 107ht in der Standardversion mit Kippmulde mit Schaufel, Ausfahrbarer Unterwagen von 760 bis 1060 mm, ist die ideale Maschine f&uuml;r alle Anforderungen in der Materialhandhabung.</p>\r\n\r\n<p>Der Bausatz &bdquo;hi-tip&ldquo; unterst&uuml;tzt das Aussch&uuml;tten der Kippmulde an den gew&uuml;nschten Stellen und kann eine maximale Aussch&uuml;tth&ouml;he von 1600 mm erreichen.</p>\r\n\r\n<p>Die Ausf&uuml;hrung erm&ouml;glicht das Ausladen von Material direkt auf LKWs oder in Sammelkontainer.</p>\r\n', '86613-Carry107ht-scaricamento.jpg', 'de-DE', 1, 1, 80, 0, '2018-06-01 08:05:17', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"0.9 - 2.7 Tons\";}'),
(140, 296, 'Carry107ht', 'Tolva con pala autocargable', '<p><strong>A&uacute;n m&aacute;s vers&aacute;til</strong></p>\r\n\r\n<p>El modelo Carry 107ht, versi&oacute;n est&aacute;ndar de tolva con pala autocargable y con orugas extensibles desde 760 a 1060 mm, es ideal para el transporte y la manutenci&oacute;n de material. El kit &ldquo;hi-tip&rdquo; ayuda a vaciar el volquete desde arriba en los puntos deseados, alcanzando una altura m&aacute;xima de descarga de 1600 mm.</p>\r\n\r\n<p>Esta versi&oacute;n permite vaciar el material directamente en el cami&oacute;n o en los cubos de recogida.</p>\r\n\r\n<p>Con la tolva levantada, la m&aacute;quina resulta adecuada para trabajar sobre superficies planas o moderadamente irregulares.</p>\r\n', '86613-Carry107ht-scaricamento.jpg', 'es-ES', 1, 1, 80, 0, '2018-06-01 08:09:01', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(141, 295, 'Carry107', 'Lama frontale livellatrice', '<p><strong>Perfetto per il livellamento</strong></p>\r\n\r\n<p>Il minidumper Carry 107 versione con lama frontale &egrave; adatto per il livellamento di terreni e conglomerati.</p>\r\n\r\n<p>L&rsquo;inclinazione da ambedue i lati di 30&deg; lo rendono perfetto per lo sgombero della neve.</p>\r\n\r\n<p>Il telaio portante, realizzato come pianale di contenimento, consente di trasportare vari attrezzi e nel caso di uso come &ldquo;sgombraneve&rdquo;, sacchi di sale antighiaccio.</p>\r\n', '28981-Carry107-lama-neve-dx-3-4-fronte-B.jpg', 'it-IT', 1, 1, 70, 0, '2018-06-01 08:10:47', '2018-06-01 08:12:53', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(142, 295, 'Carry107', 'Lame frontale nivelante', '<p><strong>Parfait pour le nivelage</strong></p>\r\n\r\n<p>Le 107 avec lame frontale est adapt&eacute; pour le nivelage des terrains.</p>\r\n\r\n<p>L&rsquo;inclinaison de 30&deg; des deux c&ocirc;t&eacute;s le rende id&eacute;al pour le d&eacute;neigement.</p>\r\n\r\n<p>Le ch&acirc;ssis r&eacute;alis&eacute; comme un plateau, permet de transporter divers accessoires, ou des sacs de sel dans le cas de d&eacute;neigement.</p>\r\n', '28981-Carry107-lama-neve-dx-3-4-fronte-B.jpg', 'fr-FR', 1, 1, 70, 0, '2018-06-01 08:12:18', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(143, 295, 'Carry107', 'Frontaler Planierschild', '<p><strong>Perfekt zum Planieren</strong></p>\r\n\r\n<p>Der Minidumper Carry 107 eignet sich in der Version mit Frontschild f&uuml;r das Planieren von B&ouml;den und Kies.</p>\r\n\r\n<p>Kann dank der Neigung von 30&deg; auf beiden Seiten vorteilhaft f&uuml;r den Winterdienst eingesetzt werden.</p>\r\n\r\n<p>Der Tragrahmen, der wie eine geschlossene Ladepritsche ausgef&uuml;hrt ist, erm&ouml;glicht den Transport verschiedenartiger Ger&auml;te und beim Einsatz als &bdquo;Schneer&auml;umer&ldquo; k&ouml;nnen Streusalzs&auml;cke darauf abgelegt werden.</p>\r\n', '28981-Carry107-lama-neve-dx-3-4-fronte-B.jpg', 'de-DE', 1, 1, 70, 0, '2018-06-01 08:15:52', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(144, 295, 'Carry107', 'Pala dozer frontal', '<p><strong>Ideal para la nivelaci&oacute;n</strong></p>\r\n\r\n<p>El minidumper Carry 107, versi&oacute;n con pala dozer frontal es adecuado para nivelar terrenos y conglomerados.</p>\r\n\r\n<p>La inclinaci&oacute;n a 30&deg; a ambos lados lo hacen perfecto para retirar nieve.</p>\r\n\r\n<p>El chasis portante, realizado como plataforma de contenci&oacute;n, permite transportar varios aperos o sacos de sal antihielo.</p>\r\n', '28981-Carry107-lama-neve-dx-3-4-fronte-B.jpg', 'es-ES', 1, 1, 70, 0, '2018-06-01 08:17:08', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(145, 294, 'Carry107', 'Pianale con sponde apribili', '<p><strong>Estremamente versatile</strong></p>\r\n\r\n<p>Il minidumper Carry 107 versione con pianale sponde apribili &egrave; la soluzione ideale per il trasporto e la movimentazione di materiale ingombrante nel cantiere, in modo veloce, sicuro e senza alcuna fatica per l&rsquo;operatore.</p>\r\n\r\n<p>Dimensioni del pianale 990 x 790 x 200 / 1240 x 1290 mm (sponde chiuse/sponde aperte) (P x L x H).</p>\r\n\r\n<p>Carro estensibile da 760 a 1060 mm, per una maggiore stabilit&agrave;.</p>\r\n', '73296-Carry107-pianale-dx-3-4-retro.jpg', 'it-IT', 1, 1, 60, 0, '2018-06-01 08:19:20', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(146, 294, 'Carry107', 'Plateau Ã  ridelles', '<p><strong>Extr&ecirc;mement polyvalent</strong></p>\r\n\r\n<p>Le 107 version plateau &agrave; ridelles est la solution id&eacute;ale pour le d&eacute;placement rapide de mat&eacute;riels encombrants sur les chantiers, en toute s&eacute;curit&eacute; et sans fatigue pour l&rsquo;op&eacute;rateur.</p>\r\n\r\n<p>Dimensions du plateau 900x790x200/1240x1290mm (ridelles ferm&eacute;es / ridelles ouvertes) (PxLxH).</p>\r\n\r\n<p>La voie variable de 760 &agrave; 1060 mm permet une meilleure stabilit&eacute;.</p>\r\n', '73296-Carry107-pianale-dx-3-4-retro.jpg', 'fr-FR', 1, 1, 60, 0, '2018-06-01 08:20:43', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(147, 294, 'Carry107', 'Pritsche mit herabklappbaren Bordkanten', '<p><strong>H&ouml;chst vielseitig</strong></p>\r\n\r\n<p>Der Minidumper Carry 107 ist in der Version mit herabklappbaren Bordkanten die ideale L&ouml;sung f&uuml;r den Transport und die Handhabung von sperrigem Material auf der Baustelle und in schwer zug&auml;nglichen Bereichen.</p>\r\n\r\n<p>Abmessungen der Pritsche 990 x 790 x 200 / 1240 x 1290 mm (Bordkanten geschlossen/ge&ouml;ffnet) (T x L x H).</p>\r\n\r\n<p>Ausfahrbarer Unterwagen von 760 bis 1060 mm, f&uuml;r eine gr&ouml;&szlig;ere Stabilit&auml;t.</p>\r\n', '73296-Carry107-pianale-dx-3-4-retro.jpg', 'de-DE', 1, 1, 60, 0, '2018-06-01 08:22:55', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(148, 294, 'Carry107', 'Soporte portapersonas abatible', '<p><strong>Sumamente vers&aacute;til</strong></p>\r\n\r\n<p>El minidumper Carry 107, est&aacute; disponible con tolva plana y laterales abatibles.</p>\r\n\r\n<p>Es ideal para el transporte de materiales de construcci&oacute;n, adem&aacute;s de hacerlo con rapidez, seguridad, y sin esfuerzo para el operario.</p>\r\n\r\n<p>La medida de la tolva es de 990 x 790 x 200 / 1240 x 1290 mm (laterales cerrados / laterales abiertos) (P x L x H). Orugas extensibles desde 760 a 1060 mm, perfecto para una mayor estabilidad.</p>\r\n', '73296-Carry107-pianale-dx-3-4-retro.jpg', 'es-ES', 1, 1, 60, 0, '2018-06-01 08:24:16', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(149, 293, 'Carry107', 'Betoniera con pala', '<p><strong>Scattante, ideale in cantiere</strong></p>\r\n\r\n<p>Il minidumper Carry 107 allestito con la betoniera diventa un amico insostituibile in cantiere per impastare terra, inerti in modo veloce, sicuro e senza alcuna fatica per l&rsquo;operatore. Capacit&agrave; totale vasca/resa 250/190 litri.</p>\r\n\r\n<p>Carro estensibile da 760 a 1060 mm, per una maggiore stabilit&agrave;.</p>\r\n', '25108-Carry107-betoniera-dx-3-4-retro.jpg', 'it-IT', 1, 1, 50, 0, '2018-06-01 08:25:55', '2018-06-01 08:27:16', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(150, 293, 'Carry107', 'BÃ©tonniÃ¨re et pelle', '<p><strong>Nerveux, id&eacute;al pour les chantiers</strong></p>\r\n\r\n<p>Le 107 avec b&eacute;tonni&egrave;re est irrempla&ccedil;able sur les chantiers pour m&eacute;langer rapidement la terre, les agr&eacute;gats, en toute s&eacute;curit&eacute; et sans fatigue pour l&rsquo;op&eacute;rateur.</p>\r\n\r\n<p>La capacit&eacute; totale cuve/rendement est de 250/190 l.</p>\r\n\r\n<p>La voie variable de 760 &agrave; 1060 mm permet une meilleure stabilit&eacute;.</p>\r\n', '25108-Carry107-betoniera-dx-3-4-retro.jpg', 'fr-FR', 1, 1, 50, 0, '2018-06-01 08:26:58', '2018-06-01 08:29:06', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(151, 293, 'Carry107', 'Betonmischer mit Schaufel', '<p><strong>Flink, ideal auf der Baustelle</strong></p>\r\n\r\n<p>Der mit einem Betonmischer ausgestattete Minidumper Carry 107 ist unentbehrlich auf der Baustelle, um schnell, sicher und ohne M&uuml;he f&uuml;r den Fahrer Erde und Inertstoffe zu vermischen.</p>\r\n\r\n<p>Gesamtkapazit&auml;t der Wanne/Ausbeute 250/190 Liter.</p>\r\n\r\n<p>Ausfahrbarer Unterwagen von 760 bis 1060 mm, f&uuml;r eine gr&ouml;&szlig;ere Stabilit&auml;t.</p>\r\n', '25108-Carry107-betoniera-dx-3-4-retro.jpg', 'de-DE', 1, 1, 50, 0, '2018-06-01 08:28:43', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(152, 293, 'Carry107', 'Hormigonera con pala', '<p><strong>&Aacute;gil y r&aacute;pido, ideal en obra</strong></p>\r\n\r\n<p>Il minidumper Carry 107 allestito con la betoniera diventa un amico insostituibile in cantiere per impastare terra, inerti in modo veloce, sicuro e senza alcuna fatica per l&rsquo;operatore.</p>\r\n\r\n<p>Capacit&agrave; totale vasca/resa 250/190 litri.</p>\r\n\r\n<p>Carro estensibile da 760 a 1060 mm, per una maggiore stabilit&agrave;.</p>\r\n', '25108-Carry107-betoniera-dx-3-4-retro.jpg', 'es-ES', 1, 1, 50, 0, '2018-06-01 08:30:20', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(153, 292, 'Carry107', 'Cassone con pala', '<p>Veloce, sicuro, infaticabile</p>\r\n\r\n<p>Il minidumper Carry 107 &egrave; la soluzione ideale per il trasporto e la movimentazione di vari tipi di materiale nel cantiere e in luoghi difficilmente accessibili.</p>\r\n\r\n<p>Carro estensibile da 760 a 1060 mm, per una maggiore stabilit&agrave;.</p>\r\n\r\n<p>La pala autocaricante consente di trasferire nel cassone detriti, terra, inerti e quant&rsquo;altro in modo veloce, sicuro e senza alcuna fatica per l&rsquo;operatore.</p>\r\n', '85493-CARRY107-01-laterale-dx-pedanaopen.jpg', 'it-IT', 1, 1, 40, 0, '2018-06-01 08:31:49', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(154, 292, 'Carry107', 'Benne et pelle', '<p><strong>Rapide, s&ucirc;r, robuste</strong></p>\r\n\r\n<p>Le 107 est la solution id&eacute;ale pour transporter et d&eacute;placer diff&eacute;rents types de mat&eacute;riels sur les chantiers ou dans des lieux difficiles d&rsquo;acc&egrave;s.</p>\r\n\r\n<p>La voie variable de 760 &agrave; 1060 mm permet une meilleure stabilit&eacute;.</p>\r\n\r\n<p>La pelle chargeuse permet de transf&eacute;rer rapidement dans la benne toutes sortes de d&eacute;tritus, terre, agr&eacute;gats, et bien d&rsquo;autres en toute s&eacute;curit&eacute; et sans fatigue pour l&rsquo;op&eacute;rateur.</p>\r\n', '85493-CARRY107-01-laterale-dx-pedanaopen.jpg', 'fr-FR', 1, 1, 40, 0, '2018-06-01 08:32:57', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(155, 292, 'Carry107', 'Kippmulde mit Schaufel', '<p><strong>Schnell, sicher, unerm&uuml;dlich</strong></p>\r\n\r\n<p>Der Minidumper Carry 107 ist die ideale L&ouml;sung f&uuml;r den Transport und die Handhabung von verschiedenartigem Baumaterial auf der Baustellen und in schwer zug&auml;nglichen Bereichen.</p>\r\n\r\n<p>Ausfahrbarer Unterwagen von 760 bis 1060 mm, f&uuml;r eine gr&ouml;&szlig;ere Stabilit&auml;t.</p>\r\n\r\n<p>Die Selbstladeschaufel l&auml;dt Bauschutt, Erde, Zuschlagstoffe und anderes in den Kippbeh&auml;lter ohne M&uuml;he f&uuml;r den Fahrer.</p>\r\n', '85493-CARRY107-01-laterale-dx-pedanaopen.jpg', 'de-DE', 1, 1, 40, 0, '2018-06-01 08:34:13', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(156, 292, 'Carry107', 'Tolva con pala autocargable', '<p><strong>Veloz, seguro, incansable</strong></p>\r\n\r\n<p>El minidumper Carry 107 constituye la soluci&oacute;n ideal para el transporte y la manutenci&oacute;n de varios tipos de material en obra y en lugares de dif&iacute;cil acceso.</p>\r\n\r\n<p>Carro extensible de 760 a 1060 mm, para una mayorestabilidad.</p>\r\n\r\n<p>La pala autocargable permite transferir a la tolva descartes, tierra, material inerte, etc. de manera r&aacute;pida, segura y sin cansancio para el operador.</p>\r\n', '85493-CARRY107-01-laterale-dx-pedanaopen.jpg', 'es-ES', 1, 1, 40, 0, '2018-06-01 08:35:17', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(157, 291, 'carry105 electricpower', 'Cassone con pala', '<p>Ecologica senza rinunce</p>\r\n\r\n<p>Il minidumper Carry105 electric power &egrave; la soluzione ideale per soddisfare le esigenze di movimentazione di materiale all&rsquo;interno di luoghi chiusi come le serre, adatto nella vivaistica e nell&rsquo;agricoltura, per tutti quei luoghi sensibili come scuole, ospedali e in ambienti poco ventilati dove si rende indispensabile lavorare senza gas, fumi e rumori.</p>\r\n', '2581-Carry105ep-dx-3-4-retro-ribalt-NEW.jpg', 'it-IT', 1, 1, 30, 0, '2018-06-01 08:36:55', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(158, 291, 'Carry105 electricpower', 'Benne et pelle', '<p>Ecologique sans efforts</p>\r\n\r\n<p>Le 105 &eacute;lectrique est la solution id&eacute;ale pour pallier aux exigences des d&eacute;placements de mat&eacute;riels &agrave; l&rsquo;int&eacute;rieur de lieux clos comme les serres, adapt&eacute; aux espaces verts et &agrave; l&rsquo;agriculture, et pour tous les lieux sensibles comme les &eacute;coles, les h&ocirc;pitaux, et les environnements peu ventil&eacute;s o&ugrave; il est indispensable de travailler sans fum&eacute;e, gaz ou bruit.</p>\r\n', '2581-Carry105ep-dx-3-4-retro-ribalt-NEW.jpg', 'fr-FR', 1, 1, 30, 0, '2018-06-01 08:38:00', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(159, 291, 'Carry105 electricpower', 'Kippmulde mit Schaufel', '<p>Umweltfreundlich ohne Einbu&szlig;en</p>\r\n\r\n<p>Der Minidumper Carry105 electric Leistung ist die ideale L&ouml;sung f&uuml;r alle Anforderungen im Materialtransport in geschlossen R&auml;umen wie Werkhallen oder Treibh&auml;user; er eignet sich f&uuml;r den Einsatz in Pflanzenschulen und in der Landwirtschaft, in allen sensiblen Orten wie Schulen, Krankenh&auml;user und schlecht gel&uuml;ftete R&auml;ume, wo ohne Gas-, Rauch und Ger&auml;uschemissionen gearbeitet werden muss.</p>\r\n', '2581-Carry105ep-dx-3-4-retro-ribalt-NEW.jpg', 'de-DE', 1, 1, 30, 0, '2018-06-01 08:39:03', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(160, 291, 'Carry105 electricpower', 'Tolva con pala autocargable', '<p><strong>Ecol&oacute;gico sin renuncias</strong></p>\r\n\r\n<p>El minidumper Carry105 El&eacute;ctrico Potencia es la soluci&oacute;n ideal para responder a las necesidades de manutenci&oacute;n de material en lugares cerrados como invernaderos, adecuado para el uso en viveros y en la agricultura y en lugares sensibles como escuelas y hospitales y ambientes poco ventilados donde resulta indispensable trabajar sin gases, humos y ruidos.</p>\r\n', '2581-Carry105ep-dx-3-4-retro-ribalt-NEW.jpg', 'es-ES', 1, 1, 30, 0, '2018-06-01 08:40:17', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(161, 290, 'Carry105', 'Pianale con sponde apribili con pala', '<p><strong>Velocit&agrave; e adattabilit&agrave;</strong></p>\r\n\r\n<p>Il minidumper Carry 105 versione con pianale sponde apribili &egrave; ideale per caricare materiale ingombrante e movimentare materiale all&rsquo;interno di capannoni o serre, particolarmente indicato per utilizzi nella vivaistica e in agricoltura.</p>\r\n', '1216-Carry105-pianale-dx.jpg', 'it-IT', 1, 1, 20, 0, '2018-06-01 08:41:54', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(162, 290, 'Carry105', 'Avec plateau Ã  ridelles', '<p><strong>Vitesse et facult&eacute; d&rsquo;adaptation</strong></p>\r\n\r\n<p>Le mini-transporteur carry 105 avec plateau &agrave; ridelles est id&eacute;al pour charger ou d&eacute;placer du mat&eacute;riel encombrant &agrave; l&rsquo;int&eacute;rieur de hangars ou de serres.</p>\r\n\r\n<p>Il est particuli&egrave;rement indiqu&eacute; pour les travaux d&rsquo;espaces verts ou dans l&rsquo;agriculture.</p>\r\n', '1216-Carry105-pianale-dx.jpg', 'fr-FR', 1, 1, 20, 0, '2018-06-01 08:43:05', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(163, 290, 'Carry105', 'Pritsche mit herabklappbaren Bordkanten', '<p><strong>Geschwindigkeit und Anpassungsf&auml;higkeit</strong></p>\r\n\r\n<p>Der Minidumper Carry 105 in der Version mit Pritsche und herabklappbaren Bordkanten ist besonders f&uuml;r die Handhabung von sperrigem Material und f&uuml;r von Material in Werkhallen oder Gew&auml;chsh&auml;usern geeignet, sowie f&uuml;r den Einsatz in Pflanzenschulen und in der Landwirtschaft.</p>\r\n', '1216-Carry105-pianale-dx.jpg', 'de-DE', 1, 1, 20, 0, '2018-06-01 08:44:24', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(164, 290, 'Carry105', 'Soporte portapersonas abatible', '<p><strong>Agilidad y adaptabilidad</strong></p>\r\n\r\n<p>El minidumper Carry 105, versi&oacute;n con soporte portapersonas abatible es ideal para la carga y la manutenci&oacute;n de material voluminoso en naves industriales o invernaderos, particularmente indicado para el uso en viveros y en la agricultura.</p>\r\n', '1216-Carry105-pianale-dx.jpg', 'es-ES', 1, 1, 20, 0, '2018-06-01 08:45:28', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"400 / 1000 Kg\";}'),
(165, 303, 'IC35', '', '<p><strong>Potente e robusto</strong></p>\r\n\r\n<p>La potenza per svolgere i lavori gravosi.</p>\r\n\r\n<p>Eccezionale facilit&agrave; d&rsquo;uso unita a una struttura estremamente robusta e manutenzione facilitata.</p>\r\n', '93598-IC35-3-4-front-dx.jpg', 'it-IT', 1, 1, 30, 0, '2018-06-01 08:48:36', '2018-06-01 08:51:21', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(166, 303, 'IC35', '', '<p><strong>Puissant et robuste</strong></p>\r\n\r\n<p>La puissance pour r&eacute;aliser les t&acirc;ches lourdes.</p>\r\n\r\n<p>Sa facilit&eacute; d&rsquo;utilisation se conjugue &agrave; sa structure extr&ecirc;mement robuste et &agrave; sa facilit&eacute; d&rsquo;entretien.</p>\r\n', '93598-IC35-3-4-front-dx.jpg', 'fr-FR', 1, 1, 30, 0, '2018-06-01 08:50:21', '2018-06-01 08:52:24', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(167, 303, 'IC35', '', '<p><strong>Leistungsstark und robust</strong></p>\r\n\r\n<p>Ausreichend Leistung f&uuml;r schwere Arbeiten. Sehr leicht zu bedienen, eine sehr robuste und einfach zu wartende Struktur.</p>\r\n', '93598-IC35-3-4-front-dx.jpg', 'de-DE', 1, 1, 30, 0, '2018-06-01 08:53:20', '2018-06-01 08:55:40', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(169, 300, 'Carry150', '', '<p><strong>Versatilit&agrave; per ogni utilizzo</strong></p>\r\n\r\n<p>Trasportatore cingolato a trasmissione idrostatica a due circuiti indipendenti con pompa a pistoni assiali a cilindrata variabile e motore idraulico a pistoni assiali a due cilindrate per ogni cingolo.</p>\r\n\r\n<p>Posto guida dell&rsquo;operatore in posizione posteriore centrale con sedile ammortizzato e regolabile; accesso da ambo i lati.</p>\r\n', '31099-Carry150_3-4-retro.jpg', 'it-IT', 1, 1, 10, 0, '2018-06-01 08:56:59', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(168, 303, 'IC35', '', '<p><strong>Potente y s&oacute;lido</strong></p>\r\n\r\n<p>Potencia para realizar trabajos pesados.</p>\r\n\r\n<p>Excepcional facilidad de uso asociada a una estructura sumamente s&oacute;lida y un mantenimiento sencillo.</p>\r\n', '93598-IC35-3-4-front-dx.jpg', 'es-ES', 1, 1, 30, 0, '2018-06-01 08:54:41', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(170, 300, 'Carry150', '', '<p><strong>Polyvalence pour toute utilisation</strong></p>\r\n\r\n<p>Chariot de transport sur chenilles &agrave; transmission hydrostatique, deux circuits ind&eacute;pendants avec pompe &agrave; pistons axiaux de cylindr&eacute;e variable et moteur hydraulique &agrave; pistons axiaux &agrave; deux cylindr&eacute;es par chenille.</p>\r\n\r\n<p>Poste de commande op&eacute;rateur en position arri&egrave;re centrale avec si&egrave;ge amorti et r&eacute;glable; acc&egrave;s par les deux c&ocirc;t&eacute;s.</p>\r\n', '31099-Carry150_3-4-retro.jpg', 'fr-FR', 1, 1, 10, 0, '2018-06-01 08:57:55', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(171, 300, 'Carry150', '', '<p><strong>Vielseitig f&uuml;r jeden Einsatz</strong></p>\r\n\r\n<p>Der Raupendumper besitzt einen hydrostatischen Antrieb mit zwei unabh&auml;ngigen Kreisl&auml;ufen mit Axialverstellpumpe und einen Hydraulikmotor mit Axialkolben mit 2 Hubr&auml;umen pro Raupe.</p>\r\n\r\n<p>Fahrerplatz in mittlerer Position mit gefedertem und verstellbarem Sitz; Zugang von beiden Seiten.</p>\r\n', '31099-Carry150_3-4-retro.jpg', 'de-DE', 1, 1, 10, 0, '2018-06-01 08:58:54', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(172, 300, 'Carry150', '', '<p><strong>Versatilidad para cualquier uso</strong></p>\r\n\r\n<p>Transportador de orugas con transmisi&oacute;n hidrost&aacute;tica de dos circuitos independientes con bomba de pistones axiales de cilindrada variable y motor hidr&aacute;ulico de pistones axiales de dos cilindradas por cada oruga.</p>\r\n\r\n<p>Puesto de conducci&oacute;n del operario en el centro de la parte trasera, con asiento regulable con amortiguador; acceso por ambos lados.</p>\r\n', '31099-Carry150_3-4-retro.jpg', 'es-ES', 1, 1, 10, 0, '2018-06-01 08:59:54', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(173, 300, 'Carry150', '', '<p><strong>Versatilidad para cualquier uso</strong></p>\r\n\r\n<p>Transportador de orugas con transmisi&oacute;n hidrost&aacute;tica de dos circuitos independientes con bomba de pistones axiales de cilindrada variable y motor hidr&aacute;ulico de pistones axiales de dos cilindradas por cada oruga.</p>\r\n\r\n<p>Puesto de conducci&oacute;n del operario en el centro de la parte trasera, con asiento regulable con amortiguador; acceso por ambos lados.</p>\r\n', '31099-Carry150_3-4-retro.jpg', 'es-ES', 1, 1, 10, 0, '2018-06-01 08:59:57', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(174, 301, 'Carry250', '', '<p><strong>Trasportatore cingolato per tutti i terreni</strong></p>\r\n\r\n<p>Trasportatore cingolato a trasmissione idrostatica a due circuiti indipendenti con pompa a pistoni assiali a cilindrata variabile e motore idraulico a pistoni assiali a due cilindrate per ogni cingolo.</p>\r\n\r\n<p>Telaio a struttura modulare composta da una unit&agrave; motrice installata su telaio unificato per ricevere attrezzature diverse. Sottocarro ad assi oscillanti con cingoli in gomma, idonei alle alte velocit&agrave;.</p>\r\n\r\n<p>La notevole altezza libera dal suolo gli consente di muoversi agevolmente sullo sterrato e su terreni particolarmente accidentati.</p>\r\n', '53455-Carry250_3-4-fronte.jpg', 'it-IT', 1, 1, 20, 0, '2018-06-01 09:01:13', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(175, 301, 'Carry250', '', '<p><strong>Chariot de transport sur chenilles tout-terrain</strong></p>\r\n\r\n<p>Chariot de transport sur chenilles &agrave; transmission hydrostatique, deux circuits ind&eacute;pendants avec pompe &agrave; pistons axiaux de cylindr&eacute;e variable et moteur hydraulique &agrave; pistons axiaux &agrave; deux cylindr&eacute;es par chenille.</p>\r\n\r\n<p>Ch&acirc;ssis &agrave; structure modulaire compos&eacute;e d&rsquo;une unit&eacute; motrice mont&eacute;e sur ch&acirc;ssis unifi&eacute; adapt&eacute; &agrave; recevoir diff&eacute;rents outillages.</p>\r\n\r\n<p>Chariot de base &agrave; essieux oscillants et chenilles en caoutchouc, adapt&eacute;es &agrave; des vitesses &eacute;lev&eacute;es. La garde au sol remarquable permet des mouvements faciles, m&ecirc;me sur la terre et les terrains accident&eacute;s.</p>\r\n', '53455-Carry250_3-4-fronte.jpg', 'fr-FR', 1, 1, 20, 0, '2018-06-01 09:02:07', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(176, 301, 'Carry250', '', '<p>Ein Raupendumper f&uuml;r jedes Gel&auml;nde</p>\r\n\r\n<p>Der Raupendumper besitzt einen hydrostatischen Antrieb mit zwei unabh&auml;ngigen Kreisl&auml;ufen mit Axialverstellpumpe und einen Hydraulikmotor mit Axialkolben mit 2 Hubr&auml;umen pro Raupe.</p>\r\n\r\n<p>Rahmen mit modularer Struktur mit einem Antriebsaggregat, das auf einem standardisierten Tragrahmen installiert ist und die verschiedenen Werkzeuge aufnimmt. Unterwagen mit Pendelachse und Gummiraupen, der f&uuml;r hohe Geschwindigkeiten ausgelegt ist.</p>\r\n\r\n<p>Durch den erheblichen Bodenabstand kann der Dumper auch auf freiem oder besonders unwegsamen Gel&auml;nde gut man&ouml;vriert werden.</p>\r\n', '53455-Carry250_3-4-fronte.jpg', 'de-DE', 1, 1, 20, 0, '2018-06-01 09:03:06', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(177, 301, 'Carry250', '', '<p><strong>Transportador de orugas para cualquier terreno</strong></p>\r\n\r\n<p>Transportador de orugas con transmisi&oacute;n hidrost&aacute;tica de dos circuitos independientes con bomba de pistones axiales de cilindrada variable y motor hidr&aacute;ulico de pistones axiales de dos cilindradas por cada oruga.</p>\r\n\r\n<p>Bastidor de estructura modular con unidad motora instalada sobre bastidor &uacute;nico para alojar los distintos equipos.</p>\r\n\r\n<p>Bajo bastidor de ejes oscilantes con orugas de goma, adecuadas para altas velocidades.</p>\r\n\r\n<p>Gracias a su considerable distancia al suelo, puede moverse f&aacute;cilmente en pisos sin asfaltar y en terrenos especialmente accidentados.</p>\r\n', '53455-Carry250_3-4-fronte.jpg', 'es-ES', 1, 1, 20, 0, '2018-06-01 09:04:11', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:14:\"1500 / 3000 Kg\";}'),
(178, 272, 'Transporteurs', '', '<p>Robustes, puissantes et faciles &agrave; utiliser</p>\r\n', '10997-IC120-2.jpg', 'fr-FR', 1, 1, 40, 0, '2018-06-01 09:09:10', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(179, 272, 'Crawler Carriers', '', '<p>Robust, leistungsf&auml;hig und bedienerfreundlich</p>\r\n', '10997-IC120-2.jpg', 'de-DE', 1, 1, 40, 0, '2018-06-01 09:11:20', '2018-06-01 09:12:16', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(180, 272, 'Crawler Carriers', '', '<p>Resistentes, potentes y f&aacute;ciles de usar</p>\r\n', '10997-IC120-2.jpg', 'es-ES', 1, 1, 40, 0, '2018-06-01 09:13:10', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(181, 304, 'IC55', '', '<p><strong>IC 55 a comfortable workplace</strong></p>\r\n\r\n<p>A comfortable driver&rsquo;s seat with anti-fatigue systems for the operator with all of the operations controlled from a single hydraulic joystick.</p>\r\n\r\n<p>IC55 with new Kubota V3800-Tier 4 motor observes regulations on emissions.</p>\r\n\r\n<p>Ample access to the engine and the centralised position of all the parts on the right side of the machine offer easy maintenance.</p>\r\n', '38462-IC55.jpg', 'en-EN', 1, 1, 10, 0, '2018-06-01 09:17:31', '2018-06-01 09:20:18', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}');
INSERT INTO `tbl_items` (`ID_item`, `ID_cat`, `Titolo`, `Sottotitolo`, `Descrizione`, `Immagine`, `Lingua`, `Attiva`, `Pubblica`, `Ordine`, `Evidenza`, `Data_creazione`, `Data_modifica`, `Attributi`) VALUES
(183, 304, 'IC55', '', '<p><strong>IC 55 un ambiente di lavoro confortevole</strong></p>\r\n\r\n<p>Una posizione di guida comoda e con sistemi antiaffaticamento per l&rsquo;operatore con tutte le operazioni controllate da un unico joystick idraulico.</p>\r\n\r\n<p>IC55 con la nuova motorizzazione Kubota V3800-Tier 4 rispetta le normative sulle emissioni.</p>\r\n\r\n<p>Gli ampi accessi al motore e la posizione centralizzata di tutti i componenti sul lato destro della macchina consentono una facile manutenzione.</p>\r\n', '38462-IC55.jpg', 'it-IT', 1, 1, 10, 0, '2018-06-01 09:20:42', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(182, 305, 'IC75-2', '', '<p><strong>Customizable and easy maintenance</strong></p>\r\n\r\n<p>IC75-2 can be customized to suit any type of work.</p>\r\n\r\n<p>The driver&rsquo;s seat is particularly comfortable thanks to the wrap-around and adjustable design and the ergonomic set-up of the controls.</p>\r\n\r\n<p>The standard version is equipped with pilot-operated joy-sticks that ensure maximum precision.</p>\r\n', '88097-IC75-2.jpg', 'en-EN', 1, 1, 20, 0, '2018-06-01 09:19:16', '2018-06-01 09:31:41', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(184, 304, 'IC55', '', '<p><strong>IC 55 en environnement de travail confortable</strong></p>\r\n\r\n<p>Une position de conduite confortable, avec des syst&egrave;mes anti-fatigue pour l&rsquo;op&eacute;rateur avec toutes les op&eacute;rations contr&ocirc;l&eacute;es par un joystick hydraulique unique.</p>\r\n\r\n<p>IC55 avec la nouvelle motorisation Kubota V3800-Tier 4 respecte les r&eacute;glementations sur les &eacute;missions. Les larges acc&egrave;s au moteur et la position centralis&eacute;e de tous les composants sur le c&ocirc;t&eacute; droit de la machine facilitent l&rsquo;entretien.</p>\r\n', '38462-IC55.jpg', 'fr-FR', 1, 1, 10, 0, '2018-06-01 09:23:08', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(185, 304, 'IC55', '', '<p><strong>IC 55 - ein komfortabler Arbeitsplatz</strong></p>\r\n\r\n<p>Eine bequeme Sitzposition und ergonomische Vorrichtungen gegen Erm&uuml;dung des Bedieners, wobei alle Vorg&auml;nge &uuml;ber nur einen hydraulischen Joystick gesteuert werden.</p>\r\n\r\n<p>Der gute Zugang zum Motor und die zentralisierte Lage aller Bauteile auf der rechten Seite der Maschine erm&ouml;glichen problemlose Wartung.</p>\r\n', '38462-IC55.jpg', 'de-DE', 1, 1, 10, 0, '2018-06-01 09:24:16', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(186, 304, 'IC55', '', '<p><strong>IC 55 un ambiente de trabajo c&oacute;modo</strong></p>\r\n\r\n<p>Una posici&oacute;n de gu&iacute;a c&oacute;moda y con sistemas anti-fatiga para el operador con todas las operaciones controladas por un &uacute;nico joystick hidr&aacute;ulico.</p>\r\n\r\n<p>IC55 con la nueva motorizaci&oacute;n Kubota V3800-Tier 4 respeta la normativa sobre emisiones. Los amplios accesos al motor y la posici&oacute;n centralizada de todos los componentes en el lado derecho de la m&aacute;quina permiten un mantenimiento sencillo.</p>\r\n', '38462-IC55.jpg', 'es-ES', 1, 1, 10, 0, '2018-06-01 09:25:15', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(187, 305, 'IC75-2', '', '<p><strong>Personalizable y de mantenimiento f&aacute;cil</strong></p>\r\n\r\n<p>El IC75-2 puede personalizarse para adaptarse a cualquier tipolog&iacute;a de trabajo.</p>\r\n\r\n<p>El puesto de conducci&oacute;n resulta especialmente c&oacute;modo, gracias al asiento envolvente y regulable y a la disposici&oacute;n ergon&oacute;mica de los mandos.</p>\r\n\r\n<p>Va equipado con joysticks servoasistidos de serie que aseguran la m&aacute;xima precisi&oacute;n.</p>\r\n', '88097-IC75-2.jpg', 'es-ES', 1, 1, 20, 0, '2018-06-01 09:26:06', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(188, 305, 'IC75-2', '', '<p><strong>Personalizzabile e di facile manutenzione</strong></p>\r\n\r\n<p>L&rsquo;IC75-2 pu&ograve; essere personalizzato per adattarsi a qualsiasi tipologia di lavoro.</p>\r\n\r\n<p>La postazione di guida risulta particolarmente confortevole, grazie al sedile avvolgente e regolabile ed alla disposizione ergonomica dei comandi.</p>\r\n\r\n<p>&Egrave; equipaggiata con joy-stick servoassistiti di serie che assicurano la massima precisione.</p>\r\n', '88097-IC75-2.jpg', 'it-IT', 1, 1, 20, 0, '2018-06-01 09:27:13', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(189, 305, 'IC75-2', '', '<p>Personnalisable et facile &agrave; entretenir</p>\r\n\r\n<p>L&rsquo;IC75-2 peut &ecirc;tre personnalis&eacute; pour s&rsquo;adapter &agrave; tout type de travail.</p>\r\n\r\n<p>Le poste de conduite est particuli&egrave;rement confortable, gr&acirc;ce au si&egrave;ge-baquet et r&eacute;glable et &agrave; la disposition ergonomique des commandes.</p>\r\n\r\n<p>Il est &eacute;quip&eacute; de joysticks servo-assist&eacute;s de s&eacute;rie qui garantissent la pr&eacute;cision maximale.</p>\r\n', '88097-IC75-2.jpg', 'fr-FR', 1, 1, 20, 0, '2018-06-01 09:28:10', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(190, 305, 'IC75-2', '', '<p><strong>Individuell anpassbar und leicht zu warten</strong></p>\r\n\r\n<p>Der IC75-2 kann auf jede Art Arbeit angepasst werden.</p>\r\n\r\n<p>Der Fahrerplatz ist durch den bequemen, einstellbaren Sitz und die ergonomische Anordnung der Steuerger&auml;te besonders komfortabel.</p>\r\n\r\n<p>Er ist mit servounterst&uuml;tzten Joysticks ausgestattet, die maximale Pr&auml;zision gew&auml;hrleisten.</p>\r\n', '88097-IC75-2.jpg', 'de-DE', 1, 1, 20, 0, '2018-06-01 09:29:16', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(191, 306, 'IC120-2', '', '<p><strong>Exceptional stability</strong></p>\r\n\r\n<p>IC120-2 offers the greatest loading capacity in its category.</p>\r\n\r\n<p>Every operation is controlled from a single hydraulic joystick. Simplified maintenance.</p>\r\n', '24593-IC120-2.jpg', 'en-EN', 1, 1, 30, 0, '2018-06-01 09:30:38', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(192, 306, 'IC120-2', '', '<p><strong>Eccezionale stabilit&agrave;</strong></p>\r\n\r\n<p>L&rsquo;IC120-2 ha la massima capacit&agrave; di carico per la categoria.</p>\r\n\r\n<p>Tutte le operazioni sono controllate da un unico joystick idraulico. Manutenzione semplificata.</p>\r\n', '24593-IC120-2.jpg', 'it-IT', 1, 1, 30, 0, '2018-06-01 09:32:31', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(193, 306, 'IC120-2', '', '<p><strong>Stabilit&eacute; exceptionnelle</strong></p>\r\n\r\n<p>L&rsquo;IC120-2 a la capacit&eacute; maximale de chargement pour la cat&eacute;gorie.</p>\r\n\r\n<p>Toutes les op&eacute;rations sont contr&ocirc;l&eacute;es par un joystick hydraulique unique. Entretien simplifi&eacute;.</p>\r\n', '24593-IC120-2.jpg', 'fr-FR', 1, 1, 30, 0, '2018-06-01 09:33:29', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(194, 306, 'IC120-2', '', '<p><strong>Hervorragende Stabilit&auml;t</strong></p>\r\n\r\n<p>Der IC120-2 verf&uuml;gt &uuml;ber die h&ouml;chste Ladekapazit&auml;t seiner Kategorie.</p>\r\n\r\n<p>Alle Bewegungen werden mit nur einem hydraulischen Joystick gesteuert.</p>\r\n\r\n<p>Vereinfachte Wartung.</p>\r\n', '24593-IC120-2.jpg', 'de-DE', 1, 1, 30, 0, '2018-06-01 09:34:30', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(195, 306, 'IC120-2', '', '<p><strong>Estabilidad excepcional</strong></p>\r\n\r\n<p>El IC120-2 tiene la m&aacute;xima capacidad de carga para la categor&iacute;a.</p>\r\n\r\n<p>Todas las operaciones son controladas por un solo joystick hidr&aacute;ulico.</p>\r\n\r\n<p>Mantenimiento simplificado.</p>\r\n', '24593-IC120-2.jpg', 'es-ES', 1, 1, 30, 0, '2018-06-01 09:35:19', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:15:\"5.5 - 12.0 Tons\";}'),
(196, 270, 'Mini-chargeurs', '', '<p>Compacts et fonctionnels</p>\r\n', '74465-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'fr-FR', 1, 1, 50, 0, '2018-06-01 09:38:42', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(197, 270, 'Kompaltlader', '', 'FunktionstÃ¼chtigkeit und Vielseitigkeit ohne Grenzen', '74465-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'de-DE', 1, 1, 50, 0, '2018-06-01 09:39:49', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(198, 270, 'Minicargadoras', '', '<p>Funcionalidad y versatilidad a la en&eacute;sima potencia</p>\r\n', '74465-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'es-ES', 1, 1, 50, 0, '2018-06-01 09:41:01', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(199, 307, 'AS12', '', '<p><strong>Maximum flexibility in reduced spaces</strong></p>\r\n\r\n<p>Reliability, speed, servo-assisted joysticks and compactness are the strengths of the new KATO IMER skid-steer loader AS12, ideal to operate in confined spaces with the greatest flexibility and at the same time ensuring high performance.</p>\r\n\r\n<p>It is equipped with the Yanmar 3TNV76 1116 cc engine that achieves excellent performance even in the most complex and of difficult situations.</p>\r\n', '90143-AS12-03-3-4-fronte-dx-bennaalta_mini.jpg', 'en-EN', 1, 1, 10, 0, '2018-06-01 09:42:28', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(200, 307, 'AS12', '', '<p><strong>Massima flessibilit&agrave; in ambienti ridotti</strong></p>\r\n\r\n<p>Affidabilit&agrave;, velocit&agrave;, joystick servoassistiti e compattezza sono questi i punti di forza del nuovo skid-steer loader AS12 nato in casa KATO IMER, ideale per operare in ambienti ristretti in massima flessibilit&agrave; e nello stesso tempo garantendo performance elevate.</p>\r\n\r\n<p>&Egrave; equipaggiato con motore Yanmar 3TNV76 di 1116 di cilindrata che consente di ottenere ottime prestazioni anche nelle situazioni pi&ugrave; complesse e difficili.</p>\r\n', '90143-AS12-03-3-4-fronte-dx-bennaalta_mini.jpg', 'it-IT', 1, 1, 10, 0, '2018-06-01 09:43:16', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(201, 307, 'AS12', '', '<p><strong>Flexibilit&eacute; maximale dans des lieux restreints</strong></p>\r\n\r\n<p>Fiable, rapide, compact, avec joystick voici les points forts du nouveau-n&eacute; chez KATO IMER: le mini-chargeur AS12.</p>\r\n\r\n<p>Sa tr&egrave;s grande flexibilit&eacute; le rend id&eacute;al pour travailler dans des endroits &eacute;troits, tout en garantissant de hautes performances.</p>\r\n\r\n<p>Il est &eacute;quip&eacute; du moteur Yanmar 3TNV76 de 1116 cc, ce qui lui permet des prestations optimales m&ecirc;me dans les situations les plus complexes et contraignantes.</p>\r\n', '90143-AS12-03-3-4-fronte-dx-bennaalta_mini.jpg', 'fr-FR', 1, 1, 10, 0, '2018-06-01 09:45:01', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(202, 307, 'AS12', '', '<p><strong>H&ouml;chste Flexibilit&auml;t in beengten Bereichen</strong></p>\r\n\r\n<p>Zuverl&auml;ssigkeit, Geschwindigkeit, servounterst&uuml;tzte Joysticks und kompakte Bauweise sind die Schwerpunkte des neuen Kompaktladers AS12 aus dem Hause IHIMER, ideal f&uuml;r den Einsatz auf beengtem Raum, wo er mit gr&ouml;&szlig;ter Flexibilit&auml;t bei h&ouml;chsten Arbeitsleistungen eingesetzt wird.</p>\r\n\r\n<p>Dieser Kompaktlader ist mit einem Yanmar 3TNV76-Motor mit 1116 cc Hubraum ausgestattet, der ausgezeichnete Leistungen selbst unter schwierigen Arbeitsbedingungen gew&auml;hrleistet.</p>\r\n', '90143-AS12-03-3-4-fronte-dx-bennaalta_mini.jpg', 'de-DE', 1, 1, 10, 0, '2018-06-01 09:46:25', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(203, 307, 'AS12', '', '<p><strong>M&aacute;xima flexibilidad en espacios reducidos</strong></p>\r\n\r\n<p>Fiabilidad, velocidad, palancas de mando servoasistidas y compacidad: son los puntos fuertes de la nueva minicargadora AS12 creada por KATO IMER, ideal para trabajar en espacios estrechos con la m&aacute;xima flexibilidad y prestaciones elevadas.</p>\r\n\r\n<p>Equipada con motor Yanmar 3TNV76 de 1,116 de cilindrada, para obtener excelentes prestaciones incluso en las situaciones m&aacute;s complejas y dif&iacute;ciles.</p>\r\n', '90143-AS12-03-3-4-fronte-dx-bennaalta_mini.jpg', 'es-ES', 1, 1, 0, 0, '2018-06-01 09:49:50', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(204, 308, 'AS20', '', '<p><strong>Compact size with increased performance</strong></p>\r\n\r\n<p>The A20 is small and ideal to work in confined spaces where other machines cannot. The compact size and weight facilitate transport.</p>\r\n\r\n<p>The width of 1220 mm facilitates manoeuvres in narrow passages, corridors, small paths and gates, whereas the nominal operating capacity of 435 kg enables movements in full compliance as a result of an oversized pump ensuring performance from higher category machines.</p>\r\n', '16273-AS20_fronte_3-4_mini.jpg', 'en-EN', 1, 1, 20, 0, '2018-06-01 09:51:08', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(205, 308, 'AS20', '', '<p><strong>Dimensioni compatte con prestazioni superiori</strong></p>\r\n\r\n<p>L&rsquo;AS20 &egrave; piccola, perfetta per operare in spazi ridotti, dove altre macchine non possono. Le dimensioni e i pesi contenuti la garantisco facilit&agrave; di trasporto.</p>\r\n\r\n<p>La larghezza di 1220 mm agevola le manovre attraverso i passaggi stretti, corridoi, piccoli sentieri e cancelli mentre una capacit&agrave; operativa nominale di 435 kg consente movimentazioni di tutto rispetto, grazie ad una pompa sovradimensionata assicurando prestazioni da macchine di categoria superiore.</p>\r\n', '16273-AS20_fronte_3-4_mini.jpg', 'it-IT', 1, 1, 20, 0, '2018-06-01 09:56:32', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(206, 308, 'AS20', '', '<p><strong>Dimensions compactes avec prestations Sup&eacute;rieures</strong></p>\r\n\r\n<p><span style=\"line-height: 1.6em;\">L&rsquo; AS20 est petite, parfaite pour op&eacute;rer dans des espaces r&eacute;duits, o&ugrave; d&rsquo;autres machines ne le peuvent pas. Les dimensions et les poids r&eacute;duits permettent de la transporter facilement.</span></p>\r\n\r\n<p><span style=\"line-height: 1.6em;\">La largeur de 1220 mm facilite les man&oelig;uvres &agrave; travers les passages &eacute;troits, couloirs, petits sentiers et portails, en revanche une capacit&eacute; op&eacute;rationnelle nominale de 435 kg permet des manutentions acceptables, gr&acirc;ce &agrave; une pompe surdimensionn&eacute;e garantissant des prestations par des machines de cat&eacute;gorie sup&eacute;rieure.</span></p>\r\n', '16273-AS20_fronte_3-4_mini.jpg', 'fr-FR', 1, 1, 20, 0, '2018-06-01 09:58:40', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(207, 308, 'AS20', '', '<p class=\"p1\">kompakte bauweise bei h&ouml;chster leistung</p>\r\n\r\n<p><span style=\"line-height: 1.6em;\">AS20 ist klein und eignet sich perfekt zum Arbeiten an engen Pl&auml;tzen, was andere Maschinen nicht schaffen. Die kompakten Abmessungen und das geringe Gewicht garantieren einen problemlosen Transport.</span></p>\r\n\r\n<p>Die Breite von 1220 mm verleiht Wendigkeit an engen Durchfahrten, G&auml;ngen, kleinen Wegen und Toren, w&auml;hrend eine Nenn-Betriebskapazit&auml;t von 435 kg bemerkenswerte Bewegungen gestattet und dank einer &uuml;berdimensionierten Pumpe die Leistungen von Maschinen der h&ouml;chsten Kategorie erreicht werden.</p>\r\n', '16273-AS20_fronte_3-4_mini.jpg', 'de-DE', 1, 1, 20, 0, '2018-06-01 10:01:10', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(208, 308, 'AS20', '', '<p><strong>Dimensiones compactas con prestaciones superiores</strong></p>\r\n\r\n<p>La AS20 es peque&ntilde;a, perfecta para trabajar en espacios reducidos, donde otras m&aacute;quinas no pueden hacerlo. Las dimensiones y los pesos contenidos le garantizan facilidad de transporte.</p>\r\n\r\n<p>La anchura de 1220 mm facilita las maniobras a trav&eacute;s de los pasos estrechos, pasillos, peque&ntilde;os senderos y verjas, mientras que una capacidad operativa nominal de 435 kg permite movimientos importantes, gracias a una bomba sobredimensionada asegurando prestaciones de m&aacute;quinas de categor&iacute;a superior.</p>\r\n', '16273-AS20_fronte_3-4_mini.jpg', 'es-ES', 1, 1, 20, 0, '2018-06-01 10:03:00', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(209, 309, 'AS25', '', '<p><strong>Powerful, stable and sturdy</strong></p>\r\n\r\n<p>The AS25 is a compact, agile and sturdy machine.</p>\r\n\r\n<p>A &ldquo;small giant&rdquo; equipped with exceptional hydraulic performance, even in confined spaces, thus more advantageous to the operator in terms of production and returns.</p>\r\n\r\n<p>The 2434 cc Kubota V2403-ME3B Stage IIIA engine delivers excellent performance in all situations.</p>\r\n', '33397-AS25_posteriore_mini.jpg', 'en-EN', 1, 1, 30, 0, '2018-06-01 10:07:08', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(210, 309, 'AS25', '', '<p><strong>Potente, stabile e robusta</strong></p>\r\n\r\n<p>L&rsquo;AS25 &egrave; una macchina compatta, agile e robusta.</p>\r\n\r\n<p>Un &ldquo;piccolo gigante&rdquo; dotato di prestazioni idrauliche eccezionali anche nei piccoli spazi, dando all&rsquo;operatore vantaggi in termini di produttivit&agrave; e redditivit&agrave;.</p>\r\n\r\n<p>Il motore Kubota V2403-ME3B Stage IIIA di 2434 cc di cilindrata garantisce ottime prestazioni in tutte le situazioni.</p>\r\n', '33397-AS25_posteriore_mini.jpg', 'it-IT', 1, 1, 30, 0, '2018-06-01 10:11:22', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(211, 309, 'AS25', '', '<p><strong>Puissante, stable et robuste</strong></p>\r\n\r\n<p>L&rsquo;AS25 est une machine compacte, rapide et robuste.</p>\r\n\r\n<p>Un &laquo; petit g&eacute;ant &raquo; dot&eacute; de prestations hydrauliques exceptionnelles m&ecirc;me dans les espaces r&eacute;duits, en offrant &agrave; l&rsquo;op&eacute;rateur des avantages en termes de productivit&eacute; et rentabilit&eacute;.</p>\r\n\r\n<p>Le moteur Kubota V2403-ME3B Stage IIIA de 2434 cc de cylindr&eacute;e garantit de parfaites prestations dans toutes les situations.</p>\r\n', '33397-AS25_posteriore_mini.jpg', 'fr-FR', 1, 1, 30, 0, '2018-06-01 10:12:33', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(212, 309, 'AS25', '', '<p><strong>Leistungsf&auml;hig, stabil und robust</strong></p>\r\n\r\n<p>Bei der AS25 handelt es sich um eine kompakte, wendige und robuste Maschine.</p>\r\n\r\n<p>Dieser &bdquo;kleine Riese&ldquo; mit hervorragenden Hydraulikleistungen auch auf kleinem Raum bieten dem Bediener gro&szlig;e Vorteile bei Produktivit&auml;t und Ertragsf&auml;higkeit.</p>\r\n\r\n<p>Der Motor Kubota V2403-ME3B Stage IIIA mit 2434 m3 Hubraum sorgt f&uuml;r Bestleistung in jeder Situation.</p>\r\n', '33397-AS25_posteriore_mini.jpg', 'de-DE', 1, 1, 30, 0, '2018-06-01 10:13:48', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(213, 309, 'AS25', '', '<p><strong>Potente, estable y resistente</strong></p>\r\n\r\n<p>La AS25 es una m&aacute;quina compacta, &aacute;gil y resistente.</p>\r\n\r\n<p>Una &laquo;peque&ntilde;a gigante&raquo; con prestaciones hidr&aacute;ulicas excepcionales incluso en los peque&ntilde;os espacios, dando al operador ventajas por lo que se refiere a la productividad y rentabilidad.</p>\r\n\r\n<p>El motor Kubota V2403-ME3B Stage IIIA de 2434 cc de cilindrada garantiza excelentes prestaciones en todas las situaciones.</p>\r\n', '33397-AS25_posteriore_mini.jpg', 'es-ES', 1, 1, 30, 0, '2018-06-01 10:15:11', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(214, 310, 'AS28', '', '<p><strong>Balance of weights and perfect structure</strong></p>\r\n\r\n<p>The KATO IMER AS28 Skid Loader is powerful and compact, with top travel performance as a result of perfect distribution of the weight.</p>\r\n\r\n<p>Thanks to the auxiliary hydraulic system can be fitted with optional accessories that are useful to work in any environment and condition.</p>\r\n', '98651-AS28_fronte_3-4_mini.jpg', 'en-EN', 1, 1, 40, 0, '2018-06-01 10:58:06', '2018-06-01 11:01:55', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(215, 311, 'AS34', '', '<p><strong>Max attention to maintenance</strong></p>\r\n\r\n<p>With an operating weight of 3700 kg, the AS34 can handle a operating load of 1100 kg, and guarantees a breakout force of 2780 daN.</p>\r\n\r\n<p>Equipped with a Yanmar 4TNV98T-stage IIIA engine of 3320 cc displacement, rated 84.2 HP at 2500 rpm. Tilting cab and radiator and oil cooler with full opening system.</p>\r\n', '4109-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'en-EN', 1, 1, 50, 0, '2018-06-01 11:03:17', '2018-06-01 11:03:36', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(216, 311, 'AS34', '', '<p><strong>Attenzione massima per la manutenzione</strong></p>\r\n\r\n<p>Con un peso operativo di 3640 kg e un carico operativo di 1040 kg, l&rsquo;AS34 garantisce una forza di strappo di 28,7 kN.</p>\r\n\r\n<p>Equipaggiato con motore Yanmar 4TNV98T-stage IIIA, potenza netta di 61 kW a 2500 rpm.</p>\r\n\r\n<p>La cabina &egrave; ribaltabile ed il sistema di apertura del radiatore &egrave; full opening system.</p>\r\n', '4109-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'it-IT', 1, 1, 0, 0, '2018-06-01 12:22:10', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(217, 311, 'AS34', '', '<p><strong>Attention particuli&egrave;re pour l&rsquo;entretien</strong></p>\r\n\r\n<p>Avec un poids en marche de 3700 kg, et une charge utile de 1100 kg, l&rsquo;AS34 garantit une force d&rsquo;arrachement de 2780 daN.</p>\r\n\r\n<p>l est &eacute;quip&eacute; d&rsquo;un moteur Yanmar 4TNV98T-niveau IIIA, d&rsquo;une puissance de 61 kW &agrave; 2500 rpm. La cabine est basculante, et la trappe du radiateur s&rsquo;ouvre compl&egrave;tement.</p>\r\n', '4109-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'fr-FR', 1, 1, 50, 0, '2018-06-01 12:23:44', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(218, 311, 'AS34', '', '<p><strong>Absolut wartungsfreundlich</strong></p>\r\n\r\n<p>Einem Einsatzgewicht von 3500 kg erreicht der AS34 eine Nutzlast von 1020 kg und eine garantierte Rei&szlig;kraft von 2780 daN.</p>\r\n\r\n<p>Ausgestattet ist er mit einem Yanmar-Motor (4TNV98T - Stufe IIIA) mit einer Leistung von 82,3 PS bei 2500 RPM. Die Kabine ist kippbar, der K&uuml;hler zeichnet sich durch sein Full Opening &Ouml;ffnungssystem aus.</p>\r\n', '4109-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'de-DE', 1, 1, 50, 0, '2018-06-01 12:29:16', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(219, 311, 'AS34', '', '<p><strong>M&aacute;xima eficiencia para el mantenimiento</strong></p>\r\n\r\n<p>Con un peso operativo de 3700 kg y una carga operativa de 1100 kg, la minicargadora AS34 garantiza una fuerza de arranque de 2780 daN.</p>\r\n\r\n<p>Equipada con motor Yanmar 4TNV98T-stage IIIA, potencia de 84,2 CV a 2500 rpm. La cabina es abatible y el radiador es con sistema de apertura total.</p>\r\n', '4109-AS34-fronte-3-4-dx-Yellow_mini.jpg', 'es-ES', 1, 1, 50, 0, '2018-06-01 12:30:00', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(220, 310, 'AS28', '', '<p><strong>Equilibrio dei pesi e geometrie ottimali</strong></p>\r\n\r\n<p>Lo Skid Loader AS 28 di KATO IMER &egrave; potente e compatto, con ottime prestazioni in traslazione dovute alla perfetta distribuzione dei pesi.</p>\r\n\r\n<p>Grazie all&rsquo;impianto idraulico ausiliario pu&ograve; montare accessori opzionali utili per lavorare in qualunque ambiente e condizione.</p>\r\n', '98651-AS28_fronte_3-4_mini.jpg', 'it-IT', 1, 1, 40, 0, '2018-06-01 12:30:50', '2018-06-01 12:35:34', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(221, 310, 'AS28', '', '<p><strong>&Eacute;quilibre des poids et g&eacute;om&eacute;tries parfaites</strong></p>\r\n\r\n<p>Le Skid Loader AS 28 de KATO IMER est puissant et compact, avec des prestations parfaites en translation dues &agrave; la distribution parfaite des poids.</p>\r\n\r\n<p>Gr&acirc;ce &agrave; l&rsquo;installation hydraulique auxiliaire il peut monter des accessoires en option utiles pour travailler dans n&rsquo;importe quel environnement et condition.</p>\r\n', '98651-AS28_fronte_3-4_mini.jpg', 'fr-FR', 1, 1, 0, 0, '2018-06-01 12:32:17', '2018-06-01 12:36:11', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(222, 310, 'AS28', '', '<p style=\"line-height: 20.8px;\"><strong>Optimale Gewichtsverteilung und Geometrie</strong></p>\r\n\r\n<p style=\"line-height: 20.8px;\">Der Kompaktlader AS 28 von KATO IMER ist leistungsf&auml;hig und kompakt und bietet aufgrund der optimalen Gewichtsverteilung Bestleistung beim Fahren.</p>\r\n\r\n<p style=\"line-height: 20.8px;\">Dank der zus&auml;tzlichen Hydraulikanlage k&ouml;nnen n&uuml;tzliche Zubeh&ouml;rwerkzeuge f&uuml;r Arbeiten in jedem Terrain und unter jeden Bedingungen montiert werden.</p>\r\n', '98651-AS28_fronte_3-4_mini.jpg', 'de-DE', 1, 1, 40, 0, '2018-06-01 12:33:05', '2018-06-01 12:34:48', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(223, 310, 'AS28', '', '<p><strong>Equilibrio de pesos y geometr&iacute;as optimales</strong></p>\r\n\r\n<p>El cargador de direcci&oacute;n deslizante AS 28 de KATO IMER es potente y compacto, con &oacute;ptimas prestaciones en traslaci&oacute;n debidas a su perfecta distribuci&oacute;n de los pesos. Gracias al equipo hidr&aacute;ulico auxiliar puede montar accesorios opcionales &uacute;tiles para trabajar en cualquier ambiente y condici&oacute;n.</p>\r\n', '98651-AS28_fronte_3-4_mini.jpg', 'es-ES', 1, 1, 40, 0, '2018-06-01 12:33:50', '2018-06-01 12:36:54', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(224, 312, 'AT33', '', '<p><strong>Track loader</strong></p>\r\n\r\n<p>The AT33 Track loader is agile and sturdy, a &ldquo;small giant&rdquo; as a result of exceptional hydraulic performance.</p>\r\n\r\n<p>AT33 has an operating weight of 3575 kg and a lifting force of 23.42 kN.</p>\r\n', '5992-AT33_fronte_3-4-mini.jpg', 'en-EN', 1, 1, 60, 0, '2018-06-01 12:39:42', '2018-06-01 12:43:49', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(225, 312, 'AT33', '', '<p>Track loader</p>\r\n\r\n<p>Il Track loader AT33 &egrave; agile e robusto, &egrave; un &ldquo;piccolo gigante&rdquo; grazie a prestazioni idrauliche eccezionali.</p>\r\n\r\n<p>l&rsquo;AT33 ha un peso operativo di 3575 kg e una forza di sollevamento di 23,42 kN.</p>\r\n', '5992-AT33_fronte_3-4-mini.jpg', 'it-IT', 1, 1, 0, 0, '2018-06-01 12:44:46', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(226, 312, 'AT33', '', '<p><strong>Track loader</strong></p>\r\n\r\n<p>Le Track loader AT33 est agile et robuste, il est un &laquo; petit g&eacute;ant &raquo; gr&acirc;ce aux prestations hydrauliques exceptionnelles.</p>\r\n\r\n<p>l&rsquo;AT33 a un poids op&eacute;rationnel de 3575 kg et une force de levage de 23,42 kN.</p>\r\n', '5992-AT33_fronte_3-4-mini.jpg', 'fr-FR', 1, 1, 0, 0, '2018-06-01 12:45:29', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(227, 312, 'AT33', '', '<p>Raupenlader</p>\r\n\r\n<p>Der Raupenlader AT33 ist wendig und robust, ein &bdquo;kleiner Riese&ldquo; dank seiner hervorragenden hydraulischen Leistungen.</p>\r\n\r\n<p>Der AT33 hat ein Betriebsgewicht von 3575 kg und eine Hubkraft von 23,42 kN.</p>\r\n', '5992-AT33_fronte_3-4-mini.jpg', 'de-DE', 1, 1, 60, 0, '2018-06-01 12:46:16', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}'),
(228, 312, 'AT33', '', '<p>Track loader</p>\r\n\r\n<p>La Track loader AT33 es &aacute;gil y resistente, es un &ldquo;peque&ntilde;o gigante&rdquo; gracias a prestaciones hidr&aacute;ulicas excepcionales.</p>\r\n\r\n<p>El AT33 tiene un peso operativo de 3575 kg y una fuerza de elevaci&oacute;n de 23,42 kN.</p>\r\n', '5992-AT33_fronte_3-4-mini.jpg', 'es-ES', 1, 1, 60, 0, '2018-06-01 12:47:06', '0000-00-00 00:00:00', 'a:1:{s:4:\"tonn\";s:13:\"330 / 1000 Kg\";}');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_layout`
--

CREATE TABLE `tbl_layout` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(222) NOT NULL,
  `Descrizione` varchar(255) NOT NULL,
  `Immagine` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabella dei layout per i monopagina';

--
-- Dump dei dati per la tabella `tbl_layout`
--

INSERT INTO `tbl_layout` (`ID`, `Nome`, `Descrizione`, `Immagine`) VALUES
(1, 'Layout standard', 'titolo, descrizione e immagine', 'layout-header-standard.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `tbl_meta`
--

CREATE TABLE `tbl_meta` (
  `ID_meta` int(11) NOT NULL,
  `ID_item` int(11) NOT NULL,
  `TitoloSEO` varchar(120) NOT NULL,
  `DescrizioneSEO` varchar(200) NOT NULL,
  `KeywordSEO` varchar(120) NOT NULL,
  `PermalinkSEO` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tbl_meta`
--

INSERT INTO `tbl_meta` (`ID_meta`, `ID_item`, `TitoloSEO`, `DescrizioneSEO`, `KeywordSEO`, `PermalinkSEO`) VALUES
(6, 254, 'Categoria 2', '', '', 'categoria-2'),
(7, 255, 'Subcategoria 1.1', '', '', 'subcategoria-1-1'),
(8, 256, 'Sub subcategoria 2.1', '', '', 'sub-subcategoria-2-1'),
(9, 257, 'Sub subcategory 2.1', '', '', 'sub-subcategory-2-1'),
(10, 0, 'Lorem ipsum dolor sit amet sed etiam tandem', '', '', 'lorem-ipsum-dolor-sit-amet-sed-etiam-tandem'),
(11, 240, 'Lorem ipsum dolor sit amet sed etiam tandem', '', '', 'lorem-ipsum-dolor-sit-amet-sed-etiam-tandem'),
(12, 241, 'Lorem ipsum dolor sit amet sed etiam tandem', '', '', 'lorem-ipsum-dolor-sit-amet-sed-etiam-tandem'),
(13, 258, 'Lorem ipsum dolor sit amet sed etiam tandem', '', '', 'lorem-ipsum-dolor-sit-amet-sed-etiam-tandem'),
(14, 259, 'Paragrafo', '', '', 'paragrafo'),
(16, 261, 'Provalo per 1 mese...<br/> e decidi se pagare o meno', '', '', 'provalo-per-1-mese-br-e-decidi-se-pagare-o-meno'),
(15, 260, 'What we do', '', '', 'what-we-do'),
(17, 262, 'Skills', '', '', 'skills'),
(18, 263, 'Lorem ipsum dolor sit', '', '', 'lorem-ipsum-dolor-sit'),
(19, 264, 'Row prova', '', '', 'row-prova'),
(20, 265, 'Row prova', '', '', 'row-prova'),
(21, 266, 'Row prova', '', '', 'row-prova'),
(22, 267, 'as as aSs ', '', '', 'as-as-ass'),
(23, 268, 's AS s', '', '', 's-as-s'),
(24, 269, 'asd sad sads', '', '', 'asd-sad-sads'),
(25, 270, 'ss asS ', '', '', 'ss-ass'),
(26, 271, 'asdas da dsad', '', '', 'asdas-da-dsad'),
(27, 272, 'prova ewqwqe', '', '', 'prova-ewqwqe'),
(28, 273, 'a sa sa', '', '', 'a-sa-sa'),
(29, 274, 'dasda sdas', '', '', 'dasda-sdas'),
(30, 275, 'asd asd ada', '', '', 'asd-asd-ada'),
(31, 276, 's asasd', '', '', 's-asasd'),
(32, 277, 'sda dasdsa', '', '', 'sda-dasdsa'),
(33, 278, 'asda da 2', '', '', 'asda-da-2'),
(34, 279, 'asda da', '', '', 'asda-da'),
(35, 0, 'Lorem ipsum dolor sit amet sed etiam tandem', '', '', 'lorem-ipsum-dolor-sit-amet-sed-etiam-tandem'),
(36, 1, 'Lorem ipsum dolor sit amet sed etiam tandem', '', '', 'lorem-ipsum-dolor-sit-amet-sed-etiam-tandem'),
(37, 3, 'Paragrafo 2', '', '', 'paragrafo-2'),
(38, 4, 'What we do', '', '', 'what-we-do'),
(39, 5, 'Try it! You have free opt-out.', '', '', 'try-it-you-have-free-opt-out-'),
(40, 6, '4 Colour Theorem', '', '', '4-colour-theorem'),
(41, 7, 'Skills', '', '', 'skills'),
(42, 8, 'prova', '', '', 'prova'),
(43, 9, '9VXE', '', '', '9vxe'),
(44, 10, '9VXE', '', '', '9vxe'),
(45, 11, '9VXE', '', '', '9vxe'),
(46, 12, 'Mini escavatori', '', '', 'mini-escavatori'),
(47, 13, 'Skid Loaders', '', '', 'skid-loaders'),
(48, 14, 'Mini-dumpers', '', '', 'mini-dumpers'),
(49, 15, 'Skid loader', '', '', 'skid-loader'),
(50, 20, 'Crawler Carriers', '', '', 'crawler-carriers'),
(51, 21, 'Minidumper', '', '', 'minidumper'),
(52, 22, 'Crawler Carriers', '', '', 'crawler-carriers'),
(61, 31, '12VXE', '', '', '12vxe'),
(53, 23, '9VXE', '', '', '9vxe'),
(60, 30, '9VXE', '', '', '9vxe'),
(54, 24, 'ITEM ITA NEWS', '', '', 'item-ita-news'),
(55, 25, '12VXE', '', '', '12vxe'),
(56, 26, 'Mini-Pelles', '', '', 'mini-pelles'),
(57, 27, 'Minibagger', '', '', 'minibagger'),
(58, 28, 'Miniexcavadoras', '', '', 'miniexcavadoras'),
(59, 29, '9VXE', '', '', '9vxe'),
(62, 32, '9VXE', '', '', '9vxe'),
(63, 33, '9VXE', '', '', '9vxe'),
(64, 34, 'Prova', '', '', 'prova'),
(65, 35, 'Prova titolo', '', '', 'prova-titolo'),
(66, 36, '12VXE', '', '', '12vxe'),
(67, 37, '12VXE', '', '', '12vxe'),
(68, 38, '12VXE', '', '', '12vxe'),
(69, 39, '17VXE', '', '', '17vxe'),
(70, 40, '17VXE', '', '', '17vxe'),
(71, 41, '17VXE', '', '', '17vxe'),
(72, 42, '17VXE', '', '', '17vxe'),
(73, 43, '17VXE', '', '', '17vxe'),
(74, 44, '17VXT', '', '', '17vxt'),
(75, 45, '17VXT', '', '', '17vxt'),
(76, 46, '17VXT', '', '', '17vxt'),
(77, 47, '17VXT', '', '', '17vxt'),
(78, 48, '17VXT', '', '', '17vxt'),
(79, 49, '19VXT', '', '', '19vxt'),
(80, 50, '19VXT', '', '', '19vxt'),
(81, 51, '19VXT', '', '', '19vxt'),
(82, 52, '19VXT', '', '', '19vxt'),
(83, 53, '19VXT', '', '', '19vxt'),
(84, 54, '27V4', '', '', '27v4'),
(85, 55, '27V4', '', '', '27v4'),
(86, 56, '27V4', '', '', '27v4'),
(87, 57, '27V4', '', '', '27v4'),
(88, 58, '27V4', '', '', '27v4'),
(89, 59, '30V4', '', '', '30v4'),
(90, 60, '30V4', '', '', '30v4'),
(91, 61, '30V4', '', '', '30v4'),
(92, 62, '30V4', '', '', '30v4'),
(93, 63, '30V4', '', '', '30v4'),
(94, 64, '35N4', '', '', '35n4'),
(95, 65, '35N4', '', '', '35n4'),
(96, 66, '35N4', '', '', '35n4'),
(97, 67, '35N4', '', '', '35n4'),
(98, 68, '35N4', '', '', '35n4'),
(99, 69, '35V4', '', '', '35v4'),
(100, 70, '35V4', '', '', '35v4'),
(101, 71, '35V4', '', '', '35v4'),
(102, 72, '35V4', '', '', '35v4'),
(103, 73, '35V4', '', '', '35v4'),
(104, 74, '45V4', '', '', '45v4'),
(105, 75, '45V4', '', '', '45v4'),
(106, 76, '45V4', '', '', '45v4'),
(107, 77, '45V4', '', '', '45v4'),
(108, 78, '45V4', '', '', '45v4'),
(109, 79, '55V4', '', '', '55v4'),
(110, 80, '55V4', '', '', '55v4'),
(111, 81, '55V4', '', '', '55v4'),
(112, 82, '55V4', '', '', '55v4'),
(113, 83, '55V4', '', '', '55v4'),
(114, 84, '55N4', '', '', '55n4'),
(115, 85, '55N4', '', '', '55n4'),
(116, 86, '55N4', '', '', '55n4'),
(117, 87, '55N4', '', '', '55n4'),
(118, 88, '55N4', '', '', '55n4'),
(119, 89, '60V4', '', '', '60v4'),
(120, 90, '60V4', '', '', '60v4'),
(121, 91, '60V4', '', '', '60v4'),
(122, 92, '60V4', '', '', '60v4'),
(123, 93, '60V4', '', '', '60v4'),
(124, 94, '85V4', '', '', '85v4'),
(125, 95, '85V4', '', '', '85v4'),
(126, 96, '85V4', '', '', '85v4'),
(127, 97, '85V4', '', '', '85v4'),
(128, 98, '85V4', '', '', '85v4'),
(129, 99, 'Carry105', '', '', 'carry105'),
(130, 100, 'Mini-Transporteurs', '', '', 'mini-transporteurs'),
(131, 101, 'Minidumper', '', '', 'minidumper'),
(132, 102, 'Minidumper', '', '', 'minidumper'),
(133, 103, 'Carry105', '', '', 'carry105'),
(134, 104, 'Carry105', '', '', 'carry105'),
(135, 105, 'Carry105', '', '', 'carry105'),
(136, 106, 'Carry105', '', '', 'carry105'),
(137, 107, 'Carry105', '', '', 'carry105'),
(138, 108, 'Carry105 Electripower', '', '', 'carry105-electripower'),
(139, 109, 'Carry107', '', '', 'carry107'),
(140, 110, 'Carry107', '', '', 'carry107'),
(141, 111, 'Carry107', '', '', 'carry107'),
(142, 112, 'Carry107', '', '', 'carry107'),
(143, 113, 'Carry107ht', '', '', 'carry107ht'),
(144, 114, 'Carry110', '', '', 'carry110'),
(145, 115, 'Carry110', '', '', 'carry110'),
(146, 116, 'Carry110', '', '', 'carry110'),
(147, 117, 'Carry150', '', '', 'carry150'),
(148, 118, 'Carry250', '', '', 'carry250'),
(149, 119, 'Dumper', '', '', 'dumper'),
(150, 120, 'Dumper', '', '', 'dumper'),
(151, 121, 'IC35', '', '', 'ic35'),
(152, 122, 'Transporteurs', '', '', 'transporteurs'),
(153, 123, 'Dumper', '', '', 'dumper'),
(154, 124, 'Dumper', '', '', 'dumper'),
(155, 125, 'Carry110', '', '', 'carry110'),
(156, 126, 'Carry110', '', '', 'carry110'),
(157, 127, 'Carry110', '', '', 'carry110'),
(158, 128, 'Carry110', '', '', 'carry110'),
(159, 129, 'Carry110', '', '', 'carry110'),
(160, 130, 'Carry110', '', '', 'carry110'),
(161, 131, 'Carry110', '', '', 'carry110'),
(162, 132, 'Carry110', '', '', 'carry110'),
(163, 133, 'Carry110', '', '', 'carry110'),
(164, 134, 'Carry110', '', '', 'carry110'),
(165, 135, 'Carry110', '', '', 'carry110'),
(166, 136, 'Carry110', '', '', 'carry110'),
(167, 137, 'Carry107ht', '', '', 'carry107ht'),
(168, 138, 'Carry107ht', '', '', 'carry107ht'),
(169, 139, 'Carry107ht', '', '', 'carry107ht'),
(170, 140, 'Carry107ht', '', '', 'carry107ht'),
(171, 141, 'Carry107', '', '', 'carry107'),
(172, 142, 'Carry107', '', '', 'carry107'),
(173, 143, 'Carry107', '', '', 'carry107'),
(174, 144, 'Carry107', '', '', 'carry107'),
(175, 145, 'Carry107', '', '', 'carry107'),
(176, 146, 'Carry107', '', '', 'carry107'),
(177, 147, 'Carry107', '', '', 'carry107'),
(178, 148, 'Carry107', '', '', 'carry107'),
(179, 149, 'Carry107', '', '', 'carry107'),
(180, 150, 'Carry107', '', '', 'carry107'),
(181, 151, 'Carry107', '', '', 'carry107'),
(182, 152, 'Carry107', '', '', 'carry107'),
(183, 153, 'Carry107', '', '', 'carry107'),
(184, 154, 'Carry107', '', '', 'carry107'),
(185, 155, 'Carry107', '', '', 'carry107'),
(186, 156, 'Carry107', '', '', 'carry107'),
(187, 157, 'carry105 electricpower', '', '', 'carry105-electricpower'),
(188, 158, 'Carry105 electricpower', '', '', 'carry105-electricpower'),
(189, 159, 'Carry105 electricpower', '', '', 'carry105-electricpower'),
(190, 160, 'Carry105 electricpower', '', '', 'carry105-electricpower'),
(191, 161, 'Carry105', '', '', 'carry105'),
(192, 162, 'Carry105', '', '', 'carry105'),
(193, 163, 'Carry105', '', '', 'carry105'),
(194, 164, 'Carry105', '', '', 'carry105'),
(195, 165, 'IC35', '', '', 'ic35'),
(196, 166, 'IC35', '', '', 'ic35'),
(197, 167, 'IC35', '', '', 'ic35'),
(198, 168, 'IC35', '', '', 'ic35'),
(199, 169, 'Carry150', '', '', 'carry150'),
(200, 170, 'Carry150', '', '', 'carry150'),
(201, 171, 'Carry150', '', '', 'carry150'),
(202, 172, 'Carry150', '', '', 'carry150'),
(203, 173, 'Carry150', '', '', 'carry150'),
(204, 174, 'Carry250', '', '', 'carry250'),
(205, 175, 'Carry250', '', '', 'carry250'),
(206, 176, 'Carry250', '', '', 'carry250'),
(207, 177, 'Carry250', '', '', 'carry250'),
(208, 178, 'Transporteurs', '', '', 'transporteurs'),
(209, 179, 'Crawler Carriers', '', '', 'crawler-carriers'),
(210, 180, 'Crawler Carriers', '', '', 'crawler-carriers'),
(211, 181, 'IC55', '', '', 'ic55'),
(212, 182, 'IC75-2', '', '', 'ic75-2'),
(213, 183, 'IC55', '', '', 'ic55'),
(214, 184, 'IC55', '', '', 'ic55'),
(215, 185, 'IC55', '', '', 'ic55'),
(216, 186, 'IC55', '', '', 'ic55'),
(217, 187, 'IC75-2', '', '', 'ic75-2'),
(218, 188, 'IC75-2', '', '', 'ic75-2'),
(219, 189, 'IC75-2', '', '', 'ic75-2'),
(220, 190, 'IC75-2', '', '', 'ic75-2'),
(221, 191, 'IC120-2', '', '', 'ic120-2'),
(222, 192, 'IC120-2', '', '', 'ic120-2'),
(223, 193, 'IC120-2', '', '', 'ic120-2'),
(224, 194, 'IC120-2', '', '', 'ic120-2'),
(225, 195, 'IC120-2', '', '', 'ic120-2'),
(226, 196, 'Mini-chargeurs', '', '', 'mini-chargeurs'),
(227, 197, 'Kompaltlader', '', '', 'kompaltlader'),
(228, 198, 'Minicargadoras', '', '', 'minicargadoras'),
(229, 199, 'AS12', '', '', 'as12'),
(230, 200, 'AS12', '', '', 'as12'),
(231, 201, 'AS12', '', '', 'as12'),
(232, 202, 'AS12', '', '', 'as12'),
(233, 203, 'AS12', '', '', 'as12'),
(234, 204, 'AS20', '', '', 'as20'),
(235, 205, 'AS20', '', '', 'as20'),
(236, 206, 'AS20', '', '', 'as20'),
(237, 207, 'AS20', '', '', 'as20'),
(238, 208, 'AS20', '', '', 'as20'),
(239, 209, 'AS25', '', '', 'as25'),
(240, 210, 'AS25', '', '', 'as25'),
(241, 211, 'AS25', '', '', 'as25'),
(242, 212, 'AS25', '', '', 'as25'),
(243, 213, 'AS25', '', '', 'as25'),
(244, 214, 'AS28', '', '', 'as28'),
(245, 215, 'AS34', '', '', 'as34'),
(246, 216, 'AS34', '', '', 'as34'),
(247, 217, 'AS34', '', '', 'as34'),
(248, 218, 'AS34', '', '', 'as34'),
(249, 219, 'AS34', '', '', 'as34'),
(250, 220, 'AS28', '', '', 'as28'),
(251, 221, 'AS28', '', '', 'as28'),
(252, 222, 'AS28', '', '', 'as28'),
(253, 223, 'AS28', '', '', 'as28'),
(254, 224, 'AT33', '', '', 'at33'),
(255, 225, 'AT33', '', '', 'at33'),
(256, 226, 'AT33', '', '', 'at33'),
(257, 227, 'AT33', '', '', 'at33'),
(258, 228, 'AT33', '', '', 'at33');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `iscritti`
--
ALTER TABLE `iscritti`
  ADD PRIMARY KEY (`ID_iscritto`);

--
-- Indici per le tabelle `macchine`
--
ALTER TABLE `macchine`
  ADD PRIMARY KEY (`ID_macchina`);

--
-- Indici per le tabelle `officine`
--
ALTER TABLE `officine`
  ADD PRIMARY KEY (`ID_item`);

--
-- Indici per le tabelle `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`ID_image`);

--
-- Indici per le tabelle `tbl_global_role`
--
ALTER TABLE `tbl_global_role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indici per le tabelle `tbl_global_user`
--
ALTER TABLE `tbl_global_user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indici per le tabelle `tbl_group_menu`
--
ALTER TABLE `tbl_group_menu`
  ADD PRIMARY KEY (`ID_menu`);

--
-- Indici per le tabelle `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`ID_item`);

--
-- Indici per le tabelle `tbl_layout`
--
ALTER TABLE `tbl_layout`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `tbl_meta`
--
ALTER TABLE `tbl_meta`
  ADD PRIMARY KEY (`ID_meta`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `iscritti`
--
ALTER TABLE `iscritti`
  MODIFY `ID_iscritto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT per la tabella `macchine`
--
ALTER TABLE `macchine`
  MODIFY `ID_macchina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT per la tabella `officine`
--
ALTER TABLE `officine`
  MODIFY `ID_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT per la tabella `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;
--
-- AUTO_INCREMENT per la tabella `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `ID_image` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `tbl_global_role`
--
ALTER TABLE `tbl_global_role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `tbl_global_user`
--
ALTER TABLE `tbl_global_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `tbl_group_menu`
--
ALTER TABLE `tbl_group_menu`
  MODIFY `ID_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `ID_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
--
-- AUTO_INCREMENT per la tabella `tbl_layout`
--
ALTER TABLE `tbl_layout`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `tbl_meta`
--
ALTER TABLE `tbl_meta`
  MODIFY `ID_meta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
