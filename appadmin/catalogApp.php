<?php 
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

if(isset($_POST['lang']) && isset($_POST['type'])) {

      $lang = $_POST['lang']; // lingua
      $type = $_POST['type']; // tipo di dato da restituire listcat, listitems, item

      include "./data/connection.php";

      $conn = db_connect();
      $stmtlistcat = $conn->stmt_init();
      $stmttitolocat = $conn->stmt_init();

      switch($type){
            case "listcat":
                  $stmtlistcat->prepare("SELECT I.ID_item, I.Titolo, I.Sottotitolo, I.Descrizione, I.Immagine, C.ID
                        FROM tbl_category C, tbl_items I
                        WHERE C.ID = I.ID_cat AND C.ID_padre = 1 AND C.Type LIKE 'CAT' AND I.Attiva = 1 AND I.Pubblica = 1 AND I.Lingua LIKE ? ORDER BY I.Ordine ASC ");

                  $stmtlistcat->bind_param("s", $lang);
                  $stmtlistcat->execute();
                  $stmtlistcat->store_result();
                  $stmtlistcat->bind_result($id, $titolo, $sottotitolo, $descrizione, $immagine, $id_cat);
                  $total_results = $stmtlistcat->num_rows; // numero risultati
                  
                  if($total_results > 0) {

                        $return_arr = array();

                        while($stmtlistcat->fetch()){
                              $row_array['id'] = $id;
                              $row_array['titolo'] = $titolo;
                              $row_array['sottotitolo'] = $sottotitolo;
                              $row_array['descrizione'] = $descrizione;
                              $row_array['immagine'] = $immagine;
                              $row_array['id_cat'] = $id_cat;

                              array_push($return_arr,$row_array);
                        }

                        $data_resp = json_encode($return_arr);

                        $status = 1;
                        $mess = "Catalogo trovato... ";

                  } else {
                        $status = 0;
                        $mess = "Nessun dato trovato";
                        $titolo = "";
                  }
            break;
            case "listitems":

                  $idcat = $_POST['idcat']; // id categoria
                  $titcat = "";

                  // recupero il tiolo della categoria
                  $stmttitolocat->prepare("SELECT I.Titolo
                        FROM tbl_items I
                        WHERE I.ID_cat = ? AND I.Lingua LIKE ? ");

                  $stmttitolocat->bind_param("is", $idcat, $lang);
                  $stmttitolocat->execute();
                  $stmttitolocat->store_result();
                  $stmttitolocat->bind_result($titolo_cat);
                  
                  $stmttitolocat->fetch();

                  $stmttitolocat->free_result();
                  $stmttitolocat->close();

                  // recupero la lista degli items di quella categoria
                  $stmtlistcat->prepare("SELECT I.ID_item, I.Titolo, I.Sottotitolo, I.Descrizione, I.Immagine, I.Attributi
                        FROM tbl_category C, tbl_items I
                        WHERE C.ID = I.ID_cat AND C.ID_padre = ? AND C.Type LIKE 'ITEM' AND I.Attiva = 1 AND I.Pubblica = 1 AND I.Lingua LIKE ? ORDER BY I.Ordine ASC ");

                  $stmtlistcat->bind_param("is", $idcat, $lang);
                  $stmtlistcat->execute();
                  $stmtlistcat->store_result();
                  $stmtlistcat->bind_result($id, $titolo, $sottotitolo,  $descrizione, $immagine, $attributi);
                  $total_results = $stmtlistcat->num_rows; // numero risultati
                  
                  if($total_results > 0) {

                        $return_arr = array();
                        $arrayAttributi = array();

                        $arrayAttributi = unserialize($attributi);

                        while($stmtlistcat->fetch()){
                              $row_array['id'] = $id;
                              $row_array['titolo'] = $titolo;
                              $row_array['sottotitolo'] = $sottotitolo;
                              $row_array['descrizione'] = $descrizione;
                              $row_array['immagine'] = $immagine;
                              $row_array['attributi'] = $arrayAttributi['tonn'];
                              $row_array['id_cat'] = $idcat;
                              $row_array['titolo_cat'] = $titolo_cat;

                              array_push($return_arr,$row_array);
                        }

                        $data_resp = json_encode($return_arr);

                        $status = 1;
                        $mess = "Catalogo trovato... ";

                  } else {
                        $status = 0;
                        $mess = "Nessun dato trovato";
                        $titolo = "";
                  }
            break;
            case "item":

                  $item = $_POST['item']; // id item
                  $idcat = $_POST['idcat']; // id categoria
                  $titcat = "";

                  // recupero il tiolo della categoria
                  $stmttitolocat->prepare("SELECT I.Titolo
                        FROM tbl_items I
                        WHERE I.ID_cat = ? AND I.Lingua LIKE ? ");

                  $stmttitolocat->bind_param("is", $idcat, $lang);
                  $stmttitolocat->execute();
                  $stmttitolocat->store_result();
                  $stmttitolocat->bind_result($titolo_cat);
                  
                  $stmttitolocat->fetch();

                  $stmttitolocat->free_result();
                  $stmttitolocat->close();


                  $stmtlistcat->prepare("SELECT I.ID_item, I.Titolo, I.Sottotitolo, I.Descrizione, I.Immagine, I.Attributi, I.ID_cat
                        FROM tbl_category C, tbl_items I
                        WHERE C.ID = I.ID_cat AND I.ID_item = ? AND I.Attiva = 1 AND I.Pubblica = 1 AND I.Lingua LIKE ? ");

                  $stmtlistcat->bind_param("is", $item, $lang);
                  $stmtlistcat->execute();
                  $stmtlistcat->store_result();
                  $stmtlistcat->bind_result($ID_item, $Titolo, $sottotitolo, $Descrizione, $Immagine, $Attributi, $ID_cat);
                  $total_results = $stmtlistcat->num_rows; // numero risultati

                  $stmtlistcat->fetch();
                  
                  if($total_results > 0) {

                        $return_arr = array();
                        $arrayAttributi = array();

                        $arrayAttributi = unserialize($Attributi);

                        $row_array['id'] = $ID_item;
                        $row_array['titolo'] = $Titolo;
                        $row_array['sottotitolo'] = $Sottotitolo;
                        $row_array['descrizione'] = $Descrizione;
                        $row_array['immagine'] = "https://app.katoimer.com/appadmin/upload/".$Immagine;
                        $row_array['attributi'] = $attributi." | ".$arrayAttributi['tonn'];
                        $row_array['id_cat'] = $ID_cat;
                        $row_array['titolo_cat'] = $titolo_cat;

                        array_push($return_arr,$row_array);
                        
                        $data_resp = json_encode($return_arr);

                        $status = 1;
                        $mess = "Catalogo trovato... ";

                  } else {
                        $status = 0;
                        $mess = "Nessun dato trovato";
                        $titolo = "";
                  }
            break;
      }

      $stmtlistcat->free_result();

      $stmtlistcat->close();
      $conn->close();
} else {
      $status = 0;
      $mess = "Parametri non ricevuti.";
      $titolo = "";
}

echo json_encode(array(
      'status' => $status,
      'mess' => $mess,
      'data'=> $data_resp
));

?>