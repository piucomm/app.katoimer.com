<?php 
session_cache_expire(30);
session_start();

set_time_limit(0);

ini_set('error_reporting', E_ALL & ~E_NOTICE); 

include "include/config.php";
include "include/common.php";

require "include/inc.class.images.php";
require "include/class.progressbar.php";

controllo_sessione();

if(isset($_POST['ID_cat'])) {
	$ID_cat = $_POST['ID_cat'];
} else if(isset($_GET['ID_cat'])) {
	$ID_cat = $_GET['ID_cat'];
} else { 
	$ID_cat = 1;
}

if(isset($_POST['ID_cont'])) {
	$ID_cont = $_POST['ID_cont'];
} else if(isset($_GET['ID_cont'])) {
	$ID_cont = $_GET['ID_cont'];
} else { 
	$ID_cont = 1;
}	


if(isset($_POST['ID_imma'])) {
	$ID_imma = $_POST['ID_imma'];
} else if(isset($_GET['ID_imma'])) {
	$ID_imma = $_GET['ID_imma'];
}



if(isset($_POST['file_del'])) {
	$file_delete = "ftp/".$_POST['file_del'];
} else if(isset($_GET['file_del'])) {
	$file_delete = "ftp/".$_GET['file_del'];
}


if(isset($_POST['azione'])) {
	$azione = $_POST['azione'];
} else if(isset($_GET['azione'])) {
	$azione = $_GET['azione'];
} else {
	
		
	
	// check directory and sincro files già presenti su db	
	//$path = "../download/";
	
	$conn_id = ftp_connect('download.ceccotti.it');
	
	$login_result = ftp_login($conn_id, 'download.ceccotti','cc1720inl');
	
	if((!$conn_id) && (!$login_result)){
		echo "Connection failed";	
	} else {
		
		$dirArray = ftp_nlist($conn_id, '/ftp');
	
		$indexCount = count($dirArray);
	
		// loop through the array of files and print them all
		for($index=0; $index < $indexCount; $index++) {
			if (substr($dirArray[$index], 0, 1) != "."){ // don't list hidden files
				
					// cerco nel db i match
							
					$str_cat4 = "SELECT * 
								FROM download
								";
		
					$query_cat4 = mysql_query($str_cat4, $conn) or die(mysql_error());
					
					$check = 0;
					
					$nome = pathinfo($dirArray[$index]);
					
					$nome_ok = $nome['basename'];
					
					while ( $res_cat4 = mysql_fetch_array($query_cat4)){			
						
						//echo " FTP-  ".$nome_ok." --- DB- ".$res_cat4['URL'];
						
						if ($nome_ok == $res_cat4['URL'] ) {
							$check++;
							//echo "  ->  check OK ";
						} 
						// print(filetype($dirArray[$index]));
						// print(filesize($dirArray[$index]));
						//echo "<br/>";
					}
					
					if (($check == 0 ) && ($nome_ok != '') && ($nome_ok != ' ')   && ($nome_ok != '.') && ($nome_ok != '..') ) { // il file è nuovo
						$str_insert_attach4 = "INSERT INTO download (ID_imm, Label, URL, Primaria, Ordine)
												VALUES ('','', '$nome_ok', '1', '0')";	
																		
						$query_attach4 = mysql_query($str_insert_attach4, $conn);
					} // if nuovo file	
					
			} // if hidden files	
					
		} // for
		
			
		ftp_close($conn_id);
	
	}
	

	
	
} // chiudi if




?>


<html>
<head>
<title><?php echo TITOLO_PAGINA;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="txt2/editor.js"></script>

<script language="JavaScript" type="text/JavaScript">
<!--
function resubmit(){
		var lingua = document.form1.ID_lingua.value;
		location.href = 'visual_cat.php?lin='+lingua;
}

function elimina_imma(imm, url_del) {

	if(confirm("Vuoi veramente eliminare il file?"))
	{
		
  		location.href = 'visual_download.php?ID_imma='+imm+'&azione=elimina_imma&file_del='+url_del;
       
  	}
	
	return true;
}



