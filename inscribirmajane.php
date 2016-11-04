<?php 
include ('base_frontend.php');

if(!isset($_GET["majaneId"])){
	header('Location: '.$BASE_URL.'inscripcion.php');
}

$majane = new Majane();
$majane = $majane->getMajaneByFields(["id"], [$_GET["majaneId"]], ["int"]);

if($majane == null){
	header('Location: '.$BASE_URL.'inscripcion.php');	
}

$inscripcionPorDefecto = getInscriptionData();
function getInscriptionData(){
	$datosInscripcion = new Inscripcion();
	$janij = unserialize($_SESSION['janij']);

	if(isset($_SESSION["inscriptionInformation"])){		
		$datosInscripcion->convertFromRequest($_SESSION["inscriptionInformation"]);
		$datosInscripcion->data["id_janij"] = $janij->data["id"];
	}else{
		$ultimaInscripcion = new Inscripcion();
		$ultimaInscripcion = $ultimaInscripcion->getLastInscripcion($janij->data["id"]);	
	
		if($ultimaInscripcion != null){
			$datosInscripcion = $ultimaInscripcion;
			
			$datosInscripcion->data["dolor_cabeza"] = explode(",", $datosInscripcion->data["dolor_cabeza"]);
		}
	}
	
	return $datosInscripcion;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('header.php') ?>
		<title>Inscripcion</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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
							<div class="x_title">
							  <h1><?php echo $majane->data["titulo"] ?></h1>
							  <div class="clearfix"></div>
							</div>
						</div>
						<div id="wizard" class="form_wizard wizard_horizontal">
						  <ul class="wizard_steps">
							<li>
							  <a href="#step-1">
								<span class="step_no">1</span>
								<span class="step_descr">Datos Basicos</span>
							  </a>
							</li>
							<li>
							  <a href="#step-2">
								<span class="step_no">2</span>
								<span class="step_descr">Datos Padre / Madre /  Tutor</span>
							  </a>
							</li>
							<li>
							  <a href="#step-3">
								<span class="step_no">3</span>
								<span class="step_descr">Ficha Medica</span>
							  </a>
							</li>
						  </ul>
						  <div id="step-1">
							<form id="form-1" class="form-horizontal form-label-left">
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nombre">
										Nombre <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="nombre" name="nombre" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $janij->data["nombre"] ?>">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="apellido">
										Apellido <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="apellido" name="apellido" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $janij->data["apellido"] ?>">
									</div>
								</div>
								<fieldset class="col-md-12 col-sm-12 col-xs-12 date-fieldset">
									<div class="control-group">
										<div class="controls date-container">
											<label class="control-label col-md-4 col-sm-4 col-xs-12" for="fecha-nacimiento">
												Nacimiento ( Mes / Dia / A&ntilde;o ) <span class="required">*</span>
											</label>
											<fieldset class="item form-group left">
											  <div class="control-group">
												<div class="controls">
												  <div class="col-md-12 col-sm-12 col-xs-12  xdisplay_inputx form-group has-feedback">
													<input type="text" class="form-control has-feedback-left col-md-7 col-xs-12" id="fecha-nacimiento" name="nacimiento" aria-describedby="inputSuccess2Status" required="required" data-inputmask="'mask' : '99 / 99 / 9999'" placeholder="Mes / Dia / A&ntilde;o">
													<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
													<span id="inputSuccess2Status" class="sr-only">(success)</span>
												  </div>
												</div>
											  </div>
											</fieldset>
										</div>
									</div>
								</fieldset>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="dni">
										DNI <span class="required">*</span>
									</label>
									<div class="col-md-3 col-sm-6 col-xs-12">
									  <input type="number" id="dni" name="dni" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $janij->data["dni"] ?>">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="direccion">
										Direccion <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="direccion" name="direccion" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="localidad">
										Localidad <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="localidad" name="localidad" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="edad">
										Edad <span class="required">*</span>
									</label>
									<div class="col-md-2 col-sm-6 col-xs-12">
									  <select id="edad" name="edad" required="required" class="form-control col-md-7 col-xs-12">
										<option value></option>
										<?php for($i = 2; $i <= 25; $i++){?>
											<option value="<?php echo $i ?>"><?php echo $i ?></option>
										<?php }?>
									  </select>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="telefono">
										Telefono <span class="required">*</span>
									</label>
									<div class="col-md-3  col-sm-6 col-xs-12">
									  <input type="text" id="telefono" name="telefono" required="required" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '9999-9999'">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="grupo">
										Grupo <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <select id="grupo" name="grupo" required="required" class="form-control col-md-7 col-xs-12">
										<option></option>
										<?php 
										foreach($majane->getMajaneGroups() as $key => $grupo){ ?>
											<option value='<?php echo $grupo->data["id"] ?>'><?php echo $grupo->data["nombre"]." ( ".$grupo->data["aclaracion"]." )" ?></option>
										<?php } ?>
									  </select>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12 madrijim-container">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="madrijim">
										Madrijim 
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="madrijim" name="madrijim" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12 email-container">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">
										Email <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
							</form>
						  </div>
						  <div id="step-2">
							<form id="form-2" class="form-horizontal form-label-left">
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="nombre_padres">
										Nombre <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="nombre_padres" name="nombre_padres" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="apellido_padres">
										Apellido <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="apellido_padres" name="apellido_padres" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="dni_padres">
										DNI <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="number" id="dni_padres" name="dni_padres" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="email_padres">
										Email <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="email" id="email_padres" name="email_padres" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="celular_padres">
										Celular <span class="required">*</span>
									</label>
									<div class="col-md-3  col-sm-6 col-xs-12">
									  <input type="text" id="celular_padres" name="celular_padres" required="required" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '99-9999-9999'">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="parentesco">
										Parentesco <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <select id="parentesco" name="parentesco" required="required" class="form-control col-md-7 col-xs-12">
										<option value></option>
										<option value="Padre">Padre</option>
										<option value="Madre">Madre</option>
										<option value="Tutor">Tutor</option>
									  </select>
									</div>
								</div>
							</form>
						  </div>
						  <div id="step-3">
							<form id="form-3" class="form-horizontal form-label-left">
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="obra_social">
										Obra Social / Prepaga<span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="obra_social" name="obra_social" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="obra_social_plan">
										Plan <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="obra_social_plan" name="obra_social_plan" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="numero_socio">
										Numero de Socio <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="number" id="numero_socio" name="numero_socio" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="obra_social_telefono">
										Telefono Prepaga <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
										<input type="text" id="obra_social_telefono" name="obra_social_telefono" required="required" class="form-control col-md-7 col-xs-12" />
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">
										Sufre Alergias <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <div id="alergias" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="alergias-si" type="radio" name="alergias" value="1" data-parsley-multiple="alergias" data-parsley-id="12"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="alergias-no" type="radio" name="alergias" value="0" data-parsley-multiple="alergias"> No
										</label>
									  </div>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12 alergias_cuales-container">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="alergias_cuales">
										¿Cuales? <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="alergias_cuales" name="alergias_cuales" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">
										Realiza Alguna Dieta <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <div id="dietas" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="dietas-si" type="radio" name="dietas" value="1" data-parsley-multiple="dietas" data-parsley-id="12"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="dietas-no" type="radio" name="dietas" value="0" data-parsley-multiple="dietas"> No
										</label>
									  </div>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12 dietas_cuales-container">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="dietas_cuales">
										¿Cuales? <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="dietas_cuales" name="dietas_cuales" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">
										Plan de Vacunacion al Dia <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <div id="vacunacion" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="vacunacion-si" type="radio" name="vacunacion" value="1" data-parsley-multiple="vacunacion" data-parsley-id="12"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="vacunacion-no" type="radio" name="vacunacion" value="0" data-parsley-multiple="vacunacion"> No
										</label>
									  </div>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">
										Realiza Algun Tratamiento Farmacologico <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <div id="medicacion_regular" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="medicacion_regular-si" type="radio" name="medicacion_regular" value="1" data-parsley-multiple="medicacion_regular" data-parsley-id="12"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="medicacion_regular-no" type="radio" name="medicacion_regular" value="0" data-parsley-multiple="medicacion_regular"> No
										</label>
									  </div>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12 medicacion_regular_cuales-container">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="medicacion_regular_cuales">
										¿Cuales? <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <textarea type="text" id="medicacion_regular_cuales" name="medicacion_regular_cuales" required="required" class="form-control col-md-7 col-xs-12"></textarea>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="medicacion_contraindicada">
										Medicacion Contraindicada
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="medicacion_contraindicada" name="medicacion_contraindicada" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">
										Usa aparatos de ortodoncia, lentes u otros que requieran cuidados particulares <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <div id="elementos_medicos" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="elementos_medicos-si" type="radio" name="elementos_medicos" value="1" data-parsley-multiple="elementos_medicos" data-parsley-id="12"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="elementos_medicos-no" type="radio" name="elementos_medicos" value="0" data-parsley-multiple="elementos_medicos"> No
										</label>
									  </div>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12 elementos_medicos_cuales-container">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="elementos_medicos_cuales">
										¿Cuales? <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <textarea type="text" id="elementos_medicos_cuales" name="elementos_medicos_cuales" required="required" class="form-control col-md-7 col-xs-12"></textarea>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">
										En caso de dolor de cabeza tratar con: <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
										<input type="checkbox" name="dolor_cabeza" id="paracetamol" value="paracetamol" class="flat dolor_cabeza" data-parsley-mincheck="1"/> Paracetamol <br/>
										<input type="checkbox" name="dolor_cabeza" id="ibuprofeno" value="ibuprofeno" class="flat dolor_cabeza" /> Ibuprofeno <br/>
										<input type="checkbox" name="dolor_cabeza" id="aspirinetas" value="aspirinetas" class="flat dolor_cabeza" /> Aspirinetas <br/>
										<input type="checkbox" name="dolor_cabeza" id="no-autorizo" value="no-autorizo" class="flat dolor_cabeza" checked="checked" /> No autorizo <br/>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="dolor_cabeza_dosis">
										Dosis y presentation <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="dolor_cabeza_dosis" name="dolor_cabeza_dosis" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12">
										En caso de dolor de panza tratar con Paratropina <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <div id="usar_paratropina" class="btn-group" data-toggle="buttons">
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="usar_paratropina-si" type="radio" name="usar_paratropina" value="1" data-parsley-multiple="usar_paratropina" data-parsley-id="12"> &nbsp; Si &nbsp;
										</label>
										<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
										  <input id="usar_paratropina-no" type="radio" name="usar_paratropina" value="0" data-parsley-multiple="usar_paratropina"> No
										</label>
									  </div>
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12 usar_paratropina_dosis-container">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="usar_paratropina_dosis">
										Dosis y presentation <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="usar_paratropina_dosis" name="usar_paratropina_dosis" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12 col-sm-12 col-xs-12">
									<label class="control-label col-md-4 col-sm-4 col-xs-12" for="observaciones">
										Observaciones
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <textarea type="text" id="observaciones" name="observaciones" class="form-control col-md-7 col-xs-12"></textarea>
									</div>
								</div>
							</form>
						  </div>
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
	window.history.pushState('','','<?php echo $BASE_URL.'Inscripcion' ?>');
	
	$(document).ready(function() {
		$("#grupo").change(function(){
			if($(this).val() == 0){
				$(".madrijim-container").hide();		
			}else{
				$(".madrijim-container").show();					
			}
		});
		
		$("#alergias-si").change(function(){
			$(".alergias_cuales-container").show();
			$("#alergias_cuales").attr("required","required");
		});
		
		$("#alergias-no").change(function(){
			$(".alergias_cuales-container").hide();
			$("#alergias_cuales").removeAttr("required");
			$("#alergias_cuales").val("");
		});
		
		$("#dietas-si").change(function(){
			$(".dietas_cuales-container").show();
			$("#alergias_cuales").attr("required","required");
		});
		
		$("#dietas-no").change(function(){
			$(".dietas_cuales-container").hide();
			$("#dietas_cuales").attr("required","required");
			$("#dietas_cuales").val("");
		});
		
		$("#medicacion_regular-si").change(function(){
			$(".medicacion_regular_cuales-container").show();
			$("#dietas_cuales").attr("required","required");
		});
		
		$("#medicacion_regular-no").change(function(){
			$(".medicacion_regular_cuales-container").hide();
			$("#medicacion_regular_cuales").attr("required","required");
			$("#medicacion_regular_cuales").val("");
		});
		
		$("#elementos_medicos-si").change(function(){
			$(".elementos_medicos_cuales-container").show();
			$("#elementos_medicos_cuales").attr("required","required");
		});
		
		$("#elementos_medicos-no").change(function(){
			$(".elementos_medicos_cuales-container").hide();
			$("#elementos_medicos_cuales").attr("required","required");
			$("#elementos_medicos_cuales").val("");
		});
		
		$("#usar_paratropina-si").change(function(){
			$(".usar_paratropina_dosis-container").show();
			$("#usar_paratropina-cuales").attr("required","required");
		});
		
		$("#usar_paratropina-no").change(function(){
			$(".usar_paratropina_dosis-container").hide();
			$("#usar_paratropina_dosis").attr("required","required");
			$("#usar_paratropina_dosis").val("");
		});
		
		<?php foreach($inscripcionPorDefecto->data as $key => $value){ 
			if($value != "" && $key != "dolor_cabeza"){?>
		var element_<?php echo $key ?> = $("input[name='<?php echo $key ?>']");
		
		if (element_<?php echo $key ?>.length == 0){
			element_<?php echo $key ?> = $("select[name='<?php echo $key ?>']");
		}
		
		if (element_<?php echo $key ?>.length > 0){
			switch(element_<?php echo $key ?>[0].type){
				case "radio":
					element_<?php echo $key ?>.each(function(){
						if($(this).val() == "<?php echo $value ?>"){
							$(this).click();
							$(this).change();
						}
					});
					break;
				case "text":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
				case "email":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
				case "number":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
				case "select-one":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
			}
		}
		<?php }else if ($key == "dolor_cabeza" && $value != ""){ ?>
		var element_<?php echo $key ?> = $("input[name='<?php echo $key ?>']");
		var value = [];
		<?php foreach($value as $k => $val){ ?>
		value[<?php echo $k ?>] = "<?php echo $val ?>";
		<?php } ?>
		
		element_<?php echo $key ?>.each(function(){
			if(value.indexOf($(this)[0].id) >= 0){
				$(this).click();
			}else{
				$(this).removeAttr("checked");
			}
		});
		<?php }
		}?>
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
</script>
<!-- jQuery Smart Wizard -->
<script>
  $(document).ready(function() {
	$('#wizard').smartWizard({
	  transitionEffect: 'none',
	  labelNext:'Siguiente', 
	  labelPrevious:'Anterior',
	  labelFinish:'Terminar',
	  hideButtonsOnDisabled: true,
	  onShowStep: onShowStep,
	  onLeaveStep: onLeaveStep,
	  onFinish: onFinishWizard
	});

	$('.buttonNext').addClass('btn btn-success');
	$('.buttonPrevious').addClass('btn btn-primary');
	$('.buttonFinish').addClass('btn btn-default');
	
  });
  
  function onLeaveStep(obj, context){
	if (context.toStep < context.fromStep){
		return true;
	}
	  
	if(!validator.checkAll($("#form-" + context.fromStep))){
		return false;
	}
	
	return true;
  }
  
  function onShowStep(){
    window.scrollTo(0, 0);
	$(".stepContainer").css('height', "100%");
  }
  
  function onFinishWizard(objs, context){
	  
	if(!validator.checkAll($("#form-1")) || !validator.checkAll($("#form-2")) || !validator.checkAll($("#form-3"))){
		return false;
	}

	var generalInformation = $("#form-1").serializeArray();
	var parentInformation = $("#form-2").serializeArray();
	var medicalInformation = $("#form-3").serializeArray();
	
	$.ajax({
	  type: "POST",
	  url: '<?php echo $BASE_URL."ajax/crearvisualizar.php"?>',
	  data: {inscriptionInformation: {generalInformation: generalInformation, parentInformation: parentInformation, medicalInformation: medicalInformation, majaneid: <?php echo $majane->data["id"] ?>}},
	  success: function(data, textStatus) {
		  window.location.href = "<?php echo $BASE_URL.'inscripcionprevizualizar.php' ?>";
	  }
	});
  }  
</script>
<!-- /jQuery Smart Wizard -->
<!-- bootstrap-daterangepicker -->
<script>
  $(document).ready(function() {
	$('#fecha-nacimiento').daterangepicker({
	  singleDatePicker: true,
	  calender_style: "picker_1"
	}, function(start, end, label) {
	  console.log(start.toISOString(), end.toISOString(), label);
	});
  });
</script>
<script>
<!-- /bootstrap-daterangepicker -->