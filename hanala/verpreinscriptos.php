<?php 
include ('base_backend.php');

$base_inscripcion = new Inscripcion();

$majaneid = 0;

if(isset($_GET["majaneid"])){
	$majaneid = $_GET["majaneid"];
}

$inscripciones = new Inscripcion();
$inscripciones = $inscripciones->getInscripcionesByFields(["id_majane", "confirmado"], [$majaneid, 0], ["int", "bit"]);

$columns = $base_inscripcion->getTableAttributesList();
$rows = array();

foreach($inscripciones as $key => $inscripcion){
	array_push($rows, $inscripcion->parseDataToRow());
}

$hasEditRow = false;
$hasDeleteRow = false;
$hasSelectorRow = true;
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
							<div class="col-md-12 col-sm-12 col-xs-12">
								<h1 class="left">Listado de preinscriptos</h1>
							</div>
							
							<div class="table_container">
								<?php include ('table.php'); ?>
							</div>
							
							<div class="right">
								<a href="javascript:void(0);" onclick="confirmarPreinscriptos();" class="btn btn-success btn-lg">Confirmar Preinscriptos</a>
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
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/Preinscriptos' ?>');
	$(document).ready(function(){
		$("#datatable_filter").hide();
	});
	
	function onChangeSideBarClicked(){
		if($("#home-button").hasClass("fa fa-home")){
			$("#home-button").removeClass("fa fa-home");
			$("#home-button").hide();
		}else{
			$("#home-button").addClass("fa fa-home");
			$("#home-button").show();
		}
	}
	
	function confirmarPreinscriptos(){
		var preinscriptosAConfirmar = [];
		$("input[type='checkbox'][name='table-selector']").each(function(){
			if($(this)[0].checked && $(this)[0].value != "0"){
				preinscriptosAConfirmar.push($(this)[0].value);
			}
		});
		
		if (preinscriptosAConfirmar.length > 0){
			var url = "../ajax/confirmarpreinscriptos.php";

			$.ajax({
				url:url,
				type:'POST',
				data:{preinscriptosAConfirmar : JSON.stringify(preinscriptosAConfirmar)},
				success: function(){
					window.location.href = '<?php echo $BASE_FRONT_URL.'Hanala/verpreinscriptos?majaneid='.$majaneid ?>';
				}
			});
		}else{
			new PNotify({
				  title: 'Error',
				  text: 'Seleccione al menos un janij.',
				  type: 'error',
				  styling: 'bootstrap3'
			  });
		}
	}
</script>