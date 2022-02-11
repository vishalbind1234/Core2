
<?php  

	require_once("Model/Core/Adapter.php"); 

 ?>

<?php 

class Controller_Customers{

	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function addAction()
	{
		require_once("view/Customers/addAction.php");
	}

	public function editAction()
	{
		
		require_once("view/Customers/editAction.php");
		
	}

	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
          	$adapter = new Model_Core_Adapter();

            if( !$adapter->getConnect() ){
                $adapter->connect();
            }  
          
            $del = $adapter->getConnect()->prepare( "delete  from Customers where id = :id" );
            $del->bindValue(":id" , $_GET['id'] );  
            $del->execute();                          /*-----$del->execute() returns boolean value-------$del->rowCount()----Return no of rows----*/

        }
        catch(Exception $e){

        	$this->redirect("index.php?a=grid&c=Customers&message=" . $err = $e->getMessage() );
        }	
		
		$message = $del->rowCount() . '  row deleted' ;

        $this->redirect("index.php?a=grid&c=Customers&message=" . $message );
	
	}

	public function saveAction() /*-----------------------------------------saveAction()-------------------------------------------------------------*/
	{     

		$adapter = new Model_Core_Adapter();
		if( !$adapter->getConnect() ){
            $adapter->connect();         
        }  

        var_dump( array_key_exists( 'id' , $_POST['Person'] ) );

        if(array_key_exists( 'id' , $_POST['Person'] )) {    /* update if key exist */ 

        	if(!(int)$_POST['Person']['id']){
        		$message = 'error : id not valid ';
        		$this->redirect("index.php?a=grid&c=Customers&message=" . $message);      
        	}

			try{  


				$update = $adapter->getConnect()->prepare( "UPDATE Customers 
														  SET firstName =  :firstName , 
													          lastName  =  :lastName  ,
														      email     =  :email     ,
															  mobile    =  :mobile    ,
															  createdAt =  :createdAt ,
															  updatedAt =  :updatedAt 
														  WHERE id = " .  $_POST['Person']['id'] );  
															  
				$update->bindValue(":firstName"    , $_POST['Person']["firstName"]      ); 
				$update->bindValue(":lastName"     , $_POST['Person']["lastName"]       );
				$update->bindValue(":email"        , $_POST['Person']["email"]          );
				$update->bindValue(":mobile"       , $_POST['Person']["mobile"]         );
				$update->bindValue(":createdAt"    , $_POST['Person']["createdAt"]      );
				$update->bindValue(":updatedAt"    , $_POST['Person']["updatedAt"]      );

				$update->execute();

				$shipping = ($_POST['Address']["shipping"] == "1" ) ? 1 : 0 ;
				$billing = ($_POST['Address']["billing"] == "1" ) ? 1 : 0 ;

				$update = $adapter->getConnect()->prepare( "UPDATE Address 
														  SET customerId =  :customerId ,   
															  address    =  :address , 
															  pincode    =  :pincode , 
															  city       =  :city    , 
															  state      =  :state   , 
															  country  =  :country   , 
															  billing  =  :billing   , 
															  shipping =  :shipping 
														  WHERE aId = " .  $_POST['Address']['aId'] );


				$update->bindValue(":customerId"    , $_POST['Address']["customerId"]    );
				$update->bindValue(":address"       , $_POST['Address']["address"]       );
				$update->bindValue(":pincode"       , $_POST['Address']["pincode"]       );
				$update->bindValue(":city"          , $_POST['Address']["city"]          );
				$update->bindValue(":state"         , $_POST['Address']["state"]         );
				$update->bindValue(":country"       , $_POST['Address']["country"]       );
				$update->bindValue(":billing"       , $billing    );
				$update->bindValue(":shipping"      , $shipping   );
				
				$update->execute();

				$message =  $update->rowCount() . " row updated " ;
				$this->redirect("index.php?a=grid&c=Customers&message=" . $message );

			}
			catch(Exception $e){

				$this->redirect("index.php?a=grid&c=Customers&message=" . $err = $e->getMessage() );
			}

		}    
		else{                       
			
			try{           

/*				$commit = $adapter->getConnect()->exec("COMMIT");
*/
				$insert = $adapter->getConnect()->prepare( "INSERT INTO 
							Customers(firstName , lastName , email , mobile , createdAt  ) 
					    	VALUES( :firstName , :lastName , :email , :mobile , :createdAt  )" );    /* no need of updateAt during insert Add New */

				$insert->bindValue(":firstName"    , $_POST['Person']["firstName"]      ); 
				$insert->bindValue(":lastName"     , $_POST['Person']["lastName"]       );
				$insert->bindValue(":email"        , $_POST['Person']["email"]          );
				$insert->bindValue(":mobile"       , $_POST['Person']["mobile"]         );
				$insert->bindValue(":createdAt"    , $_POST['Person']["createdAt"]      );
				/*$insert->bindValue(":updatedAt"    , $_POST['Person']["updatedAt"]      );*/
		
				$insert->execute();
				

				$insert = $adapter->getConnect()->prepare("SELECT * FROM Customers ORDER BY id DESC LIMIT 1");
				$insert->execute();
				$result = $insert->fetchAll(PDO::FETCH_ASSOC);
				$customerId = $result['0']['id'];

				$shipping = ($_POST['Address']["shipping"] == "1" ) ? 1 : 0 ;
				$billing = ($_POST['Address']["billing"] == "1" ) ? 1 : 0 ;
				
				$insert = $adapter->getConnect()->prepare( "INSERT INTO 
					    	Address(customerId  , address , pincode , city , state , country , billing , shipping )
					    	VALUES(:customerId  , :address , :pincode , :city , :state , :country , :billing , :shipping )" );

						$insert->bindValue(":customerId" , $customerId                      ); 
						$insert->bindValue(":address"    , $_POST['Address']["address"]     ); 
						$insert->bindValue(":pincode"    , $_POST['Address']["pincode"]     ); 
						$insert->bindValue(":city"       , $_POST['Address']["city"]        ); 
						$insert->bindValue(":state"      , $_POST['Address']["state"]       ); 
						$insert->bindValue(":country"    , $_POST['Address']["country"]      ); 
						$insert->bindValue(":billing"    , $billing      ); 
						$insert->bindValue(":shipping"   , $shipping     ); 
				
				$insert->execute();  

				$message =  $insert->rowCount() . " row inserted " ;
				$this->redirect("index.php?a=grid&c=Customers&message=" . $message );
			
			}
			catch(Exception $e){

/*				$adapter->getConnect()->exec("ROLLBACK");
*/				$this->redirect("index.php?a=grid&c=Customers&message=" . $err = $e->getMessage() );
			}

		}

	}

	public function gridAction() /*---------------------------------------------------------gridAction()-----------------------------------------*/
	{
		require_once("view/Customers/gridAction.php");
		$message = ( !empty( $_GET['message']) ) ? $_GET['message'] : " " ;
		echo($message );
	}

	public function errorAction()
	{
		echo(" some error occured ");
	}
	

}

echo('hello');

$customer = new Controller_Customers();

$action = ( !empty($_GET['a']) )  ? $_GET['a'] . 'Action'  : 'errorAction' ;  

$customer->$action();



?>