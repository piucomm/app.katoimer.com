<?php 
session_cache_expire(30);

session_start();

include "include/config.php"; 

$user = mysql_real_escape_string($_POST['user']);
$passw = mysql_real_escape_string($_POST['passw']);
?>

<html>
<head>
<title><?php echo TITOLO_PAGINA;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php
//select di autenticazione utente

$str_query_utente = "SELECT DISTINCT * 
					FROM tbl_global_user tGU, tbl_global_role tGR
					WHERE tGU.Username = '{$user}' AND tGU.Password = MD5('{$passw}') AND tGU.RoleID = tGR.RoleID";

$query_utente = mysql_query($str_query_utente, $conn) or die('Errore nella query!!!');

// verifico se la query restituisce un risultato altrimenti l'utente non è autorizzato



if (@mysql_num_rows($query_utente)) {
	
		
	$res_utente = mysql_fetch_array($query_utente); 
	
	$nome_utente = $res_utente['Username'];
	
	$_SESSION['UserID'] = $res_utente['UserID']; // id utente
	$_SESSION['nome_utente'] = $res_utente['Nome']." ".$res_utente['Cognome'];
	
	$_SESSION['nome_r'] = $res_utente['Role_Name']; // ruolo
	
	$_SESSION['ID_ruolo'] = $res_utente['RoleID']; // id ruolo
	
	$_SESSION['ico'] = $res_utente['icona'];
	
	$_SESSION['W_thumb'] = W_THUMB;
	$_SESSION['H_thumb'] = H_THUMB;

	$_SESSION['W_big'] = W_BIG;
	$_SESSION['H_big'] = H_BIG;

?>

<table width="100%" border="0" cellspacing="0">
	
    <?php include "include/top_bar.php"; ?>

	  <tr>
		<td align="left" valign="top"> 
		  	<!-- inizio tabella menu -->
			<?php include "include/menuSX.php"; ?>
			<!-- fine tabella menu -->
		
		</td>
		<td align="center" valign="middle" > 
		  <!-- inizio tabella box centrale -->
		  <br /><br /><br /><br />
          <strong>Benvenuto nell'area amministrativa! <?php echo TITOLO_PAGINA; ?></strong><br />
           <small>Si ricorda che l'accesso a quest'area da parte di utenti non autorizzati &egrave; illegale e, come tale, punibile a norma delle vigenti norme di legge.</small>
          <br /><br /><br /><br />
		  <!-- fine tabella box_centrale -->
		</td>
</tr>
	  
<?php include "include/footer.php";?>
	
	</table>

<?php	
//se l'utente non è autorizzato
} else {


	$_SESSION['tipo_errore'] = "Errore Autenticazione";
	$_SESSION['msg_errore'] = "Autorizzazione non concessa. Nome Utente e Password non corretti!";
	$_SESSION['img_errore'] = "img/img_errore_autent.jpg";
	include "errore.php";

}

mysql_close($conn);
?>
</body>
</html>
