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
	$ID_cat = 0; // tutte le categorie
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


function elimina_prodotto(id_c, pagina, id_cat) {

	if(confirm("Vuoi veramente eliminare il contenuto?"))
	{
		
  		location.href = 'visual_gallery.php?ID_cont='+id_c+'&azione=elimina_prodotto&n_pagina='+pagina+'&ID_cat='+id_cat;
       
  	}
	
	return true;
}


function v_Form(a, id_cat){

	var messaggio = "";
	var bool = 0;
	
	if ( a == 1 ) {
	
		/*if ( document.add_sezione.titolo.value == "" ){
			bool = bool + 1;
			messaggio = messaggio + "Il campo Titolo non puo essere vuoto!\n";
		} */
	
		
		if ( bool == 0 ) {

			document.add_sezione.action = 'visual_gallery.php?azione=adding&ID_cat='+id_cat;
			
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
	

	
		/*if ( document.add_sezione.titolo.value == "" ){
			bool = bool + 1;
			messaggio = messaggio + "Il campo Titolo non puo essere vuoto!\n";
		} */
	
		
		if ( bool == 0 ) {

			document.add_sezione.action = 'visual_gallery.php?azione=modifing&ID_cat='+id_cat+'&ID_cont='+id_cont;
			
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
        	Gestione Prodotti<br><br>
          </td>
          
          
  		</tr>
        <?php
		
			$strEsito = "";
		
			  // elimino il contenuto
			 if($_GET['azione'] == "elimina_prodotto" ){
			 	
				 //elimino la traduzione
				$strEliminaCucina = "DELETE FROM prodotti
									WHERE ID_cont = '{$_GET[ID_cont]}'";			
				
				$resEliminaCucina = mysql_query($strEliminaCucina) or die(mysql_error());
				
				$colEsito = "#ff0000";
				$strEsito = "Contenuto eliminato correttamente!";
				
			 }
	
			 // aggiungo il prodotto
			 if($_GET['azione'] == "adding" ){
			 	
				$tit = addslashes(stripslashes($_POST['titolo']));
				$tit_eng = addslashes(stripslashes($_POST['titolo_eng']));
				$tit_fra = addslashes(stripslashes($_POST['titolo_fra']));
				$tit_de = addslashes(stripslashes($_POST['titolo_de']));
				$stit = addslashes(stripslashes($_POST['sottotitolo']));
				$stit_eng = addslashes(stripslashes($_POST['sottotitolo_eng']));
				$stit_fra = addslashes(stripslashes($_POST['sottotitolo_fra']));
				$stit_de = addslashes(stripslashes($_POST['sottotitolo_de']));
				$txt = addslashes(stripslashes($_POST['testo_sc']));
				$txt_eng = addslashes(stripslashes($_POST['testo_sc_eng']));
				$txt_fra = addslashes(stripslashes($_POST['testo_sc_fra']));
				$txt_de = addslashes(stripslashes($_POST['testo_sc_de']));
				$note = $_POST['note'];
				$prezzo = $_POST['prezzo'];
				$sconto = $_POST['sconto'];
				$pub = $_POST['pubblica'];
				$ord = $_POST['ordine'];
				$new = $_POST['new'];
				$inH = $_POST['inHome'];
				
				
				$strAdd = "INSERT INTO prodotti (ID_cont, ID_cat, Titolo, Titolo_eng, Titolo_fra, Titolo_de, Sottotitolo, Sottotitolo_eng, Sottotitolo_fra, Sottotitolo_de, Testo,Testo_eng, Testo_fra, Testo_de, Note, Pubblica, Ordine, InHome, New, Prezzo, Sconto, Flag, ID_allegato, genitore)
						VALUES ('','$ID_cat', '$tit','$tit_eng','$tit_fra','$tit_de', '$stit', '$stit_eng', '$stit_fra', '$stit_de', '$txt','$txt_eng','$txt_fra','$txt_de', '$note', '$pub', '$ord', '$inH', '$new', '$prezzo' , '$sconto', 0, 0, 0)";			
				
				$resAdd = mysql_query($strAdd) or die(mysql_error());
				
				$colEsito = "#c0ff28";
				$strEsito = "Contenuto aggiunto correttamente!";

			 }
	
	
		 	 // modifico la cucina
			 if($_GET['azione'] == "modifing" ){
			 	
				$tit = addslashes(stripslashes($_POST['titolo']));
				$tit_eng = addslashes(stripslashes($_POST['titolo_eng']));
				$tit_fra = addslashes(stripslashes($_POST['titolo_fra']));
				$tit_de = addslashes(stripslashes($_POST['titolo_de']));
				$stit = addslashes(stripslashes($_POST['sottotitolo']));
				$stit_eng = addslashes(stripslashes($_POST['sottotitolo_eng']));
				$stit_fra = addslashes(stripslashes($_POST['sottotitolo_fra']));
				$stit_de = addslashes(stripslashes($_POST['sottotitolo_de']));
				$txt = addslashes(stripslashes($_POST['testo_sc']));
				$txt_eng = addslashes(stripslashes($_POST['testo_sc_eng']));
				$txt_fra = addslashes(stripslashes($_POST['testo_sc_fra']));
				$txt_de = addslashes(stripslashes($_POST['testo_sc_de']));
				$note = $_POST['note'];
				$prezzo = $_POST['prezzo'];
				$sconto = $_POST['sconto'];
				$pub = $_POST['pubblica'];
				$ord = $_POST['ordine'];
				$new = $_POST['new'];
				$inH = $_POST['inHome'];
				$idCont = $_GET['ID_cont'];
				
				
				$strMod = "UPDATE `prodotti` SET `ID_cat` = '$ID_cat', `Titolo` = '$tit', `Titolo_eng` = '$tit_eng',`Titolo_fra` = '$tit_fra',`Titolo_de` = '$tit_de', `Sottotitolo` = '$stit',`Sottotitolo_eng` = '$stit_eng',`Sottotitolo_fra` = '$stit_fra',`Sottotitolo_de` = '$stit_de', `Testo` = '$txt', `Testo_eng` = '$txt_eng',`Testo_fra` = '$txt_fra',`Testo_de` = '$txt_de', `Note` = '$note', `Pubblica` = '$pub', `Ordine` = '$ord', `InHome` = '$inH', `New` = '$new', `Prezzo` = '$prezzo', `Sconto` = '$sconto' WHERE `ID_cont` = '$idCont' ";		
				
				$resMod = mysql_query($strMod, $conn) or die(mysql_error());
				
				$colEsito = "#c0ff28";
				$strEsito = "Contenuto modificato correttamente!";
				
				$tit_sc = "";
				$tit_eng_sc = "";
				$stit_sc = "";
				$stit_eng_sc = "";
				$testo_sc = "";
				$testo_sc_eng = "";
				

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
        	<?php if($_GET['azione'] == "modifica") { echo "Modifica"; } else { echo "Aggiungi"; } ?> Contenuto<br>
       	  <br>
    
    
			<form name="add_sezione" id="add_sezione" method="post" >
		
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabellaMenuBordoBlu">
              <input name="refresh" type="hidden" id="refresh" value="0">
              <input name="azione" type="hidden" id="azione" value="add">
              <input name="<?php echo $NOME_SESSIONE; ?>" type="hidden" id="<?php echo $NOME_SESSIONE; ?>" value="<?php echo $ID_SESSIONE; ?>">
				
                
              <?php // query modifica   
                
              if($_GET['azione'] == "modifica") {
			  	
				$str_modDett = "SELECT * 
						FROM prodotti O
						WHERE O.Flag = 0 AND O.ID_cat='{$ID_cat}' AND O.ID_cont='{$_GET['ID_cont']}'";

				$query_modDett = mysql_query($str_modDett, $conn) or die(mysql_error());
				
				$res_modDett = mysql_fetch_array($query_modDett);
				
				$testo_sc = addslashes(stripslashes($res_modDett['Testo']));
				$testo_sc_eng = addslashes(stripslashes($res_modDett['Testo_eng']));
				$testo_sc_fra = addslashes(stripslashes($res_modDett['Testo_fra']));
				$testo_sc_de = addslashes(stripslashes($res_modDett['Testo_de']));
	
			  }
                
              ?>
			  
			    
              <tr>
                <td valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Categorie Gallerie</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt">
				
					<?php
					//Visualizzazione delle categorie
					
					$str_tipo_c = "SELECT * 
								FROM categorie ";

					$query_tipo_c = mysql_query($str_tipo_c, $conn) or die(mysql_error()); 
					?>
                  <select name="ID_cat" class="tabellaMenuBordoBlu" id="ID_cat" size="1" >
                    <?php

					while ( $res_tipo_c = mysql_fetch_array($query_tipo_c)){
						
							$str_nome_padre = "SELECT * 
								FROM categorie 
								WHERE ID_cat = '{$res_tipo_c['ID_padre']}'
								LIMIT 0,1";

							$query_nome_padre = mysql_query($str_nome_padre, $conn) or die(mysql_error());
							
							$res_nome_padre = mysql_fetch_array($query_nome_padre);
							
							$nome_padre = "";
							
							if($res_nome_padre['ID_padre'] != 0) {
								$nome_padre = $res_nome_padre['Titolo']." // ";
							}
							
							$flag_check_S = "";
					
							if( $res_tipo_c['ID_cat'] == $ID_cat){
								$flag_check_S = "selected";
							}		
					
							echo "<option value=\"".$res_tipo_c['ID_cat']."\" ".$flag_check_S.">".$nome_padre.$res_tipo_c['Titolo']."</option>";
					

					}
					?>
                  </select>				</td>
              </tr>



              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Titolo</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt">
                <input name="titolo" type="text" class="tabellaMenuBordoBlu" id="titolo" value="<?php echo stripslashes($res_modDett['Titolo']);?>" size="100%" maxlength="150">
                  <img src="img/spacer.gif" width="8" height="9"><span class="fontDettLoginGrigio"> Max. 150 caratteri</span></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              
               <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Titolo eng</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt">
                <input name="titolo_eng" type="text" class="tabellaMenuBordoBlu" id="titolo_eng" value="<?php echo stripslashes($res_modDett['Titolo_eng']);?>" size="100%" maxlength="150"></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              
 
			  <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Sottotitolo</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt">
				<input id="sottotitolo" name="sottotitolo" class="tabellaMenuBordoBlu" size="100%" maxlength="150" value="<?php echo stripslashes($res_modDett['Sottotitolo']);?>" ></td>
              </tr>

              <tr><td width="170" colspan="4" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td></tr>
              
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Sottotitolo (eng)</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt">
				<input id="sottotitolo_eng" name="sottotitolo_eng" class="tabellaMenuBordoBlu" size="100%" maxlength="150" value="<?php echo stripslashes($res_modDett['Sottotitolo_eng']);?>" ></td>
              </tr>


              <tr><td width="170" colspan="4" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td></tr>
              
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Testo</div></td>
                <td colspan="3" class="bodyTxt">
						<!-- Textarea !-->
					  <?php
					  
					    echo '<!-- tinyMCE -->
						<script language="javascript" type="text/javascript" src="./js/tiny_mce/tiny_mce.js"></script>
						<script language="javascript" type="text/javascript">
							tinyMCE.init({
								// General options
								mode : "textareas",
								theme : "advanced",
								plugins : "safari,table,advimage,advlink,media,visualchars,nonbreaking,xhtmlxtras,pagebreak,paste",
								language : "it",
								//disk_cache : true,
								pagebreak_separator : "<!-- page break -->",
									paste_auto_cleanup_on_paste : true,
									convert_urls : false,
									relative_urls: false,
						
								// Theme options
								theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,'./*outdent,indent,|,sub,sup,|,link,unlink,anchor,image,media,*/'charmap,|,pagebreak",
								theme_advanced_buttons2 : "tablecontrols,|,undo,redo,|,code",
								theme_advanced_buttons3 : "",
								theme_advanced_buttons4 : "",
								theme_advanced_toolbar_location : "top",
								theme_advanced_toolbar_align : "left",
								theme_advanced_statusbar_location : "none",
								theme_advanced_resizing : true,
							});
						</script>
						<!-- /tinyMCE -->
						';   ?>
                      <textarea id="testo_sc" name="testo_sc" rows="10" cols="80"><?php echo stripslashes($testo_sc);?></textarea>                  
                        </td></tr>

			  <tr>
                <td width="170" colspan="4" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
              </tr>
              
              
               <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Testo (eng)</div></td>
                <td colspan="3" class="bodyTxt"><textarea id="testo_sc_eng" name="testo_sc_eng" rows="10" cols="80"><?php echo stripslashes($testo_sc_eng);?></textarea></td></tr>

              
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Link</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt">
				<input id="note" name="note" class="tabellaMenuBordoBlu" size="100%" maxlength="150" value="<?php echo $res_modDett['Note'];?>" ></td>
              </tr>
			  <tr>
                <td width="170" colspan="4" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
              </tr>   
              

              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Pubblica</div></td>
                <td width="294" class="bodyTxt">
				
				<?php 
				if( $res_modDett['Pubblica'] == 0 ) { 
					$si = "checked";
					$no = "";
				} else {
					$no = "checked";
					$si = "";
				}
				?>
				 
				<input type="radio" name="pubblica" value="0" <?php echo $si;?>>
                si
                <input type="radio" name="pubblica" value="1" <?php echo $no;?>>
                no				</td>
                <td width="164" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin">&nbsp;</td>
                <td width="506" class="bodyTxt">&nbsp;</td>
              </tr>
              <tr>
                <td width="170" height="10" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Inserisci in Home Page</div></td>
                <td class="bodyTxt">
				
				<?php 
				if( $res_modDett['InHome'] == 0 ) { 
					$si = "checked";
					$no = "";
				} else {
					$no = "checked";
					$si = "";
				}
				?>				
				
				<input type="radio" name="inHome" value="0" <?php echo $si;?>>
                si
                <input type="radio" name="inHome" value="1" <?php echo $no;?>>
                no </td>
                <td bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin" >&nbsp;</td>
                <td class="bodyTxt">&nbsp;</td>
              </tr>

              <tr>
                <td width="170" height="10" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
			  
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">New</div></td>
                <td class="bodyTxt">
				
				<?php 
				if( $res_modDett['New'] == 0 ) { 
					$si = "checked";
					$no = "";
				} else {
					$no = "checked";
					$si = "";
				}
				?>				
				
				<input type="radio" name="new" value="0" <?php echo $si;?>>
                si
                <input type="radio" name="new" value="1" <?php echo $no;?>>
                no				</td>
                <td bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin" ><div align="left">Ordine</div></td>
                <td class="bodyTxt"><input name="ordine" class="tabellaMenuBordoBlu" id="ordine" size="10" maxlength="10" value="<?php echo $res_modDett['Ordine'];?>" > </td>
              </tr>

              <tr>
                <td width="170" height="10" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>			  
			  
              <tr bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" >
                <td width="170" height="34" class="bodyTxt">&nbsp;</td>
                <td colspan="3" class="bodyTxt">
                <?php if($_GET['azione'] != "modifica") { ?>
        			<input name="b_conferma" type="submit"  value="Aggiungi Contenuto" onClick="return v_Form(1,<?php echo $ID_cat;?>);">
                <?php } else { ?>
                	<input name="b_conferma" type="submit"  value="Modifica Contenuto" onClick="return mod_Form(<?php echo $_GET['ID_cont']; ?>,<?php echo $ID_cat;?>);">
                    <input name="b_indietro" type="submit"  value="Torna indietro" onClick="window.history.back();">
                <?php } ?>    
                    
                    <br></tr>
            </table>
          </form>      
          
      
          

          
          </td>
  		</tr>        
  
  
  		<?php if($_GET['azione'] != "modifica") { // inizio adding ?>
  
    	<tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="1008" align="left" valign="top" class="fontDettLoginGrigioBig"><br />
            <form name="change_cat" id="change_cat" method="post" >
            	<input name="refresh" type="hidden" id="refresh" value="0">
              	<input name="azione" type="hidden" id="azione" value="add">
            
        	Lista Contenuti Inseriti
            
            <?php
					//Visualizzazione delle categorie
					
					$str_tipo_c1 = "SELECT * 
								FROM categorie ";

					$query_tipo_c1 = mysql_query($str_tipo_c1, $conn) or die(mysql_error()); 
					?>
            		<select name="ID_cat_lista" class="tabellaMenuBordoBlu" id="ID_cat_lista" size="1" onChange="return v_Form(2,this.options[this.selectedIndex].value);">
                    <option value="0" >Tutte le categorie</option>
                    <?php

					while ( $res_tipo_c1 = mysql_fetch_array($query_tipo_c1)){
						
							$str_nome_padre = "SELECT * 
								FROM categorie 
								WHERE ID_cat = '{$res_tipo_c1['ID_padre']}'
								LIMIT 0,1";

							$query_nome_padre = mysql_query($str_nome_padre, $conn) or die(mysql_error());
							
							$res_nome_padre = mysql_fetch_array($query_nome_padre);
							
							$nome_padre = "";
							
							if($res_nome_padre['ID_padre'] != 0) {
								$nome_padre = $res_nome_padre['Titolo']." // ";
							}
							
							$flag_check_S1 = "";
					
							if( $res_tipo_c1['ID_cat'] == $ID_cat){
								$flag_check_S1 = "selected";
							}		
					
							echo "<option value=\"".$res_tipo_c1['ID_cat']."\" ".$flag_check_S1.">".$nome_padre.$res_tipo_c1['Titolo']."</option>";
					

					}
					?>
                  </select>	
                  </form> </td>
  		</tr>      

		
  		<tr>
    		<td>&nbsp;</td>
       	  <td align="left" valign="top">
		  
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabellaMenuBordoBlu">
             <?php
			 
			 if( $ID_cat == 0 ) { 
			 
			  	$str_conta = "SELECT count(*) 
						FROM prodotti O 
						WHERE O.Flag = 0 ";
	
			  } else {

			 	$str_conta = "SELECT count(*) 
						FROM prodotti O 
						WHERE O.ID_cat='{$ID_cat}' AND O.Flag = 0 ";
			  }			
			
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
			
			
			 if( $ID_cat == 0 ) { 
			 
			  	$str_cat = "SELECT * 
						FROM prodotti O
						WHERE O.Flag = 0
						ORDER BY O.ordine ASC 
						LIMIT {$b_pag},{$per_pag}";
	
			  } else {

			 	$str_cat = "SELECT * 
						FROM prodotti O
						WHERE O.Flag = 0 AND O.ID_cat='{$ID_cat}' 
						ORDER BY O.ordine ASC 
						LIMIT {$b_pag},{$per_pag}";
			  }				
			
			

			$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());
			?>
              <tr> 
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin"> 
                <img src="img/spacer.gif" width="0" height="9"></td>
                <td width="73" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Ordine</td>
                <td width="330" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Contenuto</td>
                <td width="211" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Sottotitolo</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Elimina</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Modifica</td>
                <td align="center" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Immagini</td>
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
				  <div align="center"><?php echo $res_cat['Ordine'];?></div></td>
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu"><div align="center"><?php echo 
			html_entity_decode($res_cat['Titolo']);?></div></td>
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo html_entity_decode($res_cat['Sottotitolo']); ?></div></td>
                
                <td width="87" align="center" bgcolor="<?php echo $colore_celle;?>" valign="middle">
					<a href="#" onClick="javascript:elimina_prodotto(<?php echo $res_cat['ID_cont']; ?>,<?php echo $now_page;?>, <?php echo $ID_cat;?>);return false;" class="sezioneMenu">
					<img src="icone/Delete.gif" width="27" height="27" border="0"></a></td>
          <td width="82" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
					
					<a href="visual_gallery.php?azione=modifica&ID_cat=<?php echo $res_cat['ID_cat']; ?>&ID_cont=<?php echo $res_cat['ID_cont']; ?>" class="sezioneMenu">
					<img src="icone/Edit.gif" width="27" height="27" border="0"></a></td>
             <td width="72" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
             	     <?php

					 $str_conta = "SELECT count(*) as tot_imm
								FROM imm 
								WHERE ID_cont = '{$res_cat['ID_cont']}'";
					
					$query_conta = mysql_query($str_conta, $conn) or die(mysql_error());   
					$res_conta = mysql_fetch_object($query_conta); ?>
             		<a href="visual_immagini.php?ID_cat=<?php echo $res_cat['ID_cat']; ?>&ID_cont=<?php echo $res_cat['ID_cont']; ?>" class="sezioneMenu">
					<img src="icone/Image.gif" width="27" height="27" border="0"></a> (<?php echo $res_conta->tot_imm; ?>)</td>
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
					if( $now_page != ($j + 1)){ 
						?>
						-
						<a href="visual_gallery.php?n_pagina=<?php echo $j + 1; ?>&ID_cat=<?php echo $ID_cat; ?>" class="sezioneMenu">
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
        
        <?php } // fine if adding ?>
        
        
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
