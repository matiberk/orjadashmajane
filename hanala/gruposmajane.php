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

$base_grupo = new Majane_Grupo();

if(isset($_POST["grupo"])){	
	$id_majane = $_POST["majaneid"];
	
	if(isset($_POST["grupoid"])){
		$base_grupo->update($_POST["grupo"], $_POST["aclaracion"], $_POST["grupoid"]);
	}else{
		$base_grupo->save($_POST["grupo"], $_POST["aclaracion"], $id_majane);
	}
	
	showSuccess("Cambio realizado con exito");
}

if(isset($_GET["delete_id"])){
	$delete_group_id = $_GET["delete_id"];
	$base_grupo->delete($_GET["delete_id"]);
}

if (isset($majaneid)){
	$currentMajane = new Majane();
	
	foreach($majanot as $key => $majane){
		if($majane->data["id"] == $majaneid){
			$currentMajane = $majane;
		}
	}
	
	$majane_grupos = new Majane_Grupo();
	$majane_grupos = $currentMajane->getMajaneGroups();

	$columns = $base_grupo->getTableAttributesList();
	$rows = array();	

	foreach($majane_grupos as $key => $grupo){
		array_push($rows, $grupo->parseDataToRow());
	}
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
								<h1 class="left"><?php echo $majane->data["titulo"] ?> - Grupos</h1>
								<div class="right add-table-button-container">
									<a href="gruposmajane.php?majaneid=<?php echo $majane->data['id'] ?>" class="btn btn-success btn-lg">Ver Grupos</a>
								</div>
							</div>
							<?php }
							if(isset($currentMajane)){?>
							<div class="table_container">
								<?php include ('table.php'); ?>
							</div>
							
							<form method="post" id="group-form" class="form-horizontal form-label-left col-md-12 col-sm-12 col-xs-12" action="<?php echo $BASE_URL ?>gruposmajane.php">
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="grupo">
										Nuevo Grupo
									</label>
									<div class="col-md-6 col-sm-10 col-xs-12">
									  <input type="text" id="grupo" name="grupo" required="required" class="form-control col-md-12 col-xs-12" />
									</div>
								</div>
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="aclaracion">
										Aclaracion
									</label>
									<div class="col-md-6 col-sm-10 col-xs-12">
									  <input type="text" id="aclaracion" name="aclaracion" required="required" class="form-control col-md-12 col-xs-12" />
									  <a href="javascript: void(0)" onclick="$('#group-form').submit();">Agregar Grupo</a>
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
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/GruposMajane' ?>');
	
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
</script>