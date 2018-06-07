<?php
session_cache_expire(30);
session_start();

$uid=$_POST['uid'];
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

$stmtup->prepare("UPDATE tbl_global_user SET Nome=?, Cognome=?, Email=?, Telefono=?, Note=?, Immagine=? WHERE UserID=?");

if ($stmtup === false) {
  $status = 0;
  $err_mess = $this->mysqli->error;
  //trigger_error($this->mysqli->error, E_USER_ERROR);
}

$stmtup->bind_param('sssissi', $uname, $usurname, $uemail, $uphone, $note, $img, $uid);

$err_status = $stmtup->execute();
if ($err_status === false) {
  $status = 0;
  $err_mess = $stmtup->error;
  //trigger_error($stmtup->error, E_USER_ERROR);
}

$_SESSION['nome_utente'] = $uname." ".$usurname;
$_SESSION['user_thumb'] = $img;

mysqli_stmt_close($stmtup);  
$connup->close();

echo json_encode(array(
	'status' => $status,
	'mess' => $err_mess
));

?>