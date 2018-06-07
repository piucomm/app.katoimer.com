<?php

include "config.php";

$str_query_user = "CREATE TABLE `tbl_global_user` (
				  `UserID` int(11) NOT NULL auto_increment,
				  `RoleID` int(11) NOT NULL default '0',
				  `Nome` varchar(100) NOT NULL default '',
				  `Cognome` varchar(100) NOT NULL default '',
				  `Indirizzo` varchar(100) default NULL,
				  `Numero_Civico` varchar(50) default NULL,
				  `Citta` varchar(100) default NULL,
				  `Provincia` varchar(100) default NULL,
				  `CAP` int(11) default '0',
				  `Nazione` varchar(100) default NULL,
				  `Email` varchar(100) NOT NULL default '',
				  `Username` varchar(50) NOT NULL default '',
				  `Password` varchar(50) NOT NULL default '',
				  `Telefono` int(11) default '0',
				  `Cellulare` int(11) default '0',
				  `Accettata` tinyint(4) NOT NULL default '0',
				  `Data_Inserimento` datetime NOT NULL default '0000-00-00 00:00:00',
				  `Sito_Web` varchar(100) default NULL,
				  PRIMARY KEY  (`UserID`)
				) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1 COMMENT='Tabella relativa ai dettagli dell'' utente' AUTO_INCREMENT=0 ;";

mysql_query($str_query_user, $conn) or die('Errore nella query User!');


$str_query_role = "CREATE TABLE `tbl_global_role` (
				  `RoleID` int(11) NOT NULL auto_increment,
				  `Role_Name` varchar(100) NOT NULL default '',
				  `Role_Description` longtext,
				  `icona` varchar(255) NOT NULL default '',
				  PRIMARY KEY  (`RoleID`)
				) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Tabella relativa ai ruoli dell'' utente in un gruppo' AUTO_INCREMENT=5";

mysql_query($str_query_role, $conn) or die('Errore nella query Role!');

$str_insert_role = "INSERT INTO `tbl_global_role` (`RoleID`, `Role_Name`, `Role_Description`, `icona`) VALUES (1, 'SuperAdmin', 'Utente che può fare tutto', 'img/ico_superadmin.gif'),
(2, 'Admin', NULL, 'img/ico_admin.gif'),
(3, 'Admin_settore', NULL, 'img/ico_admin_settore.gif'),
(4, 'User', NULL, 'img/ico_user.gif');";

mysql_query($str_insert_role, $conn) or die('Errore nella query insert Role!');






$str_user_menu = "CREATE TABLE `tbl_group_menu` (
  `ID_menu` int(11) NOT NULL auto_increment,
  `Voce_menu` varchar(255) NOT NULL default '',
  `Descrizione` varchar(255) NOT NULL default '',
  `Link` varchar(255) NOT NULL default '',
  `ID_ruolo` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='Tabella delle voci del menu associate al ruolo' AUTO_INCREMENT=0 ;";

mysql_query($str_user_menu, $conn) or die('Errore nella query USER MENU!');

$str_insert_usermenu = "INSERT INTO `tbl_group_menu` (`ID_menu`, `Voce_menu`, `Descrizione`, `Link`, `ID_ruolo`) VALUES (NULL, 'GESTIONE UTENTI', 'Gestione utenti SuperAdmin', 'gestione_utenti.php', '1');";

mysql_query($str_insert_usermenu, $conn) or die('Errore nella query insert MENU UTenti Role2!');

// inserisco di default il super admin con gestione utenti

$str_insert_user = "INSERT INTO `tbl_global_user` (`UserID`, `RoleID`, `Nome`, `Cognome`, `Indirizzo`, `Numero_Civico`, `Citta`, `Provincia`, `CAP`, `Nazione`, `Email`, `Username`, `Password`, `Telefono`, `Cellulare`, `Accettata`, `Data_Inserimento`, `Sito_Web`) VALUES (NULL, '1', 'Crecchi', 'Cucine', NULL, NULL, NULL, NULL, '0', NULL, '', 'crecchi', MD5('crecchi'), '0', '0', '0', '0000-00-00 00:00:00', NULL);";

mysql_query($str_insert_user, $conn) or die('Errore nella query insert Role SuperAdmin 1!');






?>