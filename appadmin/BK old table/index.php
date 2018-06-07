<?php
session_start();
include "./data/connection.php";

if($_GET['act'] == "logout" ){
  unsetSess();
}

if (isset($_SESSION["username"]) && ($_SESSION["username"] != "")) 
  header("Location: login-users.php");


?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php include('inc-meta.php'); ?>
        
    <title>Admin panel | +communication</title>
    <meta name="description" content="">

    <?php include('inc-style.php'); ?>

</head>
  <body class="hold-transition register-page">
    <div id="ajax-loader"><img src="./img/loader.gif" /></div>
    <div class="register-box">
      <div class="register-logo">
        <a href="./../index.php"><b>+</b>comm</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Accesso Area Riservata</p>

        <form name="login_form" id="login_form" method="post" action="login-users.php" >
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" id="user" name="user">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="passw" name="passw">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button id="sendAuth" name="invia" type="submit" value="Login"  class="btn btn-primary btn-block btn-flat">Login</button>
            </div><!-- /.col -->
          </div>
        </form>
      <div id="error-div" ></div>
      </br>
      <small><b>Version</b> 2.0.0 <br/><strong>Copyright &copy; 2016 +comm</strong><br/>All rights reserved.</small>

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
        url: "ajax/checklogin.php",
        data: 'user='+document.login_form.user.value+'&passw='+document.login_form.passw.value,
        dataType: 'json',
        beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
        success: function(msg){
          
          showError(msg.id);
          if(parseInt(msg.status)!=1) {
            $('#ajax-loader').css('visibility','hidden');
            document.login_form.user.value = msg.name;
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
