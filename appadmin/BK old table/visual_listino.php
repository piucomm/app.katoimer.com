<?php 
session_cache_expire(30);
session_start();

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
<title><? echo TITOLO_PAGINA;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="txt2/editor.js"></script>

<script language="JavaScript" type="text/JavaScript">
<!--
function resubmit(){
		var lingua = document.form1.ID_lingua.value;
		location.href = 'visual_cat.php?lin='+lingua;
}


function elimina_cucina(id_c, pagina, id_cat) {

	if(confirm("Vuoi veramente eliminare il contenuto?"))
	{
		
  		location.href = 'visual_gallery.php?ID_cont='+id_c+'&azione=elimina_cucina&n_pagina='+pagina+'&ID_cat='+id_cat;
       
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

			testo_sc.prepareSubmit();
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
	

	
		if ( document.add_sezione.titolo.value == "" ){
			bool = bool + 1;
			messaggio = messaggio + "Il campo Titolo non puo essere vuoto!\n";
		} 
	
		
		if ( bool == 0 ) {

			testo_sc.prepareSubmit();
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
        	Gestione Listino Prezzi<br>
        	<br>
          </td>
          
          
  		</tr>
        <?
		
			$strEsito = "";
	
		 	 // modifico il listino
			 if($_POST['azione'] == "modifing" ){
			 	
				$testo = addslashes(stripslashes($_POST['note']));
				$testo_eng = addslashes(stripslashes($_POST['note_eng']));
				$testo_fra = addslashes(stripslashes($_POST['note_fra']));
				$testo_de = addslashes(stripslashes($_POST['note_de']));
				
				$pA_1 = $_POST['prezzoA_1'];
				$pB_1 = $_POST['prezzoB_1'];
				$pC_1 = $_POST['prezzoC_1'];
	
				$pA_2 = $_POST['prezzoA_2'];
				$pB_2 = $_POST['prezzoB_2'];
				$pC_2 = $_POST['prezzoC_2'];
				
				$pA_3 = $_POST['prezzoA_3'];
				$pB_3 = $_POST['prezzoB_3'];
				$pC_3 = $_POST['prezzoC_3'];
				
				$pA_4 = $_POST['prezzoA_4'];
				$pB_4 = $_POST['prezzoB_4'];
				$pC_4 = $_POST['prezzoC_4'];
				
				$pA_5 = $_POST['prezzoA_5'];
				$pB_5 = $_POST['prezzoB_5'];
				$pC_5 = $_POST['prezzoC_5'];
				
				$pA_6 = $_POST['prezzoA_6'];
				$pB_6 = $_POST['prezzoB_6'];
				$pC_6 = $_POST['prezzoC_6'];
				
				$strMod = "UPDATE `listino` SET `prezzoA` = '$pA_1', `prezzoB` = '$pB_1', `prezzoC` = '$pC_1', `note` = '$testo', `note_eng` = '$testo_eng', `note_fra` = '$testo_fra', `note_de` = '$testo_de' WHERE `id` = '1' ";		
				$resMod = mysql_query($strMod, $conn) or die(mysql_error());
				
				$strMod1 = "UPDATE `listino` SET `prezzoA` = '$pA_2', `prezzoB` = '$pB_2', `prezzoC` = '$pC_2', `note` = '$testo', `note_eng` = '$testo_eng', `note_fra` = '$testo_fra', `note_de` = '$testo_de' WHERE `id` = '2' ";	
				$resMod1 = mysql_query($strMod1, $conn) or die(mysql_error());
				
				$strMod2 = "UPDATE `listino` SET `prezzoA` = '$pA_3', `prezzoB` = '$pB_3', `prezzoC` = '$pC_3', `note` = '$testo', `note_eng` = '$testo_eng', `note_fra` = '$testo_fra', `note_de` = '$testo_de' WHERE `id` = '3' ";	
				$resMod2 = mysql_query($strMod2, $conn) or die(mysql_error());
				
				$strMod3 = "UPDATE `listino` SET `prezzoA` = '$pA_4', `prezzoB` = '$pB_4', `prezzoC` = '$pC_4', `note` = '$testo', `note_eng` = '$testo_eng', `note_fra` = '$testo_fra', `note_de` = '$testo_de' WHERE `id` = '4' ";	
				$resMod3 = mysql_query($strMod3, $conn) or die(mysql_error());
				
				$strMod4 = "UPDATE `listino` SET `prezzoA` = '$pA_5', `prezzoB` = '$pB_5', `prezzoC` = '$pC_5', `note` = '$testo', `note_eng` = '$testo_eng', `note_fra` = '$testo_fra', `note_de` = '$testo_de' WHERE `id` = '5' ";	
				$resMod4 = mysql_query($strMod4, $conn) or die(mysql_error());
				
				$strMod5 = "UPDATE `listino` SET `prezzoA` = '$pA_6', `prezzoB` = '$pB_6', `prezzoC` = '$pC_6', `note` = '$testo', `note_eng` = '$testo_eng', `note_fra` = '$testo_fra', `note_de` = '$testo_de' WHERE `id` = '6' ";	
				$resMod5 = mysql_query($strMod5, $conn) or die(mysql_error());

				$colEsito = "#c0ff28";
				$strEsito = "Listino modificato correttamente!";
				

			 }
			 
			 if($strEsito != "") {	
		
		?>
		<tr bgcolor="<? echo $colEsito; ?>"> 
                <td colspan="11" height="28"><div align="center" class="fontDettLogin"> 
                  
                  <? echo $strEsito; ?>
                  </div></td>
        </tr>        
        <?
		
			}
		?>
        
        
		<tr>
          	<td width="8" align="left" valign="top"><img src="img/spacer.gif" width="8" height="24"></td>
        	<td width="1008" align="left" valign="top" class="fontDettLoginGrigioBig">
        	
    
    
			<form name="add_sezione" id="add_sezione" method="post" >
		
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabellaMenuBordoBlu">
              <input name="refresh" type="hidden" id="refresh" value="0">
              <input name="azione" type="hidden" id="azione" value="modifing">
              <input name="<?=$NOME_SESSIONE?>" type="hidden" id="<?=$NOME_SESSIONE?>" value="<?=$ID_SESSIONE?>">
	
              <? 
			  
			  // query vecchio listino 
			  
			  	$str_modDett = "SELECT * 
				FROM listino L ";

				$query_modDett = mysql_query($str_modDett, $conn) or die(mysql_error());
				
				$ind = 0;
				
				while($res_modDett = mysql_fetch_array($query_modDett)){
					$prezzoA[$ind] = stripslashes($res_modDett['prezzoA']);
					$prezzoB[$ind] = stripslashes($res_modDett['prezzoB']);
					$prezzoC[$ind] = stripslashes($res_modDett['prezzoC']);
					$appa[$ind] = stripslashes($res_modDett['appartamento']);
					$note = addslashes(stripslashes($res_modDett['note']));
					$note_eng = addslashes(stripslashes($res_modDett['note_eng']));
					$note_fra = addslashes(stripslashes($res_modDett['note_fra']));
					$note_de = addslashes(stripslashes($res_modDett['note_de']));
					$ind++;
				}
                
              ?>
	
              <tr>
                <td width="30" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" width="34" height="10" border="0"></td>
                <td colspan="3" bgcolor="<? echo $_SESSION['colore']; ?>" class="bodyTxt"></td>
              </tr>
              <td width="170" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin" colspan="5"><table width="682" border="1">
              
                <tr>
                  <th width="79" scope="col">Periodo Vacanza</th>
                  <th width="125" bgcolor="#FFFFCC" scope="col"><? echo $appa[0]; ?></th>
                  <th width="106" bgcolor="#FFFFCC" scope="col"><? echo $appa[1]; ?></th>
                  <th width="102" bgcolor="#FFFFCC" scope="col"><? echo $appa[2]; ?></th>
                  <th width="93" bgcolor="#FFFFCC" scope="col"><? echo $appa[3]; ?></th>
                  <th width="85" bgcolor="#FFFFCC" scope="col"><? echo $appa[4]; ?></th>
                  <th width="62" bgcolor="#FFFFCC" scope="col"><? echo $appa[5]; ?></th>
                </tr>
                <tr>
                  <th bgcolor="#66FF00" scope="row">A</th>
                  <td><div align="center"><input id="prezzoA_1" name="prezzoA_1" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoA[0]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoA_2" name="prezzoA_2" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoA[1]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoA_3" name="prezzoA_3" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoA[2]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoA_4" name="prezzoA_4" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoA[3]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoA_5" name="prezzoA_5" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoA[4]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoA_6" name="prezzoA_6" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoA[5]; ?>"></div></td>
                </tr>
                <tr>
                  <th bgcolor="#FF9900" scope="row">B</th>
                  <td><div align="center"><input id="prezzoB_1" name="prezzoB_1" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoB[0]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoB_2" name="prezzoB_2" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoB[1]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoB_3" name="prezzoB_3" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoB[2]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoB_4" name="prezzoB_4" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoB[3]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoB_5" name="prezzoB_5" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoB[4]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoB_6" name="prezzoB_6" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoB[5]; ?>"></div></td>
                </tr>
                <tr>
                  <th bgcolor="#CC0000" scope="row">C</th>
                  <td><div align="center"><input id="prezzoC_1" name="prezzoC_1" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoC[0]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoC_2" name="prezzoC_2" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoC[1]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoC_3" name="prezzoC_3" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoC[2]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoC_4" name="prezzoC_4" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoC[3]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoC_5" name="prezzoC_5" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoC[4]; ?>"></div></td>
                  <td><div align="center"><input id="prezzoC_6" name="prezzoC_6" class="tabellaMenuBordoBlu" size="15" maxlength="10"  value="<? echo $prezzoC[5]; ?>"></div></td>
                </tr>
              </table></td>
              </tr>
              
                <td width="30" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin" colspan="5"><img src="img/spacer.gif" width="34" height="20" border="0"></td>
              </tr>
              <tr>
                <td width="30" valign="top" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Note</div></td>
                <td colspan="3" class="bodyTxt">
                      <?
					  
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
';
					  
					  ?>
                      <textarea id="note" name="note" rows="5" cols="80"><? echo $note;?></textarea>
                    </td>
              </tr>
              <tr>
                <td width="170" height="10" colspan="4" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
              </tr>			  
			  
              
              <tr>
                <td width="30" valign="top" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Note (eng)</div></td>
                <td colspan="3" class="bodyTxt">
                      <textarea id="note_eng" name="note_eng" rows="5" cols="80"><? echo $note_eng;?></textarea>
                    </td>
              </tr>
              <tr>
                <td width="170" height="10" colspan="4" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
              </tr>
              
              <tr>
                <td width="30" valign="top" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Note (fra)</div></td>
                <td colspan="3" class="bodyTxt">
                      <textarea id="note_fra" name="note_fra" rows="5" cols="80"><? echo $note_fra;?></textarea>
                    </td>
              </tr>
              <tr>
                <td width="170" height="10" colspan="4" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
              </tr>	               
                           
              <tr>
                <td width="30" valign="top" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><div align="left">Note (de)</div></td>
                <td colspan="3" class="bodyTxt">
                      <textarea id="note_de" name="note_de" rows="5" cols="80"><? echo $note_de;?></textarea>
                    </td>
              </tr>
              <tr>
                <td width="170" height="10" colspan="4" bgcolor="<? echo $_SESSION['colore']; ?>" class="fontDettLogin"><img src="img/spacer.gif" height="10" border="0"> </td>
              </tr>	               
              
              
              
              <tr bgcolor="<? echo COLORE_HEADER_TABLE; ?>" >
                <td width="170" height="34" class="bodyTxt">&nbsp;</td>
                <td colspan="3" class="bodyTxt">
                
                	<input name="b_conferma" type="submit"  value="Modifica Listino" onClick="return mod_Form(<? echo $_GET['ID_cont']; ?>,<? echo $ID_cat;?>);">
                    <input name="b_indietro" type="submit"  value="Torna indietro" onClick="window.history.back();">
                    
                    <br></tr>
            </table>
          </form>      
          
      
          

          
          </td>
  		</tr>        
  
        
        
	  </table>
		<!-- fine visualizza sottosezione-->


        
	<!-- fine tabella box_centrale -->
		
        
        
        
        </td>
</tr>
	  
<? include "include/footer.php";?>
	
	</table>

<? 		

mysql_close($conn);
?>
</body>
</html>
