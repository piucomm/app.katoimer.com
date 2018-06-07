<?php
session_cache_expire(30);
session_start();

$rec_data = json_decode(stripslashes($_POST['data']));

$typeToS = $rec_data->TypeTS;  // tipo di contenuto da visualizzare

$attiva = $rec_data->Attiva; // pubblicato o no
$id_padre = $rec_data->Padre;  // Il padre di tutti è Menu con ID = 1

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

switch($typeToS) {
  case "categorie":  // visualizzo le categorie

    /* count risultati */
    if($searchString == "" ){ 
      $stmt2->prepare("SELECT C.Titolo 
                  FROM categorie C
                  WHERE C.Attiva = ? AND C.ID_padre = ? "); // 
      $stmt2->bind_param("ii", $attiva, $id_padre);
    } else {
      $stmt2->prepare("SELECT C.Titolo 
                  FROM categorie C
                  WHERE C.Attiva = ? AND C.ID_padre = ? AND C.Titolo LIKE CONCAT('%', ?, '%') "); // 
      $stmt2->bind_param("iis", $attiva, $id_padre, $searchString );
    }

    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($Titolo); 
    $total_results = $stmt2->num_rows; // numero risultati

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

    $jpagin .= "Totale risultati: ".$total_results." - Risultati per pagina: "; //.$per_page;
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
    $jpagin .= "<button onclick=\"showData(".$prev_page.",".$per_page.",'categorie')\" class=\"btn btn-default btn-sm\" id=\"pagLeft\""; 
    if($prev_page<1){ $jpagin .= "disabled"; }
    $jpagin .= "><i class=\"fa fa-chevron-left\"></i></button>";

    $jpagin .= "<button onclick=\"showData(".$next_page.",".$per_page.",'categorie')\" class=\"btn btn-default btn-sm\" id=\"pagLeft\""; 
    if($page>=$total_pages){ $jpagin .= "disabled"; }
    $jpagin .= "><i class=\"fa fa-chevron-right\"></i></button>";

    $jpagin .= "</div>";

    if($total_results > 0) {

      /* $jpagin .= " <div class=\"btn-group\">";
        $jpagin .= "<a href=\"";
        if($prev_page>=1){ $jpagin .= "./categoria-page.php?page=".$prev_page; } 
        $jpagin .= "\" class=\"btn btn-default btn-sm\" id=\"pagLeft\""; 
        if($prev_page<1){ $jpagin .= "disabled"; }
        $jpagin .= ">";
        $jpagin .= "<i class=\"fa fa-chevron-left\"></i></a>";
        $jpagin .= "<a href=\"";
          if($page<$total_pages){ $jpagin .= "./categoria-page.php?page=".$next_page; }
          $jpagin .= "\" class=\"btn btn-default btn-sm\" id=\"pagRight\""; 
          if($page>=$total_pages){ $jpagin .= "disabled"; }
        $jpagin .= ">";
        $jpagin .= "<i class=\"fa fa-chevron-right\"></i></a>";
      $jpagin .= "</div>"; */

      if($searchString == "" ){ 
        $stmt2->prepare("SELECT C.ID_cat, C.Titolo,C.Titolo_eng,C.Titolo_fra,C.Titolo_de, C.Descrizione, C.Descrizione_eng, C.Descrizione_fra, C.Descrizione_de, C.Pubblica, C.Ordine, C.Evidenza
                          FROM categorie C
                          WHERE C.Attiva = ? AND C.ID_padre = ? ORDER BY C.Ordine DESC LIMIT ?,? ");
        $stmt2->bind_param("iiii", $attiva, $id_padre, $start_query, $per_page);
      } else {
        $stmt2->prepare("SELECT C.ID_cat, C.Titolo,C.Titolo_eng,C.Titolo_fra,C.Titolo_de, C.Descrizione, C.Descrizione_eng, C.Descrizione_fra, C.Descrizione_de, C.Pubblica, C.Ordine, C.Evidenza
                          FROM categorie C
                          WHERE C.Attiva = ? AND C.ID_padre = ? AND C.Titolo LIKE CONCAT('%', ?, '%') ORDER BY C.Ordine DESC LIMIT ?,?");
        $stmt2->bind_param("iisii", $attiva, $id_padre, $searchString , $start_query, $per_page);    
      }

      $stmt2->execute();
      $stmt2->store_result();
      $stmt2->bind_result($ID_cat, $Titolo,$Titolo_eng,$Titolo_fra,$Titolo_de, $Descrizione, $Descrizione_eng, $Descrizione_fra, $Descrizione_de, $Pubblica, $Ordine, $Evidenza); 

      if($_SESSION['lingua']['it'] == 1){
        $princ_tit = $Titolo;
        $princ_desc = $Descrizione;
      } else {
        if($_SESSION['lingua']['en'] == 1){
          $princ_tit = $Titolo_eng;
          $princ_desc = $Descrizione_eng;
        }
      }

      $jstatus = 1;

      $jmess .= "<thead>";
      $jmess .= "<tr>";
        $jmess .= "<th></th><th>ID</th><th>Evidenza</th><th>Titolo</th><th>Descrizione</th><th>Immagini</th><th>Pubblica</th><th>Ordine</th><th></th>";
      $jmess .= "</tr>";
      $jmess .= "</thead>";

      while($stmt2->fetch()){ 

        $jmess .= "<tr>";
          $jmess .= "<td><input type=\"checkbox\" class=\"checkbox\" name=\"selItem[]\" value=\"".$ID_cat."\" ></td>";
          $jmess .= "<td class=\"catCol id\">".$ID_cat."</td>";
          $jmess .= "<td class=\"catCol star\">"; if($Evidenza == 1) { $jmess .= "<i class=\"fa fa-star text-yellow\"></i> "; }
          $jmess .= "</td>";
          $jmess .= "<td class=\"catCol name\"><a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat."\" title=\"Modifica\" >".$Titolo."</a></td>";
          $jmess .= "<td class=\"catCol txt\">".$Descrizione."</td>";
          $jmess .= "<td class=\"catCol image\"><i class=\"fa fa-file-image-o\" aria-hidden=\"true\"></i></td>";
          $jmess .= "<td class=\"catCol pubb\"><i class=\"fa fa-circle "; if($Pubblica == 1): $jmess .= "green-icon"; else: $jmess .= "red-icon"; endif;
          $jmess .= "\" aria-hidden=\"true\"></i> </td>";
          $jmess .= "<td class=\"catCol ordine\">".$Ordine."</td>";
          $jmess .= "<td class=\"catCol update\"><a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat."\" class=\"btn btn-default btn-sm\" id=\"updateBt\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>";
        $jmess .= "</tr>";

      }

    } else {
      $jstatus = 1;
      $jmess = "<tr><td colspan\"9\">Nessun risultato trovato</td></tr>";
    }
  break; // break categorie
}

mysqli_stmt_close($stmt2);  
$conn2->close();

echo json_encode(array(
	'status' => $jstatus,
	'msg' => $jmess,
  'pag' => $jpagin
));

?>