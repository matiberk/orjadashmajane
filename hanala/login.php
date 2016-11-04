<?php 
include ('config.php');
include ('../classes/db_connection.php');
include ('../classes/base_class.php');
include ('../classes/hanala.php');
include ('../helper.php');

$user = isset($_POST["user"]) ? $_POST["user"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
		
if (session_status() == 1) {
    session_start();
	$_SESSION = array();
}

if(isset($_SESSION['hanala'])){
	header('Location: '.$BASE_URL.'home.php');
}
		
validateAdminLogin();

function validateAdminLogin(){
	if(!empty($_POST)){
		$user = $_POST["user"];
		$password = $_POST["password"];
				
		if ($user != null && $password != null){
			logInHanala($user, $password);
			return;
		}
		showError("Los datos ingresados son invalidos, por favor reviselos e ingreselos de nuevo");
	}
}

function logInHanala($user, $password) {
	$hanala = new Hanala();
	$hanala = $hanala->getHanalaByField(["usuario", "password"], [$user, $password], ["string", "string"]);
	
	if (isset($hanala->data)){
		$_SESSION['hanala'] = serialize($hanala);
		header('Location: '.$BASE_URL.'home.php');
		return;
	}else{
		showError("Los datos son incorrectos.");
		return;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include ('../header.php'); ?>
		<title>Login</title>
	</head>
	<body class="login_body">
		<div>
		  <div class="login_wrapper">
			<div class="animate form login_form">
			  <section class="login_content">
				<img src="/images/logo-orja.jpg" class="login_orja_logo"/>
				<form method="post" action="login.php" id="login-form">
				  <h1>Login Hanala</h1>
				  <div class="item form-group">
					<input id="user" name="user" type="text" class="form-control col-md-12 col-xs-12" placeholder="Usuario" required="required" value="<?php echo $user ?>"/>
				  </div>
				  <div class="item form-group">
					<input id="password" name="password" type="password" class="form-control col-md-12 col-xs-12" placeholder="Contraseña" required="required" value="<?php echo $password ?>"/>
				  </div>
				  <div>
					<a class="btn btn-default btn-lg" onclick="$('#login-form').submit();"><h2>Iniciar Sesion</h2></a>
				  </div>

				  <div class="clearfix"></div>

				  <div class="separator">
				  </div>
				</form>
			  </section>
			</div>
		  </div>
		</div>
		<?php include ('../footer.php'); ?>
		<footer></footer>
	</body>
</html>

<script>
	window.history.pushState('','','<?php echo $BASE_FRONT_URL.'Hanala/Login' ?>');
</script>