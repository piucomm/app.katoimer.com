-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mag 09, 2018 alle 10:03
-- Versione del server: 10.1.31-MariaDB
-- Versione PHP: 5.6.27

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
-- Struttura della tabella `tbl_category`
--

CREATE TABLE `tbl_category` (
  `ID` int(11) NOT NULL,
  `Type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Note` text COLLATE latin1_general_ci NOT NULL,
  `Layout` int(11) NOT NULL DEFAULT '1',
  `Data_layout` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ID_padre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `tbl_category`
--

INSERT INTO `tbl_category` (`ID`, `Type`, `Note`, `Layout`, `Data_layout`, `ID_padre`) VALUES
(1, 'CAT', '', 1, '', 0),
(2, 'CAT', '', 1, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"1\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:0:\"\";}', 1),
(263, 'CAT', '', 6, 'a:4:{s:3:\"cta\";s:1:\"1\";s:6:\"layout\";s:1:\"6\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:12:\"introduction\";}', 1),
(267, 'CAT', '', 10, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:2:\"10\";s:6:\"ancora\";s:6:\"skills\";s:8:\"classCss\";s:0:\"\";}', 1),
(266, 'CAT', '', 8, 'a:4:{s:3:\"cta\";s:1:\"1\";s:6:\"layout\";s:1:\"8\";s:6:\"ancora\";s:0:\"\";s:8:\"classCss\";s:8:\"approach\";}', 1),
(265, 'CAT', '', 7, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"7\";s:6:\"ancora\";s:5:\"promo\";s:8:\"classCss\";s:7:\"success\";}', 1),
(264, 'CAT', '', 5, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"5\";s:6:\"ancora\";s:8:\"whatwedo\";s:8:\"classCss\";s:8:\"approach\";}', 1),
(268, 'CAT', '', 2, 'a:4:{s:3:\"cta\";s:1:\"0\";s:6:\"layout\";s:1:\"2\";s:6:\"ancora\";s:11:\"sd ad sad a\";s:8:\"classCss\";s:8:\"as adsad\";}', 1);

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
(1, 'en_GB', 'en_GB', '<p><strong>AlephZero</strong><br />\r\n71-75 Shelton Street - Covent Garden<br />\r\nLondon WC2H 9JQ<br />\r\n<br />\r\nOffice Phone +44 000 0000000<br />\r\nFax +44 000 0000000<br />\r\n<a href=\"mailto:info@alephzero.technology\">info@alephzero.technology</a></p>\r\n', '<p>How, then, can I translate into words the limitless Aleph, which my floundering mind can scarcely encompass?<br />\r\nJ.Luis Borges</p>\r\n');

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
(4, 1, 'Orlando', 'Guiggi', '', 'o.guiggi@piucommunication.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 2147483647, 1, '0000-00-00 00:00:00', '17249-Arnold_Gary_Coleman_thumb400x275.jpg'),
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
  `Data_modifica` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tbl_items`
--

INSERT INTO `tbl_items` (`ID_item`, `ID_cat`, `Titolo`, `Descrizione`, `Immagine`, `Lingua`, `Attiva`, `Pubblica`, `Ordine`, `Evidenza`, `Data_creazione`, `Data_modifica`) VALUES
(2, 2, 'Aleph Zero, the number of the numbers', '<p>When a child asks &quot;How many numbers are there?&quot; everyone answers &quot;Infinite&quot;. The scientific answer is &quot;Aleph Zero&quot;.</p>\r\n\r\n<p>Aleph Zero is where the finite and the infinite meet each other.</p>\r\n\r\n<p>In the sublime tale of Jorge Luis Borges, the Aleph is the point where all the places of the world meet each other.</p>\r\n', '90823-bg-univers-superhero.png', 'en_GB', 1, 1, 10, 0, '2016-11-23 15:59:02', '2017-03-20 11:58:46'),
(1, 1, 'Monopage', '', '', 'en_GB', 1, 1, 0, 0, '2016-11-23 16:00:09', '0000-00-00 00:00:00'),
(3, 263, 'Paragrafo 2', '<p>When a person bids on keywords for Paid Search, the number of options is astronomical, immense. For all practical purposes, it is infinite.</p>\r\n\r\n<p>If you have 500 keywords to bid on and can vary the bids from 0.01 to 10, the combinations are infinite, impossible to optimize once, let alone to optimize again many times per day.</p>\r\n\r\n<p>So, the human bidder (understandably!) gives up and over-simplifies the problem by choosing a finite, indeed a very small, number of bids and changing them from time to time.</p>\r\n\r\n<p>Aleph Zero directly and fully copes with the immensity of the task and optimizes hundreds or thousands of bids, each one with its singular value, 100 times per day, every day, forever.</p>\r\n\r\n<p>Machine Learning algorithms inside Aleph Zero explore the immense labyrinth of bidding and find the right exit. The labyrinth changes its shape, and Aleph Zero restlessly restarts its task.</p>\r\n\r\n<p>Indeed, a non-human task. Leave numerical labyrinths to algorithms, and free humans for what they really do well!</p>\r\n', '94192-diagram.png', 'en_GB', 1, 1, 20, 0, '2016-11-23 16:03:13', '2017-03-20 12:02:15'),
(4, 264, 'What we do', '<p>You give us access to your Search campaigns. Aleph Zero manages your bids with an invisible hand.</p>\r\n\r\n<p>You see your bids changing and KPIs improving, then you harvest the fruits. What do you have to do? Nothing.&nbsp;</p>\r\n\r\n<p>To be honest, you do one thing: you choose your KPIs. Maybe only one: ROI, CPC, CPA, bounce rate, impression share, time on site ... Maybe many KPIs: indeed, you can define a combination of multiple KPIs and ask Aleph Zero to optimize them, balancing their importance. This is a very sophisticated feature for our expert clients.</p>\r\n\r\n<p>Contact us to learn more about the terrific outcomes Aleph Zero reaches!</p>\r\n', '', 'en_GB', 1, 1, 30, 0, '2016-11-23 16:05:46', '2017-03-20 12:03:32'),
(5, 265, 'Try it! You have free opt-out.', '<p>Try Aleph Zero on your campaigns. After one month, you will decide whether to pay and continue or simply leave the service without any fee.</p>\r\n\r\n<p>We are extremely confident in our technology, as we have seen that it quite simply works. Everyday we see what it is able to do and the dramatic impact it has on our clients&#39; ROI.</p>\r\n\r\n<p>You need simply to assess your ROI improvements and see how much they exceed the cost. At that point you decide.</p>\r\n', '', 'en_GB', 1, 1, 50, 0, '2016-11-23 16:13:30', '2017-03-20 12:07:29'),
(6, 266, '4 Colour Theorem', '<p>We are a start-up founded in 2016 in London, with labs in Pisa, Italy.</p>\r\n\r\n<p>After a few months, we proposed Aleph Zero to GroupM Italy. They assessed the outcomes of our technology and recognized its disruptive potential.</p>\r\n\r\n<p>So, in March 2017 GroupM and 4 Colour Theorem announced their partnership for exploiting Aleph Zero in Italy for the Sponsored Search sector.</p>\r\n\r\n<p>We are very proud of this achievement, definitely not easy for a small self-funding start-up.</p>\r\n\r\n<p>This is only a first step. Indeed, the Aleph Zero technology has already generated a version for Programmatic Buying and a release for Social Advertising is coming soon.</p>\r\n', '', 'en_GB', 1, 1, 60, 0, '2016-11-23 16:14:19', '2017-03-20 12:08:35'),
(7, 267, 'Skills', '<div class=\"boxSkill skills-item text-center\">\r\n<div class=\"iconCircle plus\">Machine Learning</div>\r\n</div>\r\n\r\n<div class=\"boxSkill skills-item text-center\">\r\n<div class=\"iconCircle plus\">Data Science</div>\r\n</div>\r\n\r\n<div class=\"boxSkill skills-item text-center\">\r\n<div class=\"iconCircle plus\">Big Data</div>\r\n</div>\r\n\r\n<div class=\"boxSkill skills-item text-center\">\r\n<div class=\"iconCircle plus\">Decision Theory</div>\r\n</div>\r\n\r\n<div class=\"boxSkill skills-item text-center\">\r\n<div class=\"iconCircle plus\">Portfolio Management</div>\r\n</div>\r\n\r\n<div class=\"boxSkill skills-item text-center\">\r\n<div class=\"iconCircle plus\">Auctions Optimization</div>\r\n</div>\r\n', '', 'en_GB', 1, 1, 70, 0, '2016-11-23 16:15:34', '2017-03-20 12:08:42'),
(8, 268, 'prova', '<p>as dad sadsad asd asd assa dsad aas d</p>\r\n', '66280-cabin.png', 'en_GB', 0, 1, 80, 0, '2016-11-24 13:18:24', '2016-11-24 13:18:55');

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
(1, 'Header standard', 'Header con titolo, immagine e background', 'layout-header-standard.jpg'),
(2, 'Row standard', 'Row con titolo, testo e immagine', 'layout-row-standard.jpg'),
(3, 'Row standard BG', 'Row con titolo, testo, immagine e background', 'layout-row-standard-bg.jpg'),
(4, 'Row 2 col.', 'Row con titolo, testo due colonne e immagine', 'layout-row-2col.jpg'),
(5, 'Row 2 col. NO Img', 'Row con titolo, testo 2 colonne', 'layout-row-2col-noimg.jpg'),
(6, 'Row 2 col solo testo', 'Row con testo 2 col.', 'layout-row-2col-noimg-notitle.jpg'),
(7, 'Row 2 col BG rosa', 'Row con titolo, testo 2 colonne, bg e decorazioni', 'layout-row-2col-bgrosa.jpg'),
(8, 'Row 3 col NO Img', 'Row con titolo, testo 3 colonne', 'layout-row-3col-noimg.jpg'),
(9, 'Row 3 col solo testo', 'Row con testo 3 col.', 'layout-row-3col-noimg-notitle.jpg'),
(10, 'Row 1 col NO Img', 'Row con titolo, testo 1 col', 'layout-row-1col-noimg.jpg');

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
(42, 8, 'prova', '', '', 'prova');

--
-- Indici per le tabelle scaricate
--

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
-- AUTO_INCREMENT per la tabella `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;
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
  MODIFY `ID_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `tbl_layout`
--
ALTER TABLE `tbl_layout`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT per la tabella `tbl_meta`
--
ALTER TABLE `tbl_meta`
  MODIFY `ID_meta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
