<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);
include "./data/connection.php";
controllo_sessione();
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php require_once('inc-meta.php'); ?>
        
    <title>Admin | Dashboard</title>
    <meta name="description" content="">
    <meta name="robots" content="NOINDEX, NOFOLLOW">

    <?php require_once('inc-style.php'); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini" >

  <div id="ajax-loader"><img src="./img/loader.gif" /></div>

      <div class="wrapper">

      <?php include('inc-header.php'); ?>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <?php require_once('inc-menu-sx.php'); ?>
          
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Dati globali
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Dati globali</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">

            <div class="callout callout-info" id="resultOK" style="display: none;" >
              <h4>Update effettuato con successo!</h4>
              <p></p>
            </div>

            <div class="callout callout-danger" id="resultKO" style="display: none;" >
              <h4>Errore nell'update</h4>
              <p></p>
            </div>     

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Modifica dati</h3> *campi obbligatori
              </div>
              <?php
              $conn = db_connect();

              $stmt = $conn->stmt_init();

              $stmt->prepare("SELECT DISTINCT tC.Footer_txt, tC.Claim_txt
                        FROM tbl_config tC "); // 
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($footer, $claim); 

              $stmt->fetch(); 
              
              if($Immagine == '') { $imgProf = $dir_site."/img/noimage-profile.png"; } else { $imgProf = $dir_site."/upload/thumb-".$Immagine; }

              ?>
              <form id="updateForm" name="updateForm" method="post" >

                <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['user_ID']; ?>" >
                <input type="hidden" id="imgProfile" name="imgProfile" value="" >
                
                <div class="row">

                <div class="col-md-6">

                  <div class="box-body pad ">

                      <div class="form-group">
                        <label for="linguaPred">Lingua predefinita</label><br/>
                        <?php 
                        for($z = 0; $z < count($_SESSION['lingua']); $z++) {
                          echo "<input type=\"radio\" name=\"linguaPred\" value=\"".trim($_SESSION['lingua'][$z])."\" ";
                          if(strcmp(trim($_SESSION['lingua'][$z]),$_SESSION['predef_lingua'] ) == 0) { echo "checked=\"checked\""; }
                          echo " />";
                          echo "<img src=\"./img/".trim($_SESSION['lingua'][$z]).".jpg\" class=\"lingua\" />";
                        }
                        ?>
                         
                      </div>

                  </div><!-- /.box-body -->

                </div><!-- /.col-md-6 -->

                <div class="col-md-6">

                  <div class="box-body pad "></div><!-- /.box-body -->

                </div><!-- /.col-md-6 -->

                <div class="col-md-12">

                  <div class="box-body pad ">

                  <div class="form-group">
                    <label for="editor_claim">Claim</label>
                    <textarea id="editor_claim" name="editor_claim" rows="10" cols="80"><?php echo $claim; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="editor_footer">Footer</label>
                    <textarea id="editor_footer" name="editor_footer" rows="10" cols="80"><?php echo $footer; ?></textarea>
                  </div>

                  </div><!-- /.box-body -->

                </div> <!-- /.col-md-12 -->

              </div><!-- /.row -->  

              <div class="box-footer">
                    <a href="index.php" class="btn btn-default">Home page</a>
                    <button type="submit" id="submitForm" class="btn btn-info pull-right">Ok, modifica</button>
              </div> 

              </form>

              <?php
              mysqli_stmt_close($stmt);      
              $conn->close();
              ?>

            </div><!-- /.box -->       

          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->

      <?php require_once('inc-footer.php'); ?>

      </div><!-- /.wrapper -->

      <?php require_once('inc-scripts.php'); ?>

      <script type="text/javascript">
      <!--
      $('#ajax-loader').css('visibility','hidden');
      $('#resultOK').css('display','none');
      $('#resultKO').css('display','none');
      var datastring = "";

      $(document).ready(function(e) {

        CKEDITOR.replace('editor_footer');
        CKEDITOR.replace('editor_claim');
        
        // SUBMIT FORM
        $( "#submitForm" ).click(function(e) {
          e.preventDefault();

          $('#resultOK').css('display','none');
          $('#resultKO').css('display','none');

          CKEDITOR.instances.editor_footer.updateElement();  
          CKEDITOR.instances.editor_claim.updateElement();
          datastring = $("#updateForm").serialize();

          console.log("datastring "+datastring);

          $.ajax({
              type: "POST",
              url: "ajax/update_config.php",
              data: datastring,
              dataType: "json",
              beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
              success: function(data) {
                if(data.status == 1) {
                  $('#ajax-loader').css('visibility','hidden');
                  $('#resultOK').css('display','block');
                  $("html, body").animate({ scrollTop: 0 }, "slow");
                } else {
                  showError(data.msg);
                }

              },
              error: function() {
                $('#ajax-loader').css('visibility','hidden');
                $('#resultKO').css('display','block');
                showError("Ajax sending data...");
              }
            });
            return false;
          // }  // if check value
        });


      });  

      function showError(errMsg){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $('#resultKO').css('display','block');
        $('#resultKO p').html(errMsg);
      }

      </script>

</html>
