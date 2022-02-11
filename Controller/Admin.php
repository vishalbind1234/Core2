
<?php  

	require_once("Model/Core/Adapter.php"); 

 ?>

<?php 

class Controller_Admin{

	/*public $adapter = new Model_Core_Adapter();*/


	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function addAdmin()
	{
		require_once("view/Admin/addAdmin.php");
	}

	public function editAdmin()
	{
		
		require_once("view/Admin/editAdmin.php");
		
	}

	public function deleteAdmin()  /*--------------------------------------deleteAdmin()----------------------------------------------*/  
	{
		try{  
            
          	$adapter = new Model_Core_Adapter();

            if( !$adapter->getConnect() ){
                $adapter->connect();
            }  
          
            $del = $adapter->getConnect()->prepare( "DELETE  FROM Admin where id = :id" );  

            $del->bindValue(":id" , $_GET['id'] );  
            $del->execute();                          /*-----$del->execute() returns boolean value-------$del->rowCount()----Return no of rows----*/
            	 
        }
        catch(Exception $e){

        	$this->redirect("index.php?a=grid&c=Admin&message=" . $err = $e->getMessage() );
        }	
		
		$message = $del->rowCount() . '  row deleted' ;

        $this->redirect("index.php?a=grid&c=Admin&message=" . $message );
	
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
			catch(Exception $e){

				$this->redirect("index.php?a=grid&c=Admin&message=" . $err = $e->getMessage() );
			}

		}    
		else{                       
			
			try{           

/*				$commit = $adapter->getConnect()->exec("COMMIT");
*/
				$insert = $adapter->getConnect()->prepare( "INSERT INTO 
							Admin(firstName , lastName , email , password , status ,  createdAt  ) 
					    	VALUES( :firstName , :lastName , :email , :password  , :status  , :createdAt  )" );    /* no need of updateAt during insert Add New */

				$insert->bindValue(":firstName"    , $_POST['Admin']["firstName"]      ); 
				$insert->bindValue(":lastName"     , $_POST['Admin']["lastName"]       );
				$insert->bindValue(":email"        , $_POST['Admin']["email"]          );
				$insert->bindValue(":password"     , $_POST['Admin']["password"]       );
				$insert->bindValue(":status"       , $_POST['Admin']["status"]         );
				$insert->bindValue(":createdAt"    , $_POST['Admin']["createdAt"]      );
				/*$insert->bindValue(":updatedAt"    , $_POST['Admin']["updatedAt"]      );*/
		
				$insert->execute();
				


				$message =  $insert->rowCount() . " row inserted " ;
				$this->redirect("index.php?a=grid&c=Admin&message=" . $message );
			
			}
			catch(Exception $e){

/*				$adapter->getConnect()->exec("ROLLBACK");
*/				$this->redirect("index.php?a=grid&c=Admin&message=" . $err = $e->getMessage() );
			}

		}

	}

	public function gridAdmin() /*---------------------------------------------------------gridAdmin()-----------------------------------------*/
	{
		require_once("view/Admin/gridAdmin.php");
		$message = ( !empty( $_GET['message']) ) ? $_GET['message'] : " " ;
		echo($message );
	}

	public function fetchOneAdmin()
	{

		/*if( !$this->adapter->getConnect() ){
            $this->adapter->connect();         
        } */ 

        $adapter = new Model_Core_Adapter();
		
		$query = "SELECT * FROM Admin" ;
		/*$mode =  PDO::FETCH_COLUMN  ;*/
		/*$column = 1;*/
		$result = $adapter->fetchOne($query  ,  1  );
		print_r( $result );
		require_once("view/Admin/gridAdmin.php");
	}
	
	public function errorAction()
	{

		echo(" some error occured ");
	}

}

/*echo('hello');

$Admin = new Controller_Admin();

$method = ( !empty($_GET['a']) )  ? $_GET['a'] . 'Admin'  : 'errorAdmin' ;  

$Admin->$method();*/




?>