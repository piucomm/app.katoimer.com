<?php
session_cache_expire(30);
session_start();

$uname=$_POST['nameUser'];
$usurname=$_POST['surnameUser'];
$uemail=$_POST['emailUser'];
$uphone=$_POST['phoneUser'];

$status = 1;

echo json_encode(array(
	'status' => $status
));

?>