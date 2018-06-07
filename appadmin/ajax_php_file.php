<?php

if(isset($_FILES["file"]["type"])) {
  $validextensions = array("jpeg", "jpg", "png");
  $temporary = explode(".", $_FILES["file"]["name"]);
  $file_extension = end($temporary);

  if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
  ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
  && in_array($file_extension, $validextensions)) {
  
    if ($_FILES["file"]["error"] > 0) {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
    } else {

      //genero un numero casuale tra 0 e 100000
      $randomN = (integer) (rand()%100000);
      $targetPath = "upload/".$randomN."-".$_FILES['file']['name']; // Target path where file is to be stored
      // $targetPath = sanitizeName($targetPath);

      if (file_exists($targetPath)) {
        echo $targetPath . " <div class=\"callout callout-danger\">File già presente</div> ";
      } else {
        $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable

        move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
        echo "<div class=\"callout callout-info\">";
        echo "<span id='success'>Immagine caricata correttamente: </span>". $targetPath;
        /* echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
        echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
        echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>"; */
        echo "</div>";
      }
    }

  } else {
    echo "<div class=\"callout callout-danger\">Dimensione o tipologia immagine errata</div>";
  }
} else {
  echo "<div class=\"callout callout-danger\">Errore nell'invio dati... </div>";
}

?>