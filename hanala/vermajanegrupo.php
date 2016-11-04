<?php 
include ('base_backend.php');

$grupo_id = $_GET["grupo_id"];
$majane_id = $_GET["majane_id"];

$majane_grupo = new Majane_Grupo();
$majane_grupo = $majane_grupo->getMajaneGroupByFields(["id"], [$grupo_id], ["int"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title>Editar Grupo</title>
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
							<div class="x_title">
								<h1>Editar Grupo</h1>
							</div>
							<form method="post" id="grupo-form" class="form-horizontal form-label-left col-md-12 col-sm-12 col-xs-12" action="<?php echo $BASE_URL ?>gruposmajane.php">
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nuevo-mensaje">
										Nombre
									</label>
									<div class="col-md-6 col-sm-10 col-xs-12">
									  <input type="text" id="grupo" name="grupo" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $majane_grupo->data["nombre"] ?>"/>
									</div>
								</div>
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="aclaracion">
										Aclaracion
									</label>
									<div class="col-md-6 col-sm-10 col-xs-12">
									  <input type="text" id="aclaracion" name="aclaracion" required="required" class="form-control col-md-12 col-xs-12" value="<?php echo $majane_grupo->data["aclaracion"] ?>"/>
									</div>
								</div>
								<div class="right">
									<button type="submit" class="btn btn-success btn-lg">Editar Grupo</button>
								</div>
								<input type="hidden" value="<?php echo $majane_id ?>" name="majaneid" />
								<input type="hidden" value="<?php echo $grupo_id ?>" name="grupoid" />
							</form>
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