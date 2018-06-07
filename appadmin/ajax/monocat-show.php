<?php
session_cache_expire(30);
session_start();

$rec_data = json_decode(stripslashes($_POST['data']));

$typeToS = $rec_data->TypeTS;  // tipo di contenuto da visualizzare
$lingua = $rec_data->Lingua; // lingua
$attiva = $rec_data->Attiva; // pubblicato o no
$id_padre = $rec_data->Padre;  // Il padre di tutti è Base con ID = 1

$current_page = $rec_data->Page;  // pagina corrente per paginazione

if($rec_data->ItemPerPage != 0) { 
  $per_page = $rec_data->ItemPerPage;  // numero item per pagina
} else { $per_page = 100000000; }

$searchString = $rec_data->Search; // stringa di ricerca

$jstatus = 0;
$jmess = "";
$jpagin = "";

$config2 = parse_ini_file('../data/config.ini'); 
$conn2 = mysqli_connect('localhost',$config2['username'],$config2['password'],$config2['dbname']);

$stmt2 = $conn2->stmt_init();
$stmt3 = $conn2->stmt_init();

switch($typeToS) {
  case "CAT":  // visualizzo le categorie

    /* count risultati */
    if(strcmp($searchString, "") == 0){ 
      $stmt2->prepare("SELECT I.Titolo 
                  FROM tbl_category C, tbl_items I
                  WHERE C.ID = I.ID_cat AND C.Type = ? AND I.Attiva = ? AND C.ID_padre = ? AND I.Lingua = ? "); // 
      $stmt2->bind_param("siis", $typeToS, $attiva, $id_padre, $lingua);
    } else {
      $stmt2->prepare("SELECT I.Titolo 
                  FROM tbl_category C, tbl_items I
                  WHERE C.ID = I.ID_cat AND C.Type = ? AND I.Attiva = ? AND C.ID_padre = ? AND I.Lingua = ?  AND I.Titolo LIKE CONCAT('%', ?, '%') "); // 
      $stmt2->bind_param("siiss",$typeToS, $attiva, $id_padre, $lingua, $searchString );
    }

    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($Titolo); 
    $total_results = $stmt2->num_rows; // numero risultati

    $stmt2->free_result();
    //$stmt2->close();

    // calcolo pagination
    $resto_mod = $total_results % $per_page;

    if($total_results >= $per_page) {
      $total_pages = ceil($total_results / $per_page);
    } else { $total_pages = 1;}
                    
    $page = $current_page;

    $start_query = $page;

    if ($page <= 0) {
      $page = 1;
    }
                      
    if ($page <= 1) {
      $start_query = 0;
    } else {
      $start_query = ($page - 1) * $per_page;
    }

    if($searchString != "" ) { $jpagin .= "<b>Ricerca per:</b> ".$searchString." | "; }

    $jpagin .= "Lingua: ";
    $jpagin .= "<div class=\"btn-group\">";
    $jpagin .= "<select class=\"dropLingua\">";
    $jpagin .= "<option value=\"it_IT\" "; if(strcmp($lingua,"it_IT") == 0) $jpagin .=  "selected"; $jpagin .= " >".$_SESSION['lingua'][0]."</option>";
    $jpagin .= "<option value=\"en_GB\" ";if(strcmp($lingua,"en_GB") == 0) $jpagin .=  "selected"; $jpagin .= " >".$_SESSION['lingua'][1]."</option>";
    $jpagin .= "</select>"; $jpagin .= "<img src=\"./img/".$lingua.".jpg\" class=\"lingua\" />";
    $jpagin .= "</div> ";

    $jpagin .= " - Totale risultati: ".$total_results." - Risultati per pagina: "; //.$per_page;
    $jpagin .= "<div class=\"btn-group\">";
    $jpagin .= "<select class=\"dropItemsNumber\">";
    $jpagin .= "<option value=\"1\" "; if($per_page==1) $jpagin .=  "selected"; $jpagin .= " >1</option>";
    $jpagin .= "<option value=\"10\" ";if($per_page==10) $jpagin .=  "selected"; $jpagin .= " >10</option>";
    $jpagin .= "<option value=\"20\" ";if($per_page==20) $jpagin .=  "selected"; $jpagin .= " >20</option>";
    $jpagin .= "<option value=\"50\" ";if($per_page==50) $jpagin .=  "selected"; $jpagin .= " >50</option>";
    $jpagin .= "<option value=\"100\" "; if($per_page==100) $jpagin .=  "selected"; $jpagin .= " >100</option>";
    $jpagin .= "</select>";
    $jpagin .= "</div>";

    $jpagin .= " - Pagina: ".$page." di ".$total_pages;
    $prev_page = $page-1;
    $next_page = $page+1;

    $jpagin .= " <div class=\"btn-group\">";
    $jpagin .= "<button onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."')\" class=\"btn btn-default btn-sm\" id=\"pagLeft\""; 
    if($prev_page<1){ $jpagin .= "disabled"; }
    $jpagin .= "><i class=\"fa fa-chevron-left\"></i></button>";

    $jpagin .= "<button onclick=\"showData(".$next_page.",".$per_page.",'".$typeToS."','".$lingua."')\" class=\"btn btn-default btn-sm\" id=\"pagLeft\""; 
    if($page>=$total_pages){ $jpagin .= "disabled"; }
    $jpagin .= "><i class=\"fa fa-chevron-right\"></i></button>";

    $jpagin .= "</div>";


    if($total_results > 0) {

      if(strcmp($searchString, "") == 0){ 
        $stmt2->prepare("SELECT I.ID_item, I.ID_cat, I.Titolo, I.Descrizione,I.Pubblica, I.Ordine, I.Evidenza
                          FROM tbl_category C, tbl_items I
                          WHERE C.ID = I.ID_cat AND C.Type = ? AND I.Attiva = ? AND C.ID_padre = ? AND I.Lingua = ? ORDER BY I.Ordine DESC LIMIT ?,? ");
        $stmt2->bind_param("siisii",$typeToS, $attiva, $id_padre, $lingua, $start_query, $per_page);
      } else {
        $stmt2->prepare("SELECT I.ID_item, I.ID_cat, I.Titolo, I.Descrizione,I.Pubblica, I.Ordine, I.Evidenza
                          FROM tbl_category C, tbl_items I
                          WHERE C.ID = I.ID_cat AND C.Type = ? AND I.Attiva = ? AND C.ID_padre = ? AND I.Lingua = ? AND I.Titolo LIKE CONCAT('%', ?, '%')  ORDER BY I.Ordine DESC LIMIT ?,? ");
        $stmt2->bind_param("siissii",$typeToS, $attiva, $id_padre, $lingua, $searchString, $start_query, $per_page); 
      }

      $stmt2->execute();
      $stmt2->store_result();
      $stmt2->bind_result($ID_item, $ID_cat, $Titolo,$Descrizione,$Pubblica, $Ordine, $Evidenza); 
      $total_counter = $stmt2->num_rows; // numero risultati

      $jstatus = 1;

      $jmess .= "<thead>";
      $jmess .= "<tr>";
        $jmess .= "<th></th><th>ID</th><th>Evidenza</th><th>Titolo</th><th>Descrizione</th><th>Immagini</th><th>Pubblica</th><th>Ordine</th><th>Modifica</th><th>Traduzioni</th>";
      $jmess .= "</tr>";
      $jmess .= "</thead>";

      while($stmt2->fetch()){ 

        $jmess .= "<tr>";
          $jmess .= "<td><input type=\"checkbox\" class=\"checkbox\" name=\"selItem[]\" value=\"".$ID_item."\" ></td>";
          $jmess .= "<td class=\"catCol id\">".$ID_item."</td>";
          $jmess .= "<td class=\"catCol star\">"; if($Evidenza == 1) { $jmess .= "<i class=\"fa fa-star text-yellow\"></i> "; }
          $jmess .= "</td>";
          $jmess .= "<td class=\"catCol name\"><a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat."&lingua=".$lingua."&id_item=".$ID_item."\" title=\"Modifica in lingua ".$lingua."\" >".$Titolo."</a></td>";
          $jmess .= "<td class=\"catCol txt\">".substr($Descrizione, 0, 100);
          if(strlen($Descrizione)>100): $jmess .= "..."; endif;
          $jmess .= "</td>";
          $jmess .= "<td class=\"catCol image\"><i class=\"fa fa-file-image-o\" aria-hidden=\"true\"></i></td>";
          $jmess .= "<td class=\"catCol pubb\"><i class=\"fa fa-circle "; if($Pubblica == 1): $jmess .= "green-icon"; else: $jmess .= "red-icon"; endif;
          $jmess .= "\" aria-hidden=\"true\"></i> </td>";
          $jmess .= "<td class=\"catCol ordine\">".$Ordine."</td>";
          $jmess .= "<td class=\"catCol update\"><a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat."&lingua=".$lingua."&id_item=".$ID_item."\" class=\"btn btn-default btn-sm\" id=\"updateBt\" title=\"Modifica in lingua ".$lingua."\" ><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>";
          $jmess .= "<td class=\"catCol lingua\">";
          
          // verifico se è presente la traduzione nelle altre lingue
          $temp_lingua = $_SESSION['lingua']; // rimuovo la lingua attuale dalla variabile di sessione LINGUA
          if(($key = array_search($lingua, $temp_lingua)) !== false) {
            array_splice($temp_lingua, $key, 1);
          }

          for($iLin = 0; $iLin < count($temp_lingua); $iLin++) {
            $linguaNew = $temp_lingua[$iLin];
            
            // count risultati item altre lingue con Stato attivo = 1
            $stmt3->prepare("SELECT I.ID_item
                          FROM tbl_items I
                          WHERE I.ID_cat = ? AND I.Attiva = 1 AND I.Lingua = ? ");
            $stmt3->bind_param("is", $ID_cat, $linguaNew);
            
            $stmt3->execute();
            $stmt3->store_result(); 
            $stmt3->bind_result($ID_item_cat);
            $stmt3->fetch();
            $total_results_lingua = $stmt3->num_rows; // numero risultati
            //$jmess .= "tot ".count($temp_lingua)." ID_item traduzione ".$ID_item." Lingua ".$linguaNew. " ---- ";
            
            if($total_results_lingua > 0) {
              $jmess .= "<a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat."&lingua=".$linguaNew."&id_item=".$ID_item_cat."\" title=\"Modifica traduzione in lingua ".$linguaNew."\" ><img src=\"./img/".$linguaNew.".jpg\" class=\"lingua\" ></a><br/>";
            } else {
              $jmess .= "<a href=\"./categoria-page.php?act=add&trans_of_id=".$ID_item."&id_cat=".$ID_cat."&lingua=".$linguaNew."&trans_of_item=".$Titolo."\" class=\"btn btn-default btn-sm\" id=\"updateBt\" title=\"Traduzione mancante in lingua ".$linguaNew."\" ><i class=\"fa fa-plus\" aria-hidden=\"true\"></i> <img src=\"./img/".$linguaNew.".jpg\" class=\"lingua\" style=\"width:15px;\" ></a>";
            }

            $stmt3->free_result();
            //$stmt3->close(); 

          } // for
          
         
          $jmess .= "</td>";
        $jmess .= "</tr>";

      } // while

      $stmt3->close(); 

    } else {
      $jstatus = 1;
      $jmess = "<tr><td colspan\"10\">Nessun risultato trovato</td></tr>";
    }
  break; // break categorie
}

$stmt2->free_result();
//mysqli_stmt_close($stmt2);  
$stmt2->close();
$conn2->close();

echo json_encode(array(
	'status' => $jstatus,
	'msg' => $jmess,
  'pag' => $jpagin
));

?>