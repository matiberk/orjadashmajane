<?php 
include ('config.php');
include ('classes/db_connection.php');
include ('classes/base_class.php');
include ('classes/janij.php');
include ('helper.php');

$user = isset($_POST["user"]) ? $_POST["user"] : "";
$dni = isset($_POST["dni"]) ? $_POST["dni"] : "";

if (session_status() == 1) {
    session_start();
	$_SESSION = array();
}

if(isset($_SESSION['janij'])){
	header('Location: '.$BASE_URL.'home.php');
}

validateUserAction();

function validateUserAction(){
	if(!empty($_POST)){
		$user = $_POST["user"];
		$dni = $_POST["dni"];
		$action = $_POST["action"];
		$userInfo = explode(".", $user);
				
		if(count($userInfo) == 2){
			$userName = $userInfo[0];
			$userLastName = $userInfo[1];
			if ($userName != null && $userLastName != null && $dni != null){
				if($action == "login"){
					logJanijIn($userName, $userLastName, $dni);
				}else if ($action == "signin"){
					createJanij($userName, $userLastName, $dni);
				}
				
				return;
			}
		}
		showError("Los datos ingresados son invalidos, por favor reviselos e ingreselos de nuevo. Recuerde que el usario es el nombre del janij y el apellido separados por un punto.");
	}
}

function logJanijIn($userName, $userLastName, $dni) {
	$janij = new Janij();
	$janij = $janij->getJanijByFields(["dni", "nombre", "apellido"], [$dni,$userName,$userLastName], ["int","string","string"]);

	$janijWithSameDNI = new Janij();
	$janijWithSameDNI = $janijWithSameDNI->getJanijByFields(["dni"], [$dni], ["int"]);
	
	if (isset($janij->data)){
		$_SESSION['janij'] = serialize($janij);
		header('Location: '.$BASE_URL.'home.php');
		return;
	}else{
		showError("Los datos son incorrectos.");
		return;
	}
	
	showError("Los datos ingresados son invalidos, por favor reviselos e ingreselos de nuevo. Recuerde que el usario es el nombre del janij y el apellido separados por un punto.");
}

function createJanij($userName, $userLastName, $dni) {
	$janijWithSameDNI = new Janij();
	$janijWithSameDNI = $janijWithSameDNI->getJanijByFields(["dni"], [$dni], ["int"]);
	
	if (isset($janijWithSameDNI->data)){
		showError("Ya existe un Janij con estos datos.");
		return;
	}
	
	$newJanij = new Janij();
	$newJanij = $newJanij->createJanij($dni, $userName, $userLastName, 1);
	if(isset($newJanij->data)){
		$_SESSION['janij'] = serialize($newJanij);
		header('Location: '.$BASE_URL.'home.php');
		return;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('header.php') ?>
		<title>Login</title>
	</head>
	<body class="login_body">
		<div>
		  <div class="login_wrapper">
			<div class="animate form login_form">
			  <section class="login_content">
				<img src="/images/logo-orja.jpg" class="login_orja_logo"/>
				<form method="post" action="login.php" id="login-form">
				  <h1>Sistema de Inscripcion para Majane</h1>
				  <div class="item form-group">
					<input id="user" name="user" type="text" class="form-control col-md-12 col-xs-12" placeholder="Usuario (El usuario es el nombre y apellido del Janij separado por un punto)" required="required" value="<?php echo $user ?>"/>
				  </div>
				  <div class="item form-group">
					<input id="dni" name="dni" type="number" class="form-control col-md-12 col-xs-12" placeholder="DNI (Es el DNI del Janij)" required="required" value="<?php echo $dni ?>"/>
				  </div>
				  <div>
					<a class="btn btn-default btn-lg" id="login" name="login" onclick="$('#action').val('login'); $('#login-form').submit();"><h2>Iniciar Sesion</h2></a>
					<a class="btn btn-default btn-lg" id="signin" name="signin" onclick="$('#action').val('signin'); $('#login-form').submit();"><h2>Crear Cuenta</h2></a>
					<input type="hidden" name="action" id="action" value="" />
				  </div>

				  <div class="clearfix"></div>

				  <div class="separator">
				  </div>
				</form>
			  </section>
			</div>
		  </div>
		</div>
		<?php include ('footer.php'); ?>
		<footer></footer>
	</body>
</html>

<script>
	window.history.pushState('','','<?php echo $BASE_URL.'Login' ?>');
</script>