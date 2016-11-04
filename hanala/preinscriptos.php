<?php 
include ('base_backend.php');

$majanot = new Majane();
$majanot = $majanot->getMajanotByFields(["abierto"], [1], ["bit"]);

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title>Preinscriptos</title>
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
								<h1 class="left"><?php echo $majane->data["titulo"] ?> - Preinscriptos</h1>
								<div class="right add-table-button-container">
									<a href="verpreinscriptos.php?majaneid=<?php echo $majane->data['id'] ?>" class="btn btn-success btn-lg">Ver Preinscriptos</a>
								</div>
							</div>
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
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/Preinscriptos' ?>');
	
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