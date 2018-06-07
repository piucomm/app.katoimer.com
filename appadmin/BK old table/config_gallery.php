<?php 
header("Content-type: application/xml");
header("Cache-control: no-cache, must-revalidate");
echo "<?xml version=\"1.0\"?>\n";
echo "<GALLERY COLUMNS=\"5\" XPOSITION=\"30\" YPOSITION=\"30\" WIDTH=\"160\" HEIGHT=\"90\" LWIDTH=\"479\" LHEIGHT=\"392\" >\n";

ini_set('error_reporting', E_ALL & ~E_NOTICE); 

include "include/config.php";
		

$str_cat = "SELECT *
		FROM categorie C
		WHERE C.ID_padre != 0
		ORDER BY C.Ordine, C.Titolo ASC ";	
			
$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());
		
while ($res_cat = mysql_fetch_object($query_cat)){
	
	if(($res_cat->Link == "0") || ($res_cat->Link == "gallprod")){
		
		echo "<categoria id_subvoce=\"$res_cat->ID_cat\" nomecat=\"$res_cat->Titolo\" type=\"vertical\" >";
	
		$str_prod = "SELECT * 
		FROM prodotti 
		WHERE ID_cat = '{$res_cat->ID_cat}'
		ORDER BY Ordine, Titolo ASC ";	
			
		$query_prod = mysql_query($str_prod, $conn) or die(mysql_error());

		// seleziono tutti i prodotti per la sottocategoria
		while ($res_prod = mysql_fetch_object($query_prod)){
			
			$res_prod->Testo = str_replace("<p>","",$res_prod->Testo);
			$res_prod->Testo = str_replace("</p>","",$res_prod->Testo);
			
			$res_prod->Testo_eng = str_replace("<p>","",$res_prod->Testo_eng);
			$res_prod->Testo_eng = str_replace("</p>","",$res_prod->Testo_eng);
			
			$txt_dec = html_entity_decode($res_prod->Testo);
			
			
			echo "<prodotto id=\"$res_prod->ID_cont\" dim=\"$res_prod->Note\" ><nome><![CDATA[$res_prod->Titolo]]></nome><desc><![CDATA[$res_prod->Testo]]></desc><desc_eng><![CDATA[$res_prod->Testo_eng]]></desc_eng>";
				
				// cerco le immagini
				$str_imm = "SELECT * 
					FROM imm 
					WHERE ID_cont = '{$res_prod->ID_cont}' ORDER BY Ordine ASC";	
					
				$query_imm = mysql_query($str_imm, $conn) or die(mysql_error());
				echo "<img>";
				while($res_imm = mysql_fetch_object($query_imm)){
					
					$large_img = "http://www.ceccotticollezioni.it/admin/public/large_".basename($res_imm->URL);
					$thumb_img = "http://www.ceccotticollezioni.it/admin/public/thumb_".basename($res_imm->URL);
				
					echo "<imgcont large=\"$large_img\" thumb=\"$thumb_img\" dida=\"$res_imm->Label\" />";

				}
				echo "</img>";
			echo "</prodotto>";
		}
		
		
	echo "</categoria>";

	}
	
	
	if(($res_cat->Link == "news") || ($res_cat->Link == "dez") || ($res_cat->Link == "adv")  || ($res_cat->Link == "filosofia") ) {
		
		echo "<".$res_cat->Link." id_subvoce=\"$res_cat->ID_cat\" type=\"vertical\" >";

		$str_prod = "SELECT * 
		FROM prodotti 
		WHERE ID_cat = '{$res_cat->ID_cat}' 
		ORDER BY Ordine, Titolo ASC ";	
			
		$query_prod = mysql_query($str_prod, $conn) or die(mysql_error());

		// seleziono tutti i prodotti per la sottocategoria
		while ($res_prod = mysql_fetch_object($query_prod)){
			
			$res_prod->Testo = str_replace("<p>","",$res_prod->Testo);
			$res_prod->Testo = str_replace("</p>","",$res_prod->Testo);
			
			$res_prod->Testo_eng = str_replace("<p>","",$res_prod->Testo_eng);
			$res_prod->Testo_eng = str_replace("</p>","",$res_prod->Testo_eng);
			
/*			$res_prod->Testo = str_replace("<","&lt;",$res_prod->Testo);
			$res_prod->Testo = str_replace(">","&gt;",$res_prod->Testo);
			$res_prod->Testo = str_replace("ˆ","&agrave;",$res_prod->Testo);
			$res_prod->Testo = str_replace("","&egrave;",$res_prod->Testo);
			$res_prod->Testo = str_replace("“","&igrave;",$res_prod->Testo);
			$res_prod->Testo = str_replace("u","&ugrave;",$res_prod->Testo);
			$res_prod->Testo = str_replace("˜","&ograve;",$res_prod->Testo); */
			
			$txt_dec = $res_prod->Testo;
					
			
			echo "<prodotto id=\"$res_prod->ID_cont\" dim=\"$res_prod->Note\" InHome=\"$res_prod->InHome\" path_url=\"$res_prod->Note\" ><nome><![CDATA[$res_prod->Titolo]]></nome><nome_eng><![CDATA[$res_prod->Titolo_eng]]></nome_eng><desc><![CDATA[$txt_dec]]></desc><desc_eng><![CDATA[$res_prod->Testo_eng]]></desc_eng>";
				
				// cerco le immagini
				$str_imm = "SELECT * 
					FROM imm 
					WHERE ID_cont = '{$res_prod->ID_cont}' ORDER BY Ordine ASC";	
					
				$query_imm = mysql_query($str_imm, $conn) or die(mysql_error());
				echo "<img>";
				while($res_imm = mysql_fetch_object($query_imm)){
					
					$large_img = "http://www.ceccotticollezioni.it/admin/public/large_".basename($res_imm->URL);
					$thumb_img = "http://www.ceccotticollezioni.it/admin/public/thumb_".basename($res_imm->URL);
					$orig_img = "http://www.ceccotticollezioni.it/admin/public/".basename($res_imm->URL);
				
					echo "<imgcont large=\"$large_img\" thumb=\"$thumb_img\" original=\"$orig_img\" dida=\"$res_imm->Label\" />";

				}
				echo "</img>";
			echo "</prodotto>";
		}

		echo "</".$res_cat->Link.">";


	}

}					

echo "</GALLERY>"; 	
	
mysql_close($conn);
?>

