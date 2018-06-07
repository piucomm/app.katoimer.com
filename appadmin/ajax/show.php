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
$recursive_view = $rec_data->RecursiveView;  // vista ricorsiva?

$order_by = $rec_data->OrderBy;  // ordinamento
$custom_where = $rec_data->CustomWhere; // filtri custom per where sql

$jstatus = 0;
$jmess = "";
$jpagin = "";


$config2 = parse_ini_file('../data/config.ini'); 
$conn2 = mysqli_connect('localhost',$config2['username'],$config2['password'],$config2['dbname']);

$stmt2 = $conn2->stmt_init();
//$stmt_subcat = $conn2->stmt_init();

$numero_lingue = count($_SESSION['lingua']);

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

    for($ilin = 0; $ilin < $numero_lingue; $ilin++){
      $jpagin .= "<option value=\"".$_SESSION['lingua'][$ilin]."\" "; if(strcmp($lingua,$_SESSION['lingua'][$ilin]) == 0) $jpagin .=  "selected"; $jpagin .= " >".$_SESSION['lingua'][$ilin]."</option>";
    }
    
    $jpagin .= "</select>"; $jpagin .= "<img src=\"./img/".$lingua.".jpg\" class=\"lingua\" />";
    $jpagin .= "</div> ";

    $jpagin .= " - Tot. risultati: ".$total_results." - Risultati per pag.: "; //.$per_page;
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
        $stmt2->prepare("SELECT I.ID_item, I.ID_cat, I.Titolo, I.Sottotitolo, I.Descrizione, I.Immagine,I.Pubblica, I.Ordine, I.Evidenza, C.ID_padre, C.Type, L.Immagine
                          FROM tbl_category C, tbl_items I, tbl_layout L
                          WHERE C.ID = I.ID_cat AND C.Layout = L.ID AND C.Type = ? AND I.Attiva = ? AND C.ID_padre = ? AND I.Lingua = ? ORDER BY I.Ordine ASC LIMIT ?,? ");
        $stmt2->bind_param("siisii",$typeToS, $attiva, $id_padre, $lingua, $start_query, $per_page);
      } else {
        $stmt2->prepare("SELECT I.ID_item, I.ID_cat, I.Titolo, I.Sottotitolo, I.Descrizione, I.Immagine,I.Pubblica, I.Ordine, I.Evidenza, C.ID_padre, C.Type, L.Immagine
                          FROM tbl_category C, tbl_items I, tbl_layout L
                          WHERE C.ID = I.ID_cat AND C.Layout = L.ID AND C.Type = ? AND I.Attiva = ? AND C.ID_padre = ? AND I.Lingua = ? AND I.Titolo LIKE CONCAT('%', ?, '%')  ORDER BY I.Ordine ASC LIMIT ?,? ");
        $stmt2->bind_param("siissii",$typeToS, $attiva, $id_padre, $lingua, $searchString, $start_query, $per_page); 
      }

      $stmt2->execute();
      $stmt2->store_result();
      $stmt2->bind_result($ID_item, $ID_cat, $Titolo, $Sottotitolo, $Descrizione,$Img,$Pubblica, $Ordine, $Evidenza, $ID_padre_nested, $Tipo, $Img_layout); 
      $total_counter = $stmt2->num_rows; // numero risultati

      $jstatus = 1;

      $jmess .= "<thead>";
      $jmess .= "<tr><th></th>";
        // $jmess .= "<th>ID</th><th>Evidenza</th>";
        $jmess .= "<th>Titolo</th><th>Descrizione</th><th>Immagini</th><th>Pubblica</th><th>Ordine</th><th>Modifica</th>";
          if($numero_lingue > 1) { $jmess .= "<th>Traduzioni</th>"; }
      $jmess .= "</tr>";
      $jmess .= "</thead>";

      while($stmt2->fetch()){ 

        $jmess .= "<tr>";
          $jmess .= "<td class=\"catCol\" ><input type=\"checkbox\" class=\"checkbox\" name=\"selItem[]\" value=\"".$ID_item."-".$Tipo."\" ></td>";
          /* $jmess .= "<td class=\"catCol id\">".$ID_item."</td>";
          $jmess .= "<td class=\"catCol star\">"; if($Evidenza == 1) { $jmess .= "<i class=\"fa fa-star text-yellow\"></i> "; }
          $jmess .= "</td>"; */
          $jmess .= "<td class=\"catCol name\">";
            $jmess .= "<a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat."&lingua=".$lingua."&id_item=".$ID_item."\" title=\"Modifica in lingua ".$lingua."\" >".$Titolo;
            if($Sottotitolo != ""): $jmess .= "<small>".$Sottotitolo."</small>"; endif;
              $jmess .= "</a></td>";
          $jmess .= "<td class=\"catCol txt\">".substr(strip_tags($Descrizione), 0, 100);
          if(strlen($Descrizione)>100): $jmess .= "..."; endif;
          $jmess .= "</td>";
          $jmess .= "<td class=\"catCol image\">";
            if(strcmp($Img,"") != ""):
            $jmess .= "<img src=\"./upload/".$Img."\" style=\"width:80px;\"/>";
            endif;
          $jmess .= "</td>";
          $jmess .= "<td class=\"catCol pubb\"><i class=\"fa fa-circle "; if($Pubblica == 1): $jmess .= "green-icon"; else: $jmess .= "red-icon"; endif;
          $jmess .= "\" aria-hidden=\"true\"></i> </td>";
          $jmess .= "<td class=\"catCol ordine\">".$Ordine."</td>";
          $jmess .= "<td class=\"catCol update\"><a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat."&lingua=".$lingua."&id_item=".$ID_item."\" class=\"btn btn-default btn-sm\" id=\"updateBt\" title=\"Modifica in lingua ".$lingua."\" ><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>";
          
          if($numero_lingue > 1) {
            $jmess .= "<td class=\"catCol lingua\">";
            
            // verifico se è presente la traduzione nelle altre lingue
            $temp_lingua = $_SESSION['lingua']; // rimuovo la lingua attuale dalla variabile di sessione LINGUA
            if(($key = array_search($lingua, $temp_lingua)) !== false) {
              array_splice($temp_lingua, $key, 1);
            }

            for($iLin = 0; $iLin < count($temp_lingua); $iLin++) {
              $linguaNew = $temp_lingua[$iLin];

              $jmess .= manageTranslation($ID_cat, $linguaNew, $ID_item, $Titolo,$Img, $conn2);

            } // for        
           
            $jmess .= "</td>";
          }

        $jmess .= "</tr>";


        /* ************** */
        /* SOTTOCATEGORIE RICORSIVE */
        /* ************** */ 
        if(($ID_cat != 1) && ($recursive_view == 1)) {
          $jmess .= subContent($typeToS, $attiva, $ID_cat, $lingua, $conn2, 0); 
        }
        
      } // while
   
      $stmt2->free_result();

    } else {
      $jstatus = 1;
      $jmess = "<tr><td colspan\"10\">Nessun risultato trovato</td></tr>";
    }
  break; // break categorie
  case "USERS":  // visualizzo gli iscritti

    /* count risultati */
    if(strcmp($searchString, "") == 0){ 
      $stmt2->prepare("SELECT I.Nome 
                  FROM iscritti I");
      $stmt2->bind_param();
    } else {
      $stmt2->prepare("SELECT I.Nome 
                  FROM iscritti I
                  WHERE I.Nome LIKE CONCAT('%', ?, '%') "); // 
      $stmt2->bind_param("s",$searchString );
    }

    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($Nome); 
    $total_results = $stmt2->num_rows; // numero risultati

    $stmt2->free_result();

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

    $customwhere = empty($custom_where) ? ' 1=1' : $custom_where;

    $jpagin .= "<div class=\"btn-group\">";
      $jpagin .= "<button onclick=\"showData(".$page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."')\" class=\"btn btn-default btn-sm\" title=\"Filtro Tutti\" > Tutti</button>";
      $jpagin .= "<button onclick=\"showData(".$page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."','I.Proprietario = 1')\" class=\"btn btn-default btn-sm\" title=\"Filtro Proprietario\" > Proprietari</button>";
      $jpagin .= "<button onclick=\"showData(".$page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."','I.Ospite = 1')\" class=\"btn btn-default btn-sm\" title=\"Filtro Ospite\" > Ospiti</button>";
    $jpagin .= "</div>";


    $jpagin .= "<span style=\"opacity: 0;\" >Lingua:</span> ";
    $jpagin .= "<div class=\"btn-group\"  style=\"opacity: 0;\" >";
    $jpagin .= "<select class=\"dropLingua\">";

    for($ilin = 0; $ilin < $numero_lingue; $ilin++){
      $jpagin .= "<option value=\"".$_SESSION['lingua'][$ilin]."\" "; if(strcmp($lingua,$_SESSION['lingua'][$ilin]) == 0) $jpagin .=  "selected"; $jpagin .= " >".$_SESSION['lingua'][$ilin]."</option>";
    }
    
    $jpagin .= "</select>"; $jpagin .= "<img src=\"./img/".$lingua.".jpg\" class=\"lingua\" />";
    $jpagin .= "</div> ";

    $jpagin .= " - Tot. risultati: ".$total_results." - Risultati per pag.: "; //.$per_page;
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

      $sortorder = empty($order_by) ? ' ORDER BY I.Nome DESC' : $order_by;

      if(strcmp($searchString, "") == 0){ 
        $stmt2->prepare("SELECT I.ID_iscritto, I.Nome, I.Email, I.Ospite, I.Proprietario, I.Stato
                          FROM iscritti I
                          WHERE 1=1 AND ".$customwhere."
                          ".$sortorder." LIMIT ?,? ");
        $stmt2->bind_param("ii",$start_query, $per_page);
      } else {
        $stmt2->prepare("SELECT I.ID_iscritto, I.Nome, I.Email, I.Ospite, I.Proprietario, I.Stato
                          FROM iscritti I
                          WHERE I.Nome LIKE CONCAT('%', ?, '%') AND ".$customwhere." ".$sortorder." LIMIT ?,? ");
        $stmt2->bind_param("sii",$searchString, $start_query, $per_page); 
      }

      $stmt2->execute();
      $stmt2->store_result();
      $stmt2->bind_result($ID_iscritto, $Nome, $Email, $Ospite, $Proprietario, $Stato); 
      $total_counter = $stmt2->num_rows; // numero risultati

      $jstatus = 1;

      $order_name_asc = " ORDER BY I.Nome ASC";
      $order_name_desc = " ORDER BY I.Nome DESC";
      $order_email_asc = " ORDER BY I.Email ASC";
      $order_email_desc = " ORDER BY I.Email DESC";

      $jmess .= "<thead>";
      $jmess .= "<tr><th></th>";
        // $jmess .= "<th>ID</th><th>Evidenza</th>";
        $jmess .= "<th>Email ";
          $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-down\"></i>";
          $jmess .= "</button>";
            $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_desc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-up\"></i>";
          $jmess .= "</a>";
        $jmess .= "</th>";
        $jmess .= "<th>Nome ";
          $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_name_asc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-down\"></i>";
          $jmess .= "</button>";
            $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_name_desc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-up\"></i>";
          $jmess .= "</a>";
        $jmess .= "</th>";
        $jmess .= "<th>Ospite/Proprietario</th>";
        $jmess .= "<th>Stato</th>";
      $jmess .= "</tr>";
      $jmess .= "</thead>";

      while($stmt2->fetch()){ 

        $jmess .= "<tr>";
          $jmess .= "<td class=\"catCol\" ><input type=\"checkbox\" class=\"checkbox\" name=\"selItem[]\" value=\"".$ID_iscritto."\" ></td>";
          $jmess .= "<td class=\"catCol name\"><a href=\"./user-profile.php?act=edit&lingua=".$lingua."&id_user=".$ID_iscritto."\" title=\"Modifica in lingua ".$lingua."\" >".$Email."</a></td>";
          $jmess .= "<td class=\"catCol name\">".$Nome."</td>";
          $jmess .= "<td class=\"catCol pubb\" >";
            if($Ospite == 1): $jmess .= "Ospite"; endif;
            if($Proprietario == 1): $jmess .= "Proprietario"; endif;
            $jmess .= "</td>";
          $jmess .= "<td class=\"catCol pubb\"><i class=\"fa fa-circle "; 
            if($Stato == 1): $jmess .= "green-icon"; else: $jmess .= "red-icon"; endif;
            $jmess .= "\" aria-hidden=\"true\"></i> </td>";
        $jmess .= "</tr>";
        

      } // while
   
      $stmt2->free_result();
    } else {
      $jstatus = 1;
      $jmess = "<tr><td colspan\"10\">Nessun risultato trovato</td></tr>";
    }
  break; // break users
  case "OFFICINE":  // visualizzo le officine/dealers

    /* count risultati */
    if(strcmp($searchString, "") == 0){ 
      $stmt2->prepare("SELECT O.Nome 
                  FROM officine O");
      $stmt2->bind_param();
    } else {
      $stmt2->prepare("SELECT O.Nome 
                  FROM officine O
                  WHERE O.Nome LIKE CONCAT('%', ?, '%') "); // 
      $stmt2->bind_param("s",$searchString );
    }

    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($Nome); 
    $total_results = $stmt2->num_rows; // numero risultati

    $stmt2->free_result();

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

    $customwhere = empty($custom_where) ? ' 1=1' : $custom_where;

    $jpagin .= "<div class=\"btn-group\">";
      $jpagin .= "<button onclick=\"showData(".$page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."')\" class=\"btn btn-default btn-sm\" title=\"Filtro Tutti\" id=\"btnFilterTutti\" > Tutti</button>";
      $jpagin .= "<button onclick=\"showData(".$page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."','O.Dealer = 1')\" class=\"btn btn-default btn-sm\" title=\"Filtro Dealer\" id=\"btnFilterDealer\" > Dealer</button>";
      $jpagin .= "<button onclick=\"showData(".$page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."','O.Officina = 1')\" class=\"btn btn-default btn-sm\" title=\"Filtro Officina\" id=\"btnFilterOfficina\"  > Officina</button>";
    $jpagin .= "</div>";


    $jpagin .= "<span style=\"opacity: 0;\" >Lingua:</span> ";
    $jpagin .= "<div class=\"btn-group\"  style=\"opacity: 0;\" >";
    $jpagin .= "<select class=\"dropLingua\">";

    for($ilin = 0; $ilin < $numero_lingue; $ilin++){
      $jpagin .= "<option value=\"".$_SESSION['lingua'][$ilin]."\" "; if(strcmp($lingua,$_SESSION['lingua'][$ilin]) == 0) $jpagin .=  "selected"; $jpagin .= " >".$_SESSION['lingua'][$ilin]."</option>";
    }
    
    $jpagin .= "</select>"; $jpagin .= "<img src=\"./img/".$lingua.".jpg\" class=\"lingua\" />";
    $jpagin .= "</div> ";

    $jpagin .= " Tot. risultati: ".$total_results." - Risultati per pag.: "; //.$per_page;
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

      $sortorder = empty($order_by) ? ' ORDER BY O.Nome DESC' : $order_by;

      if(strcmp($searchString, "") == 0){ 
        $stmt2->prepare("SELECT O.ID_item, O.Nome, O.Email, O.Citta, O.Nazione, O.Officina, O.Dealer, O.Stato
                          FROM officine O
                          WHERE 1=1 AND ".$customwhere."
                          ".$sortorder." LIMIT ?,? ");
        $stmt2->bind_param("ii",$start_query, $per_page);
      } else {
        $stmt2->prepare("SELECT O.ID_item, O.Nome, O.Email, O.Citta, O.Nazione,  O.Officina, O.Dealer, O.Stato
                          FROM officine O
                          WHERE O.Nome LIKE CONCAT('%', ?, '%') AND ".$customwhere." ".$sortorder." LIMIT ?,? ");
        $stmt2->bind_param("sii",$searchString, $start_query, $per_page); 
      }

      $stmt2->execute();
      $stmt2->store_result();
      $stmt2->bind_result($ID_item, $Nome, $Email, $Citta, $Nazione, $Officina, $Dealer, $Stato); 
      $total_counter = $stmt2->num_rows; // numero risultati

      $jstatus = 1;

      $order_name_asc = " ORDER BY O.Nome ASC";
      $order_name_desc = " ORDER BY O.Nome DESC";
      $order_email_asc = " ORDER BY O.Email ASC";
      $order_email_desc = " ORDER BY O.Email DESC";
      $order_citta_asc = " ORDER BY O.Citta ASC";
      $order_citta_desc = " ORDER BY O.Citta DESC";
      $order_nazione_asc = " ORDER BY O.Nazione ASC";
      $order_nazione_desc = " ORDER BY O.Nazione DESC";

      $jmess .= "<thead>";
      $jmess .= "<tr><th></th>";
        // $jmess .= "<th>ID</th><th>Evidenza</th>";
        $jmess .= "<th>Nome attività";
          $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_name_asc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-down\"></i>";
          $jmess .= "</button>";
            $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_name_desc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-up\"></i>";
          $jmess .= "</a>";
        $jmess .= "</th>";


        $jmess .= "<th>Citta ";
          $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_citta_asc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-down\"></i>";
          $jmess .= "</button>";
            $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_citta_desc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-up\"></i>";
          $jmess .= "</a>";
        $jmess .= "</th>";

        $jmess .= "<th>Nazione ";
          $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_nazione_asc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-down\"></i>";
          $jmess .= "</button>";
            $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_nazione_desc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-up\"></i>";
          $jmess .= "</a>";
        $jmess .= "</th>";

        $jmess .= "<th>Email ";
          $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_asc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-down\"></i>";
          $jmess .= "</button>";
            $jmess .= "<a href=\"#\" onclick=\"showData(".$prev_page.",".$per_page.",'".$typeToS."','".$lingua."',0,'','".$order_email_desc."');return false;\">";
            $jmess .= "<i class=\"fa fa-chevron-up\"></i>";
          $jmess .= "</a>";
        $jmess .= "</th>";       

        $jmess .= "<th>Dealer/Officina</th>";
        $jmess .= "<th>Stato</th>";
      $jmess .= "</tr>";
      $jmess .= "</thead>";

      while($stmt2->fetch()){ 

        $jmess .= "<tr>";
          $jmess .= "<td class=\"catCol\" ><input type=\"checkbox\" class=\"checkbox\" name=\"selItem[]\" value=\"".$ID_item."\" ></td>";
          $jmess .= "<td class=\"catCol name\">";
          $jmess .= "<a href=\"./officina-profile.php?act=edit&lingua=".$lingua."&id_item=".$ID_item."\" title=\"Modifica in lingua ".$lingua."\" >".$Nome."</a></td>";
          $jmess .= "<td class=\"catCol name\">".$Citta."</td>";
          $jmess .= "<td class=\"catCol name\">".$Nazione."</td>";
          $jmess .= "<td class=\"catCol name\">";
          $jmess .= "<a href=\"./officina-profile.php?act=edit&lingua=".$lingua."&id_item=".$ID_item."\" title=\"Modifica in lingua ".$lingua."\" >".$Email."</a></td>";
          $jmess .= "<td class=\"catCol pubb\" >";
            if($Dealer == 1): $jmess .= "Dealer"; endif;
            if($Officina == 1): $jmess .= "Officina"; endif;
            $jmess .= "</td>";
          $jmess .= "<td class=\"catCol pubb\"><i class=\"fa fa-circle "; 
            if($Stato == 1): $jmess .= "green-icon"; else: $jmess .= "red-icon"; endif;
            $jmess .= "\" aria-hidden=\"true\"></i> </td>";
        $jmess .= "</tr>";
        

      } // while
   
      $stmt2->free_result();
    } else {
      $jstatus = 1;
      $jmess = "<tr><td colspan\"10\">Nessun risultato trovato</td></tr>";
    }
  break; // break officine

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


// visualizzo il codice html della traduzione (bandierina se c'è già, + e bandierina se non c'è)
function manageTranslation($idc, $linguan, $ii, $tit, $img, $cc ) {   
  // id categoria condivisa, lingua nuova, id item lingua originale, connessione
  $msgManageTrans = "";
  $stmt3 = $cc->stmt_init();
  // count risultati item altre lingue con Stato attivo = 1
  $stmt3->prepare("SELECT I.ID_item
                    FROM tbl_items I
                    WHERE I.ID_cat = ? AND I.Attiva = 1 AND I.Lingua = ? ");
  $stmt3->bind_param("is", $idc, $linguan);
              
  $stmt3->execute();
  $stmt3->store_result(); 
  $stmt3->bind_result($ID_item_cat);
  $stmt3->fetch();
  $total_results_lingua = $stmt3->num_rows; // numero risultati traduzioni presenti
  
  $linguan = trim($linguan);

  if($total_results_lingua > 0) {
    $msgManageTrans .= "<a href=\"./categoria-page.php?act=edit&id_cat=".$idc."&lingua=".$linguan."&id_item=".$ID_item_cat."\" class=\"btn btn-default btn-sm\" title=\"Modifica traduzione in lingua ".$linguan."\" ><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i> <img src=\"./img/".$linguan.".jpg\" class=\"lingua\" style=\"width:15px; margin-bottom:6px;\" ></a><br/>";
  } else {
    $msgManageTrans .= "<a href=\"./categoria-page.php?act=add&trans_of_id=".$ii."&id_cat=".$idc."&lingua=".$linguan."&trans_of_item=".$tit."&trans_of_img=".$img."\" class=\"btn btn-default btn-sm yellow-bt\" id=\"updateBt\" title=\"Traduzione mancante in lingua ".$linguan."\" ><i class=\"fa fa-plus\" aria-hidden=\"true\"></i> <img src=\"./img/".$linguan.".jpg\" class=\"lingua\" style=\"width:15px;\" ></a>";
  }

  $stmt3->free_result();
  $stmt3->close(); 

  return $msgManageTrans;
}

/* funzione che restituisce TRUE se l'item è tradotto nella lingua passata */
function isTranslated($id_cat_item, $linguan, $cc) { 

  $isTrans = 1;
  $stmt3 = $cc->stmt_init();
  // count risultati item altre lingue con Stato attivo = 1
  $stmt3->prepare("SELECT I.ID_item
                    FROM tbl_items I
                    WHERE I.ID_cat = ? AND I.Attiva = 1 AND I.Lingua = ? ");
  $stmt3->bind_param("is", $id_cat_item, $linguan);
              
  $stmt3->execute();
  $stmt3->store_result(); 
  $stmt3->bind_result($IDC);
  $stmt3->fetch();
  $total_results_lingua = $stmt3->num_rows; // numero risultati

  if($total_results_lingua > 0){
    $isTrans = 0;
  }

  $stmt3->free_result();
  $stmt3->close(); 

  return $isTrans;

}

function subContent($typeToS_rec, $attiva_rec, $ID_cat_rec, $lin_rec, $cc, $deep) {

  global $numero_lingue;

  $stmt_subcat = $cc->stmt_init();

  $stmt_subcat->prepare("SELECT I.ID_item, I.ID_cat, I.Titolo, I.Sottotitolo, I.Descrizione, I.Immagine, I.Pubblica, I.Ordine, I.Evidenza, C.ID_padre, C.Type
                            FROM tbl_category C, tbl_items I
                            WHERE C.ID = I.ID_cat AND I.Attiva = ? AND C.ID_padre = ? AND I.Lingua = ? ORDER BY I.Ordine DESC ");
  $stmt_subcat->bind_param("iis",$attiva_rec, $ID_cat_rec, $lin_rec);

  $stmt_subcat->execute();
  $stmt_subcat->store_result();
  $stmt_subcat->bind_result($ID_item_sc, $ID_cat_sc, $Titolo_sc, $Sottotitolo_sc, $Descrizione_sc,$Img_sc,$Pubblica_sc, $Ordine_sc, $Evidenza_sc, $ID_padre_nested_rec, $Tipo); 
  $total_counter_subcat = $stmt_subcat->num_rows; // numero risultati


  if($total_counter_subcat > 0) {
        
    while($stmt_subcat->fetch()){ 

      $num_deep = $deep*15;
      $class_spacer_sc = " style=\"padding-left:".$num_deep."px;\" ";

      $spacer_sc = "<i class=\"fa fa-ellipsis-h\" ".$class_spacer_sc." aria-hidden=\"true\"></i> ";

      $jmes_sc .= "<tr class=\"subCat\" >";
      $jmes_sc .= "<td class=\"catCol\"><input type=\"checkbox\" class=\"checkbox\" name=\"selItem[]\" value=\"".$ID_item_sc."-".$Tipo."\" ></td>";
      $jmes_sc .= "<td class=\"catCol name\">";
      $jmes_sc .= $spacer_sc.$spacer_sc;
      $jmes_sc .= "<a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat_sc."&lingua=".$lin_rec."&id_item=".$ID_item_sc."\" title=\"Modifica in lingua ".$lin_rec."\" >".$Titolo_sc."</a> ";
            if($Sottotitolo_sc != "") : $jmes_sc .= " <small style=\"text-transform: uppercase;\" >".$Sottotitolo_sc."</small>"; endif;
        if($Evidenza_sc == 1) { $jmes_sc .= "<i class=\"fa fa-star text-yellow\"></i> "; }
      $jmes_sc .= "</td>";
      $jmes_sc .= "<td class=\"catCol txt\">".substr($Descrizione_sc, 0, 100);
      if(strlen($Descrizione_sc)>100): $jmes_sc .= "..."; endif;
      $jmes_sc .= "</td>";

      /* IMMAGINE */
      $jmes_sc .= "<td class=\"catCol image\">";
        if(strcmp($Img_sc,"") != 0 ): $jmes_sc .= "<img src=\"https://app.katoimer.com/appadmin/upload/".$Img_sc."\" style=\"width:80px;\" />"; endif;
      $jmes_sc .="</td>";
      
      /* END IMMAGINE */

      $jmes_sc .= "<td class=\"catCol pubb\"><i class=\"fa fa-circle "; if($Pubblica_sc == 1): $jmes_sc .= "green-icon"; else: $jmes_sc .= "red-icon"; endif;
      $jmes_sc .= "\" aria-hidden=\"true\"></i> </td>";
      $jmes_sc .= "<td class=\"catCol ordine\">".$Ordine_sc."</td>";
      $jmes_sc .= "<td class=\"catCol update\"><a href=\"./categoria-page.php?act=edit&id_cat=".$ID_cat_sc."&lingua=".$lin_rec."&id_item=".$ID_item_sc."\" class=\"btn btn-default btn-sm\" id=\"updateBt\" title=\"Modifica in lingua ".$lin_rec."\" ><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td>";

      if($numero_lingue > 1){
        $jmes_sc .= "<td class=\"catCol lingua\"> ";
     
        // verifico se è presente la traduzione nelle altre lingue
        $temp_lingua_sc = $_SESSION['lingua']; // rimuovo la lingua attuale dalla variabile di sessione LINGUA
        if(($key = array_search($lin_rec, $temp_lingua_sc)) !== false) {
          array_splice($temp_lingua_sc, $key, 1);
        } // if 

        for($iLin = 0; $iLin < count($temp_lingua_sc); $iLin++) {
          $linguaNew_sc = $temp_lingua_sc[$iLin];
          $isTrans = isTranslated($ID_padre_nested_rec, $linguaNew_sc, $cc); // verifico se il padre è tradotto o meno
          if($isTrans == 0 ){ // se il padre non è tradotto in questa lingua non faccio vedere la traduzione
             $jmes_sc .= manageTranslation($ID_cat_sc, $linguaNew_sc, $ID_item_sc, $Titolo_sc,$Img_sc, $cc);
          }
            
        } // for 
               
        $jmes_sc .= "</td>";
      }

      $jmes_sc .= "</tr>";

      $deep_new = $deep + 1;
      $jmes_sc .= subContent($typeToS_rec, $attiva_rec, $ID_cat_sc, $lin_rec, $cc, $deep_new); 

    } // while

  } // if counter risultati

  $stmt_subcat->free_result();
  $stmt_subcat->close();

  // $jmes_sc = "<tr><td>Tot ricorsivo. ".$total_counter_subcat."</td></tr>";

  return $jmes_sc;
        
}

?>