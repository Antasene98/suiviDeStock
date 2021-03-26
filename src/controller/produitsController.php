<?php
    require '../model/produitsModel.php';
    require '../model/produits.php';
    require_once '../entity/config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class produitsController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new produitsModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                case 'add' :                    
					$this->insert();
					break;						
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;								
				default:
                    $this->list();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // check validation
		public function checkValidation($sporttb)
        {    $noerror=true;
            // Validate category        
            if(empty($sporttb->qtStock)){
                $sporttb->qtStock_msg = "Field is empty.";$noerror=false;
            } else{$sporttb->qtStock_msg ="";}            
            // Validate name            
            if(empty($sporttb->nom)){
                $sporttb->name_msg = "Field is empty.";$noerror=false;     
            } else{$sporttb->name_msg ="";}
            return $noerror;
            if(empty($sporttb->ref)){
                $sporttb->ref_msg = "Field is empty.";$noerror=false;     
            } else{$sporttb->ref_msg ="";}
            return $noerror;
        }
        
        // add new record
		public function insert()
		{
            try{
                $sporttb=new produits();
                if (isset($_POST['addbtn'])) 
                {   
                    // read form value
                    $sporttb->qtStock = trim($_POST['qtStock']);
                    $sporttb->nom = trim($_POST['nom']);
                    $sporttb->ref = trim($_POST['ref']);

                    //call validation
                    $chk=$this->checkValidation($sporttb);                    
                    if($chk)
                    {   
                        //call insert record            
                        $pid = $this -> objsm ->insertRecord($sporttb);
                        if($pid>0){			
                            $this->list();
                        }else{
                            echo "Somthing is wrong..., try again.";
                        }
                    }else
                    {    
                        $_SESSION['sporttbl0']=serialize($sporttb);//add session obj           
                        $this->pageRedirect("view/insert.php");                
                    }
                }
            }catch (Exception $e) 
            {
                $this->close_db();	
                throw $e;
            }
        }
        // update record
        public function update()
		{
            try
            {
                
                if (isset($_POST['updatebtn'])) 
                {
                    $sporttb=unserialize($_SESSION['sporttbl0']);
                    $sporttb->id = trim($_POST['id']);
                    $sporttb->qtStock = trim($_POST['qtStock']);
                    $sporttb->nom = trim($_POST['nom']);      
                    $sporttb->ref = trim($_POST['ref']);                                        
                    // check validation  
                    $chk=$this->checkValidation($sporttb);
                    if($chk)
                    {
                        $res = $this -> objsm ->updateRecord($sporttb);	                        
                        if($res){			
                            $this->list();                           
                        }else{
                            echo "Somthing is wrong..., try again.";
                        }
                    }else
                    {         
                        $_SESSION['sporttbl0']=serialize($sporttb);      
                        $this->pageRedirect("update.php");                
                    }
                }elseif(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
                    $id=$_GET['id'];
                    $result=$this->objsm->selectRecord($id);
                    $row=mysqli_fetch_array($result);  
                    $sporttb=new produits();                  
                    $sporttb->id=$row["id"];
                    $sporttb->nom=$row["nom"];
                    $sporttb->qtStock=$row["qtStock"];
                    $sporttb->ref=$row["ref"];
                    $_SESSION['sporttbl0']=serialize($sporttb);
                    $this->pageRedirect('update.php');
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->close_db();				
                throw $e;
            }
        }
        // delete record
        public function delete()
		{
            try
            {
                if (isset($_GET['id'])) 
                {
                    $id=$_GET['id'];
                    $res=$this->objsm->deleteRecord($id);                
                    if($res){
                        $this->pageRedirect('produit.php');
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->close_db();				
                throw $e;
            }
        }
        public function list(){
            $result=$this->objsm->selectRecord(0);
            include "../view/list.php";                                        
        }
    }
		
	
?>