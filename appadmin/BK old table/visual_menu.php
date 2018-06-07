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
        	Gestione Menu Principale<br><br>
          </td>
          
          
  		</tr>
        <?php
		
			$strEsito = "";
		
			  // elimino il contenuto
			 if($_GET['azione'] == "elimina_voce" ){
			 	
			 	//tutti i figli vengono trasferiti al padre ell'eliminato 
			 	$strModEl = "UPDATE `categorie` SET `ID_padre` = '$ID_padre' WHERE `ID_padre` = '$ID_cat' ";		
				$resModEl = mysql_query($strMod, $conn);
				
				 //elimino la categoria
				$strEliminaCucina = "DELETE FROM categorie
									WHERE ID_cat = '{$ID_cat}'";			
				
				$resEliminaCucina = mysql_query($strEliminaCucina) or die(mysql_error());
				
				$ID_cat = $_GET['ID_padre'];  // voglio visualizzare nel drop down in basso i figli del padre dell'eliminato

				$colEsito = "#ff0000";
				$strEsito = "Contenuto eliminato correttamente!";
				
			 }
			 
			 
			 
			 // aggiungo la voce di menu
			 if($_GET['azione'] == "adding" ){
			 	
				$tit = $_POST['titolo'];
				$tit_eng = $_POST['titolo_eng'];
				$txt = addslashes(stripslashes($_POST['testo_sc']));
				$txt_eng = addslashes(stripslashes($_POST['testo_sc_eng']));
				$link = $_POST['link'];
				$note = $_POST['note'];
				$pub = $_POST['pubblica'];
				
				$ID_padre = $_POST['ID_padre'];
				
				$ord = $_POST['ordine'];

				$strAdd = "INSERT INTO `categorie` (`ID_cat`, `Titolo`, `Titolo_eng`, `Descrizione`, `Descrizione_eng`, `Note`, `Link`, `ID_padre` , `Pubblica` , `Ordine`) VALUES (NULL, '$tit', '$tit_eng', '$txt', '$txt_eng', '$note', '$link', '$ID_padre' , '$pub' , '$ord')";	
				
				$resAdd = mysql_query($strAdd) or die(mysql_error());
				
				$ID_cat = $_POST['ID_padre'];
				
				$colEsito = "#c0ff28";
				$strEsito = "Contenuto aggiunto correttamente!";

			 }
	
	
		 	 // modifico la voce
			 if($_GET['azione'] == "modifing" ){
			 	
				$tit = $_POST['titolo'];
				$tit_eng = $_POST['titolo_eng'];
				$txt = addslashes(stripslashes($_POST['testo_sc']));
				$txt_eng = addslashes(stripslashes($_POST['testo_sc_eng']));
				$link = $_POST['link'];
				$note = $_POST['note'];
				$pub = $_POST['pubblica'];
				$ord = $_POST['ordine'];
				
				$ID_cont = $_GET['ID_cont'];
				
				$strMod = "UPDATE `categorie` SET `Titolo` = '$tit', `Titolo_eng` = '$tit_eng', `Descrizione` = '$txt', `Descrizione_eng` = '$txt_eng',   `Note` = '$note', `Link` = '$link' , `ID_padre` = '$ID_padre' , `Pubblica` = '$pub' , `Ordine` = '$ord'  WHERE `ID_cat` = '$ID_cont' ";		
				
				$resMod = mysql_query($strMod, $conn) or die(mysql_error());
				
				$colEsito = "#c0ff28";
				$strEsito = "Contenuto modificato correttamente!";
				

			 }
			 
		if($strEsito != "") { ?>
		<tr bgcolor="<?php echo $colEsito; ?>"> 
			<td colspan="11" height="28"><div align="center" class="fontDettLogin"> 
			<?php echo $strEsito; ?></td>
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
              <input name="<?php echo $NOME_SESSIONE; ?>" type="hidden" id="<?php echo $NOME_SESSIONE; ?>" value="<?php echo $NOME_SESSIONE; ?>">
				
                
              <?php // query modifica   
                
              $ID_cont = $_GET['ID_cont'];
                
              if($_GET['azione'] == "modifica") {
			  	
				$str_modDett = "SELECT * 
						FROM categorie C
						WHERE C.ID_cat='{$ID_cont}' ";

				$query_modDett = mysql_query($str_modDett, $conn) or die(mysql_error());
				
				$res_modDett = mysql_fetch_array($query_modDett);
				
				$testo_sc = addslashes(stripslashes($res_modDett['Descrizione']));
				$testo_sc_eng = addslashes(stripslashes($res_modDett['Descrizione_eng']));

	
			  }
                
              ?>
			  
			    
              <tr>
                <td valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Categoria Padre</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt">
				
					<?php
					//Visualizzazione delle categorie
					
					$str_tipo_c = "SELECT * 
								FROM categorie ";

					$query_tipo_c = mysql_query($str_tipo_c, $conn) or die(mysql_error()); 
					?>
                  	<select name="ID_padre" class="tabellaMenuBordoBlu" id="ID_padre" size="1" >

                    <?php
					while ( $res_tipo_c = mysql_fetch_array($query_tipo_c)){
							
							$flag_check_S = "";
					
							if( $res_tipo_c['ID_cat'] == $ID_cat){
								$flag_check_S = "selected='selected'";
							}		
					
							echo "<option value=\"".$res_tipo_c['ID_cat']."\" ".$flag_check_S.">".$res_tipo_c['Titolo']."</option>";

					}
					?>
					</select>	
                  	</td>
              </tr>

              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Titolo</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt"><input name="titolo" type="text" class="tabellaMenuBordoBlu" id="titolo" value="<?php echo stripslashes($res_modDett['Titolo']);?>" size="100%" maxlength="150">
                  <img src="img/spacer.gif" width="8" height="9"><span class="fontDettLoginGrigio"> Max. 150 caratteri</span></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Titolo eng</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt"><input name="titolo_eng" type="text" class="tabellaMenuBordoBlu" id="titolo_eng" value="<?php echo stripslashes($res_modDett['Titolo_eng']);?>" size="100%" maxlength="150">
                  <img src="img/spacer.gif" width="8" height="9"><span class="fontDettLoginGrigio"> Max. 150 caratteri</span></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
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
                      <textarea id="testo_sc" name="testo_sc" rows="10" cols="80"><?php echo $testo_sc;?></textarea>                  
				</td></tr>

			  <tr>
                <td width="170" colspan="4" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
              </tr>
              
              
               <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Testo (eng)</div></td>
                <td colspan="3" class="bodyTxt"><textarea id="testo_sc_eng" name="testo_sc_eng" rows="10" cols="80"><?php echo $testo_sc_eng;?></textarea></td></tr>

			  <tr>
                <td width="170" colspan="4" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
              </tr>
              
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Link</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt"><input name="link" type="text" class="tabellaMenuBordoBlu" id="link" value="<?php echo stripslashes($res_modDett['Link']);?>" size="100%" maxlength="250"></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              
              <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Ordine</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt"><input name="ordine" type="text" class="tabellaMenuBordoBlu" id="ordine" value="<?php echo stripslashes($res_modDett['Ordine']);?>" size="100%" maxlength="250"></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              
              
               <tr>
                <td width="170" valign="top" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Note</div></td>
                <td colspan="3" align="left" valign="top" class="bodyTxt"><input name="note" type="text" class="tabellaMenuBordoBlu" id="note" value="<?php echo stripslashes($res_modDett['Note']);?>" size="100%" ></td>
              </tr>
              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="164" height="10" border="0"></td>
                <td colspan="3" bgcolor="<?php echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              

              <tr>
                <td width="170" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Pubblica</div></td>
                <td width="294" class="bodyTxt">
				
				<?php 
				if( $res_modDett['Pubblica'] == 1 ) { 
					$si = "checked";
					$no = "";
				} else {
					$no = "checked";
					$si = "";
				}
				?>
				 
				<input type="radio" name="pubblica" value="1" <?php echo $si;?> ><small> si </small>
                <input type="radio" name="pubblica" value="0" <?php echo $no;?> ><small> no </small>
                </td>
                <td width="164" bgcolor="<?php echo $_SESSION['colore']; ?>" class="fontDettLogin">&nbsp;</td>
                <td width="506" class="bodyTxt">&nbsp;</td>
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
                	<input name="b_conferma" type="submit"  value="Modifica Contenuto" onClick="return mod_Form(<?php echo $ID_cont; ?>,<?php echo $ID_cat;?>);">
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
                   
                    <?php

					while ( $res_tipo_c1 = mysql_fetch_array($query_tipo_c1)){
						
							$str_count_ch = mysql_query("SELECT count(*) as Tot_ch FROM categorie WHERE ID_padre = '{$res_tipo_c1['ID_cat']}'", $conn) or die(mysql_error()); 
							$res_count_child = mysql_fetch_array($str_count_ch);
							
							$flag_check_S1 = "";
					
							if( $res_tipo_c1['ID_cat'] == $ID_cat){
								$flag_check_S1 = "selected";
							}		
					
							echo "<option value=\"".$res_tipo_c1['ID_cat']."\" ".$flag_check_S1.">".$res_tipo_c1['Titolo']." (".$res_count_child['Tot_ch'].")</option>";

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
			 
			 $str_conta = "SELECT count(*) 
						FROM categorie C 
						WHERE C.ID_padre='{$ID_cat}'";	
			
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
						FROM categorie C 
						WHERE C.ID_padre='{$ID_cat}'
						ORDER BY Ordine ASC
						LIMIT {$b_pag},{$per_pag}";	
			
			$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());
			
			?>
              <tr> 
                <td align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin"> 
                <img src="img/spacer.gif" width="0" height="9"></td>
                <td width="33" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Ordine</td>
                <td width="330" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Titolo</td>
                <td width="211" align="left" bgcolor="<?php echo COLORE_HEADER_TABLE; ?>" class="fontDettLogin">Testo</td>
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
					$colore_celle = "#ffffff";
				} else {
					$colore_celle = "#F7F7F7";
				}
					
					
			?>
			<tr> 
                <td width="14" height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu"><img src="img/spacer.gif" width="8" height="9"></td>
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo html_entity_decode($res_cat['Ordine']); ?></div></td>
                
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu"><div align="center">
                <?php echo html_entity_decode($res_cat['Titolo']);?></div></td>
                <td height="40" align="left" valign="middle" bgcolor="<?php echo $colore_celle;?>" class="sezioneMenu">
                <div align="center"><?php echo html_entity_decode($res_cat['Descrizione']); ?></div></td>
                
                <td width="87" align="center" bgcolor="<?php echo $colore_celle;?>" valign="middle">
					<a href="#" onClick="javascript:elimina_voce(<?php echo $res_cat['ID_cat']; ?>,<?php echo $now_page;?>, <?php echo $res_cat['ID_padre'];?>);return false;" class="sezioneMenu">
					<img src="icone/Delete.gif" width="27" height="27" border="0"></a></td>
          <td width="82" align="center" valign="middle" class="sezioneMenu" bgcolor="<?php echo $colore_celle;?>" >
					
					<a href="visual_menu.php?azione=modifica&ID_cat=<?php echo $res_cat['ID_padre']; ?>&ID_cont=<?php echo $res_cat['ID_cat'];?>" class="sezioneMenu">
					<img src="icone/Edit.gif" width="27" height="27" border="0"></a></td>
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
						<a href="visual_menu.php?n_pagina=<?php echo $j + 1; ?>&ID_padre=<?php echo $ID_padre; ?>&ID_cat=<?php echo $ID_cat; ?>" class="sezioneMenu">
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