function clearImg(){
	document.CaricaFile.uploadfile.value = "";
}

function goBack(ID_cat){

	document.Back.action = './';
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
        	<form name="Back" id="Back" method="post" >Gestione File Download <input name="b_indietro" type="submit" value="Torna indietro" onClick="return goBack(<?php echo $ID_cat;?>);"></form>
          </td>
          
          
  		</tr>
        <?php
		
	


// -- upload immagine--

//dimensioni massime del file in bytes
$dim_file = 4200000;
//url da get per il path dell' attachment
$dir = $_SERVER['DOCUMENT_ROOT']."/download/";

$url_file = $dir.$_FILES['uploadfile']['name'];



$strEsito = "";
		
// elimino il file
if($azione == "elimina_imma" ){
			 
	//prendo l'url
	$str_URL = "SELECT * 
				FROM download
				WHERE `ID_imm` = '{$ID_imma}' ";

	$query_URL = mysql_query($str_URL, $conn) or die(mysql_error());
	$res_URL = mysql_fetch_array($query_URL);		
			 	
	//elimino l'immagine
	$strEliminaImm = "DELETE FROM download
					WHERE `ID_imm` = '{$ID_imma}' ";		
				
	$resEliminaImm = mysql_query($strEliminaImm) or die(mysql_error());
	
	
	/* CONNESSIONE FTP */
	
	$conn_id = ftp_connect('download.ceccotti.it');
		
	$login_result = ftp_login($conn_id, 'download.ceccotti','cc1720inl');
	
	if((!$conn_id) && (!$login_result)){
		echo "Connection failed";	
	} else {
		
		// try to delete $file_delete
		if (ftp_delete($conn_id, $file_delete)) {
		 	$colEsito = "#ff0000";
			$strEsito = "File eliminato correttamente!";
		} else {
		 	$colEsito = "#ff0000";
			$strEsito = "ERRORE! File non eliminato dalla directory! ";
		}	
	}
	
	ftp_close($conn_id);
	
}



if ( $azione == "modifica_do") {


	$label = $_POST['label'];
	$ordine = $_POST['ordine'];
	$primaria = $_POST['primaria'];
	$categ = $_POST['categ'];

	
	$str_mod1 = "UPDATE `download` SET 
				`Label` = '{$label}', 
				`Primaria` = '{$primaria}',
				`Ordine` = '{$ordine}',
				`Categoria` = '{$categ}' 
				WHERE `ID_imm` = '{$ID_imma}' ";
															
	$query_mod1 = mysql_query($str_mod1, $conn);
	
	$colEsito = "#c0ff28";
	$strEsito = "Il file e' stato modificato correttamente!";
	
	
} 

if($strEsito != "") {	
		
?>
	<tr bgcolor="<?php echo $colEsito; ?>"> 
          <td colspan="11" height="28">
			<div align="center" class="fontDettLogin"> 
			<?php echo $strEsito; ?>
			<div></td>
	</tr>        
<?php
}
?>
        
        
		<tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="1008" align="left" valign="top" class="fontDettLoginGrigioBig"><br />
            <?php
			
			
			if ($azione == "modifica") {
			
				$str_immDett = "SELECT *
						FROM download
						WHERE ID_imm = '{$ID_imma}' ";
			
				$query_immDett  = mysql_query($str_immDett, $conn) or die(mysql_error());   
				$res_immDett  = mysql_fetch_array($query_immDett);
	
			
			?>
            
            <br>
       	  	<br>
    
    
			<form ENCTYPE="multipart/form-data" ACTION="<?php $PHP_SELF ?>" METHOD="post" name="CaricaFile">
		
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabellaMenuBordoBlu">
              <input type="hidden" name="checksend" value="1">
              <input type="hidden" name="ID_cont" value="<?php echo $ID_cont; ?>">
              <?php if ($azione == "modifica") { ?>
              	<input type="hidden" name="azione" value="modifica_do">
                <input type="hidden" name="ID_imma" value="<?php echo $ID_imma; ?>">
              <?php } ?>

		  <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Download</div></td>
                <td colspan="3" class="bodyTxt"><table width="100%" class="contentTable" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top">
                      <?php echo $res_immDett['URL']; ?>
                      </td>
                    </tr>
              </table>			  
              </tr>              

			  <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Didascalia</div></td>
                <td colspan="3" class="bodyTxt"><table width="100%" class="contentTable" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top">
                        <input id="label" name="label" class="tabellaMenuBordoBlu" size="100%" maxlength="150" value="<?php echo $res_immDett['Label']; ?>"></td>
                    </tr>
              </table>			  </tr>


              <tr>
                <td width="170" height="10" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Ordine</div></td>
                <td width="294" class="bodyTxt">
				<input name="ordine" class="tabellaMenuBordoBlu" id="ordine" size="10" maxlength="10" value="<?php echo $res_immDett['Ordine']; ?>" >
                
                </td>
                <td width="164" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin" >Categoria</td>
                <td width="506" class="bodyTxt">
                <input name="categ" class="tabellaMenuBordoBlu" id="categ" size="90%" maxlength="150" value="<?php echo $res_immDett['Categoria']; ?>" >
                </td>
              </tr>

              <tr>
                <td width="170" height="10" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>			  
			  
              <tr bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" >
                <td width="170" height="34" class="bodyTxt">&nbsp;</td>
                <td colspan="3" class="bodyTxt">

        			<input name="b_conferma" type="submit" value="Modifica File" >
                    
                    <br></tr>
            </table>
          </form>      
          
      	<?php
          }	
			
		?>

		</td>
  		</tr>        
  
  
  
    	<tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="1008" align="left" valign="top" class="fontDettLoginGrigioBig"><br />

        	Lista Download 
             </td>
  		</tr>      

		
  		<tr>
    		<td>&nbsp;</td>
       	  <td align="left" valign="top">
		  
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabellaMenuBordoBlu">
             <?php

			 $str_conta = "SELECT count(*) 
						FROM download 
						";
			
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
						FROM download
						ORDER BY Ordine ASC";

			$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());
			?>
              <tr> 
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin"> 
                <img src="img/spacer.gif" width="0" height="9"></td>
                <td width="361" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Anteprima</td>
                <td width="340" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Didascalia</td>
                <td width="195" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Categoria</td>
                <td colspan="2" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Ordine</td>
               
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Modifica</td>
                
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Elimina</td>

                
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
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
				  <div align="center"><?php echo $res_cat['URL'];?></div></td>
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo html_entity_decode($res_cat['Label']); ?></div></td>
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo html_entity_decode($res_cat['Categoria']); ?></div></td>
                <td colspan="2" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
				  <div align="center"><?php echo html_entity_decode($res_cat['Ordine']); ?></div></td>
                
          		<td width="76" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
					<a href="visual_download.php?azione=modifica&ID_cont=<?php echo $res_cat['ID_cont']; ?>&ID_imma=<?php echo $res_cat['ID_imm']; ?>" class="sezioneMenu">
					<img src="icone/Edit.gif" width="27" height="27" border="0"></a></td>
                    
                <td width="68" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
                	<a href="#" onClick="elimina_imma(<?php echo $res_cat['ID_imm']; ?>,'<?php echo $res_cat['URL'];?>');" >
					<img src="icone/Delete.gif" width="27" height="27" border="0"></a></td>    
                    
             </tr>
	

			 <?php
			 	$i++;
			 } // while
			 ?>
			 			 
			 <tr bgcolor="<?php echo COLORE_HEADER_TABLE; ?>"> 

                <td align="center" bgcolor="<?php echo $_SESSION['colore']; ?>" class="sezioneMenu" colspan="10" > 
                <br />
				Files trovati:  <?php echo $tot_news;?>	</td>
              </tr>
			  <?php
			 } else { 
			 ?>
              <tr> 
                <td colspan="10"><div align="center" class="fontDettLogin"> 
                    <p>&nbsp;</p>
                    <p>Nessun file presente!</p>
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
