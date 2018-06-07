<?php
session_cache_expire(30);
session_start();

$uid=$_POST['uid'];

$upw= md5($_POST['newpw']); 

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

$stmtadd = $connup->stmt_init();

$stmtadd->prepare("INSERT INTO iscritti ( Nome, Email, Password, Ospite, Proprietario, Stato, AuthPrivacy, AuthMarketing, Telefono, Immagine, Note) VALUE ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?)");

$stmtadd->bind_param('sssiiiiisss', $uname, $uemail, $upw, $ospite, $proprietario, $stato, $privacy, $marketing,$phone, $img, $note);

$status = 1;
$err_mess = "Inserimento iscritto riuscito.";

$err_status = $stmtadd->execute();
if ($err_status === false) {
	$status = 0;
	$err_mess = $stmtadd->error;
}

mysqli_stmt_close($stmtadd);  
$connup->close();

echo json_encode(array(
	'status' => $status,
	'msg' => $err_mess
));

?>