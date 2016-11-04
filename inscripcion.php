<?php 
include ('base_frontend.php');

$majanot = new Majane();
$majanot = $majanot->getMajanotByFields(["abierto"], [1], ["bit"]);

unset($_SESSION["inscriptionInformation"]);
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
					<?php foreach($majanot as $key => $majane){ 
						$inscripcionMajane = new Inscripcion();
						$inscripcionMajane = $inscripcionMajane->getInscriptionByFields(["id_janij", "id_majane"],[$janij->data["id"], $majane->data["id"]], ["int", "int"]);
					?>
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
								  <p><?php echo $majane->data["descripcion"] ?></p>
								  <div class="right">
									<?php if($inscripcionMajane != null){ ?>
									<a href="inscribirmajane.php>"><button type="button" disabled class="btn btn-success btn-lg">Ya estas inscripto</button></a>
									<?php }else{ ?>
									<a href="inscribirmajane.php?majaneId=<?php echo $majane->data["id"] ?>"><button type="button" class="btn btn-success btn-lg">Inscribite</button></a>
									<?php } ?>
								  </div>
								</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>
					<?php } ?>
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