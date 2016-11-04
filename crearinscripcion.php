<?php 
include ('base_frontend.php');

if(isset($_SESSION["inscriptionInformation"])){
	$inscriptionInformation = $_SESSION["inscriptionInformation"];
	
	$newInscription = new Inscripcion();
	$newInscription->convertFromRequest($inscriptionInformation);
	$newInscription->data["id_janij"] = $janij->data["id"]; 
	$newInscription->data["confirnado"] = 'false';
	$completeInscription = $newInscription->save();
	
	unset($_SESSION["inscriptionInformation"]);
	addPendingSuccess("Se ha realizado la inscripcion con exito, se le enviara un email cuando se halla confirmado.");
	header('Location: '.$BASE_URL.'inscripcion.php');
	exit;
}
else{
	addPendingErrorMessage("Ha ocurrido un error en la inscripcion, intentelo de nuevo mas tarde.");
	header('Location: '.$BASE_URL.'inscripcion.php');
	exit;	
}
	
function parseRequest($requestData){
	$parsedData = array();
	
	foreach($requestData as $key => $data){
		if(isset($parsedData[$data["name"]]) && !empty($parsedData[$data["name"]])){
			if(gettype($parsedData[$data["name"]]) == gettype(array())){
				array_push($parsedData[$data["name"]], $data["value"]);
			}else{
				$oldValue = $parsedData[$data["name"]];
				$parsedData[$data["name"]] = array();
				array_push($parsedData[$data["name"]], $oldValue);
				array_push($parsedData[$data["name"]], $data["value"]);
			}
		}else{
			$parsedData[$data["name"]] = $data["value"];
		}
	}
	
	return $parsedData;
}
?>