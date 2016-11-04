<?php 
include ('../hanala/base_backend.php');

if(isset($_POST["preinscriptosAConfirmar"])){
	$preinscriptosAConfirmar = json_decode($_POST["preinscriptosAConfirmar"]);
	var_dump($preinscriptosAConfirmar);
	foreach($preinscriptosAConfirmar as $key => $id){
		$inscripto = new Inscripcion();
		$inscripto = $inscripto->getInscriptionByFields(["id"],[$id],["int"]);
		$inscripto->confirmarInscripto();
	}
}
?>