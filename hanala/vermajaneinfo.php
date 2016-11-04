<?php 
include ('base_backend.php');

$info_id = $_GET["info_id"];
$majane_id = $_GET["majane_id"];

$majane_info = new Majane_Info();
$majane_info = $majane_info->getInfoByFields(["id"], [$info_id], ["int"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title>Editar Mensaje</title>
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
							<form method="post" id="info-form" class="form-horizontal form-label-left col-md-12 col-sm-12 col-xs-12" action="<?php echo $BASE_URL ?>informaciones.php">
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nuevo-mensaje">
										Mensaje
									</label>
									<div class="col-md-8 col-sm-10 col-xs-12">
									  <textarea type="text" id="nuevo-mensaje" name="nuevo-mensaje" class="form-control col-md-12 col-xs-12"><?php echo $majane_info->data['informacion'] ?></textarea>
									  <a href="javascript: void(0)" onclick="validateAddMessage();">Editar Mensaje</a>
									</div>
								</div>
								<input type="hidden" value="<?php echo $majane_id ?>" name="majaneid" />
								<input type="hidden" value="<?php echo $info_id ?>" name="infoid" />
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