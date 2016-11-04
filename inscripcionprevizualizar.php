<?php 
include ('base_frontend.php');

if(!isset($_SESSION['inscriptionInformation'])){
	header('Location: '.$BASE_URL.'inscripcion.php');
	exit;
}

$vistamajane = $_SESSION["inscriptionInformation"];

$majane = new Majane();
$majane = $majane->getMajaneByFields(["id"], [$vistamajane["majaneid"]], ["int"]);

function getBool($value){
	if ($value == "1"){
		return true;
	}
	return false;
}

function getBoolString($value){
	if(getBool($value)){
		return 'Si';
	}
	return 'No';
}

function getCommonText($value){
	if(isset($value) && !empty($value)){
		return $value;
	}
	return 'Ninguna';
}

function getGroupString($groupId){
	$vistamajane = $_SESSION["inscriptionInformation"];

	$majane = new Majane();
	$majane = $majane->getMajaneByFields(["id"], [$vistamajane["majaneid"]], ["int"]);

	foreach($majane->getMajaneGroups() as $key => $grupo){
		if($grupo->data["id"] == $groupId){
			return $grupo->data["nombre"];
		}
	}
	return "";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('header.php') ?>
		<title>Inscripcion</title>
	</head>
	<body class="nav-md">
		<div class="container body">
		  <div class="main_container">
			
			<?php include ('sidebar.php'); ?>
			<?php include ('topnav.php'); ?>
			
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="col-md-12">
							<h1 class="confirm-inscription-title">Revise que los datos sean correctos y confirme la inscripcion
							<br/>
							<h3>Datos Basicos</h3>
							<br/>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Nombre
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["nombre"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Apellido
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["apellido"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Nacimiento
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["nacimiento"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									DNI
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["dni"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Direccion
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["direccion"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Localidad
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["localidad"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Edad
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["edad"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Telefono
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["telefono"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Grupo
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getGroupString($vistamajane["generalInformation"]["grupo"]) ?>
								</label>
							</div>
							
							<?php if(isset($vistamajane["generalInformation"]["madrijim"]) && !empty($vistamajane["generalInformation"]["madrijim"])){ ?>
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Madrijim
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["madrijim"] ?>
								</label>
							</div>
							<?php } ?>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Email
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["generalInformation"]["email"] ?>
								</label>
							</div>
						</div>
						<br/>
						
						<div class="col-md-12">
							<h3>Datos Padre / Madre /  Tutor</h3>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Nombre
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["parentInformation"]["nombre_padres"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Apellido
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["parentInformation"]["apellido_padres"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									DNI
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["parentInformation"]["dni_padres"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Email
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["parentInformation"]["email_padres"] ?>
								</label>
							</div>
							
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Celular
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["parentInformation"]["celular_padres"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Parentesco
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["parentInformation"]["parentesco"] ?>
								</label>
							</div>
							
						</div>
						<br/>
						
						<div class="col-md-12">
							<h3>Ficha Medica</h3>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Obra Social
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["obra_social"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Plan
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["obra_social_plan"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Numero de Socio
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["numero_socio"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Telefono
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["obra_social_telefono"] ?>
								</label>
							</div>
							
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Alergias
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getBoolString($vistamajane["medicalInformation"]["alergias"])?>
								</label>
							</div>
							
							<?php if(getBool($vistamajane["medicalInformation"]["alergias"])){ ?>
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									¿Cuales?
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["alergias_cuales"] ?>
								</label>
							</div>
							<?php } ?>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Dietas
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getBoolString($vistamajane["medicalInformation"]["dietas"]) ?>
								</label>
							</div>
							
							<?php if(getBool($vistamajane["medicalInformation"]["dietas"])){ ?>
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									¿Cuales?
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["dietas_cuales"] ?>
								</label>
							</div>
							<?php } ?>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Medicacion Regular
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getBoolString($vistamajane["medicalInformation"]["medicacion_regular"]) ?>
								</label>
							</div>
							
							<?php if(getBool($vistamajane["medicalInformation"]["medicacion_regular"])){ ?>
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									¿Cuales?
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["medicacion_regular_cuales"] ?>
								</label>
							</div>
							<?php } ?>
							
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Medicacion Contraindicada
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getCommonText($vistamajane["medicalInformation"]["medicacion_contraindicada"]) ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Elementos Medicos
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getBoolString($vistamajane["medicalInformation"]["elementos_medicos"])?>
								</label>
							</div>
							
							<?php if(getBool($vistamajane["medicalInformation"]["elementos_medicos"])){ ?>
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									¿Cuales?
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["elementos_medicos_cuales"] ?>
								</label>
							</div>
							<?php } ?>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Tratar dolor de cabeza con 
								</label>
								<label class="control-label col-md-6 col-sm-3 col-xs-12 datapreview" >
									<?php foreach( $vistamajane["medicalInformation"]["dolor_cabeza"] as $key => $medicacion){ echo '/ '.$medicacion.' /';}?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Dosis
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["dolor_cabeza_dosis"] ?>
								</label>
							</div>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Usar Paratropina
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getBoolString($vistamajane["medicalInformation"]["usar_paratropina"])?>
								</label>
							</div>
							
							<?php if(getBool($vistamajane["medicalInformation"]["usar_paratropina"])){ ?>
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Dosis
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo $vistamajane["medicalInformation"]["usar_paratropina_dosis"] ?>
								</label>
							</div>
							<?php } ?>
							
							<div class="item form-group col-md-12 col-sm-12 col-xs-12">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" >
									Observaciones
								</label>
								<label class="control-label col-md-3 col-sm-3 col-xs-12 datapreview" >
									<?php echo getCommonText($vistamajane["medicalInformation"]["observaciones"])?>
								</label>
							</div>
						</div>
						<br/>
						<div class="right">
							<a href="inscribirmajane.php?majaneId=<?php echo $majane->data["id"] ?>"><button type="button" class="btn btn-default btn-lg">Modificar Datos</button></a>
							<a href="crearinscripcion.php"><button type="button" class="btn btn-success btn-lg">Confirmar Inscripcion</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include ('footer.php'); ?>
		<footer></footer>
	</body>
</html>

<script>
	window.history.pushState('','','<?php echo $BASE_URL.'InscripcionPrevizualizar' ?>');

	function onChangeSideBarClicked(){
		if($("#home-button").hasClass("fa fa-home")){
			$("#home-button").removeClass("fa fa-home");
			$("#home-button").hide();
		}else{
			$("#home-button").addClass("fa fa-home");
			$("#home-button").show();
		}
	}
</script>