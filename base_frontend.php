<?php
include ('config.php'); 
include ('helper.php');
include ('classes/db_connection.php');
include ('classes/base_class.php');
include ('classes/janij.php');
include ('classes/majane.php');
include ('classes/majane_info.php');
include ('classes/majane_grupo.php');
include ('classes/inscripcion.php');

if (session_status() == 1) {
    session_start();
}

if(!isset($_SESSION['janij'])){
	header('Location: '.$BASE_URL.'login.php');
	exit;
}

$janij = new Janij();
$janij = unserialize($_SESSION['janij']);
?>