
<?php  

	require_once("../Adapter.php"); 

 ?>

<?php 

class Customers{

	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function addAction()
	{
		require_once("addAction.php");
	}

	public function editAction()
	{
		
		require_once("editAction.php");
		
	}

	public function deleteAction()  
	{
		try{
            
          	$adapter = new Adapter();

            if( !$adapter->getConnect() ){
                $adapter->connect();
            }  
          
            $del = $adapter->getConnect()->prepare( "delete  from Customers where id = :id" );
            $del->bindValue(":id" , $_GET['id'] );  
            $del->execute();                          /*-----$del->execute() returns boolean value-------$del->rowCount()----Return no of rows----*/

        }
        catch(Exception $e){

        	$this->redirect("Customers.php?a=gridAction&message=" . $err = $e->getMessage() );
        }	
		
		$message = $del->rowCount() . '  row deleted' ;

        $this->redirect("Customers.php?a=gridAction&message=" . $message );
	
	}

	public function saveAction() /*-----------------------------------------saveAction()--------------------------------*/
	{     

		$adapter = new Adapter();
		if( !$adapter->getConnect() ){
            $adapter->connect();         
        }  

        var_dump( array_key_exists( 'id' , $_POST['Person'] ) );

        if(array_key_exists( 'id' , $_POST['Person'] )) {    /* update if key exist */ 

        	if(!(int)$_POST['Person']['id']){
        		$message = 'error : id not valid ';
        		$this->redirect("Customers.php?a=gridAction&message=" . $message);      
        	}

			try{  


				$stmt = $adapter->getConnect()->prepare( "UPDATE Customers 
														  SET firstName =  :firstName , 
													          lastName  =  :lastName  ,
														      email     =  :email     ,
															  mobile    =  :mobile    ,
															  createdAt =  :createdAt ,
															  updatedAt =  :updatedAt 
														  WHERE id = " .  $_POST['Person']['id'] );  
															  
				$stmt->bindValue(":firstName"    , $_POST['Person']["firstName"]      ); 
				$stmt->bindValue(":lastName"     , $_POST['Person']["lastName"]       );
				$stmt->bindValue(":email"        , $_POST['Person']["email"]          );
				$stmt->bindValue(":mobile"       , $_POST['Person']["mobile"]         );
				$stmt->bindValue(":createdAt"    , $_POST['Person']["createdAt"]      );
				$stmt->bindValue(":updatedAt"    , $_POST['Person']["updatedAt"]      );

				$stmt->execute();

				
				$stmt = $adapter->getConnect()->prepare( "UPDATE Address 
														  SET customerId =  :customerId ,   
															  address    =  :address , 
															  pincode    =  :pincode , 
															  city       =  :city    , 
															  state      =  :state   , 
															  country  =  :country   , 
															  billing  =  :billing   , 
															  shipping =  :shipping 
														  WHERE aId = " .  $_POST['Address']['aId'] );


				$stmt->bindValue(":customerId"    , $_POST['Address']["customerId"]    );
				$stmt->bindValue(":address"       , $_POST['Address']["address"]       );
				$stmt->bindValue(":pincode"       , $_POST['Address']["pincode"]       );
				$stmt->bindValue(":city"          , $_POST['Address']["city"]          );
				$stmt->bindValue(":state"         , $_POST['Address']["state"]         );
				$stmt->bindValue(":country"       , $_POST['Address']["country"]       );
				$stmt->bindValue(":billing"       , $_POST['Address']["billing"]       );
				$stmt->bindValue(":shipping"      , $_POST['Address']["shipping"]      );
				
				$stmt->execute();

			}
			catch(Exception $e){

				$this->redirect("Customers.php?a=gridAction&message=" . $err = $e->getMessage() );
			}

		}    
		else{                       
			
			try{           

				$stmt = $adapter->getConnect()->prepare( "INSERT INTO 
							Customers(firstName , lastName , email , mobile , createdAt  ) 
					    	VALUES( :firstName , :lastName , :email , :mobile , :createdAt  )" );    /* no need of updateAt during insert Add New */

				$stmt->bindValue(":firstName"    , $_POST['Person']["firstName"]      ); 
				$stmt->bindValue(":lastName"     , $_POST['Person']["lastName"]       );
				$stmt->bindValue(":email"        , $_POST['Person']["email"]          );
				$stmt->bindValue(":mobile"       , $_POST['Person']["mobile"]         );
				$stmt->bindValue(":createdAt"    , $_POST['Person']["createdAt"]      );
				/*$stmt->bindValue(":updatedAt"    , $_POST['Person']["updatedAt"]      );*/
		
				$stmt->execute();

				$stmt = $adapter->getConnect()->prepare("SELECT * FROM Customers ORDER BY id DESC LIMIT 1");
				$stmt->execute();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$customerId = $result['0']['id'];

				$stmt = $adapter->getConnect()->prepare( "INSERT INTO 
					    	Address(customerId  , address , pincode , city , state , country , billing , shipping )
					    	VALUES(:customerId  , :address , :pincode , :city , :state , :country , :billing , :shipping )" );

						$stmt->bindValue(":customerId" , $customerId                      ); 
						$stmt->bindValue(":address"    , $_POST['Address']["address"]     ); 
						$stmt->bindValue(":pincode"    , $_POST['Address']["pincode"]     ); 
						$stmt->bindValue(":city"       , $_POST['Address']["city"]        ); 
						$stmt->bindValue(":state"      , $_POST['Address']["state"]       ); 
						$stmt->bindValue(":country"    , $_POST['Address']["country"]      ); 
						$stmt->bindValue(":billing"    , $_POST['Address']["billing"]      ); 
						$stmt->bindValue(":shipping"   , $_POST['Address']["shipping"]     ); 
				
				$stmt->execute();  

			}
			catch(Exception $e){

				$this->redirect("Customers.php?a=gridAction&message=" . $err = $e->getMessage() );
			}

		}
		$this->redirect("Customers.php?a=gridAction");
	}

	public function gridAction()
	{
		require_once("gridAction.php");
		$message = ($_GET['message']) ? $_GET['message'] : " " ;
		echo($message );
	}

	public function errorAction()
	{
		echo(" some error occured ");
	}
	

}


$customer = new Customers();

$action = ($_GET['a']) ? $_GET['a'] : 'errorAction' ;

$customer->$action();



?>