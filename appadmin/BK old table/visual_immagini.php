<?php 
session_cache_expire(30);
session_start();

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


if(isset($_POST['azione'])) {
	$azione = $_POST['azione'];
} else if(isset($_GET['azione'])) {
	$azione = $_GET['azione'];
}


if(!isset($_FILES['uploadfile']['name'])) {
	$uploadfile_name = "";
} else {
	$uploadfile_name = $_FILES['uploadfile']['name'];
}

if(!isset($_FILES['uploadfile']['size'])) {
	$uploadfile_size = "";
} else {
	$uploadfile_size = $_FILES['uploadfile']['size'];
}

if(!isset($uploadfile)) {
	$uploadfile = "";
}
if(!isset($_FILES['uploadfile']['tmp_name'])) {
	$tmp_name = "";
} else {
	$tmp_name = $_FILES['uploadfile']['tmp_name'];
}

if(!isset($_FILES['uploadfile']['type'])) {
	$extension = "";
} else {
	$extension = $_FILES['uploadfile']['type'];
}

if(!isset($_FILES['uploadfile']['tmp_name'])) {
	$_FILES['uploadfile']['tmp_name'] = "";
}
if(!isset($_FILES['uploadfile']['name'])) {
	$_FILES['uploadfile']['name'] = "";
}


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


function elimina_imma(imm, ID_cat, ID_cont) {

	if(confirm("Vuoi veramente eliminare l'Immagine?"))
	{
		
  		location.href = 'visual_immagini.php?ID_imma='+imm+'&azione=elimina_imma&ID_cat='+ID_cat+'&ID_cont='+ID_cont;
       
  	}
	
	return true;
}

function clearImg(){
	document.CaricaFile.uploadfile.value = "";
}

