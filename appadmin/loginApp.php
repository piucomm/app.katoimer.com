<?php 
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

if(isset($_POST['email']) && isset($_POST['password'])) {

	include "./data/connection.php";

	$conn = db_connect();

	$user = $_POST['email'];
	$passw = $_POST['password'];

	$stmt = $conn->stmt_init();

	$stmt->prepare("SELECT I.Email, I.Ospite, I.Proprietario
	          FROM iscritti I 
	          WHERE I.Email = ? AND I.Password = MD5(?)  ");
	$stmt->bind_param("ss", $user, $passw);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($nome, $ospite, $proprietario);
    $total_results = $stmt->num_rows; // numero risultati

    $stmt->fetch();

    if($total_results > 0) {
		$status = "success";
	} else {
		$status = "failed";
	}

	$stmt->close();
	$conn->close();

	echo json_encode(array(
		'status' => $status,
		'ospite' => $ospite,
		'proprietario' => $proprietario
	));

} else {
	// messaggio di errore

}
?>