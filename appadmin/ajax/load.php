<?php
session_cache_expire(30);
session_start();

if(isset($_POST['action_load']) && ($_POST['action_load'] != "" ) {
	$action_load=$_POST['action_load'];
}

$status = 1;
$err_mess = "";

$configup = parse_ini_file('../data/config.ini'); 
$connup = mysqli_connect('localhost',$configup['username'],$configup['password'],$configup['dbname']);

if($action_load == "load-cat") {
	$stmtup = $connup->stmt_init();

	$stmtup->prepare("UPDATE tbl_global_user SET Nome=?, Cognome=?, Email=?, Telefono=?, Note=? WHERE UserID=?");

	if ($stmtup === false) {
	  $status = 0;
	  $err_mess = $this->mysqli->error;
	  //trigger_error($this->mysqli->error, E_USER_ERROR);
	}

	$stmtup->bind_param('sssisi', $uname, $usurname, $uemail, $uphone, $note, $uid);

	$err_status = $stmtup->execute();
	if ($err_status === false) {
	  $status = 0;
	  $err_mess = $stmtup->error;
	  //trigger_error($stmtup->error, E_USER_ERROR);
	}

	mysqli_stmt_close($stmtup);  
	$connup->close();

	echo json_encode(array(
		'status' => $status,
	  'mess' => $err_mess
	));
}

?>