<?php
session_cache_expire(30);
session_start();

$act="";
$status = 0;
$mess = "Nessuna azione selezionata";

if(isset($_POST['act']) && ($_POST['act'] != "" )) {

	$act=$_POST['act'];

	$configadd = parse_ini_file('../data/config.ini'); 
	$connadd = mysqli_connect('localhost',$configadd['username'],$configadd['password'],$configadd['dbname']);

	$stmtadd = $connadd->stmt_init();

	if((strcmp($act,"add-cat") == 0) || (strcmp($act,"edit-cat") == 0) || (strcmp($act,"add-trans-cat") == 0) ) {

		$ID_padre = $_POST['itemPadre'];
		$lin = $_POST['itemLingua'];
		$type = $_POST['itemType'];
		if(isset($_POST['noteCat'])): $note_cat = $_POST['noteCat']; else: $note_cat = ""; endif;
		$pubblica = $_POST['pubb1'];
		$evidenza = $_POST['evid1'];
		$attiva = 1;
		$ordine = $_POST['ordine'];
		$tit1=$_POST['titolo'];
		$stit1=$_POST['sottotitolo'];
		$desc1=$_POST['editor1'];
		if(isset($_POST['note1'])): $note1 = $_POST['note1']; else: $note1 = ""; endif;
		$img = $_POST['imgProfile'];
		//SEO meta
		if(isset($_POST['titSeo']) && ($_POST['titSeo'] != "")): $titSeo= $_POST['titSeo']; else: $titSeo = $tit1; endif;
		if(isset($_POST['keySeo'])): $keySeo=$_POST['keySeo']; else: $keySeo = ""; endif;
		if(isset($_POST['editorSeo'])): $editorSeo=$_POST['editorSeo']; else: $editorSeo = ""; endif;
		if(isset($_POST['permaSeo']) && ($_POST['permaSeo'] != "")): $str_perma = $_POST['permaSeo']; else: $str_perma = $tit1; endif;

		// serializzo i dati layout
		$new_cta = $_POST['selCta']; // visualizzo CTA?
		$new_layout_ID = $_POST['selLayout']; // id layout (chiave esterna tbl_layout)
		$ancora = $_POST['ancora']; // #ancora 
		$classCss = $_POST['classCss']; // classe per gli stili

		$serializeLayout = serialize(array( 'cta' => $new_cta, 'layout'=> $new_layout_ID, 'ancora'=> $ancora, 'classCss'=> $classCss));

		$new_tonnellaggio = $_POST['itemTonn']; // tonnellaggio

		$serializeAttributi = serialize(array( 'tonn' => $new_tonnellaggio ));

		// costruisco il permalink
		$str_perma = strtolower(trim($str_perma));
		$str_perma = preg_replace('/[^a-z0-9-]/', '-', $str_perma);
		$str_perma = preg_replace('/-+/', "-", $str_perma);
	
		if(strcmp($act,"add-cat") == 0) {

			$status = 1;
			$mess = "Categoria inserita con successo."; 

			$stmtadd->prepare("INSERT INTO tbl_category ( Type, Note, Layout, Data_layout, ID_padre) VALUE ( ? , ?, ? , ? , ?)");

			if ($stmtadd === false) {
			  $status = 0;
			  $mess = " Error prepare cat ADD ".$this->mysqli->error;
			}

			$stmtadd->bind_param('ssisi', $type, $note_cat, $new_layout_ID, $serializeLayout, $ID_padre );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0;
			  $mess = " Error execute cat ADD ".$stmtadd->error;
			}	
			$stmtadd->store_result(); 
			$ID_new_cat = $stmtadd->insert_id;
			$stmtadd->free_result();	
			
			$stmtadd->prepare("INSERT INTO tbl_items ( ID_cat, Titolo, Sottotitolo, Descrizione, Immagine, Lingua, Pubblica, Attiva, Evidenza, Ordine, Attributi) VALUE ( ? , ? , ? , ? , ?, ?, ?, ?, ?, ?, ?)");

			if ($stmtadd === false) {
			  $status = 0;
			  $mess = " Error prepare item ADD ".$this->mysqli->error;
			}

			$stmtadd->bind_param('isssssiiiis', $ID_new_cat, $tit1, $stit1, $desc1, $img, $lin ,$pubblica,$attiva,$evidenza,$ordine, $serializeAttributi );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0;
			  $mess = " Error execute item ADD ".$stmtadd->error;
			}

			$stmtadd->store_result();
			$ID_new_item = $stmtadd->insert_id;
			$stmtadd->free_result();

			/* AGGIUNGO I META TAG */
			$stmtadd->prepare("INSERT INTO tbl_meta ( ID_item, TitoloSEO, DescrizioneSEO, KeywordSEO, PermalinkSEO) VALUE ( ? , ? , ?, ?, ?)");

			if ($stmtadd === false) {
			  $status = 0; $mess = " Error prepare meta ADD ".$this->mysqli->error;
			}

			$stmtadd->bind_param('issss', $ID_new_item, $titSeo, $editorSeo, $keySeo, $str_perma);

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0; 
			  $mess = " Error execute meta ADD ".$stmtadd->error;
			}

			$stmtadd->store_result();
			$stmtadd->free_result();


			/* AGGIUNGO LE IMMAGINI ALLA GALLERIA
			$tag_img = "TAG-PROVA";

			$stmtadd->prepare("INSERT INTO tbl_gallery ( ID_item, URL, Tag) VALUE ( ? , ? , ?)");

			if ($stmtadd === false) {
			  $status = 0; $mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('iss', $ID_new_item, $img, $tag_img);

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0; $mess = $stmtadd->error;
			}

			$stmtadd->store_result();
			$stmtadd->free_result();  */


		} else if(strcmp($act,"edit-cat") == 0) {

			$id_cat = $_POST['ID_cat'];
			$id_item = $_POST['ID_item'];

			$status = 1;
			$mess = "Categoria modificata con successo.";

			/* AGGIORNO LA CATEGORIA */
			$stmtadd->prepare("UPDATE tbl_category SET Type=?, Layout=?, Data_layout=?, ID_padre=? WHERE ID=? ");

			if ($stmtadd === false) {
			  $status = 0; $mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('sisii', $type, $new_layout_ID, $serializeLayout, $ID_padre, $id_cat );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0; $mess = $stmtadd->error;
			}

			$stmtadd->free_result();

			/* AGGIORNO L'ITEM */
			$stmtadd->prepare("UPDATE tbl_items SET Titolo=?, Sottotitolo=?, Descrizione=?, Immagine=?, Pubblica=?, Attiva=?, Evidenza=?, Ordine=?, Data_modifica = NOW(), Attributi=? WHERE ID_item=? ");

			if ($stmtadd === false) {
			  $status = 0; $mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('ssssiiiisi', $tit1,$stit1, $desc1, $img, $pubblica,$attiva,$evidenza,$ordine,$serializeAttributi, $id_item );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0; $mess = $stmtadd->error;
			}

			$stmtadd->free_result();

			/* AGGIORNO I META */
			$stmtadd->prepare("UPDATE tbl_meta SET TitoloSEO=?, DescrizioneSEO=?, KeywordSEO=?, PermalinkSEO=? WHERE ID_item= ? ");

			if ($stmtadd === false) {
			  $status = 0; $mess = $this->mysqli->error;
			}

			$stmtadd->bind_param('ssssi', $titSeo, $editorSeo, $keySeo, $str_perma, $id_item );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0; $mess = $stmtadd->error;
			}

			$stmtadd->free_result();			

		} else if(strcmp($act,"add-trans-cat") == 0) {

			$id_cat = $_POST['ID_cat'];

			$status = 1;
			$mess = "Categoria tradotta con successo.";
			
			$stmtadd->prepare("INSERT INTO tbl_items ( ID_cat, Titolo, Sottotitolo, Descrizione, Immagine, Lingua, Pubblica, Attiva, Evidenza, Ordine, Attributi) VALUE ( ? , ? , ? , ? , ?, ?, ?, ?, ?, ?, ?)");

			if ($stmtadd === false) {
			  $status = 0; $mess .= "<br/>MYQSL Insert item ".$this->mysqli->error;
			}

			$stmtadd->bind_param('isssssiiiis', $id_cat, $tit1, $stit1, $desc1, $img, $lin ,$pubblica,$attiva,$evidenza,$ordine, $serializeAttributi );

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0; $mess .= "<br/>BIND ERROR Insert item ".$stmtadd->error;
			}

			$stmtadd->store_result();
			$ID_new_item = $stmtadd->insert_id; // id item appena inserito
			$stmtadd->free_result();

			/* AGGIUNGO I META TAG */
			$stmtadd->prepare("INSERT INTO tbl_meta ( ID_item, TitoloSEO, DescrizioneSEO, KeywordSEO, PermalinkSEO) VALUE ( ? , ? , ?, ?, ?)");

			if ($stmtadd === false) {
			  $status = 0; $mess .= "<br/>MYQSL Insert Meta ".$this->mysqli->error;
			}

			$stmtadd->bind_param('issss', $ID_new_item, $titSeo, $editorSeo, $keySeo, $str_perma);

			$err_status = $stmtadd->execute();
			if ($err_status === false) {
			  $status = 0; $mess .= "<br/>BIND ERROR Insert Meta ".$ID_new_item." ".$stmtadd->error;
			}

			$stmtadd->store_result();
			$stmtadd->free_result();
		}

	}

	$stmtadd->close();
	$connadd->close();

}

echo json_encode(array(
	'status' => $status,
	'msg' => $mess
));


?>