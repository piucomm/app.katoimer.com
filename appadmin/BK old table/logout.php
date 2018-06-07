<?php
session_start();
unset($nome_utente);
session_unregister("nome_utente");
header('Location: index.php');
exit();
?>