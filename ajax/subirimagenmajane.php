<?php 
include ('../hanala/base_backend.php');

$return = Array('ok'=>TRUE);

$upload_folder = $dirpath.'images/majanot';

$nombre_archivo = $_FILES['archivo']['name'];

$tipo_archivo = $_FILES['archivo']['type'];
$types = explode("/", $tipo_archivo);
$extension = end($types);

$tamano_archivo = $_FILES['archivo']['size'];

$tmp_archivo = $_FILES['archivo']['tmp_name'];

$archivador = $upload_folder . '/quellevo-' . $_POST["id_majane"].".".$extension;

$majane = new Majane();
$majane = $majane->getMajaneByFields(["id"], [$_POST["id_majane"]], ["int"]);

$oldFileUrl = null;
$imageFormats = array("jpg", "jpeg", "png");
$fileExists = false;

foreach($imageFormats as $key => $imageFormat){
	$currentUrl = $upload_folder . '/quellevo-' . $_POST["id_majane"].".".$imageFormat;
	if(file_exists($currentUrl)){
		$oldFileUrl = $currentUrl;
	}
}

if($oldFileUrl != null){
	unlink($oldFileUrl);
}

if (!move_uploaded_file($tmp_archivo, $archivador)) {
	$return = Array('ok' => FALSE, 'msg' => "Ocurrio un error al subir el archivo. No pudo guardarse.", 'status' => 'error');
}else{
	chmod($archivador, 0777);
}

echo json_encode($return);
?>