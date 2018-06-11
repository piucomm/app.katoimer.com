<?php
session_cache_expire(30);
session_start();

$uid=$_POST['uid'];


$uname=$_POST['nameUser'];
$uemail=$_POST['emailUser'];
$uweb=$_POST['webUser'];

$phone=$_POST['phoneUser'];
$fax=$_POST['faxUser'];

$img=$_POST['imgProfile'];

$stato = $_POST['stato'];
$dealer = $_POST['dealer'];
$officina = $_POST['officina'];

$latForm = $_POST['latForm'];
$longForm = $_POST['longForm'];

if(($_POST['newLat'] != 0) && ($_POST['newLong'] != 0)){
	$latForm = $_POST['newLat'];
	$longForm = $_POST['newLong'];
}

$indirizzoForm = $_POST['indirizzoForm'];
$cittaForm = $_POST['cittaForm'];
$capForm = $_POST['capForm'];
$nazioneForm = $_POST['nazioneForm'];

$privacy=$_POST['privacyUser'];
$marketing=$_POST['marketingUser'];

$note=$_POST['editor1'];

$status = 1;
$status_mess = "Elemento aggiunto con successo";

$configup = parse_ini_file('../data/config.ini'); 
$connup = mysqli_connect('localhost',$configup['username'],$configup['password'],$configup['dbname']);

$stmtadd = $connup->stmt_init();

$stmtadd->prepare("INSERT INTO officine ( Nome, Email, Sitoweb, Dealer, Officina, Stato, AuthPrivacy, AuthMarketing, Latitudine, Longitudine, Indirizzo, Citta, CAP, Nazione, Telefono, Fax, Immagine, Note) VALUE ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )");

$stmtadd->bind_param('sssiiiiiddssssssss', $uname, $uemail, $uweb, $dealer, $officina, $stato, $privacy, $marketing, $latForm, $longForm, $indirizzoForm, $cittaForm, $capForm, $nazioneForm, $phone, $fax, $img, $note);

$status = 1;
$status_mess = "Inserimento officina/dealers riuscito.";

$err_status = $stmtadd->execute();
if ($err_status === false) {
	$status = 0;
	$status_mess = $stmtadd->error;
}

mysqli_stmt_close($stmtadd);  
$connup->close();

echo json_encode(array(
	'status' => $status,
	'msg' => $status_mess
));

?>