<?php 
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL & ~E_NOTICE); 

include "include/config.php";
include "include/common.php"; 

controllo_sessione();

?>

<html>
<head>
<title><?php echo TITOLO_PAGINA;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">


<script language="JavaScript" type="text/JavaScript">
<!--
function resubmit(){
		var lingua = document.form1.ID_lingua.value;
		location.href = 'visual_cat.php?lin='+lingua;
}


function elimina_utente(id_u,pagina) {

	if(confirm("Vuoi veramente eliminare l'utente!"))
	{
		
  		location.href = 'gestione_utenti.php?ID_utente='+id_u+'&azione=elimina_utente&n_pagina='+pagina;
       
  	}
	
	return true;
}

//-->
</script>


</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">


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
		  
		
        



 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  		<tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="100%" align="left" valign="top" class="fontDettLoginGrigioBig"><br>Gestione Utenti<br><br></td>
  		</tr>

  		<tr>
    		<td>&nbsp;</td>
       	  <td align="left" valign="top">
		  
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabellaMenuBordoBlu">
             <?php

			 // elimino l'utente
			 if($_GET['azione'] == "elimina_utente" ){
			 	
				 //elimino la traduzione
				$strEliminaUt = "DELETE FROM tbl_global_user
									WHERE UserID = '{$_SESSION['UserID']}'";			
				
				$resEliminaUt = mysql_query($strEliminaUt) or die(mysql_error());

			 }
	
			 
			 $str_conta = "SELECT count(*) 
						FROM tbl_global_user tGU, tbl_global_role tGR
						WHERE tGU.RoleID >= {$_SESSION['ID_ruolo']} AND tGU.RoleID = tGR.RoleID ";
			
			$query_conta = mysql_query($str_conta, $conn) or die(mysql_error());   
			$res_conta = mysql_fetch_array($query_conta);
			
			//numero della pagina attuale
			if (!isset($_GET['n_pagina'])){
				$now_page = 1;
			} else {
				$now_page = $_GET['n_pagina'];
			}
			
			//numero totale news
			$tot_news = $res_conta[0];
			
			if ( $tot_news != 0 ) {
			
			// **************************
			// numero di categorie per pagina
			// **************************
			
			$per_pag = 10 ;
			
			//paginazione
			if ( $tot_news > $per_pag ){
				if (($tot_news % $per_pag) == 0 ){
					$num_pag = $tot_news / $per_pag;
				} else {
					$num_pag = (($tot_news - ($tot_news % $per_pag)) / $per_pag ) + 1;
				}
			} else {
				$num_pag = 1 ;
			}
			
			$z = 0;
			for ($z = 0; $z < $num_pag; $z++ ){
				$pagine[] = $z + 1;
			}
			
			$b_pag = ( $per_pag * ($now_page - 1));
			$l_pag = ( $per_pag * $now_page );
			
			$str_cat = "SELECT * 
						FROM tbl_global_user tGU, tbl_global_role tGR
						WHERE tGU.RoleID >= {$_SESSION['ID_ruolo']} AND tGU.RoleID = tGR.RoleID
						ORDER BY tGU.UserID ASC 
						LIMIT {$b_pag},{$per_pag}";

			$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());
			?>
              <tr> 
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin"> 
                <img src="img/spacer.gif" width="0" height="9"></td>
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Nome utente </td>
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Ruolo</td>
                <td colspan="2" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Login</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Elimina</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Modifica</td>
              </tr>
              <?php	
			$i = 2;	
			$s = 1;
			
			while ( $res_cat = mysql_fetch_array($query_cat)){			
			
				if( $s < 10 ) {
					$num[$s] = "0".$s;			 
				} else {
					$num[$s] = $s;
				}
			
				if ( ($i % 2) == 0 ){
					$colore_celle = "ffffff";
				} else {
					$colore_celle = "F7F7F7";
				}
					
				// se l'utente sono io voglio un colore diverso e non posso eliminarmi
				if ( $res_cat['UserID'] == $_SESSION['UserID'] ){	
					$colore_celle = "ffb43d";
				}
					
				?>
				<tr> 
	                <td width="14" height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu"><img src="img/spacer.gif" width="8" height="9"></td>
	                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
					  <div align="center"><?php echo html_entity_decode($res_cat['Nome'])." ".html_entity_decode($res_cat['Cognome']);?></div></td>
	                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
	                <div align="center"><img src="<?php echo $res_cat['icona'];?>" width="22" height="22" border="0" align="absmiddle"> <?php echo html_entity_decode($res_cat['Role_Name']); ?></div></td>
	                <td colspan="2" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
					  <div align="center"><?php echo html_entity_decode($res_cat['Username']); ?></div></td>
	                <td width="68" align="center" bgcolor="<?php echo $colore_celle;?>" valign="middle" ">
						</td>
	                <td width="99" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
						</td>
	             </tr>

			 <?php
			 	$i++;
			 } // while
			 ?>
			 			 
			 <tr> 

                <td align="center" bgcolor="<?php echo $_SESSION['colore']; ?>" class="sezioneMenu" colspan="10"> 
                <br>
				Pagina 
				<?php
				$j = 0;
				$n_pagine = count($pagine);
				
				for ($j = 0; $j < $n_pagine; $j++){
					if( $now_page != ($j + 1)){ 
						?>
						-
						<a href="visual_cat.php?n_pagina=<?php echo $j + 1; ?>" class="sezioneMenu">
						<?php 
						echo $pagine[$j];
						echo "</a>";	
					} else {
						echo " - <strong> [ ".$pagine[$j]." ] </strong>";
					}
				}
				?>
				<img src="img/spacer.gif" width="24" height="9" border="0">Utenti trovati:  <?php echo $tot_news;?>	</td>
              </tr>
              
			 <?php
			 
			 } else { 
			 	
			 ?>
			 
              <tr> 
                <td colspan="10"><div align="center" class="fontDettLogin"> 
                    <p></p>
                    <p>&nbsp;</p>
                    <p>Nessun utente presente !!!</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                  </div></td>
              </tr>
              
             <?php	
             	 
			 }
			 
			 ?>
			 
            </table>
		  <br></td>
		</tr>
	  </table>
		<!-- fine visualizza sottosezione-->

        
          <!-- fine tabella box_centrale -->

        </td>
</tr>
	  
<?php include "include/footer.php";?>
	
</table>

<?php 		

mysql_close($conn);
?>
</body>
</html>
