<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";

controllo_sessione();

if(isset($_GET['id_item']) && ($_GET['id_item'] != "" )) {
  $id_item_get = $_GET['id_item']; // id user
}

if(isset($_GET['act']) && ($_GET['act'] != "" )) {
  $act = $_GET['act']; // act add or edit
}

?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php require_once('inc-meta.php'); ?>
        
    <title>Admin | Officine/Dealers</title>
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
              <i class="fa fa-wrench" aria-hidden="true"></i> Officine/Dealers
            </h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Gestione Officine/Dealers</li>
            </ol>
          </section>

          <!-- Main content -->

          <section class="content">

            <div class="callout callout-info" id="resultOK" style="display:none;" >
              <h4>Azione effettuata con successo</h4>
              <p></p>
            </div>

            <div class="callout callout-danger" id="resultKO" style="display:none;" >
              <h4>Errore</h4>
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
                } ?> officina/dealer</h3> *campi obbligatori
              </div>
              <?php

              $flagSelDealer1 = "";
              $flagSelDealer0 = "checked=\"checked\"";
              $flagSelOfficina1 = "";
              $flagSelOfficina0 = "checked=\"checked\"";
              $flagSelStato1 = "";
              $flagSelStato0 = "checked=\"checked\"";

              $flagSelPrivacy1 = "";
              $flagSelPrivacy0 = "checked=\"checked\"";
              $flagSelMarketing1 = "";
              $flagSelMarketing0 = "checked=\"checked\"";

              $conn = db_connect();

              $stmt = $conn->stmt_init();

              $stmt->prepare("SELECT DISTINCT O.ID_item, O.Nome, O.Email, O.Sitoweb, O.Password, O.Dealer, O.Officina, O.Stato, O.AuthPrivacy, O.AuthMarketing, O.Latitudine, O.Longitudine, O.Indirizzo, O.Citta, O.CAP, O.Nazione, O.Telefono,O.Fax, O.Immagine, O.Note
                        FROM officine O
                        WHERE O.ID_item = ? LIMIT 0,1"); // 
              $stmt->bind_param("i", $id_item_get);
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($ID_item, $Nome, $Email, $Sitoweb, $Password, $Dealer, $Officina, $Stato, $Privacy, $Marketing,$Latitudine, $Longitudine, $Indirizzo, $Citta, $CAP, $Nazione, $Telefono, $Fax, $Immagine, $Note); 
              $total_res = $stmt->num_rows; // numero risultati

              $stmt->fetch(); 

              $Nome = trim($Nome);
              $Password = trim($Password);
              $Email = trim($Email);

              if($Dealer == 1): $flagSelDealer1 = "checked=\"checked\""; $flagSelDealer0 = ""; endif;
              if($Officina == 1): $flagSelOfficina1 = "checked=\"checked\""; $flagSelOfficina0 = ""; endif;
              if($Stato == 1): $flagSelStato1 = "checked=\"checked\""; $flagSelStato0 = ""; endif;

              if($Privacy == 1): $flagSelPrivacy1 = "checked=\"checked\""; $flagSelPrivacy0 = ""; endif;
              if($Marketing == 1): $flagSelMarketing1 = "checked=\"checked\""; $flagSelMarketing0 = ""; endif;

              if($Telefono != 0) { $Telefono = trim($Telefono); } else { $Telefono = ""; }

              if($Fax != 0) { $Fax = trim($Fax); } else { $Fax = ""; }
              
              $imgHidden = $Immagine;

              if($Immagine == '') { $imgProf = $_SESSION['url_admin']."/img/noimage-profile.png"; } else { $imgProf = $_SESSION['url_admin']."/upload/thumb-".$Immagine; }

              // if($total_res > 0) {
              ?>
              <form id="updateForm" name="updateForm" method="post" >

                <input type="hidden" id="uid" name="uid" value="<?php echo $ID_item; ?>" >
                <input type="hidden" id="imgProfile" name="imgProfile" value="<?php echo $imgHidden; ?>" >
                
                <div class="row">

                <div class="col-md-6">

                  <div class="box-body pad ">

                      <div class="form-group">
                        <label for="nameUser">Nome attività *</label>
                        <input type="text" class="form-control" id="nameUser" name="nameUser" placeholder="Nome" value="<?php echo $Nome; ?>" >
                      </div>

                      <div class="form-group">
                        <label for="emailUser">Email</label>
                        <input type="email" class="form-control" id="emailUser" name="emailUser" placeholder="Email" value="<?php echo $Email; ?>" >
                      </div>

                      <div class="form-group">
                      <label for="webUser">Sito web</label>
                        <input type="text" class="form-control" id="webUser" name="webUser" placeholder="http://www..." value="<?php echo $Sitoweb; ?>" >
                      </div>

                      <div class="form-group">
                        <label for="phoneUser">Telefono</label>
                        <input type="text" class="form-control" id="phoneUser" name="phoneUser" placeholder="Telefono" value="<?php echo $Telefono; ?>">
                      </div>

                      <div class="form-group">
                        <label for="faxUser">Fax</label>
                        <input type="text" class="form-control" id="faxUser" name="faxUser" placeholder="Fax" value="<?php echo $Fax; ?>">
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

                      <label>Dealer</label>
                      sì 
                      <input type="radio" name="dealer" value="1" <?php echo $flagSelDealer1; ?>  />
                      <input type="radio" name="dealer" value="0" <?php echo $flagSelDealer0; ?> /> no
     
                    </div> <!-- end form-group -->

                    <div class="form-group">

                      <label>Officina</label>
                      sì 
                      <input type="radio" name="officina" value="1" <?php echo $flagSelOfficina1; ?>  />
                      <input type="radio" name="officina" value="0" <?php echo $flagSelOfficina0; ?> /> no
     
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


                <div class="col-md-6">

                  <div class="box-body pad ">

                    <div class="form-group">
                      <label for="indirizzoForm">Indirizzo</label>
                      <input type="text" class="form-control" id="indirizzoForm" name="indirizzoForm" placeholder="Via Lorem Ipsum, 15" value="<?php echo $Indirizzo; ?>" >
                    </div> <!-- end form-group -->

                    <div class="form-group">
                      <label for="cittaForm">Citta</label>
                      <input type="text" class="form-control" id="cittaForm" name="cittaForm" placeholder="Milano" value="<?php echo $Citta; ?>" >
                    </div> <!-- end form-group -->

                    <div class="form-group">
                      <label for="capForm">CAP</label>
                      <input type="text" class="form-control" id="capForm" name="capForm" placeholder="55555" value="<?php echo $CAP; ?>" >
                    </div> <!-- end form-group -->

                    <div class="form-group">
                      <label for="nazioneForm">Nazione</label>
                      <input type="text" class="form-control" id="nazioneForm" name="nazioneForm" placeholder="Italia" value="<?php echo $Nazione; ?>" >
                    </div> <!-- end form-group -->

                  </div><!-- /.box-body -->

                </div><!-- /.col-md-6 -->

                <div class="col-md-6">

                  <div class="box-body pad ">

                    <div class="form-group">
                      <label for="latForm">Latitudine</label>
                      <input type="text" class="form-control" id="latForm" name="latForm" placeholder="11.11111111111" value="<?php echo $Latitudine; ?>" >
                    </div> <!-- end form-group -->

                    <div class="form-group">
                      <label for="longForm">Longitudine</label>
                      <input type="text" class="form-control" id="longForm" name="longForm" placeholder="11.11111111111" value="<?php echo $Longitudine; ?>" >
                    </div> <!-- end form-group -->

                    <div class="form-group">
                      <div id="map"></div>
                    </div>

                  </div><!-- /.box-body -->

                </div><!-- /.col-md-6 -->


                <div class="col-md-12">

                  <div class="box-body pad " >
                    <hr id="line">

                    <div class="form-group">
                      <label for="editor1">Note</label>
                      <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $Note; ?></textarea>
                    </div>
                  </div>

                </div><!-- /.col-md-12 -->

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

              <form id="redirectForm" name="redirectForm" method="get" action="categoria-officine.php" >
                <input type="hidden" id="status" name="status" >
                <input type="hidden" id="textstatus" name="textstatus" >
                <input type="hidden" id="act" name="act" value="load" >
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

          indirizzo = $('#indirizzoForm').val();
          citta = $('#cittaForm').val();
          cap = $('#capForm').val();
          nazione = $('#nazioneForm').val();

          latForm = parseFloat($('#latForm').val());
          longForm = parseFloat($('#longForm').val());

          var newLat, newLong;

          // campi obbligatori
          if ( document.updateForm.nameUser.value == "" ) {

            showError("I Campi * non possono essere vuoti!");
            return false;
            
          } else {

            CKEDITOR.instances.editor1.updateElement();
            datastring = $("#updateForm").serialize();

            if (( indirizzo != "" ) && ( citta != "" ) && ( cap != "" ) && ( nazione != "" )) {

              indirizzo = indirizzo.replace(/ /g, "+");
              citta = citta.replace(/ /g, "+");
              cap = cap.replace(/ /g, "+");
              nazione = nazione.replace(/ /g, "+");

              // recupero la latitudine e la longitudine se non sono già presenti
              if( 
                (( latForm == 0 ) || ( longForm == 0 )) || 
                (( latForm == "" ) || ( longForm == "" )) || 
                (( isNaN(latForm) ) || ( isNaN(longForm)) ) 
                ) 
                {

                urlGoogleMap = "https://maps.googleapis.com/maps/api/geocode/json?address="+indirizzo+",+"+citta+",+"+nazione+"&key=AIzaSyBkM3TGhJ-xPVTp3406S4fyMhUkwxY7NAo";

                $.ajax({
                    type: "POST",
                    url: urlGoogleMap,
                    dataType: "json",
                    beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
                    success: function(data) {
                      console.log("Google map status: "+data.status)
                      if(data.status == "OK"){
                        newLat = data.results[0].geometry.location.lat;
                        newLong = data.results[0].geometry.location.lng;
                        datastring += "&newLat="+newLat;
                        datastring += "&newLong="+newLong;
                        document.getElementById("latForm").value = newLat;
                        document.getElementById("longForm").value = newLong;
                        initMap();
                        console.log("datastring "+datastring);
                        updateData(datastring);
                      } 
                    },
                    error: function() {
                      console.log("Error ajax sending data Google Map...");
                      console.log("datastring "+datastring);
                      updateData(datastring);
                    }
                }); // ajax
                return false;
              } // if

              console.log("Latitudine e longitudine già presenti o uguale a zero");
              updateData(datastring);

            } else {
              console.log("Indirizzo vuoto:  "+datastring);
              updateData(datastring);
            } // else if
              
          } // else if

        }); // click submit form modifica

        function updateData(datastring) {
          $.ajax({
                type: "POST",
                url: "ajax/update_officina.php",
                data: datastring,
                dataType: "json",
                beforeSend: function(x){$("html, body").animate({ scrollTop: 0 }, 10); $('#ajax-loader').css('visibility','visible');},
                success: function(data) {
                  if(data.status == 1) {
                    location.href= "categoria-officine.php?act=load&statusmess="+data.status+"&txtmess="+data.msg;
                    //showOk(data.msg);
                  } else {
                    $('#ajax-loader').css('visibility','hidden');
                    showError(data.msg);
                  }

                },
                error: function() {
                  $('#ajax-loader').css('visibility','hidden');
                  showError("Error ajax sending data...");
                }
          });
          return false;
        };


        // SUBMIT FORM ADD
        $( "#submitFormAdd" ).click(function(e) {
          e.preventDefault();
          
          $('#resultOK').css('display','none');
          $('#resultKO').css('display','none');

          indirizzo = $('#indirizzoForm').val();
          citta = $('#cittaForm').val();
          cap = $('#capForm').val();
          nazione = $('#nazioneForm').val();

          latForm = parseFloat($('#latForm').val());
          longForm = parseFloat($('#longForm').val());

          if (( document.updateForm.nameUser.value == "" ) ) {

            showError("I Campi * non possono essere vuoti!");
            return false;
            
          } else {

            CKEDITOR.instances.editor1.updateElement();
            datastring = $("#updateForm").serialize();

            console.log("datastring add"+datastring);

            if (( indirizzo != "" ) && ( citta != "" ) && ( cap != "" ) && ( nazione != "" )) {

              indirizzo = indirizzo.replace(/ /g, "+");
              citta = citta.replace(/ /g, "+");
              cap = cap.replace(/ /g, "+");
              nazione = nazione.replace(/ /g, "+");

              // recupero la latitudine e la longitudine se non sono già presenti
              if( 
                (( latForm == 0 ) || ( longForm == 0 )) || 
                (( latForm == "" ) || ( longForm == "" )) || 
                (( isNaN(latForm) ) || ( isNaN(longForm)) ) 
                ) 
                {

                urlGoogleMap = "https://maps.googleapis.com/maps/api/geocode/json?address="+indirizzo+",+"+citta+",+"+nazione+"&key=AIzaSyBkM3TGhJ-xPVTp3406S4fyMhUkwxY7NAo";

                $.ajax({
                    type: "POST",
                    url: urlGoogleMap,
                    dataType: "json",
                    beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
                    success: function(data) {
                      console.log("Google map status: "+data.status)
                      if(data.status == "OK"){
                        newLat = data.results[0].geometry.location.lat;
                        newLong = data.results[0].geometry.location.lng;
                        datastring += "&newLat="+newLat;
                        datastring += "&newLong="+newLong;
                        document.getElementById("latForm").value = newLat;
                        document.getElementById("longForm").value = newLong;
                        initMap();
                        console.log("datastring "+datastring);
                        addData(datastring);
                      } 
                    },
                    error: function() {
                      console.log("Error ajax sending data Google Map...");
                      console.log("datastring "+datastring);
                      addData(datastring);
                    }
                }); // ajax
                return false;
              } // if

              console.log("Latitudine e longitudine già presenti o uguale a zero");
              addData(datastring);

            } else {
              console.log("Indirizzo vuoto:  "+datastring);
              addData(datastring);
            } // else if

          } 

        }); // click submit form modifica


        function addData(datastring) {
            $.ajax({
                type: "POST",
                url: "ajax/add_officina.php",
                data: datastring,
                dataType: "json",
                beforeSend: function(x){$("html, body").animate({ scrollTop: 0 }, "slow"); $('#ajax-loader').css('visibility','visible');},
                success: function(data) {
                  if(data.status == 1) {
                    location.href= "categoria-officine.php?act=load&statusmess="+data.status+"&txtmess="+data.msg;
                    //showOk(data.msg);
                  } else {
                    $('#ajax-loader').css('visibility','hidden');
                    showError(data.msg);
                  }
              },
              error: function() {
                $('#ajax-loader').css('visibility','hidden');
                  showError("Ajax sending data...");
              }
            });
            return false;
        };


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

      function initMap() {
        latForm = parseFloat($('#latForm').val());
        longForm = parseFloat($('#longForm').val());

        console.log("Init map latForm "+latForm+" longForm "+longForm);
        var myLatLng = {lat: latForm, lng: longForm};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }

      </script>

      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkM3TGhJ-xPVTp3406S4fyMhUkwxY7NAo&callback=initMap">
      </script>

</html>
