<?
include "include/config.php";
include "include/common.php"; 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Documento senza titolo</title>
</head>

<body>

<?

$str_tipo_c = "ALTER TABLE `occasioni` ADD `Sconto` INT( 20 ) NOT NULL AFTER `Prezzo` ;";

$query_tipo_c = mysql_query($str_tipo_c, $conn) or die(mysql_error()); 


?>


</body>
</html>
