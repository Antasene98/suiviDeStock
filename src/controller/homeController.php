<?php
    require '../model/produitsModel.php';
    require '../model/produits.php';
    require_once '../entity/config.php';

    
	class homeController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new produitsModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{
	
                    $this->graph();
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // check validation
	
        // add new record
	

        public function graph(){
            $result=$this->objsm->selectRecord(0);
            include "../view/graph.php";                                        
        }
    }
		
	
?>