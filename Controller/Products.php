
<?php

class Controller_Products{

	public function redirect( $url )
	{
		header("Location:" . $url );
		exit();
	}

	public function addProduct( )
	{
		require_once('view/Products/product_add.php');
	}

	public function editProduct( )
	{
		require_once('view/Products/product_edit.php');
	}

	public function saveProduct( ) /*-----------------------------------------save function------------------------------------------------------------------*/
	{
		$adapter = new Model_Core_Adapter();
		if( !$adapter->getConnect() ){

			$adapter->connect();	
		}
		


		if( array_key_exists( 'p_id' , $_POST ) ){

			if( !(int)$_POST['p_id'] ){
				$message = ' invalid id ' ;
				$this->redirect("index.php?a=grid&c=Products&message=" . $message );
			}

			try{

				$stmt = $adapter->getConnect()->prepare( "update Products set name = :name , price =  :price ,quantity = :quantity , status = :status , createdAt = :createdAt , updatedAt = :updatedAt where id = " . $_POST["p_id"] ) ;

				$stmt->bindValue(":name"      , $_POST["p_name"]           ); 
				$stmt->bindValue(":price"     , (float)$_POST["p_price"]   );
				$stmt->bindValue(":quantity"  , (int)$_POST["p_quantity"]  );
				$stmt->bindValue(":status"    , (int)$_POST["p_status"]    );
				$stmt->bindValue(":createdAt" , $_POST["p_createdAt"]      );
				$stmt->bindValue(":updatedAt" , $_POST["p_updatedAt"]      );

				$stmt->execute();

				echo( " row updated successfully " );
				
			}
			catch(Exception $e){

				$this->redirect("index.php?a=grid&c=Products&message=" . $e->getMessage() );
				
			}
			
		}
		else{

			try{

				$stmt = $adapter->getConnect()->prepare( "insert into Products(name , price , quantity , status , createdAt ) values( :name , :price , :quantity , :status , :createdAt  ) ") ;

				$stmt->bindValue(":name"      , $_POST["p_name"]        );
				$stmt->bindValue(":price"     , $_POST["p_price"]       );
				$stmt->bindValue(":quantity"  , $_POST["p_quantity"]    );
				$stmt->bindValue(":status"    , $_POST["p_status"]      );
				$stmt->bindValue(":createdAt" , $_POST["p_createdAt"]   );
		        /*  $stmt->bindValue(":updatedAt" , $_POST["p_updatedAt"]   ); */
				$stmt->execute();

				echo( " data inserted successfully " );

			}
			catch(Exception $e){

				$this->redirect("index.php?a=grid&c=Products&message=" . $e->getMessage() );
			}
		
		}

		$message = " done " ;
		$this->redirect("index.php?a=grid&c=Products&message=" . $message );

	}

	public function deleteProduct( ) /*------------------------------------------------delete function----------------------------------------------*/
	{
		$adapter = new Model_Core_Adapter();
		if( !$adapter->getConnect() ){

			$adapter->connect();	
		}   

		$del = $adapter->getConnect()->prepare("delete from Products where id = " . $_GET['id'] );    echo('hiiiiiiii');
		$del->execute();

		$message = $del->rowCount() . " row deleted " ;                                
		$this->redirect("index.php?a=grid&c=Products&message=" . $message );           

	}

	public function gridProduct( )
	{
		require_once('view/Products/product_grid.php');
		echo( $_GET['message'] );
	}

	public function errorAction( )
	{
		echo(' error occured ');
	}

}



?>