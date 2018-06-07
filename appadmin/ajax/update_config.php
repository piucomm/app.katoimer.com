<?php
session_cache_expire(30);
session_start();

$footer=$_POST['editor_footer'];
$claim=$_POST['editor_claim'];
$lingua_pred = $_POST['linguaPred'];

$status = 1;
$err_mess = "Update dati globali effettuato con successo!";

$configup = parse_ini_file('../data/config.ini'); 
$connup = mysqli_connect('localhost',$configup['username'],$configup['password'],$configup['dbname']);

$stmtup = $connup->stmt_init();

$stmtup->prepare("UPDATE tbl_config SET Footer_txt=?, Claim_txt=?, Lingua_predefinita=? WHERE ID=1");

if ($stmtup === false) {
  $status = 0;
  $err_mess = $this->mysqli->error;
  //trigger_error($this->mysqli->error, E_USER_ERROR);
}

$stmtup->bind_param('sss', $footer, $claim, $lingua_pred);

$err_status = $stmtup->execute();
if ($err_status === false) {
  $status = 0;
  $err_mess = $stmtup->error;
}

mysqli_stmt_close($stmtup);  
$connup->close();

echo json_encode(array(
	'status' => $status,
	'mess' => $err_mess
));

?>