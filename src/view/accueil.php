<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="~/../../../public/css/bootstrap.css"> 
    <link href="~/../../../public/css/fontawesome/css/font-awesome.css" rel="stylesheet" />    
    <script src="~/../../../public/js/bootstrap.js"></script>
    <script src="~/../../../public/js/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>
    
<?php
	session_unset();
	require_once  '../controller/homeController.php';		
    $controller = new homeController();	
    $controller->mvcHandler();
             
        
    
    ?> 

</html>

