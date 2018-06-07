<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";

controllo_sessione();

$dir_site = "/CUSTOM-ADMIN/admin";

?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php require_once('inc-meta.php'); ?>
        
    <title>Admin | Dashboard</title>
    <meta name="description" content="">

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
              <?php echo $_SESSION['nome_utente'] ?>
              <small>User profile</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">User profile</li>
            </ol>
          </section>

          <!-- Main content -->

          <section class="content">

            <div class="callout callout-info" id="resultOK" >
              <h4>Update effettuato con successo!</h4>
              <p></p>
            </div>

            <div class="callout callout-danger" id="resultKO" >
              <h4>Errore nell'update</h4>
              <p></p>
            </div>     

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Modifica profilo</h3> *campi obbligatori
              </div>
              <?php

              $conn = db_connect();

              $stmt = $conn->stmt_init();

              $stmt->prepare("SELECT DISTINCT tGU.UserID, tGU.Nome, tGU.Cognome, tGU.Email, tGU.Telefono, tGU.Note, tGU.Immagine, tGU.Username, tGU.Password, tGR.RoleID, tGR.Role_Name
                        FROM tbl_global_user tGU, tbl_global_role tGR
                        WHERE tGU.UserID = ? AND tGU.RoleID = tGR.RoleID LIMIT 0,1"); // 
              $stmt->bind_param("i", $_SESSION['user_ID']);
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($UserID, $Nome, $Cognome, $Email, $Telefono, $Note, $Immagine, $Username, $Password, $Role_ID, $Role_Name); 
              $total_res = $stmt->num_rows; // numero risultati

              $stmt->fetch(); 

              $Username = trim($Username);
              $Nome = trim($Nome);
              $Cognome = trim($Cognome);
              $Email = trim($Email);

              if($Telefono != 0) { $Telefono = trim($Telefono); } else { $Telefono = ""; }
              
              if($Immagine == '') { $imgProf = $dir_site."/img/noimage-profile.png"; } else { $imgProf = $dir_site."/upload/thumb-".$Immagine; }

              // if($total_res > 0) {
              ?>
              <form id="updateForm" name="updateForm" method="post" >

                <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['user_ID']; ?>" >
                <input type="hidden" id="imgProfile" name="imgProfile" value="" >
                
                <div class="row">

                <div class="col-md-6">

                  <div class="box-body pad ">

                      <div class="form-group">
                        <label for="nameUser">Nome *</label>
                        <input type="text" class="form-control" id="nameUser" name="nameUser" placeholder="Nome" value="<?php echo $Nome; ?>" >
                      </div>

                      <div class="form-group">
                        <label for="surnameUser">Cognome *</label>
                        <input type="text" class="form-control" id="surnameUser" name="surnameUser" placeholder="Cognome" value="<?php echo $Cognome; ?>" >
                      </div>

                      <div class="form-group">
                        <label for="emailUser">Email *</label>
                        <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="Email" value="<?php echo $Email; ?>" >
                      </div>

                      <div class="form-group">
                        <label for="phoneUser">Telefono *</label>
                        <input type="text" class="form-control" id="phoneUser" name="phoneUser" placeholder="Telefono" value="<?php echo $Telefono; ?>">
                      </div>

                  </div><!-- /.box-body -->

                </div><!-- /.col-md-6 -->

                <div class="col-md-6">

                  <div class="box-body pad ">

                    <div class="form-group">
                      <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                      <div id="image_preview" class="imageThumb profile" ><img id="previewing" src="<?php echo $imgProf; ?>" style="width:100px;" /></div>
                      <div id="selectImage">
                      <label>Seleziona foto</label><br/>
                      <input type="file" name="fileUp" id="fileUp" required /><br/>
                      <button id="submitUpload" class="btn btn-primary" />Carica foto</button>
                      </div>
                      </form>
                      <hr id="line">
                      <h4 id='loading' style="display:none;" >loading...</h4>
                      <div id="message"></div> 

                    </div>

                    <div class="form-group">
                      <label>Ruolo:</label> <?php echo $_SESSION['role_name'];?>
                    </div>

                    <div class="form-group">
                      <label for="usern">Username</label>
                      <input type="text" class="form-control" id="usern" name="usern" value="<?php echo $Username; ?>">
                    </div>

                    <div class="form-group">
                      <label for="newpw">Nuova Password</label>
                      <input type="password" class="form-control" id="newpw" name="newpw" >
                    </div>

                    <div class="form-group">
                      <label for="newpw2">Riscrivi Password</label>
                      <input type="password" class="form-control" id="newpw2" name="newpw2" >
                    </div>

                  </div><!-- /.box-body -->

                </div><!-- /.col-md-6 -->

                <div class="col-md-12">

                  <div class="box-body pad ">

                  <div class="form-group">
                    <label for="editor1">Note</label>
                    <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $Note; ?></textarea>
                  </div>

                  <div class="form-group">
                    <textarea id="editor2" name="editor2" class="textarea" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $Note; ?></textarea>
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

        CKEDITOR.replace('editor1');

        // SUBMIT FORM
        $( "#submitForm" ).click(function(e) {
          e.preventDefault();

          $('#resultOK').css('display','none');
          $('#resultKO').css('display','none');

          if (( document.updateForm.nameUser.value == "" )
           || ( document.updateForm.surnameUser.value == "" )
           || ( document.updateForm.phoneUser.value == "" ) || ( document.updateForm.emailUser.value == "" ) ) {

            showError("I Campi non possono essere vuoti!");
            return false;
          
          } else {

            CKEDITOR.instances.editor1.updateElement();
            datastring = $("#updateForm").serialize();

            console.log("datastring "+datastring);

            $.ajax({
              type: "POST",
              url: "ajax/update.php",
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
          }
        });

        var fileToUp = "";

        // Function to preview image after validation
        $(function() {
          $("#fileUp").change(function() {
            $("#message").empty(); // To remove the previous error message
            fileToUp = this.files[0];
            var imagefile = fileToUp.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) {
              $('#previewing').attr('src','./img/noimage-profile.png');
              $("#message").html("<div class=\"callout callout-danger\">Please Select A valid Image File. Only jpeg, jpg and png Images type allowed</div>");
              return false;
            } else {
              var reader = new FileReader();
              reader.onload = imageIsLoaded;
              reader.readAsDataURL(this.files[0]);
            }
          });
        });

        function imageIsLoaded(e) {
          $("#fileUp").css("color","green");
          $('#image_preview').css("display", "block");
          $('#previewing').attr('src', e.target.result);
          $('#previewing').attr('width', '250px');
          //$('#previewing').attr('height', '230px');
        };


        /* UPLOAD IMAGE */
        $("#submitUpload").on('click',(function(e) {
          e.preventDefault();

          var dataImg = new FormData();

          //var fileUPP = document.getElementById("fileUp").files[0]; //fetch file
          //dataImg.append('file', fileUPP);
          //Append files infos
          //jQuery.each($('input:file')[0].files, function(i, file) {
            dataImg.append('file', fileToUp);
          //});

          $("#message").empty();
          $('#loading').show();
            $.ajax({
            url: "ajax/upload_image.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: dataImg, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)   // A function to be called if request succeeds
            {
              $('#loading').hide();
              document.updateForm.imgProfile.value = data.imgurl;
              $("#message").html(data.txt);
            },
            error: function() {
              $("#message").html("<div class=\"callout callout-danger\">Errore invio data...</div>");
            }
          });
        }));

        /* END UPLOAD IMAGE */

      });  


      function showError(errMsg){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $('#resultKO').css('display','block');
        $('#resultKO p').html(errMsg);
      }

      </script>

</html>
