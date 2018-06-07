<?php 
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

$dealer = 0; // officine, dealers, tutti
if(isset($_GET['dealers']) && ($_GET['dealers'] != "" )) {
  $dealer = $_GET['dealers'];
}

$officina = 0; // officine, dealers, tutti
if(isset($_GET['officine']) && ($_GET['officine'] != "" )) {
  $officina = $_GET['officine'];
}

include "./data/connection.php";

$conn = db_connect();
$stmt = $conn->stmt_init();

if($dealer == 1) {
      $stmt->prepare("SELECT DISTINCT O.ID_item, O.Nome, O.Email, O.Password, O.Dealer, O.Officina, O.Stato, O.AuthPrivacy, O.AuthMarketing, O.Latitudine, O.Longitudine, O.Indirizzo, O.Citta, O.CAP, O.Nazione, O.Telefono,O.Fax, O.Immagine, O.Note
            FROM officine O WHERE O.Stato = 1 AND O.Dealer = ? ");
      
      $stmt->bind_param("i", $dealer);
} else if($officina == 1) {
      $stmt->prepare("SELECT DISTINCT O.ID_item, O.Nome, O.Email, O.Password, O.Dealer, O.Officina, O.Stato, O.AuthPrivacy, O.AuthMarketing, O.Latitudine, O.Longitudine, O.Indirizzo, O.Citta, O.CAP, O.Nazione, O.Telefono,O.Fax, O.Immagine, O.Note
            FROM officine O WHERE O.Stato = 1 AND O.Officina = ? ");
      
      $stmt->bind_param("i", $officina);
} else {
      $stmt->prepare("SELECT DISTINCT O.ID_item, O.Nome, O.Email, O.Password, O.Dealer, O.Officina, O.Stato, O.AuthPrivacy, O.AuthMarketing, O.Latitudine, O.Longitudine, O.Indirizzo, O.Citta, O.CAP, O.Nazione, O.Telefono,O.Fax, O.Immagine, O.Note
            FROM officine O WHERE O.Stato = 1 ");
}

$stmt->execute();
$stmt->store_result();
$stmt->bind_result($ID_item, $Nome, $Email, $Password, $Dealer, $Officina, $Stato, $Privacy, $Marketing,$Latitudine, $Longitudine, $Indirizzo, $Citta, $CAP, $Nazione, $Telefono, $Fax, $Immagine, $Note); 
$total_res = $stmt->num_rows; // numero risultati
                  
if($total_res > 0) {

      $return_arr = array();

      while($stmt->fetch()){
            $row_array = array();
            $row_array['id'] = $ID_item;
            $row_array['nome'] = $Nome;
            $row_array['email'] = $Email;
            $row_array['indirizzo'] = $Indirizzo;
            $row_array['citta'] = $Citta;
            $row_array['nazione'] = $Nazione;
            $row_array['cap'] = $CAP;
            $row_array['telefono'] = $Telefono;
            $row_array['fax'] = $Fax;
            $row_array['dealer'] = $Dealer;
            $row_array['officina'] = $Officina;
            $row_array['lat'] = $Latitudine;
            $row_array['long'] = $Longitudine;
            array_push($return_arr,$row_array);
      }

      $data_resp = json_encode($return_arr);

      $status = 1;
      $mess = "Officine trovate... ".$total_res." count array ".count($return_arr);

} else {
      $status = 0;
      $mess = "Nessun dato Officine trovato";
      $titolo = "";
}


$stmt->free_result();

$stmt->close();
$conn->close();

echo json_encode(array(
      'status' => $status,
      'mess' => $mess,
      'data'=> $data_resp
));

?>