-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mag 22, 2018 alle 09:29
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
  `Telefono` varchar(255) NOT NULL,
  `Data-inserimento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Immagine` varchar(200) NOT NULL,
  `Note` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `iscritti`
--

INSERT INTO `iscritti` (`ID_iscritto`, `Nome`, `Email`, `Password`, `Ospite`, `Proprietario`, `Stato`, `AuthPrivacy`, `AuthMarketing`, `Telefono`, `Data-inserimento`, `Immagine`, `Note`) VALUES
(2, 'Orlando', 'orlando.guiggi@gmail.com', 'ffac224fd48c201e2ee0062ca5ddd206', 1, 0, 0, 0, 0, '3398362577', '2018-05-15 12:10:42', '', ''),
(3, 'Guiggi', 'info@orlandoguiggi.it', 'ffac224fd48c201e2ee0062ca5ddd206', 1, 0, 0, 1, 1, '123123123', '2018-05-15 12:50:28', '', '<p>&nbsp;das ad asdas dsadasd</p>\r\n'),
(5, 'Filippo', 'f.colca@piucommunication.com', '31f17d0937946da06e9648dbe01bfec9', 0, 1, 1, 0, 0, '23423423', '2018-05-15 13:04:34', '', '<p>asd asd sad asdasdas</p>\r\n'),
(6, 'pluto', 'pluto@kato.it', 'c6009f08fc5fc6385f1ea1f5840e179f', 0, 1, 0, 0, 0, '', '2018-05-15 16:23:17', '', '');

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
(269, 'ITEM', '', 1, 'a:4:{s:3:\"cta\";N;s:6:\"layout\";N;s:6:\"ancora\";N;s:8:\"classCss\";N;}', 2),
(270, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(271, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(272, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1);

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

INSERT INTO `tbl_items` (`ID_item`, `ID_cat`, `Titolo`, `Descrizione`, `Immagine`, `Lingua`, `Attiva`, `Pubblica`, `Ordine`, `Evidenza`, `Data_creazione`, `Data_modifica`, `Attributi`) VALUES
(2, 2, 'Mini excavators', '<p>Desc. mini excavators</p>\r\n', '1292-VFourHD30-02 fronte 3-4_APP-CAT.jpg', 'en-EN', 1, 1, 10, 0, '2016-11-23 15:59:02', '2018-05-21 08:12:06', ''),
(1, 1, 'Catalog', '', '', 'en-EN', 1, 1, 0, 0, '2016-11-23 16:00:09', '0000-00-00 00:00:00', ''),
(13, 270, 'Skid Loaders', '<p>Desc Skin Loaders</p>\r\n', '', 'en-EN', 1, 1, 20, 0, '2018-05-21 07:28:27', '2018-05-21 09:00:47', ''),
(14, 271, 'Mini dumpers', '<p>Desc Mini dumpers</p>\r\n', '65405-VFourHD30-02 fronte 3-4_APP-CAT.jpg', 'en-EN', 1, 1, 30, 0, '2018-05-21 08:21:34', '2018-05-21 08:21:59', ''),
(15, 270, 'Skid loader Ita', '<p>sad asd ada sd asdas</p>\r\n', '', 'it-IT', 1, 1, 20, 0, '2018-05-21 08:24:31', '2018-05-21 13:38:27', ''),
(16, 1, 'Catalogo', '', '', 'it-IT', 1, 1, 0, 0, '2018-05-21 08:58:09', '0000-00-00 00:00:00', ''),
(17, 1, 'Catálogo', '', '', 'es-ES', 1, 1, 0, 0, '2018-05-21 09:02:36', '0000-00-00 00:00:00', ''),
(18, 1, 'Catalogue', '', '', 'fr-FR', 1, 1, 0, 0, '2018-05-21 09:04:05', '0000-00-00 00:00:00', ''),
(19, 1, 'Katalog', '', '', 'de-DE', 1, 1, 0, 0, '2018-05-21 09:04:29', '0000-00-00 00:00:00', ''),
(11, 269, '9VXE', '<p>Lorem ipsum...</p>\r\n', '16603-VFourHD30-02 fronte 3-4_APP.jpg', 'en-EN', 1, 1, 10, 0, '2018-05-16 08:05:29', '2018-05-16 08:40:06', ''),
(12, 2, 'Mini escavatore Ita', '<p>Lorem Ipsum</p>\r\n', '', 'it-IT', 1, 1, 10, 0, '2018-05-16 09:01:28', '2018-05-21 13:38:07', ''),
(20, 272, 'Crawler Carriers', '<p>Desc crawler carriers</p>\r\n', '', 'en-EN', 1, 1, 40, 0, '2018-05-21 13:27:01', '0000-00-00 00:00:00', ''),
(21, 271, 'Mini dumpers Ita', '', '', 'it-IT', 1, 1, 30, 0, '2018-05-21 13:36:51', '0000-00-00 00:00:00', ''),
(22, 272, 'Crawler Carriers Ita', '', '', 'it-IT', 1, 1, 40, 0, '2018-05-21 13:37:16', '0000-00-00 00:00:00', '');

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
(46, 12, 'Mini escavatore Ita', '', '', 'mini-escavatore-ita'),
(47, 13, 'Skid Loaders', '', '', 'skid-loaders'),
(48, 14, 'Mini dumpers', '', '', 'mini-dumpers'),
(49, 15, 'Skid loader Ita', '', '', 'skid-loader-ita'),
(50, 20, 'Crawler Carriers', '', '', 'crawler-carriers'),
(51, 21, 'Mini dumpers Ita', '', '', 'mini-dumpers-ita'),
(52, 22, 'Crawler Carriers Ita', '', '', 'crawler-carriers-ita');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `iscritti`
--
ALTER TABLE `iscritti`
  ADD PRIMARY KEY (`ID_iscritto`);

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
  MODIFY `ID_iscritto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT per la tabella `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
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
  MODIFY `ID_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT per la tabella `tbl_layout`
--
ALTER TABLE `tbl_layout`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `tbl_meta`
--
ALTER TABLE `tbl_meta`
  MODIFY `ID_meta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
