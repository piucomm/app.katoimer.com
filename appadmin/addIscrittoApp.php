<?php 
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

if(isset($_POST['tokenK']) && ($_POST['tokenK']) == "sae45v4b64566(Ad3" ) {

	if(isset($_POST['email']) && isset($_POST['password'])) {

		$EmailI = $_POST['email']; // email iscritto
		$NomeI = $_POST['nome']; // nome iscritto
		$PhoneI = $_POST['phone']; // nome iscritto
		$PasswI = $_POST['password'];  // password iscritto
		$OspiteI = $_POST['ospite'];  // $rec_data->password; ospite
		$ProprietarioI = $_POST['proprietario'];  // $rec_data->password; ospite
		$StatoI = $_POST['stato'];

		$Privacy = $_POST['checkPriv'];
		$Marketing  = $_POST['checkMark'];
		$Push  = $_POST['checkPush'];

		$ModelliArray = $_POST['arrayModels']; // array dei modelli di macchine aggiunte dal proprietario

		include "./data/connection.php";

		$conn = db_connect();
		$stmtadd = $conn->stmt_init();

		$stmtadd->prepare("SELECT I.Email
		    FROM iscritti I 
		    WHERE I.Email LIKE ? ");
		$stmtadd->bind_param("s", $EmailI);
		$stmtadd->execute();
		$stmtadd->store_result();
		$stmtadd->bind_result($emailcheck);
	    $total_results = $stmtadd->num_rows; // numero risultati

	    $stmtadd->fetch();
	    $stmtadd->free_result();

	    if($total_results == 0) { // l'utente non è già presente

			$status = 1;
			$cod = "ok";
			$mess = $EmailI;

			$stmtadd->prepare("INSERT INTO iscritti (Nome, Email, Password, Ospite, Proprietario, Stato, AuthPrivacy, AuthMarketing, AuthPush, Telefono) VALUE ( ? , ? , MD5(?) , ? , ? , ? , ? , ? , ? , ? )");

			if ($stmtadd === false) {
				$status = 0;
				$cod = "err05";
				$mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('sssiiiiiis', $NomeI, $EmailI, $PasswI, $OspiteI, $ProprietarioI, $StatoI, $Privacy, $Marketing, $Push, $PhoneI);

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
				$status = 0;
				$cod = "err04";
				$mess = $stmtadd->error;
			}

			$ID_iscritto = $stmtadd->insert_id;

			$stmtadd->close();

			if($ID_iscritto != 0){ // se l'inserimento iscritto è OK
				// aggiungo i macchinari
				$stmtaddmacchina = $conn->stmt_init();

				for($i = 0; $i < count($ModelliArray); $i++ ){

					$Note = "";

					$stmtaddmacchina->prepare("INSERT INTO macchine (ID_iscritto, Modello, Seriale, Note ) VALUE ( ? , ? , ? , ? )");

					if ($stmtaddmacchina === false) {
						$status = 0;
						$cod = "err05";
						$mess = $this->mysqli->error;
					}

					$stmtaddmacchina->bind_param('isss', $ID_iscritto, $ModelliArray[$i][0], $ModelliArray[$i][1], $Note );

					$err_status = $stmtaddmacchina->execute();
					if ($err_status === false) {
						$status = 0;
						$cod = "err04";
						$mess = $stmtaddmacchina->error;
					}

					$stmtaddmacchina->free_result();

				}

				$stmtaddmacchina->close();
			}

			
			$conn->close();
		} else {
			$status = 0;
			$cod = "err02";
			$mess = "Email ".$EmailI." già presente... ";
		}

	} else {
		$status = 0;
		$cod = "err03";
		$mess = "Campi email e password non ricevuti...";
	}

} else {
	$status = 0;
	$cod = "err01";
	$mess = "Token non riconosciuto";
}

echo json_encode(array(
	'status' => $status,
	'cod' => $cod,
	'mess' => $mess
));

?>