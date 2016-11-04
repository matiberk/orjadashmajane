<?php 
include ('base_backend.php');

$base_inscripcion = new Inscripcion();

$majaneid = 0;

if(isset($_GET["majaneid"])){
	$majaneid = $_GET["majaneid"];
}

$majane = new Majane();
$majane = $majane->getMajaneByFields(["id"], [$majaneid], ["int"]);

$majane_grupos = new Majane_Grupo();
$majane_grupos = $majane->getMajaneGroups();

$inscripciones = new Inscripcion();
$inscripciones = getInscriptionFilter();

$columns = $base_inscripcion->getTableAttributesList();
$rows = array();

foreach($inscripciones as $key => $inscripcion){
	array_push($rows, $inscripcion->parseDataToRow());
}

$hasEditRow = false;
$hasDeleteRow = false;
$hasSelectorRow = false;

function getInscriptionFilter(){	
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
	return $inscripciones->getInscripcionesByFields($fieldFilter, $valuesFilter, $typesFilter);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title>Inscriptos</title>
	</head>
	<body class="nav-md">
		<div class="container body">
		  <div class="main_container">
			
			<?php include ('sidebar.php'); ?>
			<?php include ('topnav.php'); ?>
			
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
					  <div class="title_left">
						<div class="col-md-12 col-sm-12 col-xs-12">
						  <div class="x_panel">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<h1 class="left">Listado de inscriptos</h1>
							</div>
							<div class="filter_container">
								<form id="filter_form" class="form-horizontal form-label-left" action="verinscriptos.php" method="post">
									<input type="hidden" name="majaneid" id=="majaneid" value="<?php echo $majaneid ?>" />
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">
											Nombre
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <input type="text" id="nombre" name="nombre" class="form-control col-md-7 col-xs-12" value="<?php if(isset($nombre)){ echo $nombre; } ?>">
										</div>
									</div>
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="apellido">
											Apellido
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <input type="text" id="apellido" name="apellido" class="form-control col-md-7 col-xs-12" value="<?php if(isset($apellido)){ echo $apellido; } ?>">
										</div>
									</div>					
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="grupo">
											Grupo
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <select id="grupo" name="grupo" class="form-control col-md-7 col-xs-12">
											<option value></option>
                                                                                        <?php foreach($majane_grupos as $key => $grupo){ ?>
											<option value="<?php echo $grupo->data["id"] ?>" <?php if(isset($_GET["grupo"]) && $_GET["grupo"] == $grupo->data["id"]){ ?>selected="selected"<?php } ?>><?php echo $grupo->data["nombre"] ?></option>
											<?php } ?>
										  </select>
										</div>
									</div>
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="obra_social">
											Obra Social
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <input type="text" id="obra_social" name="obra_social" class="form-control col-md-7 col-xs-12" value="<?php if(isset($obra_social)){ echo $obra_social; } ?>">
										</div>
									</div>									
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="dietas">
											Dietas
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <select id="dietas" name="dietas" class="form-control col-md-7 col-xs-12">
											<option value></option>
											<option value="1" <?php if(isset($_GET["dietas"]) && $_GET["dietas"] == "1"){ ?>selected="selected"<?php } ?>>SI</option>
											<option value="0" <?php if(isset($_GET["dietas"]) && $_GET["dietas"] == "0"){ ?>selected="selected"<?php } ?>>NO</option>											
										  </select>
										</div>
									</div>					
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="alergias">
											Alergias
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <select id="alergias" name="alergias" class="form-control col-md-7 col-xs-12">
											<option value></option>
											<option value="1" <?php if(isset($_GET["alergias"]) && $_GET["alergias"] == "1"){ ?>selected="selected"<?php } ?>>SI</option>
											<option value="0" <?php if(isset($_GET["alergias"]) && $_GET["alergias"] == "0"){ ?>selected="selected"<?php } ?>>NO</option>											
										  </select>
										</div>
									</div>					
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="medicacion_regular">
											Medicacion Regular
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <select id="medicacion_regular" name="medicacion_regular" class="form-control col-md-7 col-xs-12">
											<option value></option>
											<option value="1" <?php if(isset($_GET["medicacion_regular"]) && $_GET["medicacion_regular"] == "1"){ ?>selected="selected"<?php } ?>>SI</option>
											<option value="0" <?php if(isset($_GET["medicacion_regular"]) && $_GET["medicacion_regular"] == "0"){ ?>selected="selected"<?php } ?>>NO</option>											
										  </select>
										</div>
									</div>					
									<div class="item form-group col-md-6">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="elementos_medicos">
											Elementos Medicos
										</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
										  <select id="elementos_medicos" name="elementos_medicos" class="form-control col-md-7 col-xs-12">
											<option value></option>
											<option value="1" <?php if(isset($_GET["elementos_medicos"]) && $_GET["elementos_medicos"] == "1"){ ?>selected="selected"<?php } ?>>SI</option>
											<option value="0" <?php if(isset($_GET["elementos_medicos"]) && $_GET["elementos_medicos"] == "0"){ ?>selected="selected"<?php } ?>>NO</option>											
										  </select>
										</div>
									</div>
									<div class="right filte-button-container">
										<a href="javascript:void(0)" onclick="onExportToExcel();" class="btn btn-success btn-lg">Exportar</a>
										<a href="verinscriptos.php?majaneid=<?php echo $majaneid ?>" class="btn btn-success btn-lg">Resetear Filtros</a>
										<a href="javascript:void(0)" onclick="onFilterInscriptos();" class="btn btn-success btn-lg">Filtrar</a>
									</div>
								</form>
							</div>
							<div class="table_container">
								<?php include ('table.php'); ?>
							</div>
						  </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
		<?php include ('../footer.php'); ?>
		<footer></footer>
	</body>
</html>

<script>
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/Inscriptos' ?>');
	$(document).ready(function(){
		$("#datatable_filter").hide();
	});
	
	function onChangeSideBarClicked(){
		if($("#home-button").hasClass("fa fa-home")){
			$("#home-button").removeClass("fa fa-home");
			$("#home-button").hide();
		}else{
			$("#home-button").addClass("fa fa-home");
			$("#home-button").show();
		}
	}
	
	
	function onFilterInscriptos(){
		var url = "verinscriptos.php?majaneid=<?php echo $majaneid ?>";
		
		$("#filter_form input, #filter_form select").each(function(){
			if($(this)[0].value != undefined && $(this)[0].value != ""){
				url += "&" + $(this)[0].name + "=" + $(this)[0].value;
			}
		});
		
		window.location.href = "<?php echo $BASE_URL ?>" + url;
	}
	
	function onExportToExcel(){
		var url = "<?php echo $BASE_URL ?>" + "exportaraexcel.php?majaneid=<?php echo $majaneid ?>";
		
		$("#filter_form input, #filter_form select").each(function(){
			if($(this)[0].value != undefined && $(this)[0].value != ""){
				url += "&" + $(this)[0].name + "=" + $(this)[0].value;
			}
		});
		
		var win = window.open(url, '_blank');
		win.focus();
	}
</script>