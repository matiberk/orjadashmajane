<?php
include ('base_frontend.php');

if(!isset($_GET["majaneId"])){
	header('Location: '.$BASE_URL.'inscripcion.php');
}

$majane = new Majane();
$majane = $majane->getMajaneByFields(["id"], [$_GET["majaneId"]], ["int"]);

if($majane == null){
	header('Location: '.$BASE_URL.'informaciones.php');	
}

$informaciones = new Majane_Info();
$informaciones = $informaciones->getInfosByFields(["id_majane"], $majane->data["id"] , ["int"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('header.php') ?>
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
							<div class="x_title">
							  <h2><?php echo $majane->data["titulo"] ?></h2>
							  <ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								</li>
							  </ul>
							  <div class="clearfix"></div>
							</div>
							<div class="x_content">

							  <div class="bs-example" data-example-id="simple-jumbotron">
								<div class="jumbotron">
								  <h1><?php echo $majane->data["subtitulo"] ?></h1>
								  <br/><p><?php echo $majane->data["descripcion"] ?></p>
								  
								  <div class="separator"></div>
								  <?php foreach($informaciones as $key => $info){ ?>
								  <p><?php echo $info->data["fecha"] ?> - <?php echo $info->data["informacion"] ?></p>
								  <div class="separator"></div>
								  <?php } ?>
								</div>
							  </div>
							</div>
						  </div>
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
	window.history.pushState('','','<?php echo $BASE_URL.'TodaLaInfo' ?>');
	
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