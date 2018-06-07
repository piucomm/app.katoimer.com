<?php
session_cache_expire(30);
session_start();

$uid=$_POST['uid'];

$upw= $_POST['newpw']; 

$uname=$_POST['nameUser'];
$uemail=$_POST['emailUser'];

$img=$_POST['imgProfile'];

$stato = $_POST['stato'];
$proprietario = $_POST['proprietario'];
$ospite = $_POST['ospite'];

$note=$_POST['editor1'];


$status = 1;
$err_mess = "";

$configup = parse_ini_file('../data/config.ini'); 
$connup = mysqli_connect('localhost',$configup['username'],$configup['password'],$configup['dbname']);

$stmtup = $connup->stmt_init();

if(strcmp($upw, "") != 0) {  // se non ho nuove password lascio quella vecchia
	$upw= md5($_POST['newpw']); 
	$stmtup->prepare("UPDATE iscritti SET Nome=?, Email=?, Password=?, Immagine=?, Ospite=?, Proprietario=?, Stato=?  WHERE ID_iscritto=?");
	if ($stmtup === false) {  $status = 0; $err_mess = $this->mysqli->error; }
	$stmtup->bind_param('ssssiiii', $uname, $uemail, $upw, $img,$ospite,$proprietario,$stato, $uid);
} else { 
	$stmtup->prepare("UPDATE iscritti SET Nome=?, Email=?, Immagine=?, Ospite=?, Proprietario=?, Stato=? WHERE ID_iscritto=?");
	if ($stmtup === false) {  $status = 0; $err_mess = $this->mysqli->error; }
	$stmtup->bind_param('sssiiii', $uname, $uemail,  $img,$ospite,$proprietario,$stato, $uid);
} 

$err_status = $stmtup->execute();

if ($err_status === false) {
  $status = 0; $err_mess = $stmtup->error;
}

if(strcmp($img, "") != 0) { $_SESSION['user_thumb'] = "./upload/thumb-".$img; } else { $_SESSION['user_thumb'] = "./img/noimage-profile.png"; } // immagine thumb

mysqli_stmt_close($stmtup);  
$connup->close();

echo json_encode(array(
	'status' => $status,
	'mess' => $err_mess
));

?>