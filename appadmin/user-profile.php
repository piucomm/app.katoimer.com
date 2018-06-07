<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";

controllo_sessione();

if(isset($_GET['id_user']) && ($_GET['id_user'] != "" )) {
  $id_get_user = $_GET['id_user']; // id user
}

if(isset($_GET['act']) && ($_GET['act'] != "" )) {
  $act = $_GET['act']; // act add or edit
}

?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php require_once('inc-meta.php'); ?>
        
    <title>Admin | User profile</title>
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
              Utenti iscritti
            </h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Gestione utenti</li>
            </ol>
          </section>

          <!-- Main content -->

          <section class="content">

            <div class="callout callout-info" id="resultOK" style="display:none;" >
              <h4>Update effettuato con successo!</h4>
              <p></p>
            </div>

            <div class="callout callout-danger" id="resultKO" style="display:none;" >
              <h4>Errore nell'update</h4>
              <p></p>
            </div>     

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">
                <?php
                if(strcmp($act,"edit") == 0) { 
                  echo "Modifica";
                } else if(strcmp($act,"add") == 0) {
                  echo "Aggiungi ";
                } ?> utente</h3> *campi obbligatori
              </div>
              <?php

              $flagSelOspite1 = "";
              $flagSelOspite0 = "checked=\"checked\"";
              $flagSelProprietario1 = "";
              $flagSelProprietario0 = "checked=\"checked\"";
              $flagSelStato1 = "";
              $flagSelStato0 = "checked=\"checked\"";

              $flagSelPrivacy1 = "";
              $flagSelPrivacy0 = "checked=\"checked\"";
              $flagSelMarketing1 = "";
              $flagSelMarketing0 = "checked=\"checked\"";

              $conn = db_connect();

              $stmt = $conn->stmt_init();

              $stmt->prepare("SELECT DISTINCT I.ID_iscritto, I.Nome, I.Email, I.Password, I.Ospite, I.Proprietario, I.Stato, I.AuthPrivacy, I.AuthMarketing, I.Telefono, I.Immagine, I.Note
                        FROM iscritti I
                        WHERE I.ID_iscritto = ? LIMIT 0,1"); // 
              $stmt->bind_param("i", $id_get_user);
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($ID_iscritto, $Nome, $Email, $Password, $Ospite, $Proprietario, $Stato, $Privacy, $Marketing, $Telefono, $Immagine, $Note); 
              $total_res = $stmt->num_rows; // numero risultati

              $stmt->fetch(); 

              $Nome = trim($Nome);
              $Password = trim($Password);
              $Email = trim($Email);

              if($Ospite == 1): $flagSelOspite1 = "checked=\"checked\""; $flagSelOspite0 = ""; endif;
              if($Proprietario == 1): $flagSelProprietario1 = "checked=\"checked\""; $flagSelProprietario0 = ""; endif;
              if($Stato == 1): $flagSelStato1 = "checked=\"checked\""; $flagSelStato0 = ""; endif;

              if($Privacy == 1): $flagSelPrivacy1 = "checked=\"checked\""; $flagSelPrivacy0 = ""; endif;
              if($Marketing == 1): $flagSelMarketing1 = "checked=\"checked\""; $flagSelMarketing0 = ""; endif;

              if($Telefono != 0) { $Telefono = trim($Telefono); } else { $Telefono = ""; }
              
              $imgHidden = $Immagine;

              if($Immagine == '') { $imgProf = $_SESSION['url_admin']."/img/noimage-profile.png"; } else { $imgProf = $_SESSION['url_admin']."/upload/thumb-".$Immagine; }

              // if($total_res > 0) {
              ?>
              <form id="updateForm" name="updateForm" method="post" >

                <input type="hidden" id="uid" name="uid" value="<?php echo $ID_iscritto; ?>" >
                <input type="hidden" id="imgProfile" name="imgProfile" value="<?php echo $imgHidden; ?>" >
                
                <div class="row">

                <div class="col-md-6">

                  <div class="box-body pad ">

                      <div class="form-group">
                        <label for="nameUser">Nome</label>
                        <input type="text" class="form-control" id="nameUser" name="nameUser" placeholder="Nome" value="<?php echo $Nome; ?>" >
                      </div>

                      <div class="form-group">
                        <label for="emailUser">Email *</label>
                        <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="Email" value="<?php echo $Email; ?>" >
                      </div>

                      <div class="form-group">
                        <label for="phoneUser">Telefono</label>
                        <input type="text" class="form-control" id="phoneUser" name="phoneUser" placeholder="Telefono" value="<?php echo $Telefono; ?>">
                      </div>

                      <hr id="line">

                      <?php
                      if(strcmp($act,"edit") == 0) : ?>
                      <div class="form-group">
                        <label for="newpw">
                          Vecchia Password
                        </label>
                        <input type="password" class="form-control" id="oldpw" name="oldpw" >
                      </div>
                      <?php endif; ?>

                      <div class="form-group">
                        <label for="newpw">
                          <?php
                          if(strcmp($act,"edit") == 0) { 
                            echo "Nuova Password";
                          } else if(strcmp($act,"add") == 0) {
                            echo "Password *";
                          } ?>
                        </label>
                        <input type="password" class="form-control" id="newpw" name="newpw" >
                      </div>

                      <div class="form-group">
                        <label for="newpw2">
                          Riscrivi Password <?php if(strcmp($act,"add") == 0) { echo "*"; } ?>
                        </label>
                        <input type="password" class="form-control" id="newpw2" name="newpw2"  >
                      </div>

                      <hr id="line">

                      <div class="form-group">
                        <label for="editor1">Note</label>
                        <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $Note; ?></textarea>
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

                    </div> <!-- end form-group -->

                    <div class="form-group">
                      <label>Stato</label>

                      attivo 
                      <input type="radio" name="stato" value="1" <?php echo $flagSelStato1; ?> />
                      <input type="radio" name="stato" value="0" <?php echo $flagSelStato0; ?>  /> non attivo
     
                    </div> <!-- end form-group -->

                    <div class="form-group">

                      <label>Proprietario</label>
                      sì 
                      <input type="radio" name="proprietario" value="1" <?php echo $flagSelProprietario1; ?>  />
                      <input type="radio" name="proprietario" value="0" <?php echo $flagSelProprietario0; ?> /> no
     
                    </div> <!-- end form-group -->

                    <div class="form-group">

                      <label>Ospite</label>
                      sì 
                      <input type="radio" name="ospite" value="1" <?php echo $flagSelOspite1; ?>  />
                      <input type="radio" name="ospite" value="0" <?php echo $flagSelOspite0; ?> /> no
     
                    </div> <!-- end form-group -->

                    <hr id="line">

                    <div class="form-group">

                      <label>Accettazione privacy</label>
                      sì 
                      <input type="radio" name="privacyUser" value="1" <?php echo $flagSelPrivacy1; ?>  />
                      <input type="radio" name="privacyUser" value="0" <?php echo $flagSelPrivacy0; ?> /> no
     
                    </div> <!-- end form-group -->

                    <div class="form-group">

                      <label>Accettazione marketing</label>
                      sì 
                      <input type="radio" name="marketingUser" value="1" <?php echo $flagSelMarketing1; ?>  />
                      <input type="radio" name="marketingUser" value="0" <?php echo $flagSelMarketing0; ?> /> no
     
                    </div> <!-- end form-group -->



                  </div><!-- /.box-body -->

                </div><!-- /.col-md-6 -->


              </div><!-- /.row -->  

              <div class="box-footer">
                <a href="index.php" class="btn btn-default">Home page</a>
                <?php
                if(strcmp($act,"edit") == 0) { ?>
                  <button type="submit" id="submitFormEdit" class="btn btn-info pull-right">Ok, modifica</button>
                <?php } else if(strcmp($act,"add") == 0) { ?>
                  <button type="submit" id="submitFormAdd" class="btn btn-info pull-right">Ok, aggiungi</button>
                <?php } ?>
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

        // SUBMIT FORM EDIT
        $( "#submitFormEdit" ).click(function(e) {
          e.preventDefault();
          
          $('#resultOK').css('display','none');
          $('#resultKO').css('display','none');

          // validazione campi password
          if (document.updateForm.oldpw.value != ""){
            if ((document.updateForm.newpw.value == "") && (document.updateForm.newpw2.value == "")) {
              showError("I campi password sono vuoti...");
              return false;
            }

            if(document.updateForm.newpw.value != document.updateForm.newpw2.value) { // controllo che newpw sia uguale a news pw2
              showError("Le password non coincidono...");
              return false;
            }
          }
          

          if ( document.updateForm.emailUser.value == "" ) {

            showError("I Campi * non possono essere vuoti!");
            return false;
            
          } else {

              CKEDITOR.instances.editor1.updateElement();
              datastring = $("#updateForm").serialize();

              console.log("datastring "+datastring);

              $.ajax({
                type: "POST",
                url: "ajax/update_iscritto.php",
                data: datastring,
                dataType: "json",
                beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
                success: function(data) {
                  $('#ajax-loader').css('visibility','hidden');
                  if(data.status == 1) {
                    showOk(data.msg);
                  } else {
                    showError(data.msg);
                  }

                },
                error: function() {
                  $('#ajax-loader').css('visibility','hidden');
                  showError("Error ajax sending data...");
                }
              });
              return false;
          }

        }); // click submit form modifica


        // SUBMIT FORM ADD
        $( "#submitFormAdd" ).click(function(e) {
          e.preventDefault();
          
          $('#resultOK').css('display','none');
          $('#resultKO').css('display','none');

          // validazione campi
          if (document.updateForm.newpw.value != document.updateForm.newpw2.value)  { // controllo che newpw sia uguale a news pw2

            showError("Le password non coincidono...");
            return false;

          } else  {

            if (( document.updateForm.newpw.value == "" ) ||( document.updateForm.newpw2.value == "" ) || ( document.updateForm.emailUser.value == "" ) ) {

              showError("I Campi * non possono essere vuoti!");
              return false;
            
            } else {

              CKEDITOR.instances.editor1.updateElement();
              datastring = $("#updateForm").serialize();

              console.log("datastring add"+datastring);

              $.ajax({
                type: "POST",
                url: "ajax/add_iscritto.php",
                data: datastring,
                dataType: "json",
                beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
                success: function(data) {
                  $('#ajax-loader').css('visibility','hidden');
                  if(data.status == 1) {
                    showOk(data.msg);
                  } else {
                    showError(data.msg);
                  }
                },
                error: function() {
                  $('#ajax-loader').css('visibility','hidden');
                  showError("Ajax sending data...");
                }
              });
              return false;
            }

          } // if newpw == newpw2

        }); // click submit form modifica


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
