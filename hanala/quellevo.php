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
								<h1 class="left"><?php echo $majane->data["titulo"] ?> - ¿Que llevo?</h1>
								<div class="right add-table-button-container">
									<a href="quellevo.php?majaneid=<?php echo $majane->data['id'] ?>" class="btn btn-success btn-lg">Cambiar Imagen</a>
								</div>
							</div>
							<?php }
							if(isset($currentMajane)){?>				
							<div class="form-horizontal form-label-left">
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="que_llevo">
										¿Que llevo?
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="file" id="que_llevo" name="que_llevo" class="form-control col-md-7 col-xs-12">
									</div>
								</div>					
							<div>
							<div class="right">
								<button onclick="uploadMajaneImage();" class="btn btn-success btn-lg">Cambiar Foto</button>
							</div>
							<?php
							$queLlevoImagenUrl = getUrlMajaneImage($currentMajane);
							if($queLlevoImagenUrl != null){?>
							<div class="x_content">
							  <div class="bs-example" data-example-id="simple-jumbotron">
								<div class="jumbotron">
									<img style="width:100%;" src="<?php echo $queLlevoImagenUrl ?>" />
								</div>
							  </div>
							</div>
							<?php } ?>
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
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/QueLlevo' ?>');
	
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
	
	
	
	function uploadMajaneImage(){
		var inputFileImage = $("input[name='que_llevo']")[0];

		var file = inputFileImage.files[0];

		var data = new FormData();

		data.append('archivo',file);
		
		var majane_id = 0;
		<?php if(isset($currentMajane)){ ?>
		majane_id = <?php echo $currentMajane->data["id"] ?>;
		<?php } ?>
		
		data.append('id_majane', majane_id);

		var url = "../ajax/subirimagenmajane.php";

		$.ajax({

			url:url,

			type:'POST',

			contentType:false,

			data:data,

			processData:false,

			cache:false,
			
			success: function(){
				window.location.href = '<?php echo $BASE_FRONT_URL.'Hanala/QueLlevo?majaneid='.$_GET["majaneid"] ?>';
			}
		});

	}
</script>