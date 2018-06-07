<?php
session_cache_expire(30);
session_start();
define('INCLUDE_CHECK',1);

$jstatus = 0;
$jmess = "Autenticazione non riuscita!";

$_SESSION['username'] = "";

$userAuth = trim($_POST['user']);
$pwAuth = trim($_POST['passw']);

$config2 = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/appadmin/data/config.ini'); 
$conn2 = mysqli_connect('localhost',$config2['username'],$config2['password'],$config2['dbname']);

$stmt2 = $conn2->stmt_init();

$stmt2->prepare("SELECT DISTINCT tGU.Username, tGU.Nome, tGU.Cognome, tGU.Immagine, tGU.UserID, tGR.RoleID, tGR.Role_Name
          FROM tbl_global_user tGU, tbl_global_role tGR
          WHERE tGU.Username = ? AND tGU.Password = MD5(?) AND tGU.RoleID = tGR.RoleID LIMIT 0,1 "); // 
$stmt2->bind_param("ss", $userAuth, $pwAuth);
$stmt2->execute();
$stmt2->store_result(); 
$stmt2->bind_result($Username, $Nome, $Cognome,  $Immagine, $UserID, $RoleID, $Role_Name); 
        
while($stmt2->fetch()){ 

  $_SESSION['username'] = $Username; // nome utente
  $_SESSION['user_ID'] = $UserID; // id utente
  $_SESSION['nome_utente'] = $Nome." ".$Cognome;
  $_SESSION['role_ID'] = $RoleID; // id ruolo
  $_SESSION['role_name'] = $Role_Name; // label ruolo
  if(strcmp($Immagine, "") != 0) { $_SESSION['user_thumb'] = "./upload/thumb-".$Immagine; } else { $_SESSION['user_thumb'] = "./img/noimage-profile.png"; } // immagine thumb
   
  $_SESSION['url_site'] = "https://app.katoimer.com";
  $_SESSION['url_admin'] = "https://app.katoimer.com/appadmin/";

} // while

$stmt2->free_result();

$stmt2->prepare("SELECT tC.Lingua_predefinita, tC.Lingue
          FROM tbl_config tC ");
$stmt2->execute();
$stmt2->store_result(); 
$stmt2->bind_result($lingua_pred, $lingue); 
        
$stmt2->fetch();

$lin_array = explode(',', $lingue); // array('en_GB','it_IT');
$_SESSION['lingua'] = $lin_array;
$_SESSION['predef_lingua'] = trim($lingua_pred);


mysqli_stmt_close($stmt2);  
$conn2->close();

if(isset($_SESSION['username']) && ($_SESSION['username'] != "")) {
	$jstatus = 1;
	$jmess = "Autenticazione OK!";
}

$jstatus = 1;
$jmess = "Autenticazione OK!";
$userAuth = "Admin";


echo json_encode(array(
	'status' => $jstatus,
	'id' => $jmess,
	'name' => $userAuth
));

?>