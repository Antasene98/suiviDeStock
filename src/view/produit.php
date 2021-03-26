<?php
	session_unset();
	require_once  '../controller/produitsController.php';		
    $controller = new produitsController();	
    $controller->mvcHandler();
?>