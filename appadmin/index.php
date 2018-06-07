<?php
session_start();
include "./data/connection.php";

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set("log_errors", 1);
// ini_set("error_log", "/tmp/php-error.log");

if($_GET['act'] == "logout" ){
  unsetSess();
}

if (isset($_SESSION["username"]) && ($_SESSION["username"] != "")) {
  header("Location: login-users.php");
}

?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php include('inc-meta.php'); ?>
        
    <title>Admin panel | +communication</title>
    <meta name="robots" content="NOINDEX, NOFOLLOW">

    <?php include('inc-style.php'); ?>

</head>
  <body class="hold-transition register-page">
    <div id="ajax-loader"><img src="./img/loader.gif" /></div>
    <div class="register-box">
      <div class="register-logo">
        <a href="./../index.php"><b>+</b>cms</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Accesso Area Riservata</p>

        <form name="login_form" id="login_form" method="post" action="login-users.php" >
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" id="user" name="user" value="<?php
echo $_COOKIE['remember_me']; ?>" >
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="passw" name="passw">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <!-- <div class="form-group has-feedback">
            <input type="checkbox" name="remember" <?php if(isset($_COOKIE['remember_me'])) {
                echo 'checked="checked"';
              } else { echo ''; } ?> > Remember Me
          </div> -->

          <div class="row">
            <div class="col-xs-12">
              <button id="sendAuth" name="invia" type="submit" value="Login"  class="btn btn-primary btn-block btn-flat">Login</button>
            </div><!-- /.col -->
          </div>
        </form>
      <div id="error-div" ></div>
      <?php
      // if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/appadmin/data/config.ini')){
      //   //print fileperms($_SERVER['DOCUMENT_ROOT'] . '/appadmin/data/config.ini');
      //   $config2 = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/appadmin/data/config.ini'); 
      //   $conn2 = mysqli_connect('localhost',$config2['username'],$config2['password'],$config2['dbname']);
      //   echo "connesso al db";
      // } else {
      //   echo $_SERVER['DOCUMENT_ROOT'] . "does not exist at this location";
      // } 
      ?>

      </br>
      <small><b>+cms Version</b> 2.0.0 <br/><strong>Copyright &copy; 2016 +communication</strong><br/>All rights reserved.</small>

      </div><!-- /.form-box -->
    </div><!-- /.register-box --> 

    <?php include('inc-scripts.php'); ?>

    <script language="JavaScript" type="text/JavaScript">
    <!--
    $('#ajax-loader').css('visibility','hidden');
    $('#error-div').css('visibility','hidden');

    $( "#sendAuth" ).click(function(e) {
      e.preventDefault();
      
      if (( document.login_form.user.value == "" ) || ( document.login_form.passw.value == "" )) {

        $('#error-div').css('visibility','hidden');

        showError("Errore:: I Campi non possono essere vuoti!");

        return false;
      
      }  else {
        //checkLogin(, document.login_form.passw.value);

        $.ajax({
        type: "POST",
        url: "https://app.katoimer.com/appadmin/ajax/checklogin.php",
        data: 'user='+document.login_form.user.value+'&passw='+document.login_form.passw.value,
        dataType: 'json',
        beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
        success: function(msg){
          
          showError(msg.id);
          if(parseInt(msg.status)!=1) {
            $('#ajax-loader').css('visibility','hidden');
            document.login_form.user.value = msg.name;
            showError("Errore:: " + msg.id);
          } else {
            // Autenticazione riuscita
            $('#login_form').submit();
          }
        }
        });

        return false; 

      }

      return false;
      
    });

    function showError(errMsg){
        $('#error-div').css('visibility','visible');
        $('#error-div').html(errMsg);
    }

    //-->
    </script>

    </body>
</html>
