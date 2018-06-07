<?php
session_cache_expire(30);
session_start();

$uid=$_POST['uid'];

$upw= $_POST['newpw']; 

$oldpw = $_POST['oldpw']; 

$uname=$_POST['nameUser'];
$uemail=$_POST['emailUser'];

$phone=$_POST['phoneUser'];

$img=$_POST['imgProfile'];

$stato = $_POST['stato'];
$proprietario = $_POST['proprietario'];
$ospite = $_POST['ospite'];

$privacy=$_POST['privacyUser'];
$marketing=$_POST['marketingUser'];

$note=$_POST['editor1'];


$status = 1;
$err_mess = "";

$configup = parse_ini_file('../data/config.ini'); 
$connup = mysqli_connect('localhost',$configup['username'],$configup['password'],$configup['dbname']);

$stmtup = $connup->stmt_init();


if(strcmp($oldpw, "") != 0) {  // se ho la vecchia password verifico se sia corretta e la sostituisco
	$oldpw = md5($_POST['oldpw']); 

	// controllo che la vecchia password sia corretta
    $stmtup->prepare("SELECT I.Nome 
                  FROM iscritti I
                  WHERE I.ID_iscritto = ? AND I.Password = ?"); // 
    $stmtup->bind_param("is",$uid, $oldpw);

    $stmtup->execute();
    $stmtup->store_result();
    $total_results = $stmtup->num_rows; // numero risultati

    $stmtup->free_result();

    if($total_results == 0) {  // la paswword non coincide
    	$status = 0; $err_mess = "La password inserita non è corretta... riprovare!";
    } else {

    	if(strcmp($upw, "") != 0) {  // sostituisco la pw con quella nuova
			$upw= md5($_POST['newpw']); 
			$stmtup->prepare("UPDATE iscritti SET Password=? WHERE ID_iscritto=?");
			if ($stmtup === false) {  $status = 0; $err_mess = $this->mysqli->error; }
			$stmtup->bind_param('si',$upw,$uid);

			$err_status = $stmtup->execute();

			if ($err_status === false) {
				$status = 0; $err_mess = $stmtup->error;
			}
		}

    }

} 

// modifico i dati standard dell'utente

$stmtup->prepare("UPDATE iscritti SET Nome=?, Email=?, Ospite=?, Proprietario=?, Stato=?, AuthPrivacy=?, AuthMarketing=?, Telefono=?, Immagine=?, Note=? WHERE ID_iscritto=?");

if ($stmtup === false) {  $status = 0; $err_mess = $this->mysqli->error; }

$stmtup->bind_param('ssiiiiisssi',$uname,$uemail,$ospite,$proprietario,$stato,$privacy,$marketing,$phone,$img,$note,$uid);

$err_status = $stmtup->execute();

if ($err_status === false) {
	$status = 0; $err_mess = $stmtup->error;
}

mysqli_stmt_close($stmtup);  
$connup->close();

echo json_encode(array(
	'status' => $status,
	'msg' => $err_mess
));

?>