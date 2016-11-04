<?php 
include ('base_frontend.php');

$majanot = new Majane();
$majanot = $majanot->getMajanotByFields(["abierto"], [1], ["bit"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('header.php') ?>
		<title>¿Que Llevo?</title>
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
						<?php foreach($majanot as $key => $majane){ 
						$queLlevoImagenUrl = getUrlMajaneImage($majane);
						if($queLlevoImagenUrl != null){?>
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
									<img style="width:100%;" src="<?php echo $queLlevoImagenUrl ?>" />
								</div>
							  </div>
							</div>
						  </div>
						</div>
						<?php 
						}
						} ?>
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
	window.history.pushState('','','<?php echo $BASE_URL.'QueLlevo' ?>');
	
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