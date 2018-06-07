<?php

function db_connect() {

    // Define connection as a static variable, to avoid connecting more than once 
    global $connection;

    // Try and connect to the database, if a connection has not been established yet
    if(!isset($connection)) {
         // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file('./data/config.ini'); 
        $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
    }

    // If connection was not successful, handle the error
    if($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
        return "ERRMysql:: ".mysqli_connect_error(); 
    }
    return $connection;
}

// gestione autenticazione legata alla session
function controllo_sessione(){
    if (!isset($_SESSION["username"]) || ($_SESSION["username"] == "")) 
        header("Location: ./index.php?action=error&code=001");
}

// gestione autenticazione legata alla session
function disconnessione(){
    header("Location: ./index.php?action=disc&code=000");
}

function unsetSess(){
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
}


    
?>