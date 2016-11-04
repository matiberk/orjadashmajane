<?php 
include ('base_backend.php');

$base_majane = new Majane();

if(isset($_POST["majane"])){	
	$lugar = $_POST["lugar"];
	$titulo = $_POST["titulo"];
	$subtitulo = $_POST["subtitulo"];
	$descripcion = $_POST["descripcion"];
	$fecha_desde = $_POST["fecha_desde"];
	$fecha_hasta = $_POST["fecha_hasta"];
	$abierto = $_POST["abierto"];
	
	if(isset($_POST["id"])){
		$majane_id = $_POST["id"];
		$base_majane->update($majane_id, $lugar, $titulo, $subtitulo, $descripcion, $fecha_desde, $fecha_hasta, $abierto);
	}else{
		$base_majane->save($lugar, $titulo, $subtitulo, $descripcion, $fecha_desde, $fecha_hasta);
	}
}

$majanot = new Majane();
$majanot = $majanot->getAllMajanot();

$columns = $base_majane->getTableAttributesList();
$rows = array();

foreach($majanot as $key => $majane){
	array_push($rows, $majane->parseDataToRow());
}

$hasEditRow = true;
$hasDeleteRow = false;
$hasSelectorRow = false;
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title>Majanot</title>
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
								<h1 class="left">Listado de majanot</h1>
								<div class="right add-table-button-container">
									<a href="vermajane.php" class="btn btn-success btn-lg">Crear Nuevo Majane</a>
								</div>
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
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/Majanot' ?>');
	
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