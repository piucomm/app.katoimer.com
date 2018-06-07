<?php 
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL & ~E_NOTICE); 

include "include/config.php";
include "include/common.php"; 

controllo_sessione();

if(isset($_POST['ID_cat'])) {
	$ID_cat = $_POST['ID_cat'];
} else if(isset($_GET['ID_cat'])) {
	$ID_cat = $_GET['ID_cat'];
} else { 
	$ID_cat = 1; // menu principale
}

if(isset($_POST['ID_padre'])) {
	$ID_padre = $_POST['ID_padre'];
} else if(isset($_GET['ID_padre'])) {
	$ID_padre = $_GET['ID_padre'];
} else { 
	$ID_padre = 1; // cat padre nobile
}	


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


function elimina_voce(id_c, pagina, id_p) {

	if(confirm("Vuoi veramente eliminare il contenuto?"))
	{
		
  		location.href = 'visual_menu.php?ID_padre='+id_p+'&azione=elimina_voce&n_pagina='+pagina+'&ID_cat='+id_c;
       
  	}
	
	return true;
}


function v_Form(a, id_cat){

	var messaggio = "";
	var bool = 0;
	
	if ( a == 1 ) {
	
		if ( document.add_sezione.titolo.value == "" ){
			bool = bool + 1;
			messaggio = messaggio + "Il campo Titolo non puo essere vuoto!\n";
		} 
		
		if ( bool == 0 ) {

			document.add_sezione.action = 'visual_menu.php?azione=adding';
			
		} else {
	
			alert(messaggio);
			return false;
	
		}		
	
	} else if ( a == 2 ) {
	
		window.location.href = '?ID_cat='+id_cat;
	
	} 
				
	

}


function mod_Form(id_cont, id_cat){

	var messaggio = "";
	var bool = 0;
	

	
		if ( document.add_sezione.titolo.value == "" ){
			bool = bool + 1;
			messaggio = messaggio + "Il campo Titolo non puo essere vuoto!\n";
		} 
	
		
		if ( bool == 0 ) {

			document.add_sezione.action = 'visual_menu.php?azione=modifing&ID_cat='+id_cat+'&ID_cont='+id_cont;
			
		} else {
	
			alert(messaggio);
			return false;
	
		}		
	
				
	

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
		  
		
        



 <table border="0" cellspacing="0" cellpadding="0">
          <tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="1008" align="left" valign="top" class="fontDettLoginGrigioBig"><br>
        	Gestione Menu Principale<br><br></td>

  		</tr>

  		<tr>
    		<td>&nbsp;</td>
       	  <td align="left" valign="top">
		  
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabellaMenuBordoBlu">
             <?php
			 
			 $str_conta = "SELECT count(*) 
						FROM richieste R ";	
			
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
			
			$per_pag = 20 ;
			
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
						FROM richieste R 
						ORDER BY data DESC
						LIMIT {$b_pag},{$per_pag}";	
			
			$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());
			
			?>
              <tr> 
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin"> 
                <img src="img/spacer.gif" width="0" height="9"></td>
                <td width="90" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Cognome - Nome <br/> Societa' / Ruolo</td>
                <td width="110" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Email</td>
                <td width="110" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Telefono / Fax</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">CAP - Citta - Paese - Stato</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Indirizzo</td>
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
					$colore_celle = "#ffffff";
				} else {
					$colore_celle = "#F7F7F7";
				}
					
					
			?>
			<tr> 
                <td width="14" height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu"><img src="img/spacer.gif" width="8" height="9"></td>
                <td height="60" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo html_entity_decode($res_cat['cognome']." ".$res_cat['nome']); ?><br/><?php echo html_entity_decode($res_cat['company']." / ".$res_cat['role']); ?></div></td>
                
                <td height="60" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu"><div align="center">
                <?php echo html_entity_decode($res_cat['email']);?></div></td>
                <td height="60" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo $res_cat['telefono']." / ".$res_cat['fax']; ?></div></td>
                
                <td width="87" align="center" bgcolor="<?php echo $colore_celle;?>" valign="middle" class="sezioneMenu" >
				<div align="center"><?php echo $res_cat['cap']." / ".$res_cat['citta']." / ".$res_cat['country']." / ".$res_cat['stato']; ?></div>
				</td>
				
				
          		<td width="82" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
				<?php echo $res_cat['indirizzo']; ?></td>
			</tr>

			 <?php
			 	$i++;
			 } // while
			 ?>
			 			 
			 <tr bgcolor="<?php echo COLORE_HEADER_TABLE; ?>"> 

                <td align="center" bgcolor="<?php echo $_SESSION['colore']; ?>" class="sezioneMenu" colspan="12" > 
                <br />
				Pagina 
				<?php
				$j = 0;
				$n_pagine = count($pagine);
				
				for ($j = 0; $j < $n_pagine; $j++){
					if( $now_page != ($j + 1)){  ?>
						-
						<a href="richieste_password.php?n_pagina=<?php echo $j + 1; ?>&ID_padre=<?php echo $ID_padre; ?>" class="sezioneMenu">
				  <?php 
						echo $pagine[$j];
						echo "</a>";	
					} else {
						echo " - <strong> [ ".$pagine[$j]." ] </strong>";
					}
				}
				?>
				<img src="img/spacer.gif" width="24" height="9" border="0" >Contenuti trovati:  <?php echo $tot_news;?>	</td>
              </tr>
			  <?php
			 } else { 
			 ?>
              <tr> 
                <td colspan="12"><div align="center" class="fontDettLogin"> 
                    <p>&nbsp;</p>
                    <p>Nessun contenuto presente!</p>
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