function goBack(ID_cat){

	document.Back.action = 'visual_gallery.php?ID_cat='+ID_cat;
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
        	<form name="Back" id="Back" method="post" >Gestione Galleria Immagini <input name="b_indietro" type="submit" value="Torna indietro" onClick="return goBack(<?php echo $ID_cat;?>);"></form>
          </td>
          
          
  		</tr>
        <?php
		
	


// -- upload immagine--

//dimensioni massime del file in bytes
$dim_file = 4200000;
//url da get per il path dell' attachment
$dir = $_SERVER['DOCUMENT_ROOT']."/admin/public/";

$url_file = $dir.$_FILES['uploadfile']['name'];



$strEsito = "";
		
// elimino la cucina
if($azione == "elimina_imma" ){
			 
	//prendo l'url
	$str_URL = "SELECT * 
				FROM imm
				WHERE ID_imm='{$ID_imma}'";

	$query_URL = mysql_query($str_URL, $conn) or die(mysql_error());
	$res_URL = mysql_fetch_array($query_URL);		
			 	
	//elimino l'immagine
	$strEliminaImm = "DELETE FROM imm
					WHERE ID_imm='{$ID_imma}'";			
				
	$resEliminaImm = mysql_query($strEliminaImm) or die(mysql_error());
				
				
	if( (!@unlink($dir.basename($res_URL['URL']))) && (!@unlink($dir."large_".basename($res_URL['URL']))) && (!@unlink($dir."thumb_".basename($res_URL['URL'])))){
		$colEsito = "#ff0000";
		$strEsito = "ERRORE! Immagine non eliminata dalla directory! ".$dir."thumb_".basename($res_URL['URL']);
	} else  {
		
		$colEsito = "#ff0000";
		$strEsito = "Immagine eliminata correttamente!";
	}		
}




$_SESSION['nome_file'] = $dir.$_FILES['uploadfile']['name'];

if ( ($uploadfile_name == "") && ($azione == "modifica_do")) {


	$label = $_POST['label'];
	$ordine = $_POST['ordine'];
	$primaria = $_POST['primaria'];

	
	$str_mod1 = "UPDATE `imm` SET 
				`Label` = '{$label}', 
				`Primaria` = '{$primaria}',
				`Ordine` = '{$ordine}' 
				WHERE `ID_imm` = '{$ID_imma}' ";
															
	$query_mod1 = mysql_query($str_mod1, $conn);
	
	$colEsito = "#c0ff28";
	$strEsito = "Il file e' stato modificato correttamente!";
	
	
} else {
	
	if ( ($uploadfile_name == "") && ($_POST['checksend'] == 1)) {
		
		$colEsito = "#ff0000";
		$strEsito = "ERRORE! Non e' stato inserito nessun Allegato al punto 1). Clicca su SFOGLIA e seleziona il file che vuoi caricare sul sito";
	
	} else if( $uploadfile_name != "" && $_POST['checksend'] == 1) {
			
		if ($uploadfile_size < $dim_file ) {

			# lo copia in una nuova posizione
			$_FILES['uploadfile']['name'] = str_replace("à","a",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("è","e",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("é","e",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("ù","u",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("ì","i",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("ò","o",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace(" ","_",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("'","-",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("?","-",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("%","-",$_FILES['uploadfile']['name']);
			$_FILES['uploadfile']['name'] = str_replace("$","-",$_FILES['uploadfile']['name']);
			
			
			//genero un numero casuale tra 0 e 100000
			$random = (integer) (rand()%100000);
			
			if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $dir.$random.$_FILES['uploadfile']['name'])){
	
					$colEsito = "#c0ff28";
					
					if ($azione == "modifica_do") {
						$strEsito = "Il file e' stato modificato correttamente!";
					} else { 
						$strEsito = "Il file e' stato caricato correttamente!";
					}	
	
					//inserisce il record negli attachment delle sottosezione
					$nome_immagine = $dir.$random.$_FILES['uploadfile']['name'];
					
					$nome_immagine = str_replace("à","a",$nome_immagine);
					$nome_immagine = str_replace("è","e",$nome_immagine);
					$nome_immagine = str_replace("é","e",$nome_immagine);
					$nome_immagine = str_replace("ù","u",$nome_immagine);
					$nome_immagine = str_replace("ì","i",$nome_immagine);
					$nome_immagine = str_replace("ò","o",$nome_immagine);
					$nome_immagine = str_replace(" ","_",$nome_immagine);
					$nome_immagine = str_replace("'","-",$nome_immagine);
					$nome_immagine = str_replace("?","-",$nome_immagine);	
					$nome_immagine = str_replace("%","-",$nome_immagine);	
					$nome_immagine = str_replace("$","-",$nome_immagine);	
												
		
					
					$label = $_POST['label'];
					$ordine = $_POST['ordine'];
					$primaria = $_POST['primaria'];
	
	
					if ($azione == "modifica_do") {
				
						$str_mod = "UPDATE `imm` SET 
									`Label` = '{$label}', 
									`URL` = '{$nome_immagine}',
									`Primaria` = '{$primaria}',
									`Ordine` = '{$ordine}' 
									WHERE `ID_imm` = '{$ID_imma}' ";
															
						$query_mod = mysql_query($str_mod, $conn);
		
					} else {
	
	
						$str_insert_attach = "INSERT INTO imm (ID_imm, ID_cont, Label, URL, Primaria, Ordine)
									VALUES ('','$ID_cont', '$label', '$nome_immagine', '$primaria', '$ordine')";	
															
						$query_attach = mysql_query($str_insert_attach, $conn);
	
					}				
					
				} else {
				
					$colEsito = "#ff0000";
					$strEsito = "ERRORE! Il file non e' stato caricato! ".$dir.$random.$_FILES['uploadfile']['name']." -- ".$_FILES['uploadfile']['tmp_name'];
				}
			
			#se e' una immagine faccio il resize
			if(($extension == "image/gif") || ($extension == "image/pjpeg") || ( $extension == "image/jpeg")) {	
			
					//Ridimensiono l'immagine
					$immagine = new image();
					$immagine->load($dir.$random.$_FILES['uploadfile']['name']);
					
					//Creo la large
	
					$max_l = 1000;
					$max_h = 827;
							
					$immagine->resize($max_l, $max_h);
					$immagine->save($dir."large_".$random.$_FILES['uploadfile']['name']);
					
					$immagine->resize(400, 400);
					$immagine->save($dir."square_".$random.$_FILES['uploadfile']['name']);
					
					//immagine media
					$immagine->fill(805, 666);
					$immagine->save($dir."princ_".$random.$_FILES['uploadfile']['name']);
					//chmod($dir."thumb_".$_FILES['uploadfile']['name'], 0777);
					
					
					//Creo l'anteprima  160 / 90
					$immagine->fill(320, 180);
					$immagine->save($dir."thumb_".$random.$_FILES['uploadfile']['name']);
					//chmod($dir."thumb_".$_FILES['uploadfile']['name'], 0777);
	
			} else {
			
				$colEsito = "#ff0000";
				$strEsito = "ERRORE! Il file caricato non e' un'immagine!";
	
			}
				
		} else {
			
			$colEsito = "#ff0000";
			$strEsito = "ERRORE! Il file non e' stato caricato! La dimensione supera i 3Mb";
	
		}
			
	}


}

		if($strEsito != "") {	
		
		?>
		<tr bgcolor="<?php echo $colEsito; ?>"> 
                <td colspan="11" height="28"><div align="center" class="fontDettLogin"> 
                  
                  <?php echo $strEsito; ?>
                  </div></td>
        </tr>        
        <?php
		
			}
		?>
        
        
		<tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="1008" align="left" valign="top" class="fontDettLoginGrigioBig"><br />
            <?php
			
			$str_cuc = "SELECT Titolo
						FROM prodotti O 
						WHERE O.ID_cont = '{$ID_cont}'";
			
			$query_cuc = mysql_query($str_cuc, $conn) or die(mysql_error());   
			$res_cuc = mysql_fetch_array($query_cuc);
			
			
			if ($azione == "modifica") {
			
				$str_immDett = "SELECT *
						FROM imm
						WHERE ID_imm = '{$ID_imma}' ";
			
				$query_immDett  = mysql_query($str_immDett, $conn) or die(mysql_error());   
				$res_immDett  = mysql_fetch_array($query_immDett);
			
					
				$str_lab = "Modifica Immagine";
			} else {
				$str_lab = "Aggiungi Immagine";
			}	
			
			echo $str_lab." - ".$res_cuc['Titolo']; ?>
            
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
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Immagine</div></td>
                <td colspan="3" class="bodyTxt"><table width="100%" class="contentTable" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top"><?php if ($azione == "modifica") { ?><img src="<?php echo "/admin/public/thumb_".basename($res_immDett['URL']);?>" border="0"><?php } ?>
                        <INPUT NAME="uploadfile" size="50" TYPE="file" value="<?php echo "/admin/public/".basename($res_immDett['URL']);?>" ><a href="#" onClick="clearImg();" ><img src="icone/Delete_small.gif" alt="Delete image" border="0" align="absmiddle"></a></td>
                    </tr>
              </table>			  </tr>              

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
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Primaria</div></td>
                <td width="294" class="bodyTxt">
				
				<?php 
				if( $res_immDett['Primaria'] == 0 ) { 
					$si = "checked";
					$no = "";
				} else {
					$no = "checked";
					$si = "";
				}
				?>				
				
				<input type="radio" name="primaria" value="0" <?php echo $si;?>>
                si
                <input type="radio" name="primaria" value="1" <?php echo $no;?>>
                no </td>
                <td width="164" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin" >Ordine</td>
                <td width="506" class="bodyTxt"><input name="ordine" class="tabellaMenuBordoBlu" id="ordine" size="10" maxlength="10" value="<?php echo $res_immDett['Ordine']; ?>" ></td>
              </tr>

              <tr>
                <td width="170" height="10" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>			  
			  
              <tr bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" >
                <td width="170" height="34" class="bodyTxt">&nbsp;</td>
                <td colspan="3" class="bodyTxt">

        			<input name="b_conferma" type="submit" value="<?php if ($azione == "modifica") { echo "Modifica Immagine"; } else { echo "Aggiungi Immagine"; } ?>" >
                    
                    <br></tr>
            </table>
          </form>      
          
      
          

          
          </td>
  		</tr>        
  
  
  
    	<tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="1008" align="left" valign="top" class="fontDettLoginGrigioBig"><br />

        	Lista Immagini 
             </td>
  		</tr>      

		
  		<tr>
    		<td>&nbsp;</td>
       	  <td align="left" valign="top">
		  
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabellaMenuBordoBlu">
             <?php

			 $str_conta = "SELECT count(*) 
						FROM imm 
						WHERE ID_cont = $ID_cont";
			
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
						FROM imm
						WHERE ID_cont='{$ID_cont}' 
						ORDER BY Ordine ASC";

			$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());
			?>
              <tr> 
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin"> 
                <img src="img/spacer.gif" width="0" height="9"></td>
                <td width="160" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Anteprima</td>
                <td width="449" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Didascalia</td>
                <td colspan="2" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Ordine</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Primaria</td>
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
				  <div align="center"><img src="<?php echo "/admin/public/thumb_".basename($res_cat['URL']);?>" border="0"></div></td>
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo html_entity_decode($res_cat['Label']); ?></div></td>
                <td colspan="2" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
				  <div align="center"><?php echo html_entity_decode($res_cat['Ordine']); ?></div></td>
                <td width="87" align="center" bgcolor="<?php echo $colore_celle;?>" valign="middle" class="sezioneMenu"><?php if ($res_cat['Primaria'] == 0 ) echo "<strong>SI</strong>"; else echo "NO";  ?>
			
					</td>
          <td width="82" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
					
					<a href="visual_immagini.php?azione=modifica&ID_cont=<?php echo $res_cat['ID_cont']; ?>&ID_imma=<?php echo $res_cat['ID_imm']; ?>" class="sezioneMenu">
					<img src="icone/Edit.gif" width="27" height="27" border="0"></a></td>
             <td width="72" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" ><a href="#" onClick="elimina_imma(<?php echo $res_cat['ID_imm']; ?>,<?php echo $ID_cat;?>,<?php echo $ID_cont; ?>);" >
					<img src="icone/Delete.gif" width="27" height="27" border="0"></a></td>
			</tr>
	

			 <?php
			 	$i++;
			 } // while
			 ?>
			 			 
			 <tr bgcolor="<?php echo COLORE_HEADER_TABLE; ?>"> 

                <td align="center" bgcolor="<?php echo $_SESSION['colore']; ?>" class="sezioneMenu" colspan="11" > 
                <br />
				Immagini trovate:  <?php echo $tot_news;?>	</td>
              </tr>
			  <?php
			 } else { 
			 ?>
              <tr> 
                <td colspan="11"><div align="center" class="fontDettLogin"> 
                    <p>&nbsp;</p>
                    <p>Nessuna immagine presente!</p>
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
