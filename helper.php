<?php 
if (session_status() == 1) {
    session_start();
}

if(isset($_SESSION["pendingSuccessMessage"])){
	showSuccess($_SESSION["pendingSuccessMessage"]);
	unset($_SESSION["pendingSuccessMessage"]);
}

if(isset($_SESSION["pendingErrorMessage"])){
	showError($_SESSION["pendingErrorMessage"]);
	unset($_SESSION["pendingErrorMessage"]);
}

function showError($errorMessage){
	echo "<script>window.addEventListener('load', function() { new PNotify({
                                  title: 'Error',
                                  text: '".$errorMessage."',
                                  type: 'error',
                                  styling: 'bootstrap3'
                              }); });</script>";
}

function showSuccess($successMessage){
	echo "<script>window.addEventListener('load', function() { new PNotify({
                                  title: 'Completado',
                                  text: '".$successMessage."',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              }); });</script>";
}

function addPendingSuccess($successMessage){
	$_SESSION["pendingSuccessMessage"] = $successMessage;
}

function addPendingErrorMessage($errorMessage){
	$_SESSION["pendingErrorMessage"] = $errorMessage;
}

function url_exists($url) {
	$file_headers = @get_headers($url);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		return false;
	}
	else {
		return true;
	}
}

function getUrlMajaneImage($majane){
	$url = "images/majanot/quellevo-";
	$url .= $majane->data["id"];
	
	$imageFormats = array("jpg", "jpeg", "png");
	$fileExists = false;
	foreach($imageFormats as $key => $imageFormat){
		if(file_exists($url.".".$imageFormat)){
			$url .= ".".$imageFormat;
			$fileExists = true;
		}else if(file_exists("../".$url.".".$imageFormat)){
			$url = "../".$url.".".$imageFormat;
			$fileExists = true;
		}
	}
	
	if($fileExists){
		return $url;
	}
	
	return null;
}
?>