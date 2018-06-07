<?php
session_cache_expire(30);
session_start();

$rec_data = json_decode(stripslashes($_POST['data']));

$typeToR = $rec_data->TypeTR;  // tipo di contenuto da eliminare
$status = 0;
$mess = "";

$configadd = parse_ini_file('../data/config.ini'); 
$connadd = mysqli_connect('localhost',$configadd['username'],$configadd['password'],$configadd['dbname']);

$stmtadd = $connadd->stmt_init();

switch($typeToR) {
	case "categorie":  // elimino categorie
		foreach($rec_data->ItemsTR as $indexDel){

			$stmtadd->prepare("UPDATE categorie SET Attiva=0 WHERE ID_cat=?");

			if ($stmtadd === false) {
				$status = 0;
				$mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('i', $indexDel);

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
				$status = 0;
				$mess = $stmtadd->error;
			}
		}
		$status = 1;
		$mess = "Eliminazione riuscita...".$typeToR;
	break;
	case "articoli":  // elimino articoli
		foreach($rec_data->ItemsTR as $indexDel){

			$stmtadd->prepare("UPDATE categorie SET Attiva=0 WHERE ID_cat=?");

			if ($stmtadd === false) {
				$status = 0;
				$mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('i', $indexDel);

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
				$status = 0;
				$mess = $stmtadd->error;
			}
		}
		$status = 1;
		$mess = "Eliminazione riuscita...".$typeToR;
	break;

}

mysqli_stmt_close($stmtadd);  
$connadd->close();

echo json_encode(array(
	'status' => $status,
	'msg' => $mess
));


?>