<?php 
include ('base_backend.php');

$title = "Crear Majane";
$edit = false;
if(isset($_GET["majane_id"])){
	$title = "Editar Majane";
	$edit = true;
	$majane = new Majane();
	$majane = $majane->getMajaneByFields(["id"], [$_GET["majane_id"]], ["int"]);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title><?php echo $title ?></title>
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
								<h1><?php echo $title ?></h1>
							</div>
							<form id="majane-form" method="post" class="form-horizontal form-label-left">
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="lugar">
										Lugar <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="lugar" name="lugar" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">
										Titulo <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="titulo" name="titulo" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="subtitulo">
										Subtitulo <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="subtitulo" name="subtitulo" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="descripcion">
										Descripcion <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="descripcion" name="descripcion" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_desde">
										Fecha Desde <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="fecha_desde" name="fecha_desde" required="required" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '99 / 99 / 9999'" placeholder="Dia / Mes / Año">
									</div>
								</div>
								<div class="item form-group col-md-12">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_hasta">
										Fecha Hasta <span class="required">*</span>
									</label>
									<div class="col-md-5 col-sm-6 col-xs-12">
									  <input type="text" id="fecha_hasta" name="fecha_hasta" required="required" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '99 / 99 / 9999'" placeholder="Dia / Mes / Año">
									</div>
								</div>
								<?php if($edit){ ?>
									<input type="hidden" id="id" name="id" value="<?php echo $majane->data['id'] ?>"/>
									
									<div class="item form-group col-md-12">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">
											Abierto <span class="required">*</span>
										</label>
										<div class="col-md-5 col-sm-6 col-xs-12">
										  <div id="abierto" class="btn-group" data-toggle="buttons">
											<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											  <input id="abierto-si" type="radio" name="abierto" value="1" data-parsley-multiple="abierto" data-parsley-id="12"> &nbsp; Si &nbsp;
											</label>
											<label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
											  <input id="abierto-no" type="radio" name="abierto" value="0" data-parsley-multiple="abierto"> No
											</label>
										  </div>
										</div>
									</div>
								<?php }else{ ?>
									<input type="hidden" id="abierto" name="abierto" value="1" />
								<?php } ?>
								
								<input type="hidden" id="majane" name="majane" />
								<div class="right">
									<button onclick="return onMajaneSubmit();" class="btn btn-success btn-lg"><?php echo $title ?></button>
								</div>
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
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/Majanot' ?>');
	
	function onChangeSideBarClicked(){
		if($("#home-button").hasClass("fa fa-home")){
			$("#home-button").removeClass("fa fa-home");
			$("#home-button").hide();
		}else{
			$("#home-button").addClass("fa fa-home");
			$("#home-button").show();
		}
	}
	
	function onMajaneSubmit(){
		if(!validator.checkAll($("#majane-form"))){
			return false;
		}
		return true;
	}
	
	<?php 
	if($edit){
		foreach($majane->data as $key => $value){ 
			if($value != ""){?>
		var element_<?php echo $key ?> = $("input[name='<?php echo $key ?>']");
		
		if (element_<?php echo $key ?>.length == 0){
			element_<?php echo $key ?> = $("select[name='<?php echo $key ?>']");
		}
		
		if (element_<?php echo $key ?>.length > 0){
			switch(element_<?php echo $key ?>[0].type){
				case "radio":
					element_<?php echo $key ?>.each(function(){
						if($(this).val() == "<?php echo $value ?>"){
							$(this).click();
							$(this).change();
						}
					});
					break;
				case "text":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
				case "email":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
				case "number":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
				case "select-one":
					element_<?php echo $key ?>.val("<?php echo $value ?>");
					element_<?php echo $key ?>.change();
					break;
			}
		}
	<?php } 
		}
	}?>
</script>