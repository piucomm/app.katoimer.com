<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";

controllo_sessione();


/* $user = $_POST['user'];
$passw = $_POST['passw'];

$config = parse_ini_file('./data/config.ini'); 

$conn = db_connect();

$stmt = $conn->stmt_init();

$stmt->prepare("SELECT DISTINCT tGU.Username, tGU.Nome, tGU.Cognome, tGU.UserID
          FROM tbl_global_user tGU
          WHERE tGU.Username = ? AND tGU.Password = MD5(?) "); // 
$stmt->bind_param("ss", $user, $passw);
$stmt->execute();
$stmt->bind_result($Username, $Nome, $Cognome, $UserID); 
        
while($stmt->fetch()){ 
    
  $nome_utente = $Username;

  $_SESSION['username'] = $Username;
  $_SESSION['UserID'] = $UserID; // id utente
  $_SESSION['nome_utente'] = $Nome." ".$Cognome;
  

 } // while
        
$conn->close(); */

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}


?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <meta name="robots" content="NOINDEX, NOFOLLOW">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- CUSTOM STYLE -->
    <link rel="stylesheet" href="./style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition skin-blue sidebar-mini" >

      <div class="wrapper">

      <?php include('inc-header.php'); ?>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- search form 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
           /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php require_once('inc-menu-sx.php'); ?>
          
        </section>
        <!-- /.sidebar -->
      </aside>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Benvenuto,
            <small><?php echo $_SESSION['nome_utente']; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <!-- <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">


          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Gestione Catalogo</h3>
                  <p></p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-text"></i>
                </div>
                <a href="categoria-page.php?act=load" class="small-box-footer">Lista prodotti <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Profilo utente </h3>
                  <p></p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a href="profile.php" class="small-box-footer"><?php echo $_SESSION['nome_utente']; ?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Dati globali</h3>
                  <p></p>
                </div>
                <div class="icon">
                  <i class="fa fa-cogs"></i>
                </div>
                <a href="configuration.php" class="small-box-footer">Vedi dati globali <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->


          </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <?php include('inc-footer.php'); ?>

    <?php include('inc-scripts.php'); ?>

  </body>
</html>