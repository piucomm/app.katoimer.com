<?php
session_cache_expire(30);
session_start();

$uid=$_POST['uid'];
$uusername=$_POST['usern'];
$upw= $_POST['newpw']; 
$uname=$_POST['nameUser'];
$usurname=$_POST['surnameUser'];
$uemail=$_POST['emailUser'];
$uphone=$_POST['phoneUser'];
$note=$_POST['editor1'];
$img=$_POST['imgProfile'];

$status = 1;
$err_mess = "";

$configup = parse_ini_file('../data/config.ini'); 
$connup = mysqli_connect('localhost',$configup['username'],$configup['password'],$configup['dbname']);

$stmtup = $connup->stmt_init();

if(strcmp($upw, "") != 0) {  // se non ho nuove password lascio quella vecchia
	$upw= md5($_POST['newpw']); 
	$stmtup->prepare("UPDATE tbl_global_user SET Nome=?, Cognome=?, Email=?, Username=?, Password=?, Telefono=?, Note=?, Immagine=? WHERE UserID=?");
	if ($stmtup === false) {  $status = 0; $err_mess = $this->mysqli->error; }
	$stmtup->bind_param('sssssissi', $uname, $usurname, $uemail, $uusername, $upw, $uphone, $note, $img, $uid);
} else { 
	$stmtup->prepare("UPDATE tbl_global_user SET Nome=?, Cognome=?, Email=?, Username=?, Telefono=?, Note=?, Immagine=? WHERE UserID=?");
	if ($stmtup === false) {  $status = 0; $err_mess = $this->mysqli->error; }
	$stmtup->bind_param('ssssissi', $uname, $usurname, $uemail, $uusername, $uphone, $note, $img, $uid);
} 

$err_status = $stmtup->execute();

if ($err_status === false) {
  $status = 0; $err_mess = $stmtup->error;
}

$_SESSION['nome_utente'] = $uname." ".$usurname;
$_SESSION['username'] = $uusername;
if(strcmp($img, "") != 0) { $_SESSION['user_thumb'] = "./upload/thumb-".$img; } else { $_SESSION['user_thumb'] = "./img/noimage-profile.png"; } // immagine thumb

mysqli_stmt_close($stmtup);  
$connup->close();

echo json_encode(array(
	'status' => $status,
	'mess' => $err_mess
));

?>