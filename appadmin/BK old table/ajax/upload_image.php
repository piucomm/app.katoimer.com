<?php
// include ImageManipulator class
//require_once('ImageManipulator.php');
require_once('inc.class.images.php');

$jstatus = 0;
$jmess = "";
$jurl = "";

if(isset($_FILES["file"]["type"])) {
  $validextensions = array("jpeg", "jpg", "png");
  $temporary = explode(".", $_FILES["file"]["name"]);
  $file_extension = end($temporary);

  if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
  ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
  && in_array($file_extension, $validextensions)) {
  
    if ($_FILES["file"]["error"] > 0) {
      $jstatus = 1;
      $jmess = "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
    } else {

      //$immagine = new image();
      //genero un numero casuale tra 0 e 100000
      $randomN = (integer) (rand()%100000);
      $targetPath = "../upload/".$randomN."-".$_FILES['file']['name']; // Target path where file is to be stored
      //$targetPath = sanitizeName($targetPath);

      if (file_exists($targetPath)) {
        $jstatus = 1;
        $jmess = $targetPath." <div class=\"callout callout-danger\">File già presente</div> ";
      } else {
        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable

        move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file

        $immagineN = new image();
        $immagineN->load($targetPath);

        $immagineN1 = new image();
        $immagineN1->load($targetPath);

        $immagineN2 = new image();
        $immagineN2->load($targetPath);

        //Creo la large
        $max_l = 400;
        $max_h = 200;
              
        $immagineN->resize($max_l,$max_h);
        $immagineN->save("../upload/large-".$randomN."-".$_FILES['file']['name']);
          
        // immagine Attiva
        $immagineN1->fill(200,200);
        $immagineN1->save("../upload/thumb-".$randomN."-".$_FILES['file']['name']);
          

        //Creo l'immagine mobile
        $immagineN2->fill($max_l,$max_h);
        $immagineN2->save("../upload/mobile-".$randomN."-".$_FILES['file']['name']);

        /* 
        $manipulator = new ImageManipulator($_FILES['file']['tmp_name']);
        $newImage = $manipulator->resample(200, 200);
        $manipulator->save('../upload/thumb-'.$randomN."-".$_FILES['file']['name']);

        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        $x1 = $centreX - 100; // 200 / 2
        $y1 = $centreY - 100; // 130 / 2
 
        $x2 = $centreX + 100; // 200 / 2
        $y2 = $centreY + 100; // 130 / 2
 
        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
        $manipulator->save('../upload/crop-'.$randomN."-".$_FILES['file']['name']); */

        $jstatus = 1;
        $jmess = "<div class=\"callout callout-info\">";
        $jmess .= "<span id='success'>Immagine caricata correttamente: </span>". $targetPath."</div>";
        $jurl = $randomN."-".$_FILES['file']['name'];
        $jdir = "/upload/";

        /* echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
        echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
        echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>"; */
      }
    }

  } else {
    $jstatus = 0;
    $jmess = "<div class=\"callout callout-danger\">Dimensione o tipologia immagine errata</div>";
  }
} else {
  $jstatus = 0;
  $jmess = "<div class=\"callout callout-danger\">Errore risposta data... </div>";
}

echo json_encode(array(
  'status' => $jstatus,
  'txt' => $jmess,
  'imgurl' => $jurl
));

?>