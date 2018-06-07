<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";
controllo_sessione();

$dir_site = "/CUSTOM-ADMIN/admin";

$act = "load";
$Type = "USERS";
$ID_padre = 1;
$lingua = $_SESSION['predef_lingua'];

if(isset($_GET['act']) && ($_GET['act'] != "" )) {
  $act = $_GET['act'];
}

if(isset($_GET['id_user']) && ($_GET['id_user'] != "" )) {
  $id_get_user = $_GET['id_user']; // id user
}

if(isset($_GET['lingua']) && ($_GET['lingua'] != "" )) {
  $lingua = $_GET['lingua']; // lingua per modifica e aggiungi
} 

if(isset($_GET['trans_of_id']) && ($_GET['trans_of_id'] != "" )) {
  $trans_of_id = $_GET['trans_of_id']; // id item in aggiunta traduzione
  $trans_of_title = $_GET['trans_of_item'];  // title dell'item da tradurre
} else {
  $trans_of_id = 0;
  $trans_of_title = "";
}

?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php include('inc-meta.php'); ?>

    <title>Admin | Dashboard</title>
    <meta name="description" content="">
    <meta name="robots" content="NOINDEX, NOFOLLOW">

    <?php include('inc-style.php'); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini" >

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


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Utenti iscritti
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li><a href="#">Utenti iscritti</a></li>
            <!--  <li class="active">Blank page</li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">

            <div class="callout callout-info" id="resultOK" style="display:none;" >
              <h4>OK</h4>
              <p></p>
            </div>

            <div class="callout callout-danger" id="resultKO" style="display:none;"  >
              <h4>Errore</h4>
              <p></p>
            </div>    

            <div class="box box-primary">

            <?php 
            /* VISUALIZZA */
            if(strcmp($act,"load") == 0) {
            ?>
              <div class="box-header with-border">
                <a href="./user-profile.php?act=add&lingua=<?php echo $lingua; ?>" title="Aggiungi in lingua <?php echo $lingua; ?>" class="btn btn-primary margin-bottom">
                  <i class="fa fa-plus-circle" aria-hidden="true"></i> Aggiungi Utente</a>
                <div class="box-tools pull-right">

                  <div class="btn-group">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" id="searchBox" placeholder="Ricerca">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.btn-group -->

                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->


              <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <div class="btn-group">
                      <input type="checkbox" class="selectAll" value="" >
                    </div><!-- /.btn-group -->
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" id="trashBt" ><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" id="refreshBt" ><i class="fa fa-refresh"></i></button>
                    </div><!-- /.btn-group -->
                    
                    <!-- <div class="btn-group"> -->
                      <!-- vista ricorsiva e non -->
                      <!-- <button class="btn btn-default btn-sm" id="noRecursiveBt" title="Vista non ricorsiva" ><i class="fa fa-align-justify" aria-hidden="true"></i></button> -->
                      <!-- <button class="btn btn-default btn-sm" id="recursiveBt" title="Vista ricorsiva" ><i class="fa fa-indent" aria-hidden="true"></i></button> -->
                    <!-- </div> -->

                    <div class="pull-right paginationRow">
                        <!-- ajax data... -->
                    </div><!-- /.pull-right -->

                  </div>
                  <div class="table-responsive mailbox-messages">

                    <table id="showDataQuery"  class="table table-hover table-striped">
                      <!-- ajax data... -->
                    </table><!-- /.table -->
                    
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">

                    <div class="pull-right "> <!-- paginationRow -->
                      <!-- ajax data... -->
                    </div><!-- /.pull-right -->
                  </div>
                </div>
                <?php 
                ?>

        <?php 
        /* AGGIUNGI */
        } else if((strcmp($act,"add") == 0) || (strcmp($act,"edit") == 0)) {

          $connup = db_connect();

          $flagSelOspite1 = "";
          $flagSelOspite0 = "checked=\"checked\"";
          $flagSelProprietario1 = "";
          $flagSelProprietario0 = "checked=\"checked\"";
          $flagSelStato1 = "";
          $flagSelStato0 = "checked=\"checked\"";

          if (strcmp($act,"edit") == 0) { // edit fields
                        
            $stmtup = $connup->stmt_init();

            $stmtup->prepare("SELECT I.ID_iscritto, I.Nome, I.Email, I.Password, I.Ospite, I.Proprietario, I.Stato
                              FROM iscritti I");

            $stmtup->execute();

            $stmtup->store_result();
            $stmtup->bind_result($ID_iscritto, $Nome, $Email, $Password, $Ospite, $Proprietario, $Stato); 
            $total_res = $stmtup->num_rows; // numero risultati
            
            $stmtup->fetch();

            $imgHidden = $imgEvidenza;

            if($imgEvidenza == '') { $imgEvidenza = $dir_site."/img/noimage-profile.png"; } else { $imgEvidenza = $dir_site."/upload/thumb-".$imgEvidenza; }

            if($Ospite == 1): $flagSelOspite1 = "checked=\"checked\""; $flagSelOspite0 = ""; endif;
            if($Proprietario == 1): $flagSelProprietario1 = "checked=\"checked\""; $flagSelProprietario0 = ""; endif;
            if($Stato == 1): $flagSelStato1 = "checked=\"checked\""; $flagSelStato0 = ""; endif;
            
            mysqli_stmt_close($stmtup); 

            $label_tit = "Modifica";   
                            
          } else if (strcmp($act,"add") == 0) {  // add fields
            $label_tit = "Aggiungi";
            
            if($trans_of_id != 0) {
              $label_tit = "Traduci";
              //$ID_padre = $id_get_cat;
            }
          }

        ?>

              <div class="nav-tabs-custom">

                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <?php if(strcmp($act,"edit") == 0) { ?>
                    <!-- <li><a href="#cont-eng" data-toggle="tab">ENG <img src="./img/en_GB.jpg" class="lingua" /></a></li>
                    <li class="active"><a href="#cont-ita" data-toggle="tab">ITA <img src="./img/it_IT.jpg" class="lingua" /></a></li> -->
                  <?php } else if(strcmp($act,"add") == 0) { 
                    if($trans_of_id != 0) {
                      echo "<li><small>Traduzione in <img src=\"./img/".$lingua.".jpg\" class=\"lingua\" /> di: <b>".$trans_of_title." (ID:".$trans_of_id.")</b></small></li>";  } 
                    }
                  ?>
                  <li class="pull-left header"><?php echo $label_tit; ?> Utente</li>
                </ul>


                <div class="tab-content ">

                  <div class="chart tab-pane active" id="cont-ita" >

                  <form id="addForm" name="addForm" method="post" >
                    <input type="hidden" id="act" name="act" value="<?php if(strcmp($act,"edit") == 0) {
                        echo "edit-cat"; 
                        } else if(strcmp($act,"add") == 0) {
                          if($trans_of_id != 0) {
                            echo "add-trans-cat"; 
                          } else {
                            echo "add-cat"; 
                          } 
                        }?>" >
                    <?php if(strcmp($act,"edit") == 0) { ?> 
                      
                      <input type="hidden" id="ID_user" name="ID_user" value="<?php echo $id_get_user; ?>" >
                    <?php } ?>

                    <?php if($trans_of_id != 0) { ?> 
                    
                      <input type="hidden" id="itemLingua" name="itemLingua" value="<?php echo $lingua; ?>" >
                    <?php } ?>   

                    <input type="hidden" id="imgProfile" name="imgProfile" value="<?php echo $imgHidden; ?>" >

                    <div class="box-body no-padding">

                    <div class="row">

                    <div class="col-md-8">

                      <div class="box-body pad ">

                        <div class="form-group">
                          <label for="titolo">Email *</label>
                          <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Email" value="<?php echo $Email; ?>" autocomplete="on" >
                        </div>

                      <div class="form-group">
                          <label for="titolo">Nome *</label>
                          <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Nome" value="<?php echo $Nome; ?>" autocomplete="on" >
                        </div>

                      <div class="form-group">
                          <label for="titolo">Password *</label>
                          <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Password" value="<?php echo $Password; ?>" autocomplete="on" >
                        </div>


                      </div><!-- /.box-body -->

                    </div><!-- /.col-md-6 -->

                    <div class="col-md-4">

                      <div class="box-body pad ">

                          <div class="form-group">
                            <label>Stato</label>

                            attivo 
                            <input type="radio" name="stato" value="1" <?php echo $flagSelStato1; ?> />
                            <input type="radio" name="stato" value="0" <?php echo $flagSelStato0; ?>  /> non attivo
     
                          </div>

                          <div class="form-group">

                            <label>Proprietario</label>
                            sì 
                            <input type="radio" name="proprietario" value="1" <?php echo $flagSelProprietario1; ?>  />
                            <input type="radio" name="proprietario" value="0" <?php echo $flagSelProprietario0; ?> /> no
     
                          </div>

                          <div class="form-group">

                            <label>Ospite</label>
                            sì 
                            <input type="radio" name="ospite" value="1" <?php echo $flagSelOspite1; ?>  />
                            <input type="radio" name="ospite" value="0" <?php echo $flagSelOspite0; ?> /> no
     
                          </div>


                          <hr id="line">


                          <div class="form-group">
                            <label>Lingua</label>
                            <select name="itemLingua" class="form-control select2" style="width: 50%;" <?php if((strcmp($act,"edit") == 0) || ($trans_of_id != 0)) { echo "disabled"; }  // se non ho un'id dell'item da tradurre ?> > <!-- selected="selected" -->

                              <?php 
                              for($z = 0; $z < count($_SESSION['lingua']); $z++) {
                                echo "<option value=\"".$_SESSION['lingua'][$z]."\" ";
                                if(strcmp($lingua, $_SESSION['lingua'][$z]) == 0 ) { echo "selected"; }
                                echo " >".$_SESSION['lingua'][$z]."</option>";
                              }
                              ?>                            
                              
                            </select>
                          </div>

                          <hr id="line">
                     
                          <div class="form-group">
                            <label>Seleziona immagine</label><br/>
                            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                            <div id="image_preview" class="imageThumb profile" ><img id="previewing" src="<?php echo $imgEvidenza; ?>" style="width:100px;" /></div>
                            <div id="selectImage">
                            <input type="file" name="fileUp" id="fileUp" required /><br/>
                            <button id="submitUpload" class="btn btn-primary" />Carica immagine</button>
                            </div>
                            </form>
                            <hr id="line">
                            <h4 id='loading' style="display:none;" >loading...</h4>
                            <div id="message"></div> 

                          </div>


                      </div><!-- /.box-body -->

                    </div><!-- /.col-md-3 -->

                    </div><!-- /.row -->  

                    </div><!-- /.box-body -->

                    <div class="box-footer with-border">
                      <a href="categoria-users.php?act=load" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Torna alla lista Utenti</a>
                      <button type="submit" id="submitForm" class="btn btn-info pull-right">Ok, <?php echo $label_tit; ?></button>
                    </div>

                  </form>

                  </div> <!-- /chart tab-pane ITA -->


                  <div class="chart tab-pane" id="cont-eng" >
                  <form id="addMeta" name="addMeta" method="post" >
                    <input type="hidden" id="act" name="act" value="add-meta" >

                    <div class="box-body no-padding">

                    <div class="row">


                    </div><!-- /.row -->  

                    </div><!-- /.box-body -->

                    <div class="box-footer with-border">
                      <a href="categoria-page.php?act=load" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Torna alla lista Utenti</a>
                      <button type="submit" id="submitFormMeta" class="btn btn-info pull-right">Ok, aggiungi metadati</button>
                    </div>

                  </form>

                  </div> <!-- /chart tab-pane ENG -->


                </div>  <!-- /tab-content -->
              </div><!-- /.nav-tabs-custom -->

        <?php
        }
        ?>
   
              </div><!-- /. box-primary -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

      <?php include('inc-footer.php'); ?>

      <?php include('inc-scripts.php'); ?>

      <script src="./js/script.js"></script>

      <script type="text/javascript">
      <!--
      $('#ajax-loader').css('visibility','hidden');
      $('#resultOK').css('display','none');
      $('#resultKO').css('display','none');

      var act = getUrlParameter('act');

      var datastring = "";
      var now_page = 1;
      var itemPerP = 10;
      var lingua = '<?php echo $_SESSION['predef_lingua']; ?>';
      // search data typing
      var timeoutID = null;

      var tipoData = "USERS";

      $(document).ready(function(e) {

        // inizializzo gli editor nel form ADD
        if((act == "add") || (act == "edit")) {
          CKEDITOR.replace('editor1' , {
            customConfig: 'custom/ckeditor_config.js'
          });

          CKEDITOR.replace('editorSeo' , {
            customConfig: 'custom/ckeditor_config.js'
          });
        }

        // visualizzazione iniziale utenti
        showData(now_page, itemPerP, tipoData, lingua, 0);

        // disabilito il bottone visualizzazione ricorsiva al caricamento della pagina
        $('#noRecursiveBt').prop("disabled", true);

        // funzione ricerca
        function findString(strSearch) {
          lingua = $('.dropLingua').val();
          showData(now_page, itemPerP, tipoData, lingua, 0, strSearch);
        }

        $('#searchBox').keyup(function(e) {
          clearTimeout(timeoutID);
          timeoutID = setTimeout(findString.bind(undefined, e.target.value), 500);
        });

        // submit form ADD
        $( "#submitForm" ).click(function(e) {
          e.preventDefault();

          hideError();
          hideOk();

          // validazione campi
          if (document.addForm.titolo.value == "")  {

            showError("I Campi non possono essere vuoti!");
            return false;
          
          } else {

            // aggiorno il valore degli editor altrimenti non lo vedo nel datastring
            CKEDITOR.instances.editor1.updateElement();
            CKEDITOR.instances.editorSeo.updateElement();
            datastring = $("#addForm").serialize();

            console.log("datastring "+datastring);

            $.ajax({
              type: "POST",
              url: "ajax/addedit.php",
              data: datastring,
              dataType: "json",
              beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
              success: function(data) {
                if(data.status == 1) {
                  showOk(data.mess);
                } else {
                  showError(data.mess);
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


        /* IMMAGINE IN EVIDENZA */

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
              document.addForm.imgProfile.value = data.imgurl;
              $("#message").html(data.txt);
            },
            error: function() {
              $("#message").html("<div class=\"callout callout-danger\">Errore invio data...</div>");
            }
          });
        }));

        /* END UPLOAD IMAGE */


      });  


      // click Refresh bt
      $('#refreshBt').click(function(e) {
        e.preventDefault();
        showData(now_page, itemPerP, tipoData , lingua, 0);
      });

      // click vista NON ricorsiva
      $('#noRecursiveBt').click(function(e) {
        e.preventDefault();
        $(this).prop("disabled", true);
        $('#recursiveBt').prop("disabled", false);
        lingua = $('.dropLingua').val();
        showData(now_page, itemPerP, tipoData, lingua, 0);  // in js/script.js
      });

      // click vista ricorsiva
      $('#recursiveBt').click(function(e) {
        e.preventDefault();
        $(this).prop("disabled", true);
        $('#noRecursiveBt').prop("disabled", false);
        lingua = $('.dropLingua').val();
        showData(now_page, itemPerP, tipoData, lingua, 1); // in js/script.js
      });
  

      // click Trash bt
      $('#trashBt').click(function(e) {
        e.preventDefault();
        hideError(); // in js/script.js
        hideOk(); // in js/script.js
        var checkboxValues = [];
        $('input[type="checkbox"]:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });

        removeData(checkboxValues, tipoData ); // in js/script.js
      });

      </script>

</html>
