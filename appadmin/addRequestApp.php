<?php 
header("access-control-allow-origin: *");
header("access-control-allow-methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

if(isset($_POST['email']) && isset($_POST['oggetto']) && isset($_POST['testo']) ) {

	$EmailR = $_POST['email']; // email richiesta
	$OggettoR = $_POST['oggetto'];  // oggetto richiesta
	$TestoR = $_POST['testo'];  // testo richiesta

	// Email di servizio
	$to = 'o.guiggi@piucommunication.com <o.guiggi@piucommunication.com>';
	$subject = 'Acquisto servizio - www.sismacheck.com';
	$message = '<div style="background:#ccc; padding: 20px 0px; margin:0px auto; text-align:center; width:100%; display: inline-block;" ><div style=\'text-align:center; display: inline-block; border-top: 8px solid #fab14a; border-bottom: 4px solid #ffe720; padding: 20px; margin-top: 30px; color: #000000; font-size: 14px; width:500px; background-color: #fff;\' ><br><br><strong>Richiesta assistenza ricevuta dall\'APP Kato Imer effettuata da:</strong><br><br>'.
		'Email: '.$_EmailR.'<br/><br/>'.
		'Oggetto: '.$OggettoR.'<br/><br/>'.
		'<small style=\'color: #333;\'>'.
		'<a href="http://www.katoimer.com" >www.katoimer.com</a>'.
		'</small></div></div>';

	$headers = 'From: info@katoimer.com <info@katoimer.com>' . '\r\n' .
				'Reply-To: info@katoimer.com <info@katoimer.com>' . '\r\n' .
				'X-Mailer: PHP/';
	$headers .= 'MIME-Version: 1.0\r\n';
	$headers .= 'Content-Type: text/html; charset=ISO-8859-1\r\n';

	mail( $to, $subject, $message, $headers);

	$status = 1;
	$mess = "Richiesta inviata. Grazie ".$EmailR."!";

} else {
	$status = 0;
	$mess = "Campi obbligatori non ricevuti...";
}

echo json_encode(array(
	'status' => $status,
	'mess' => $mess
));

?>