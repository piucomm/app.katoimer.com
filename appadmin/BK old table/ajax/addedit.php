<?php
session_cache_expire(30);
session_start();

$act="";
$status = 0;
$mess = "Nessuan azione selezionata";

if(isset($_POST['act']) && ($_POST['act'] != "" )) {

	$act=$_POST['act'];

	$configadd = parse_ini_file('../data/config.ini'); 
	$connadd = mysqli_connect('localhost',$configadd['username'],$configadd['password'],$configadd['dbname']);

	$stmtadd = $connadd->stmt_init();

	if((strcmp($act,"add-cat") == 0) || (strcmp($act,"edit-cat") == 0)) {

		$ID_padre = $_POST['itemPadre'];
		$pubblica = $_POST['pubb1'];
		$evidenza = $_POST['evid1'];
		$attiva = 1;
		$ordine = $_POST['ordine'];
		$tit1=$_POST['tit1'];
		$tit2=$_POST['tit2'];
		$tit3=$_POST['tit3'];
		$desc1=$_POST['editor1'];
		$desc2=$_POST['editor2'];

		if(strcmp($act,"add-cat") == 0) {
			
			$stmtadd->prepare("INSERT INTO categorie ( Titolo, Titolo_eng, Descrizione, Descrizione_eng, ID_padre, Pubblica, Attiva, Evidenza, Ordine) VALUE ( ? , ? , ? , ?, ?, ?, ?, ?, ? )");

			if ($stmtadd === false) {
			  $status = 0;
			  $mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('ssssiiiii', $tit1, $tit2, $desc1, $desc2,$ID_padre,$pubblica,$attiva,$evidenza,$ordine );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0;
			  $mess = $stmtadd->error;
			}

			$status = 1;
			$mess = "Inserimento categoria riuscito.";

		} else if(strcmp($act,"edit-cat") == 0) {

			$id_cat = $_POST['ID_cat'];

			$stmtadd->prepare("UPDATE categorie SET Titolo=?, Titolo_eng=?, Descrizione=?, Descrizione_eng=?, ID_padre=?, Pubblica=?, Attiva=?, Evidenza=?, Ordine=? WHERE ID_cat=?");

			if ($stmtadd === false) {
			  $status = 0;
			  $mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('ssssiiiiii', $tit1, $tit2, $desc1, $desc2,$ID_padre,$pubblica,$attiva,$evidenza,$ordine,$id_cat );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0;
			  $mess = $stmtadd->error;
			}

			$status = 1;
			$mess = "Modifica categoria riuscito.";

		}

	}

	mysqli_stmt_close($stmtadd);  
	$connadd->close();

}

echo json_encode(array(
	'status' => $status,
	'mess' => $mess
));


?>