<?php 
if (session_status() == 1) {
    session_start();
}

$_SESSION = array();
session_destroy();
header('Location: '.$BASE_URL.'index.php');
?>