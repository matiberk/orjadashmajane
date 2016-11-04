<?php 
if(isset($_REQUEST['inscriptionInformation']) && !empty($_REQUEST['inscriptionInformation'])) {
	$inscriptionInformationPost = $_POST['inscriptionInformation'];
	
	$generalInformation = parseRequest($inscriptionInformationPost["generalInformation"]);
	$parentInformation = parseRequest($inscriptionInformationPost["parentInformation"]);
	$medicalInformation = parseRequest($inscriptionInformationPost["medicalInformation"]);
	
	$inscriptionInformation = array();
	$inscriptionInformation["generalInformation"] = $generalInformation;
	$inscriptionInformation["parentInformation"] = $parentInformation;
	$inscriptionInformation["medicalInformation"] = $medicalInformation;
	$inscriptionInformation["majaneid"] = $inscriptionInformationPost["majaneid"];
}

if (session_status() == 1) {
    session_start();
}

$_SESSION["inscriptionInformation"] = $inscriptionInformation;

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
		}else if($data["name"] == "dolor_cabeza"){
			$parsedData[$data["name"]] = array();
			array_push($parsedData[$data["name"]], $data["value"]);
		}else{
			$parsedData[$data["name"]] = $data["value"];
		}
	}
	
	return $parsedData;
}
?>