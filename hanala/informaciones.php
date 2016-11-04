<?php 
include ('base_backend.php');

$majanot = new Majane();
$majanot = $majanot->getMajanotByFields(["abierto"], [1], ["bit"]);

$columns = array();
$rows = array();

if (isset($_GET["majaneid"])){
	$majaneid = $_GET["majaneid"];
}

if (isset($_POST["majaneid"])){
	$majaneid = $_POST["majaneid"];
}

if(isset($_POST["nuevo-mensaje"])){
	$base_info = new Majane_Info();
	
	$id_majane = $_POST["majaneid"];
	
	if(isset($_POST["infoid"])){
		$base_info->update($_POST["nuevo-mensaje"], $_POST["infoid"]);
	}else{
		$base_info->save($_POST["nuevo-mensaje"], $id_majane);
	}
	
	showSuccess("Cambio realizado con exito");
}

if (isset($majaneid)){
	$currentMajane = new Majane();
	
	foreach($majanot as $key => $majane){
		if($majane->data["id"] == $majaneid){
			$currentMajane = $majane;
		}
	}

	$base_info = new Majane_Info();
	
	$informaciones = new Majane_Info();
	$informaciones = $informaciones->getInfosByFields(["id_majane"], $currentMajane->data["id"] , ["int"]);

	$columns = $base_info->getTableAttributesList();
	$rows = array();	

	foreach($informaciones as $key => $informacion){
		array_push($rows, $informacion->parseDataToRow());
	}
		
	$hasEditRow = true;
	$hasDeleteRow = false;
	$hasSelectorRow = false;	
}

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title>Informaciones</title>
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
							<?php foreach($majanot as $key => $majane){ ?>
							<div style="padding-top:30px;" class="x_title col-md-12 col-sm-12 col-xs-12">
								<h1 class="left"><?php echo $majane->data["titulo"] ?> - Informaciones</h1>
								<div class="right add-table-button-container">
									<a href="informaciones.php?majaneid=<?php echo $majane->data['id'] ?>" class="btn btn-success btn-lg">Ver Mensajes</a>
								</div>
							</div>
							<?php }
							if(isset($currentMajane)){?>
							<div class="table_container">
								<?php include ('table.php'); ?>
							</div>
							
							<form method="post" id="info-form" class="form-horizontal form-label-left col-md-12 col-sm-12 col-xs-12" action="<?php echo $BASE_URL ?>informaciones.php">
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nuevo-mensaje">
										Nuevo Mensaje
									</label>
									<div class="col-md-8 col-sm-10 col-xs-12">
									  <textarea type="text" id="nuevo-mensaje" name="nuevo-mensaje" class="form-control col-md-12 col-xs-12"></textarea>
									  <a href="javascript: void(0)" onclick="validateAddMessage();">Agregar Mensaje</a>
									</div>
								</div>
								<input type="hidden" value="<?php echo $majaneid ?>" name="majaneid" />
							</form>
							<?php } ?>
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
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/Informaciones' ?>');
	
	function onChangeSideBarClicked(){
		if($("#home-button").hasClass("fa fa-home")){
			$("#home-button").removeClass("fa fa-home");
			$("#home-button").hide();
		}else{
			$("#home-button").addClass("fa fa-home");
			$("#home-button").show();
		}
	}
	
	$(document).ready(function(){
		$(".row").first().hide();
		$(".row").last().hide();
	});
	
	function validateAddMessage(){
		if($("#nuevo-mensaje").val() != ""){
			$('#info-form').submit();
		}else{
			new PNotify({
			  title: 'Error',
			  text: 'El mensaje no puede estar vacio',
			  type: 'error',
			  styling: 'bootstrap3'
		  });
		}
	}
</script>