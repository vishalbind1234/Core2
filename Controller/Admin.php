
<?php   CCC::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Admin extends Controller_Core_Action{

	/*public $adapter = new Model_Core_Adapter();*/


	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function addAdmin()
	{
		global $adapter;
		$this->getView()->setTemplate("view/Admin/addAdmin.php")->toHtml();
	}

	public function editAdmin()
	{
		global $adapter;
		$data = $adapter->fetch("SELECT * FROM Admin WHERE id = " . $_GET['id'] );
		$this->getView()->setData($data);
		$this->getView()->setTemplate("view/Admin/editAdmin.php")->toHtml();
				
	}

	public function deleteAdmin()  /*--------------------------------------deleteAdmin()----------------------------------------------*/  
	{
		try{  
            
          	global $adapter ;
            $count = $adapter->delete( "DELETE  FROM Admin where id = " . $_GET['id'] );  
			$message = $count . ' row deleted ' ;
        	$this->redirect("index.php?a=grid&c=Admin&message=" . $message );
        }
        catch(Exception $e){

        	$this->redirect("index.php?a=grid&c=Admin&message=" . $e->getMessage() );
        }	
		

	
	}

	public function saveAdmin() /*-----------------------------------------saveAdmin()-------------------------------------------------------------*/
	{     

		$adapter = new Model_Core_Adapter();
		if( !$adapter->getConnect() ){
            $adapter->connect();         
        }  

        var_dump( array_key_exists( 'id' , $_POST['Admin'] ) );

        if(array_key_exists( 'id' , $_POST['Admin'] )) {    /* update if key exist */ 

        	if(!(int)$_POST['Admin']['id']){
        		$message = 'error : id not valid ';
        		$this->redirect("index.php?a=grid&c=Admin&message=" . $message);      
        	}
			try{  
				$update = $adapter->getConnect()->prepare( "UPDATE Admin 
														  SET firstName =  :firstName , 
													          lastName  =  :lastName  ,
														      email     =  :email     ,
														      password  =  :password  ,
															  status    =  :status    ,
															  createdAt =  :createdAt ,
															  updatedAt =  :updatedAt 
														  WHERE id = " .  $_POST['Admin']['id'] );  
															  
				$update->bindValue(":firstName"    , $_POST['Admin']["firstName"]      ); 
				$update->bindValue(":lastName"     , $_POST['Admin']["lastName"]       );
				$update->bindValue(":email"        , $_POST['Admin']["email"]          );
				$update->bindValue(":password"     , $_POST['Admin']["password"]       );
				$update->bindValue(":status"       , $_POST['Admin']["status"]         );
				$update->bindValue(":createdAt"    , $_POST['Admin']["createdAt"]      );
				$update->bindValue(":updatedAt"    , $_POST['Admin']["updatedAt"]      );
				$update->execute();

				$message =  $update->rowCount() . " row updated " ;
				$this->redirect("index.php?a=grid&c=Admin&message=" . $message );
			}
			catch(Exception $e)
			{
				$this->redirect("index.php?a=grid&c=Admin&message=" . $err = $e->getMessage() );
			}

		}    
		else{                       
			try{           
				$insert = $adapter->getConnect()->prepare( "INSERT INTO 
							Admin(firstName , lastName , email , password , status ,  createdAt  ) 
					    	VALUES( :firstName , :lastName , :email , :password  , :status  , :createdAt  )" );    /* no need of updateAt during insert Add New */

				$insert->bindValue(":firstName"    , $_POST['Admin']["firstName"]      ); 
				$insert->bindValue(":lastName"     , $_POST['Admin']["lastName"]       );
				$insert->bindValue(":email"        , $_POST['Admin']["email"]          );
				$insert->bindValue(":password"     , $_POST['Admin']["password"]       );
				$insert->bindValue(":status"       , $_POST['Admin']["status"]         );
				$insert->bindValue(":createdAt"    , $_POST['Admin']["createdAt"]      );
				$insert->execute();
				


				$message =  $insert->rowCount() . " row inserted " ;
				$this->redirect("index.php?a=grid&c=Admin&message=" . $message );
			
			}
			catch(Exception $e)
			{
				$this->redirect("index.php?a=grid&c=Admin&message=" . $err = $e->getMessage() );
			}

		}

	}

	public function gridAdmin() /*---------------------------------------------------------gridAdmin()-----------------------------------------*/
	{
		global $adapter;
		$data = $adapter->fetch("SELECT * FROM Admin");
		$this->getView()->setData($data);
		$this->getView()->setTemplate("view/Admin/gridAdmin.php")->toHtml();
		$message = ( !empty( $_GET['message']) ) ? $_GET['message'] : " " ;
		echo($message );
	}

	public function fetchOneAdmin()
	{
        $adapter = new Model_Core_Adapter();
		$query = "SELECT * FROM Admin" ;
		$result = $adapter->fetchOne($query  ,  1  );
		print_r( $result );
	}
	
	public function errorAction()
	{

		echo(" some error occured ");
	}

}






?>