
<?php

class Controller_Categories{

	public function redirect($url)
	{
		header('Location:' . $url );
		exit();
	}

	public function gridCategory()
	{
		require_once("view/Categories/gridCategory.php");
		$message = ($_GET['message']) ? $_GET['message'] : " " ;
		echo($message );	
	}

	public function addCategory()
	{
		require_once("view/Categories/addCategory.php");
	}

	public function editCategory()
	{
		require_once("view/Categories/editCategory.php");
	}

	public function deleteCategory()/*-------------------------------------------------deleteCategory()-------------------------------------*/
	{
		try{
			$adapter =  new Model_Core_Adapter();
			$adapter->connect();
			$del = $adapter->getConnect()->prepare("DELETE FROM Categories WHERE id = :id");
			$del->bindValue(":id" , $_GET['id']);
			$del->execute();
        }
        catch(Exception $e){

        	$this->redirect('index.php?a=grid&c=Categories&message=' . $e->getMessage() );
        }

        $message = $del->rowCount() . " rows deleted" ;
		$this->redirect('index.php?a=grid&c=Categories&message=' . $message );

	}

	public function saveCategory() /*----------------------------------------------------saveCategory()----------------------------------------*/
	{
		$adapter =  new Model_Core_Adapter();          
		$adapter->connect();                           

		if(array_key_exists( 'id' , $_POST['Category'] ) ){    

			if(!(int)$_POST['Category']['id']){
        		$message = 'error : id not valid ';
        		$this->redirect("index.php?a=grid&c=Categories&message=" . $message );      
        	}



        	$parentId = ( $_POST['Category']['parentId'] ) ? $_POST['Category']['parentId'] : null ;     

        	$wholePath = "" ;
			if($parentId == null){    

				$wholePath =   $_POST['Category']['id'] ;
			}
			else{                               

		        $stmt = $adapter->fetch( "SELECT wholePath FROM Categories WHERE id = " . $parentId );          
		        $parentPath = $stmt[0]['wholePath'] ;  
		        $wholePath =  $parentPath . " > " . $_POST['Category']['id'] ;   

			}
	       	


			try{
				$update = $adapter->getConnect()->prepare(" UPDATE Categories 
															SET parentId   = :parentId ,
															    name       = :name ,
															    wholePath  = :wholePath ,
									         					status     = :status ,
																createdAt  = :createdAt ,
																updatedAt  =  :updatedAt 
														    WHERE id = :id "  );

				$parentId = ( $_POST['Category']['parentId'] ) ? $_POST['Category']['parentId'] : null ;

				$update->bindValue( ":parentId"  ,  $parentId    );
				$update->bindValue( ":wholePath" ,  $wholePath   );
				$update->bindValue( ":name"      ,  $_POST['Category']['name']      );
				$update->bindValue( ":status"    ,  $_POST['Category']['status']    );
				$update->bindValue( ":createdAt" ,  $_POST['Category']['createdAt'] );
				$update->bindValue( ":updatedAt" ,  $_POST['Category']['updatedAt'] );
				$update->bindValue( ":id"        ,  $_POST['Category']['id']        );
					  					 
				$update->execute();
				/*throw( new Exception('you are right') );*/
			}
			catch(Exception $e){

				$this->redirect('index.php?a=grid&c=Categories&message=' . $e->getMessage() );
			}	

			$message = $update->rowCount() . " row updated " ;
			$this->redirect('index.php?a=grid&c=Categories&message=' . $message );


		}	
		else{  

			try{ 
		       

				$parentId = ( $_POST['Category']['parentId'] ) ? $_POST['Category']['parentId'] : null ;

			

				$insert = $adapter->getConnect()->prepare(" INSERT INTO Categories( parentId , name, wholePath , status, createdAt) 
															VALUES ( :parentId , :name , :wholePath , :status , :createdAt) ");

				$insert->bindValue( ":parentId"  ,  $parentId     );
				$insert->bindValue( ":wholePath" ,  $_POST['Category']['wholePath']    );
				$insert->bindValue( ":name"      ,  $_POST['Category']['name']      );
				$insert->bindValue( ":status"    ,  $_POST['Category']['status']    );
				$insert->bindValue( ":createdAt" ,  $_POST['Category']['createdAt'] );
									  					
				$insert->execute();


				$stmt = $adapter->fetch( "SELECT id FROM Categories ORDER BY id DESC LIMIT 1 ") ;
				$id = $stmt[0]['id'] ;

				$wholePath  ;

				if($parentId == null){

					$wholePath =  $id ;
				}
				else{ 

					$stmt = $adapter->fetch( "SELECT wholePath FROM Categories WHERE id = " . $parentId );          
			        $parentPath = $stmt[0]['wholePath'] ; 
			        $wholePath =  $parentPath . " > " . $id ; 
				}
		       		
		       	
		        $stmt = $adapter->getConnect()->prepare( " UPDATE Categories SET wholePath = :wholePath  WHERE id = :id " ); 
		        $stmt->bindValue( ":wholePath" ,  $wholePath    ); 
		        $stmt->bindValue( ":id"        ,  $id           );

		        $stmt->execute();






			}
			catch(Exception $e){

				$this->redirect('index.php?a=grid&c=Categories&message=' . $e->getMessage() );
			}

			$message = $insert->rowCount() . " row inserted " ;
			$this->redirect('index.php?a=grid&c=Categories&message=' . $message );

			
		}

	}

	public function fetchOne( $column )
	{

        $adapter = new Model_Core_Adapter();
		
		$query = "SELECT * FROM Categories " ;
		$mode =  PDO::FETCH_COLUMN  ;
		$result = $adapter->fetchOne($query  , $mode  , $column);
		print_r( $result );
		require_once("view/Admin/gridAdmin.php");
	}


	public function errorAction()
	{
		echo("error occured in url");
		exit();		
	}


}

/*$method = ( !empty( $_GET['a']) ) ? $_GET['a'] . 'Category' : 'errorAction' ;
$category = new Controller_Categories();
$category->$method();
*/

?>