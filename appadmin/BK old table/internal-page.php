<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";
controllo_sessione();

include "./paginate.php";

$act = "load";

if(isset($_GET['act']) && ($_GET['act'] != "" )) {
  $act = $_GET['act'];
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
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Ricerca">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <?php 
                $pubblica = 1;
                $id_padre = 1;  // Il padre di tutti è Menu con ID = 1
    
                /*
                $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                $pagObj = new Pagination($actual_link,$per_page,$total_results,$page);
                echo "eccomiiii... ".$pagObj->getLinks(); */

                ?>
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle" id="selectAllBt" ><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" id="trashBt" ><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm" id="refreshBt" ><i class="fa fa-refresh"></i></button>
                    <div class="pull-right paginationRow">

                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">

                    <table id="showDataQuery"  class="table table-hover table-striped">

                    </table><!-- /.table -->
                    
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <button class="btn btn-default btn-sm checkbox-toggle" id="selectAllBt" ><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" id="trashBt2" ><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                    <div class="pull-right paginationRow">
                    </div><!-- /.pull-right -->
                  </div>
                </div>
                <?php 
                ?>

        <?php 
        /* AGGIUNGI */
        } else if(strcmp($act,"add") == 0) {
        ?>

              <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#meta" data-toggle="tab">Metadati</a></li>
                  <li class="active"><a href="#cont" data-toggle="tab">Contenuto</a></li>
                  <li class="pull-left header">Aggiungi Categoria</li>
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
                            <input type="text" class="form-control" id="tit1" name="tit1" placeholder="Titolo ITA" value="" >
                          </div>

                          <div class="form-group">
                            <label for="tit2">Titolo ENG *</label>
                            <input type="text" class="form-control" id="tit2" name="tit2" placeholder="Titolo ENG" value="" >
                          </div>

                      </div><!-- /.box-body -->

                    </div><!-- /.col-md-6 -->

                    <div class="col-md-6">

                      <div class="box-body pad ">
                          
                          <div class="form-group">
                            <label>Categoria padre</label>
                            <?php
                            $pubblica = 1;
                            $id_padre = 1;  // Il padre di tutti è Menu con ID = 1

                            $conn = db_connect();

                            $stmt = $conn->stmt_init();

                            $stmt->prepare("SELECT C.Titolo,C.Titolo_eng,C.Titolo_fra,C.Titolo_de
                                              FROM categorie C
                                              WHERE C.Pubblica = ? AND C.ID_padre = ? "); // 
                            $stmt->bind_param("ii", $pubblica, $id_padre);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($Titolo,$Titolo_eng,$Titolo_fra,$Titolo_de); 
                            $total_res = $stmt->num_rows; // numero risultati

                            if($_SESSION['lingua']['it'] == 1){
                              $princ_tit = $Titolo;
                              $princ_desc = $Descrizione;
                            } else {
                              if($_SESSION['lingua']['en'] == 1){
                                $princ_tit = $Titolo_eng;
                                $princ_desc = $Descrizione_eng;
                              }
                            }

                            if($total_res > 0) {
                            ?>
                            <select class="form-control select2" style="width: 50%;"> <!-- selected="selected" -->
                              <?php     
                              while($stmt->fetch()){ 
                              ?>
                              <option ><?php echo $Titolo; ?></option>
                              <?php
                              } // while
                              ?>  
                            </select>
                            <?php 
                            }

                            mysqli_stmt_close($stmt);      
                            $conn->close();
                            ?>
                          </div>

                          <div class="form-group">
                            <label>Pubblica</label>
                            <div class="iradio_minimal-blue disabled" aria-checked="false" aria-disabled="true" style="position: relative;">
                            <input type="radio" name="r1" class="minimal" disabled="" style="position: absolute; opacity: 0;">
                            <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                            </div>
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
                      <button type="submit" id="submitForm" class="btn btn-info pull-right">Ok, aggiungi</button>
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
                      <button type="submit" id="submitForm" class="btn btn-info pull-right">Ok, aggiungi metadati</button>
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
      var datastring = "";

      var act = getUrlParameter('act');
      var now_page = 1;
      if((getUrlParameter('page') != "") && (getUrlParameter('page') != undefined ) ) { now_page = getUrlParameter('page'); }

      console.log(now_page);

      $(document).ready(function(e) {

        // inizializzo gli editor nel form ADD
        if(act == "add") {
          CKEDITOR.replace('editor1');
          CKEDITOR.replace('editor2');
          CKEDITOR.replace('editor11');
          CKEDITOR.replace('editor22');
        }

        showData(now_page);

        // submit form ADD
        $( "#submitForm" ).click(function(e) {
          e.preventDefault();

          $('#resultOK').css('display','none');
          $('#resultKO').css('display','none');

          if ( document.addForm.tit1.value == "" )  {

            showError("I Campi non possono essere vuoti!");
            return false;
          
          } else {

            CKEDITOR.instances.editor1.updateElement();
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

      });  


      function showOk(okMsg){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $('#resultOK').css('display','block');
        $('#resultOK p').html(okMsg);
      }

      function hideOk(){
        $('#resultOK').css('display','none');
      }   

      function showError(errMsg){
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $('#resultKO').css('display','block');
        $('#resultKO p').html(errMsg);
      }

      function hideError(){
        $('#resultKO').css('display','none');
      }      

      // click Refresh bt
      $('#refreshBt').click(function(e) {
        e.preventDefault();
        location.reload();
      });

      function showData(indexPage){

        var sendInfo = {
           Page: indexPage,
           Padre: 1,
           Pubblica: 1,
           ItemPerPage: 1
        };

        var jsonString = JSON.stringify(sendInfo);

        $.ajax({
              type: "POST",
              url: "ajax/show.php",
              data: {data : jsonString},
              dataType: "json",
              beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
              success: function(data) {
                $('#ajax-loader').css('visibility','hidden');
                if(data.status == 1) {
                  $('#showDataQuery').html(data.msg);
                  $('.paginationRow').html(data.pag);
                } else {
                  showError(" Loading data show: "+data.msg);
                }

              },
              error: function() {
                $('#ajax-loader').css('visibility','hidden');
                $('#resultKO').css('display','block');
                showError("Ajax sending data show...");
              }
        });
        
      }

      // click Trash bt
      $('#trashBt').click(function(e) {
        e.preventDefault();
        hideError();
        hideOk();
        var checkboxValues = [];
        $('input[type="checkbox"]:checked').each(function(index, elem) {
            checkboxValues.push($(elem).val());
        });

        var jsonString = JSON.stringify(checkboxValues);
        console.log(jsonString);

        if (checkboxValues.length != 0) {
          var r = confirm("Vuoi davvero eliminare?");
          if (r == true) {
            //alert(checkboxValues.join(', '));
            $.ajax({
              type: "POST",
              url: "ajax/delete.php",
              data: {data : jsonString},
              dataType: "json",
              beforeSend: function(x){$('#ajax-loader').css('visibility','visible');},
              success: function(data) {
                $('#ajax-loader').css('visibility','hidden');
                if(data.status == 1) {
                  showOk(data.msg);
                  showData();
                } else {
                  showError(" data : "+data.msg);
                }

              },
              error: function() {
                $('#ajax-loader').css('visibility','hidden');
                $('#resultKO').css('display','block');
                showError("Ajax sending data...");
              }
            });
            return false;
          } else {
            return false;
          }
        } else {
          showError("Selezionare almeno un contenuto da eliminare...");
        }
      });

      </script>

</html>
