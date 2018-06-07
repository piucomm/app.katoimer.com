<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";
controllo_sessione();

$act = "load";

if(isset($_GET['act']) && ($_GET['act'] != "" )) {
  $act = $_GET['act'];
}

if(isset($_GET['id_cat']) && ($_GET['id_cat'] != "" )) {
  $id_get_cat = $_GET['id_cat']; // ricevuto dal pulsante Edit categoria
}

?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php include('inc-meta.php'); ?>

    <title>Admin | Dashboard</title>
    <meta name="description" content="">

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
            Categorie
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li><a href="#">Categorie</a></li>
            <!--  <li class="active">Blank page</li> -->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">

            <div class="callout callout-info" id="resultOK" >
              <h4>OK</h4>
              <p></p>
            </div>

            <div class="callout callout-danger" id="resultKO" >
              <h4>Errore</h4>
              <p></p>
            </div>    

            <div class="box box-primary">

            <?php 
            /* VISUALIZZA */
            if(strcmp($act,"load") == 0) {
            ?>
                <div class="box-header with-border">
                  <a href="categoria-page.php?act=add" class="btn btn-primary margin-bottom"><i class="fa fa-plus-circle" aria-hidden="true"></i> Aggiungi Categoria</a>
                  <div class="box-tools pull-right">

                    <div class="btn-group">
                      <!-- <select id="dropItemsNumber">
                        <option value="1" >1</option>
                        <option value="10" selected >10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select> -->

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
                    <button class="btn btn-default btn-sm" id="refreshBt" ><i class="fa fa-refresh"></i></button>
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

                    <div class="pull-right paginationRow">
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

          $flagSelP1 = "checked=\"checked\"";  // pubblica
          $flagSelP2 = "";
          $flagSelE1 = "";  // evidenza
          $flagSelE2 = "checked=\"checked\"";

          if (strcmp($act,"edit") == 0) { // edit fields
                        
            $stmtup = $connup->stmt_init();

            $stmtup->prepare("SELECT C.Titolo,C.Titolo_eng,C.Titolo_fra,C.Titolo_de, C.Descrizione, C.Descrizione_eng, C.Descrizione_fra, C.Descrizione_de,C.ID_padre,  C.Pubblica, C.Ordine, C.Evidenza
                              FROM categorie C
                              WHERE C.ID_cat = ?");
            if ($stmtup === false) {
              echo "err 0";
            }
            $stmtup->bind_param("i", $id_get_cat);

            $errstat = $stmtup->execute();
            if ($errstat === false) {
              echo "err 1";
            }
            $stmtup->store_result();
            $stmtup->bind_result($Titolo,$Titolo_eng,$Titolo_fra,$Titolo_de, $Descrizione, $Descrizione_eng, $Descrizione_fra, $Descrizione_de, $ID_padre,  $Pubblica, $Ordine, $Evidenza);
            $total_res = $stmtup->num_rows; // numero risultati

            echo "Tot: ".$total_res;

            if($Pubblica == 0): $flagSelP1 = ""; $flagSelP2 = "checked=\"checked\""; endif;
            if($Evidenza == 1): $flagSelE1 = "checked=\"checked\""; $flagSelE2 = ""; endif;

            echo "tit: ".$Titolo_eng;

            mysqli_stmt_close($stmtup); 
            $label_tit = "Modifica";   
                            
          } else {  // add fields
            $ID_padre = 100000;
            $label_tit = "Aggiungi";
          }

        ?>

              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <?php if(strcmp($act,"edit") == 0) { ?><li><a href="#meta" data-toggle="tab">Metadati</a></li><?php } ?>
                  <li class="active"><a href="#cont" data-toggle="tab">Contenuto</a></li>
                  <li class="pull-left header"><?php echo $label_tit; ?> Categoria</li>
                </ul>
                <div class="tab-content ">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="cont" >

                  <form id="addForm" name="addForm" method="post" >
                    <input type="hidden" id="act" name="act" value="add-cat" >

                    <div class="box-body no-padding">

                    <div class="row">

                    <div class="col-md-6">

                      <div class="box-body pad ">

                          <div class="form-group">
                            <label for="tit1">Titolo ITA *</label>
                            <input type="text" class="form-control" id="tit1" name="tit1" placeholder="Titolo ITA" value="<?php echo $Titolo; ?>" autocomplete="on" >
                          </div>

                          <div class="form-group">
                            <label for="tit2">Titolo ENG</label>
                            <input type="text" class="form-control" id="tit2" name="tit2" placeholder="Titolo ENG" value="<?php echo $Titolo_eng; ?>" autocomplete="on"  >
                          </div>

                      </div><!-- /.box-body -->

                    </div><!-- /.col-md-6 -->

                    <div class="col-md-6">

                      <div class="box-body pad ">
                          
                          <div class="form-group">
                            <label>Categoria padre</label>
                            <?php

                            $stmtsel = $connup->stmt_init();

                            $stmtsel->prepare("SELECT C.ID_cat, C.Titolo,C.Titolo_eng,C.Titolo_fra,C.Titolo_de, C.Descrizione, C.Descrizione_eng, C.Descrizione_fra, C.Descrizione_de, C.Pubblica, C.Ordine, C.Evidenza
                                              FROM categorie C
                                              WHERE C.Attiva = 1 "); 

                            $stmtsel->bind_param("i", $attiva);
                            $stmtsel->execute();

                            $stmtsel->store_result();
                            $stmtsel->bind_result($ID_cat2,$Titolo2,$Titolo_eng2,$Titolo_fra2,$Titolo_de2, $Descrizione2, $Descrizione_eng2, $Descrizione_fra2, $Descrizione_de2, $Pubblica2, $Ordine2, $Evidenza2 ); 
                            $total_res2 = $stmtsel->num_rows; // numero risultati

                            if($_SESSION['lingua']['it'] == 1){
                              $princ_tit = $Titolo2;
                              $princ_desc = $Descrizione2;
                            } else {
                              if($_SESSION['lingua']['en'] == 1){
                                $princ_tit = $Titolo_eng2;
                                $princ_desc = $Descrizione_eng2;
                              }
                            }

                            if($total_res2 > 0) {
                            ?>
                            <select name="itemPadre" class="form-control select2" style="width: 50%;"> <!-- selected="selected" -->
                              <?php     
                              while($stmtsel->fetch()){ 
                              ?>
                              <option value="<?php echo $ID_cat2; ?>" <?php if($ID_cat2 == $ID_padre ) { echo "selected"; } ?> ><?php echo $Titolo2; ?></option>
                              <?php
                              } // while
                              ?>  
                            </select>
                            <?php 
                            }

                            mysqli_stmt_close($stmtsel);      
                            $connup->close();
                            ?>
                          </div>

                          <div class="form-group">
                            <label>Pubblica</label>

                            sì 
                            <input type="radio" name="pubb1" value="1" <?php echo $flagSelP1; ?> />
                            <input type="radio" name="pubb1" value="0" <?php echo $flagSelP2; ?>  /> no
     
                          </div>

                          <div class="form-group">

                            <label>In evidenza</label>
                            sì 
                            <input type="radio" name="evid1" value="1" <?php echo $flagSelE1; ?>  />
                            <input type="radio" name="evid1" value="0" <?php echo $flagSelE2; ?> /> no
     
                          </div>

                          <div class="form-group">
                            <label for="ordine">Ordine</label>
                            <input type="text" class="form-control" id="ordine" name="ordine" placeholder="0" value="" style="width: 20%;"  autocomplete="on"  >
     
                          </div>                        
                          
                      </div><!-- /.box-body -->

                    </div><!-- /.col-md-6 -->

                    <div class="col-md-12">

                      <div class="box-body pad ">

                      <div class="form-group">
                        <label for="editor1">Descrizione ITA</label>
                        <textarea id="editor1" name="editor1" rows="10" cols="80"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="editor2">Descrizione ENG</label>
                        <textarea id="editor2" name="editor2" rows="10" cols="80"></textarea>
                      </div>

                      </div><!-- /.box-body -->

                    </div> <!-- /.col-md-12 -->

                  </div><!-- /.row -->  

                    </div><!-- /.box-body -->

                    <div class="box-footer with-border">
                      <a href="categoria-page.php?act=load" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Torna alla lista Categorie</a>
                      <button type="submit" id="submitForm" class="btn btn-info pull-right">Ok, <?php echo $label_tit; ?></button>
                    </div>

                  </form>

                  </div> <!-- /chart tab-pane -->



                  <div class="chart tab-pane" id="meta" >
                  <form id="addMeta" name="addMeta" method="post" >
                    <input type="hidden" id="act" name="act" value="add-meta" >

                    <div class="box-body no-padding">

                    <div class="row">

                    <div class="col-md-6">

                      <div class="box-body pad ">

                          <div class="form-group">
                            <label for="tits1">Titolo SEO ITA *</label>
                            <input type="text" class="form-control" id="tits1" name="tits1" placeholder="Titolo ITA" value="" >
                          </div>

                          <div class="form-group">
                            <label for="tits2">Titolo SEO ENG *</label>
                            <input type="text" class="form-control" id="tits2" name="tits2" placeholder="Titolo ENG" value="" >
                          </div>

                      </div><!-- /.box-body -->

                    </div><!-- /.col-md-6 -->

                    <div class="col-md-6">

                      <div class="box-body pad ">

                          <div class="form-group">
                            <label for="ks1">Keyword ITA *</label>
                            <input type="text" class="form-control" id="ks1" name="ks1" placeholder="Keyword ITA" value="" >
                          </div>

                          <div class="form-group">
                            <label for="ks2">Keyword SEO ENG *</label>
                            <input type="text" class="form-control" id="ks2" name="ks2" placeholder="Keyword ENG" value="" >
                          </div>

                      </div><!-- /.box-body -->

                    </div><!-- /.col-md-6 -->

                    <div class="col-md-12">

                      <div class="box-body pad ">

                      <div class="form-group">
                        <label for="editor11">Meta Description ITA</label>
                        <textarea id="editor11" name="editor11" rows="4" cols="80"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="editor22">Meta Description ENG</label>
                        <textarea id="editor22" name="editor22" rows="4" cols="80"></textarea>
                      </div>

                      </div><!-- /.box-body -->

                    </div> <!-- /.col-md-12 -->

                  </div><!-- /.row -->  

                    </div><!-- /.box-body -->

                    <div class="box-footer with-border">
                      <a href="categoria-page.php?act=load" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Torna alla lista Categorie</a>
                      <button type="submit" id="submitFormMeta" class="btn btn-info pull-right">Ok, aggiungi metadati</button>
                    </div>

                  </form>

                  </div> <!-- /chart tab-pane -->
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

      $(document).ready(function(e) {

        // inizializzo gli editor nel form ADD
        if((act == "add") || (act == "edit")) {
          CKEDITOR.replace('editor1');
          CKEDITOR.replace('editor2');
          CKEDITOR.replace('editor11');
          CKEDITOR.replace('editor22');
        }

        showData(now_page, itemPerP,"categorie");

        // search data typing
        var timeoutID = null;

        function findMember(strSearch) {
          showData(now_page, itemPerP, "categorie", strSearch);
        }

        $('#searchBox').keyup(function(e) {
          clearTimeout(timeoutID);
          timeoutID = setTimeout(findMember.bind(undefined, e.target.value), 500);
        });

        // submit form ADD
        $( "#submitForm" ).click(function(e) {
          e.preventDefault();

          hideError();
          hideOk();

          // validazione campi
          if (document.addForm.tit1.value == "")  {

            showError("I Campi non possono essere vuoti!");
            return false;
          
          } else {

            // aggiorno il valore degli editor altrimenti non lo vedo nel datastring
            CKEDITOR.instances.editor1.updateElement();
            CKEDITOR.instances.editor2.updateElement();
            CKEDITOR.instances.editor11.updateElement();
            CKEDITOR.instances.editor22.updateElement();
            datastring = $("#addForm").serialize();

            console.log("datastring "+datastring);

            $.ajax({
              type: "POST",
              url: "ajax/add.php",
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

      });  


      // click Refresh bt
      $('#refreshBt').click(function(e) {
        e.preventDefault();
        showData(now_page, itemPerP, "categorie");
      });


      // click Trash bt
      $('#trashBt').click(function(e) {
        e.preventDefault();
        hideError();
        hideOk();
        var checkboxValues = [];
        $('input[type="checkbox"]:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });

        removeData(checkboxValues, "categorie");
      });

      </script>

</html>
