<?php 
include ('base_frontend.php');

$majanot = new Majane();
$majanot = $majanot->getMajanotByFields(["abierto"], [1], ["bit"]);

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
						<?php foreach($majanot as $key => $majane){ ?>
						<div class="col-md-6 col-sm-12 col-xs-12">
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
								  <br/>
								  <?php 
									$lastMajaneInfo = new Majane_Info();
									$lastMajaneInfo = $lastMajaneInfo->getLastInfo($majane->data["id"]);
									
									if ($lastMajaneInfo == null){ 
								  ?>
								  <p><?php echo $majane->data["descripcion"] ?></p>
								  <?php }else{ ?>
								  <p><?php echo $lastMajaneInfo->data["fecha"] ?> - <?php echo $lastMajaneInfo->data["informacion"] ?></p>
								  <?php } ?>
								  <?php if($lastMajaneInfo != null ){ ?>
								  <div class="right">
									<a href="todalainfo?majaneId=<?php echo $majane->data["id"] ?>"><button type="button" class="btn btn-success btn-lg">Ver Mas</button></a>
								  </div>
								  <?php } ?>
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
		</div>
		<?php include ('footer.php'); ?>
		<footer></footer>
	</body>
</html>

<script>
	window.history.pushState('','','<?php echo $BASE_URL.'Informaciones' ?>');
	
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