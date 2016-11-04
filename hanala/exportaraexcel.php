<?php 
include ('base_backend.php');
require_once ('../PHPExcel/Classes/PHPExcel.php');

if(isset($_GET["majaneid"])){
	$majaneid = $_GET["majaneid"];
}

$fieldFilter = ["id_majane", "confirmado"];
$valuesFilter = [$majaneid, 1];
$typesFilter = ["int", "bit"];

if(isset($_GET["nombre"])){
	$nombre = $_GET["nombre"];
	array_push($valuesFilter, $nombre);
	array_push($fieldFilter, "nombre");
	array_push($typesFilter, "string");
}

if(isset($_GET["apellido"])){
	$apellido = $_GET["apellido"];
	array_push($valuesFilter, $apellido);
	array_push($fieldFilter, "apellido");
	array_push($typesFilter, "string");
}

if(isset($_GET["dietas"])){
	$dietas = $_GET["dietas"];
	array_push($valuesFilter, $dietas);
	array_push($fieldFilter, "dietas");
	array_push($typesFilter, "bit");
}

if(isset($_GET["alergias"])){
	$alergias = $_GET["alergias"];
	array_push($valuesFilter, $alergias);
	array_push($fieldFilter, "alergias");
	array_push($typesFilter, "bit");
}

if(isset($_GET["obra_social"])){
	$obra_social = $_GET["obra_social"];
	array_push($valuesFilter, $obra_social);
	array_push($fieldFilter, "obra_social");
	array_push($typesFilter, "string");
}

if(isset($_GET["medicacion_regular"])){
	$medicacion_regular = $_GET["medicacion_regular"];
	array_push($valuesFilter, $medicacion_regular);
	array_push($fieldFilter, "medicacion_regular");
	array_push($typesFilter, "bit");
}

if(isset($_GET["elementos_medicos"])){
	$elementos_medicos = $_GET["elementos_medicos"];
	array_push($valuesFilter, $elementos_medicos);
	array_push($fieldFilter, "elementos_medicos");
	array_push($typesFilter, "bit");
}

if(isset($_GET["grupo"])){
        $grupo = $_GET["grupo"];
	array_push($valuesFilter, $grupo);
	array_push($fieldFilter, "grupo");
	array_push($typesFilter, "int");
}

$inscripciones = new Inscripcion();
$inscripciones = $inscripciones->getInscripcionesByFields($fieldFilter, $valuesFilter, $typesFilter);

$base_inscripcion = new Inscripcion();

if(count($inscripciones) > 0){
	$columns = $base_inscripcion->getTableAttributesList();
	$rows = array();

	foreach($inscripciones as $key => $inscripcion){
		array_push($rows, $inscripcion->parseDataToRow());
	}
	
	$lines = array();
	
	array_unshift($lines, array());
	array_unshift($columns, "");
	array_push($lines, $columns);
	
	foreach ($rows as $row) {
		array_unshift($row, "");
		array_push($lines, $row);	
 	}

	$fileName = 'janijim'.time().'.xls';

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Fill worksheet from values in array
	$objPHPExcel->getActiveSheet()->fromArray($lines, null, 'A1');

	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Janijim');

	// Set AutoSize
	$curCol = 'A';
	foreach($columns as $key => $column) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($curCol)->setAutoSize(true);
		$curCol++;
	}
	$objPHPExcel->getActiveSheet()->calculateColumnWidths();
	
	// Save Excel 2007 file
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

	header('Content-Type: application/vnd.ms-excel'); 
	header('Content-Disposition: attachment;filename="'.$fileName.'"');
	header('Cache-Control: max-age=0');

	ob_end_clean();
	$objWriter->save('php://output');
}
exit;
?>		