<?php 
header("Content-type: application/xml");
header("Cache-control: no-cache, must-revalidate");
echo "<?xml version=\"1.0\"?>\n";
echo "<config size=\"10\" font=\"Arial\">\n";

ini_set('error_reporting', E_ALL & ~E_NOTICE); 

include "include/config.php";

$str_menu = "SELECT *
		FROM categorie 
		WHERE ID_padre='0' ";	
			
$query_menu = mysql_query($str_menu, $conn) or die(mysql_error());
		
$res_menu = mysql_fetch_object($query_menu);			

$str_cat = "SELECT * 
		FROM categorie 
		WHERE ID_padre = '{$res_menu->ID_cat}' 
		ORDER BY Ordine, Titolo ASC ";	
			
$query_cat = mysql_query($str_cat, $conn) or die(mysql_error());

while ($res_cat = mysql_fetch_object($query_cat)){
	
	$str_countchild = "SELECT count(*) as totchild 
		FROM categorie 
		WHERE ID_padre = '{$res_cat->ID_cat}' ";
		
	$query_count = mysql_query($str_countchild, $conn) or die(mysql_error());
	$res_count = mysql_fetch_object($query_count);
	
	$str_countchildp = "SELECT count(*) as totchildprod 
		FROM prodotti
		WHERE ID_cat = '{$res_cat->ID_cat}' ";
		
	$query_countp = mysql_query($str_countchildp, $conn) or die(mysql_error());
	$res_countp = mysql_fetch_object($query_countp);
	
	$sum_child = $res_count->totchild + $res_countp->totchildprod;
	
	$link = $res_cat->Link;
	
	if($sum_child > 0){
		$link = 0;
	}
	
	echo "<voce id=\"$res_cat->ID_cat\" label_ita=\"$res_cat->Titolo\" label_eng=\"$res_cat->Titolo_eng\" link=\"$link\" type=\"$res_cat->Link\" >";
	
		if($res_cat->Link == "gall"){  // cerca le sottocategorie
			$str_scat = "SELECT * 
			FROM categorie 
			WHERE ID_padre = '{$res_cat->ID_cat}' 
			ORDER BY Ordine, Titolo ASC ";	
				
			$query_scat = mysql_query($str_scat, $conn) or die(mysql_error());

			while ($res_scat = mysql_fetch_object($query_scat)){
				echo "<subvoce id=\"$res_scat->ID_cat\" label_ita=\"$res_scat->Titolo\" label_eng=\"$res_scat->Titolo_eng\" link=\"$res_scat->Link\" />";
			}
			
		} else if($res_cat->Link == "gallprod"){  // creo una sottocategoria fasulla per le galleria senza sottocategorie... direttamente i prodotti
			
			echo "<subvoce id=\"$res_cat->ID_cat\" label_ita=\"$res_cat->Titolo\" label_eng=\"$res_cat->Titolo_eng\" link=\"0\" />";

			
		}  else if(($res_cat->Link == "dez") || ($res_cat->Link == "news") || ($res_cat->Link == "adv")  || ($res_cat->Link == "filosofia") ){  // cerca direttamente i prodotti (foglie)
			
			$str_scat = "SELECT * 
				FROM prodotti
				WHERE ID_cat = '{$res_cat->ID_cat}' 
				ORDER BY Ordine, Titolo ASC ";	
				
			$query_scat = mysql_query($str_scat, $conn) or die(mysql_error());

			while ($res_scat = mysql_fetch_object($query_scat)){
				echo "<subvoce id=\"$res_scat->ID_cont\" label_ita=\"$res_scat->Titolo\" label_eng=\"$res_scat->Titolo_eng\" link=\"0\" path_url=\"$res_scat->Note\" />";
			}
		}
		
		
	echo "</voce>";

}					

	echo "<intro time_interval=\"5\" >";
	
	/* 
	echo "<imgintro srci=\"slideshow/img1.jpg\" />";
	echo "<imgintro srci=\"slideshow/img2.jpg\" />";
	echo "<imgintro srci=\"slideshow/img3.jpg\" />";
	echo "<imgintro srci=\"slideshow/img4.jpg\" />";
	echo "<imgintro srci=\"slideshow/img5.jpg\" />";
	echo "<imgintro srci=\"slideshow/img6.jpg\" />"; */

		$url_img = "";

		$str_img = "SELECT * 
				FROM immintro
				WHERE Attiva = 0
				ORDER BY Ordine ASC";
	
		$query_img = mysql_query($str_img, $conn) or die(mysql_error());

		while ($res_img = mysql_fetch_array($query_img)){

			if(strcmp($res_img['URL'],"") != 0 ) {
				$url_img = "./admin/public/intro_".basename($res_img['URL']);
				
				echo "<imgintro srci=\"".$url_img."\" />";
				
			}
			
			$url_img = "";

		}
		
	echo "</intro>";
	
	
	echo "<download>";
	
		$url_down_cat = "";
	
		$str_down_cat = "SELECT DISTINCT Categoria
					FROM download
					ORDER BY Categoria ASC";
		
		$query_down_cat = mysql_query($str_down_cat, $conn) or die(mysql_error());
	
		while ($res_down_cat = mysql_fetch_array($query_down_cat)){
		
			$rdc = $res_down_cat['Categoria'];
		
			echo "<catdown label=\"".$rdc."\" >";
	
				$url_down = "";
		
				$str_down = "SELECT * 
						FROM download
						WHERE Categoria = '{$rdc}'
						ORDER BY Ordine ASC";
			
				$query_down = mysql_query($str_down, $conn) or die(mysql_error());
		
				while ($res_down = mysql_fetch_array($query_down)){
		
					if(strcmp($res_down['URL'],"") != 0 ) {
						$url_down = basename($res_down['URL']);
						
						echo "<files srci=\"".$url_down."\" label=\"".$res_down['Label']."\" />";
						
					}
					
					$url_img = "";
		
				}
			
			echo "</catdown>";
		}	
		
	echo "</download>";
	
echo "</config>"; 	
	
mysql_close($conn);
?>

