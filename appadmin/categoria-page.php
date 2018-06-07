<?php
session_cache_expire(30);
session_start();

ini_set('error_reporting', E_ALL);

include "./data/connection.php";
controllo_sessione();

$dir_site = "/appadmin";

$act = "load";
$Type = "CAT";
$ID_padre = 1;
$lingua = $_SESSION['predef_lingua'];

$class_status="display:none;";

if(isset($_GET['act']) && ($_GET['act'] != "" )) {
  $act = $_GET['act'];
}

if(isset($_GET['statusmess']) && ($_GET['statusmess'] != "" )) {
  $status = $_GET['statusmess'];
}

if(isset($_GET['txtmess']) && ($_GET['txtmess'] != "" )) {
  $textstatus = $_GET['txtmess'];
}

if(isset($_GET['id_cat']) && ($_GET['id_cat'] != "" )) {
  $id_get_cat = $_GET['id_cat']; // id categoria in edit/add
}

if(isset($_GET['id_item']) && ($_GET['id_item'] != "" )) {
  $id_get_item = $_GET['id_item']; // id item  in edit/add
}

if(isset($_GET['lingua']) && ($_GET['lingua'] != "" )) {
  $lingua = $_GET['lingua']; // lingua per modifica e aggiungi
} 

if(isset($_GET['trans_of_id']) && ($_GET['trans_of_id'] != "" )) {
  $trans_of_id = $_GET['trans_of_id']; // id item in aggiunta traduzione
  $trans_of_title = $_GET['trans_of_item'];  // title dell'item da tradurre
  $trans_of_img = $_GET['trans_of_img'];  // immagine principale dell'item da tradurre
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
      <section class="sidebar">
        <?php require_once('inc-menu-sx.php'); ?>
      </section><!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">

        <h1> Catalogo <small></small></h1>
        
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
          <li><a href="./categoria-page.php?act=load">Catalogo</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">

            <?php if((isset($status)) && ($status == 1)): $class_status="display:block;"; ?>
            <div class="callout callout-info" id="resultOK" style="<?php echo $class_status; ?>" >
              <h4>Azione effettuata</h4>
              <p><?php echo $textstatus; ?></p>
            </div>
            <?php endif; ?>

            <?php if((isset($status)) && ($status == 0)): $class_status="display:block;"; ?>
            <div class="callout callout-danger" id="resultKO" style="<?php echo $class_status; ?>"  >
              <h4>Errore</h4>
              <p><?php echo $textstatus; ?></p>
            </div>
            <?php endif; ?>

            <div class="box box-primary">

            <?php 
            /* VISUALIZZA */
            if(strcmp($act,"load") == 0) {
            ?>
              <div class="box-header with-border">
                <button class="btn btn-primary margin-bottom" id="addBt" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Aggiungi Contenuto</button>
                
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
                  <div class="btn-group">
                    <!-- vista ricorsiva e non -->
                    <button class="btn btn-default btn-sm" id="noRecursiveBt" title="Vista non ricorsiva" ><i class="fa fa-align-justify" aria-hidden="true"></i></button>
                    <button class="btn btn-default btn-sm" id="recursiveBt" title="Vista ricorsiva" ><i class="fa fa-indent" aria-hidden="true"></i></button>
                  </div><!-- /.btn-group -->

                  <div class="pull-right paginationRow">
                      <!-- ajax data... -->
                  </div><!-- /.pull-right -->

                </div><!-- /.ailbox-controls -->
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
            /* AGGIUNGI o MODIFICA */
            } else if((strcmp($act,"add") == 0) || (strcmp($act,"edit") == 0)) {

              $connup = db_connect();

              $flagSelP1 = "checked=\"checked\"";  // pubblica
              $flagSelP2 = "";
              $flagSelE1 = "";  // evidenza
              $flagSelE2 = "checked=\"checked\"";

              if (strcmp($act,"edit") == 0) { // edit fields
                          
              $stmtup = $connup->stmt_init();

              $stmtup->prepare("SELECT I.Titolo,I.Sottotitolo, I.Descrizione, I.Immagine, C.ID_padre, I.Pubblica, I.Ordine, I.Evidenza, C.Type, I.Attributi
                  FROM tbl_category C, tbl_items I
                  WHERE C.ID = I.ID_cat AND I.ID_item = ?");

              $stmtup->bind_param("i", $id_get_item);
              $stmtup->execute();

              $stmtup->store_result();
              $stmtup->bind_result($Titolo,$Sottotitolo, $Descrizione, $imgEvidenza, $ID_padre,  $Pubblica, $Ordine, $Evidenza, $Type, $Attributi);
              $total_res = $stmtup->num_rows; // numero risultati
              
              $stmtup->fetch();

              $arrayAttributi = unserialize($Attributi);

              $imgHidden = $imgEvidenza;

              if($imgEvidenza == '') { $imgEvidenza = $dir_site."/img/noimage-profile.png"; } else { $imgEvidenza = $dir_site."/upload/thumb-".$imgEvidenza; }

              if($Pubblica == 0): $flagSelP1 = ""; $flagSelP2 = "checked=\"checked\""; endif;
              if($Evidenza == 1): $flagSelE1 = "checked=\"checked\""; $flagSelE2 = ""; endif;
              
              mysqli_stmt_close($stmtup); 

              /* galleria immagini 
              $stmtimg = $connup->stmt_init();

              $stmtimg->prepare("SELECT G.ID_image, G.URL, G.Tag
                                FROM tbl_gallery G
                                WHERE G.ID_item = ?");

              $stmtimg->bind_param("i", $id_get_item);
              $stmtimg->execute();

              $stmtimg->store_result();
              $stmtimg->bind_result($ID_image, $URL, $Tag);
              $total_img = $stmtimg->num_rows; // numero risultati
              
              $stmtimg->fetch();

              //if(strcmp($Tag, "") == 0): $imgEvidenza = $URL; endif;
              $imgEvidenza = $URL;
               
              mysqli_stmt_close($stmtimg);  */

              $label_tit = "Modifica";   
                            
            } else if (strcmp($act,"add") == 0) {  // add fields
              $label_tit = "Aggiungi";
            
              if($trans_of_id != 0) {
                $label_tit = "Traduci";
                $imgEvidenza = "https://app.katoimer.com/appadmin/upload/".$trans_of_img;
                $imgHidden = $trans_of_img;
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
                  <li class="pull-left header"><?php echo $label_tit; ?> Contenuto</li>
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
                      <input type="hidden" id="ID_cat" name="ID_cat" value="<?php echo $id_get_cat; ?>" >
                      <input type="hidden" id="ID_item" name="ID_item" value="<?php echo $id_get_item; ?>" >
                    <?php } ?>

                    <?php if($trans_of_id != 0) { ?> 
                      <input type="hidden" id="ID_cat" name="ID_cat" value="<?php echo $id_get_cat; ?>" >
                      <input type="hidden" id="itemLingua" name="itemLingua" value="<?php echo $lingua; ?>" >
                    <?php } ?>   

                  <input type="hidden" id="imgProfile" name="imgProfile" value="<?php echo $imgHidden; ?>" >                 

                  <div class="box-body no-padding">

                    <div class="row">

                      <div class="col-md-9">

                        <div class="box-body pad ">

                          <div class="form-group">
                            <label for="titolo">Titolo *</label>
                            <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Titolo" value="<?php echo $Titolo; ?>" autocomplete="on" >
                          </div>

                          <div class="form-group">
                              <label for="sottotitolo">Sottotitolo</label>
                              <input type="text" class="form-control" id="sottotitolo" name="sottotitolo" placeholder="sottotitolo" value="<?php echo $Sottotitolo; ?>" autocomplete="on" >
                            </div>

                          <div class="form-group">
                            <label for="editor1">Descrizione</label>
                            <textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $Descrizione; ?></textarea>
                          </div>

                        </div><!-- /.box-body -->

                      </div><!-- /.col-md-9 -->

                      <div class="col-md-3">

                        <div class="box-body pad ">

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
                              <input type="text" class="form-control" id="ordine" name="ordine" placeholder="0" value="<?php echo $Ordine; ?>" style="width: 20%;"  autocomplete="on"  >
       
                            </div>   

                            <hr id="line">

                            <div class="form-group">
                              <label>Categoria padre </label>
                              <?php
                              $stmtsel = $connup->stmt_init();

                              $stmtsel->prepare("SELECT C.ID, I.Titolo, I.Descrizione, I.Pubblica, I.Ordine, I.Evidenza
                                                FROM tbl_category C, tbl_items I
                                                WHERE C.ID = I.ID_cat AND I.Attiva = 1 AND C.Type LIKE 'CAT' AND I.Lingua LIKE ? "); 

                              $stmtsel->bind_param("s", $lingua);
                              $stmtsel->execute();

                              $stmtsel->store_result();
                              $stmtsel->bind_result($ID_cat2,$Titolo2,$Descrizione2, $Pubblica2, $Ordine2, $Evidenza2 ); 
                              $total_res2 = $stmtsel->num_rows; // numero risultati

                              if($total_res2 > 0) {
                              ?>
                              <select name="itemPadre" class="form-control select2" style="width: 50%;" <?php if($trans_of_id != 0) { echo "disabled"; }  // se non ho un'id dell'item da tradurre ?>  >
                                <?php     
                                while($stmtsel->fetch()){ 
                                ?>
                                  <option value="<?php echo $ID_cat2; ?>" <?php if($ID_cat2 == $ID_padre ) { echo " selected=\"selected\" "; } ?> >
                                  <?php echo $Titolo2; ?></option>
                                <?php
                                } // while
                                ?>  
                              </select>
                              <?php 
                              }

                              mysqli_stmt_close($stmtsel);      
                              $stmtsel->close();
                              ?>
                            </div>

                            <div class="form-group">
                              <label>Tipologia</label>
                              <select name="itemType" class="form-control select2" style="width: 50%;" <?php if($trans_of_id != 0) { echo "disabled"; }  // se non ho un'id dell'item da tradurre ?> > <!-- selected="selected" -->
                                <option value="CAT" <?php if(strcmp($Type, "CAT") == 0 ) { echo "selected"; } ?> >CATEGORIA</option>
                                <option value="ITEM" <?php if(strcmp($Type, "ITEM") == 0 ) { echo "selected"; } ?> >ARTICOLO</option>
                                <option value="MENU" <?php if(strcmp($Type, "MENU") == 0 ) { echo "selected"; } ?> >MENU</option>
                              </select>
                            </div>

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

                            <div class="form-group">
                              <label>Tonnellaggio </label>
                              <select name="itemTonn" class="form-control select2" style="width: 80%;" >
                                
                                <option value="0.9 - 2.7 Tons" <?php if(strcmp($arrayAttributi['tonn'], "0.9 - 2.7 Tons") == 0 ) { echo "selected"; } ?> >0.9 - 2.7 Tons</option>
                                <option value="3.5 - 5.5 Tons" <?php if(strcmp($arrayAttributi['tonn'], "3.5 - 5.5 Tons") == 0 ) { echo "selected"; } ?> >3.5 - 5.5 Tons</option>
                                <option value="3.0 - 8.5 Tons" <?php if(strcmp($arrayAttributi['tonn'], "3.0 - 8.5 Tons") == 0 ) { echo "selected"; } ?> >3.0 - 8.5 Tons</option>
                                <option disabled>──────────</option>
                                  <option value="400 / 1000 Kg" <?php if(strcmp($arrayAttributi['tonn'], "400 / 1000 Kg") == 0 ) { echo "selected"; } ?> >400 / 1000 Kg</option>
                                  <option value="1500 / 3000 Kg" <?php if(strcmp($arrayAttributi['tonn'], "1500 / 3000 Kg") == 0 ) { echo "selected"; } ?> >1500 / 3000 Kg</option>
                                <option disabled>──────────</option>
                                  <option value="5.5 - 12.0 Tons" <?php if(strcmp($arrayAttributi['tonn'], "5.5 - 12.0 Tons") == 0 ) { echo "selected"; } ?> >5.5 - 12.0 Tons</option>
                                <option disabled>──────────</option>
                                  <option value="330 / 1000 Kg" <?php if(strcmp($arrayAttributi['tonn'], "330 / 1000 Kg") == 0 ) { echo "selected"; } ?> >330 / 1000 Kg</option>
                                <option disabled>──────────</option>
                                  <option value="55 / 570 Kg" <?php if(strcmp($arrayAttributi['tonn'], "55 / 570 Kg") == 0 ) { echo "selected"; } ?> >55 / 570 Kg</option>

                              </select>
                              <?php 
                              //print_r($arrayAttributi);
                              ?>
                            </div>

                        </div><!-- /.box-body -->

                      </div><!-- /.col-md-3 -->

                    </div> <!-- /.row -->

                    <div class="row">

                      <div class="col-md-12">
                        <hr/>
                      </div>

                      <!-- GESTIONE LAYOUT ROW -->
                      <?php
                      $stmtLayout = $connup->stmt_init();

                      $stmtLayout->prepare("SELECT L.ID, L.Nome, L.Descrizione, L.Immagine
                                        FROM tbl_layout L ");
                      $stmtLayout->execute();

                      $stmtLayout->store_result();
                      $stmtLayout->bind_result($ID_layout_all, $Nome_layout, $Descrizione_layout, $Thumb_layout);
                      $total_layout = $stmtLayout->num_rows; // numero risultati

                      if($total_layout > 0) {
                      ?>

                      <div class="col-md-5" >

                        <div class="box-body pad ">

                          <label for="titolo">Tipologia layout:</label><br/><br/>

                          <div class="form-group">
                              <?php
                              while($stmtLayout->fetch()) {
                              ?>
                                <div class="blockRadio <?php if($id_layout == $ID_layout_all): echo "evidBlock"; endif; ?>" >
                                <img src="./img/<?php echo $Thumb_layout; ?>" /><br/>
                                <input type="radio" name="selLayout" value="<?php echo $ID_layout_all; ?>" 
                                <?php if($total_layout == 1): echo "checked=\"checked\"";
                                elseif($id_layout == $ID_layout_all): echo "checked=\"checked\""; endif; ?> />
                                <br/><b><?php echo $Nome_layout; ?></b><br/><small><?php echo $Descrizione_layout;?></small></div>
                              <?php } // while ?>
                          </div>
                        
                        </div><!-- /.box-body -->

                      </div> <!-- /.col-md-5 -->

                      <div class="col-md-4">

                        <div class="box-body pad ">
                            <?php 
                            $flagSelCTA1 = "";
                            $flagSelCTA2 = "checked=\"checked\"";
                            if($arrayLayout['cta'] == 1){ $flagSelCTA1 = "checked=\"checked\""; $flagSelCTA2 = ""; } ?>

                            <div class="form-group">
                              <label>Call to Action</label>
                              si
                              <input type="radio" name="selCta" value="1" <?php echo $flagSelCTA1; ?> />
                              <input type="radio" name="selCta" value="0" <?php echo $flagSelCTA2; ?>  /> no
                            </div>

                            <div class="form-group">
                              <label for="classCss">Classe CSS</label>
                              <input type="text" class="form-control" id="classCss" name="classCss" placeholder="" value="<?php echo $arrayLayout['classCss']; ?>"  >
                            </div>

                            <div class="form-group">
                              <label for="ancora">Ancoraggio</label>
                              <input type="text" class="form-control" id="ancora" name="ancora" placeholder="#" value="<?php echo $arrayLayout['ancora']; ?>"  >
                            </div>   

                        </div><!-- /.box-body -->

                      </div> <!-- /.col-md-4 -->
                      <div class="col-md-3">
                      <?php 
                      } else {
                      ?>
                      <div class="col-md-12">
                      <?php
                      }// if total_layout

                      $stmtLayout->free_result();
                      mysqli_stmt_close($stmtLayout);  
                      $stmtLayout->close();
                      ?>
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
                        </div> <!-- /form-group -->
                      </div> <!-- /.col-md-3 -->

                    </div>

                    </div> <!-- /.row -->

                    <div class="row">

                      <div class="col-md-12">
                        <hr/>
                      </div>

                      <div class="col-md-12">


                      </div>

                    </div>

                    <div class="row" style="display:none;" >
                      <div class="col-md-12">
                        <div class="box-body pad ">
                          <hr/>
                          <div class="form-group">
                            <label for="titSeo">Meta Titolo <small>Max 120 caratteri</small></label>
                            <input type="text" class="form-control" id="titSeo" name="titSeo" placeholder="Titolo SEO" value="" maxlength="120" >
                          </div>

                          <div class="form-group">
                            <label for="keySeo">Meta Keyword <small>Max 120 caratteri</small></label>
                            <input type="text" class="form-control" id="keySeo" name="keySeo" placeholder="Keyword SEO" value="" maxlength="120" >
                          </div>

                          <div class="form-group">
                            <label for="editorSeo">Meta Description <small>Max 200 caratteri</small> </label>
                            <textarea id="editorSeo" name="editorSeo" rows="2" cols="80"></textarea>
                          </div>

                          <div class="form-group">
                            <label for="permaSeo">Permalink</label>
                            <input type="text" class="form-control" id="permaSeo" name="permaSeo" placeholder="Permalink SEO" value="" maxlength="120" >
                          </div>
                          
                        </div><!-- /.box-body -->

                      </div> <!-- /.col-md-12 -->

                    </div><!-- /.row -->  

                  </div><!-- /.box-body -->

                    <div class="box-footer with-border">
                      <a href="categoria-page.php?act=load" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Torna alla lista Contenuti</a>
                      <button type="submit" id="submitForm" class="btn btn-info pull-right">Ok, <?php echo $label_tit; ?></button>
                    </div>

                  </form>

                  </div> <!-- /chart tab-pane ITA -->


                  <div class="chart tab-pane" id="cont-eng" style="display:none;" >
                  <form id="addMeta" name="addMeta" method="post" >
                    <input type="hidden" id="act" name="act" value="add-meta" >

                    <div class="box-body no-padding">

                    <div class="row">

                    </div><!-- /.row -->  

                    </div><!-- /.box-body -->

                    <div class="box-footer with-border">
                      <a href="categoria-page.php?act=load" class="btn btn-default"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Torna alla lista Contenuti</a>
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

      var tipoData = "CAT";

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

        // visualizzazione iniziale categorie
        showData(now_page, itemPerP, tipoData, lingua, 1);

        // disabilito il bottone visualizzazione ricorsiva al caricamento della pagina
        $('#recursiveBt').prop("disabled", true);

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
                  //showOk(data.mess);
                  location.href= "categoria-page.php?act=load&statusmess="+data.status+"&txtmess="+data.msg;
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

      // click aggiungi contenuto
      $('#addBt').click(function(e) {
        e.preventDefault();
        lingua = $('.dropLingua').val();
        window.location.href="categoria-page.php?act=add&lingua="+lingua; 
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
        showData(now_page, itemPerP, tipoData, lingua, 0);
      });

      // click vista ricorsiva
      $('#recursiveBt').click(function(e) {
        e.preventDefault();
        $(this).prop("disabled", true);
        $('#noRecursiveBt').prop("disabled", false);
        lingua = $('.dropLingua').val();
        showData(now_page, itemPerP, tipoData, lingua, 1);
      });
  

      // click Trash bt
      $('#trashBt').click(function(e) {
        e.preventDefault();
        hideError();
        hideOk();
        var checkboxValuesCat = [];
        var checkboxValuesItem = [];
        $('input[type="checkbox"]:checked').each(function(index, elem) {
            $checkboxValue = $(elem).val();
            $id_type = $checkboxValue.split("-");
            
            if($id_type[1] === "CAT"){
              checkboxValuesCat.push($(elem).val());
            }

            if($id_type[1] === "ITEM"){
              checkboxValuesItem.push($(elem).val());
            }
            
        });

        if(checkboxValuesItem.length){
          removeData(checkboxValuesItem, tipoData);  }
       
        if(checkboxValuesCat.length){
          removeData(checkboxValuesCat, tipoData);  }

      });


      </script>

</html>
