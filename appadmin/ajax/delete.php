<?php
session_cache_expire(30);
session_start();

$rec_data = json_decode(stripslashes($_POST['data']));
$ItemsTR = $rec_data->ItemsTR; // items to remove

$typeToR = $rec_data->TypeTR;  // tipo di contenuto da eliminare
$status = 0;
$mess = "";

$configdel = parse_ini_file('../data/config.ini'); 
$conndel = mysqli_connect('localhost',$configdel['username'],$configdel['password'],$configdel['dbname']);

$stmtdel= $conndel->stmt_init();
$stmtID= $conndel->stmt_init();
$stmt2= $conndel->stmt_init();

switch($typeToR) {
	case "CAT":  // elimino categorie

		$status = 1;
		$mess = "Eliminazione effettuata con successo!";

		foreach($ItemsTR as $indexDel){

			$stmtdel->prepare("UPDATE tbl_items SET Attiva=0 WHERE ID_item=?");

			if ($stmtdel === false) {
				$status = 0;
				$mess = $this->mysqli->error;
			}

			$stmtdel->bind_param('i', $indexDel);

			$err_status = $stmtdel->execute();
			if ($err_status === false) {
				$status = 0;
				$mess = $stmtdel->error;
			}

			$stmtdel->free_result();		

			/* rimuovo anche tutti i figli comprese le traduzioni */

			/* recupero l'ID della categoria dell'item selezionato  */
			$stmtID->prepare("SELECT C.ID
		                    FROM tbl_category C, tbl_items I
		                    WHERE C.ID = I.ID_cat AND I.ID_item = ? ");
		    $stmtID->bind_param("i",$indexDel);
			$stmtID->execute();
			$stmtID->store_result();
			$stmtID->bind_result($ID); 

			$stmtID->fetch();
			$stmtID->free_result();

			/* elimino le traduzioni */
			$stmtdel->prepare("UPDATE tbl_items SET Attiva=0 WHERE ID_cat=?");

			if ($stmtdel === false) {
				$status = 0;
				$mess = $this->mysqli->error;
			}

			$stmtdel->bind_param('i', $ID);

			$err_status = $stmtdel->execute();
			if ($err_status === false) {
				$status = 0;
				$mess = $stmtdel->error;
			}

			$stmtdel->free_result();			

			/* cerco tutti gli item che hanno ID_padre = ID ricorsivamente */
		    $stmt2->prepare("SELECT C.ID
		                    FROM tbl_category C, tbl_items I
		                    WHERE C.ID = I.ID_cat AND C.ID_padre = ? ");
		    $stmt2->bind_param("i", $ID);
			$stmt2->execute();
			$stmt2->store_result();
			$stmt2->bind_result($ID_ric); 

			while($stmt2->fetch()){

				/** MANCA LA RICORSIONE **/
				/** MANCA LA RICORSIONE **/
				/** MANCA LA RICORSIONE **/
				/** MANCA LA RICORSIONE **/

				/* metto il flag attiva a 0 ai figli e le loro traduzioni*/
				$stmtdel->prepare("UPDATE tbl_items SET Attiva=0 WHERE ID_cat=?");

				if ($stmtdel === false) {
					$status = 0;
					$mess = $this->mysqli->error;
				}

				$stmtdel->bind_param('i', $ID_ric);

				$err_status = $stmtdel->execute();
				if ($err_status === false) {
					$status = 0;
					$mess = $stmtdel->error;
				}

				$stmtdel->free_result();
			}

			$stmt2->free_result();

		}

		
	break;
	case "ITEM":  // elimino articoli

		$status = 1;
		$mess = "Eliminazione effettuata con successo!";

		foreach($ItemsTR as $indexDel){

			$stmtdel->prepare("UPDATE tbl_items SET Attiva=0 WHERE ID_item=?");

			if ($stmtdel === false) {
				$status = 0;
				$mess = $this->mysqli->error;
			}

			$stmtdel->bind_param('i', $indexDel);

			$err_status = $stmtdel->execute();
			if ($err_status === false) {
				$status = 0;
				$mess = $stmtdel->error;
			}

			$stmtdel->free_result();
		}
	break;
	case "USERS":  // elimino utenti iscritti
		$status = 1;
		$mess = "Eliminazione effettuata con successo!";

		foreach($ItemsTR as $indexDel):

			$stmtdel->prepare("DELETE FROM iscritti WHERE ID_iscritto=?");

			if ($stmtdel === false) {
				$status = 0;
				$mess = $this->mysqli->error;
			}

			$stmtdel->bind_param('i', $indexDel);

			$err_status = $stmtdel->execute();
			if ($err_status === false) {
				$status = 0;
				$mess = $stmtdel->error;
			}

			$stmtdel->free_result();
		endforeach;

	break;
	case "OFFICINE":  // elimino officine/dealer
		$status = 1;
		$mess = "Eliminazione effettuata con successo!";

		foreach($ItemsTR as $indexDel):

			$stmtdel->prepare("DELETE FROM officine WHERE ID_item=?");

			if ($stmtdel === false) {
				$status = 0;
				$mess = $this->mysqli->error;
			}

			$stmtdel->bind_param('i', $indexDel);

			$err_status = $stmtdel->execute();
			if ($err_status === false) {
				$status = 0;
				$mess = $stmtdel->error;
			}

			$stmtdel->free_result();
		endforeach;

	break;

}

mysqli_stmt_close($stmtdel);  
$conndel->close();

/* funzione che rimuove i figli e le traduzioni ricorsivamente */
function removeChild($id_padre, $cc) { 

  $isTrans = 1;
  $stmt3 = $cc->stmt_init();


  $stmt3->free_result();
  $stmt3->close(); 

  return $isTrans;

}

echo json_encode(array(
	'status' => $status,
	'msg' => $mess
));


?>