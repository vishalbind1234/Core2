
<?php  CCC::loadClass('Controller_Core_Action');   ?>

<?php

class Controller_Products extends Controller_Core_Action{

	public function redirect( $url )
	{
		header("Location:" . $url );
		exit();
	}

	public function addProduct( )
	{
		global $adapter;
		$this->getView()->setTemplate('view/Products/product_add.php')->toHtml();
	}

	public function editProduct( )
	{
		global $adapter;
		$data = $adapter->fetch("SELECT * FROM Products WHERE id = " . $_GET['id'] );
		$this->getView()->setData($data);
		date_default_timezone_set('Asia/Kolkata'); 
		$this->getView()->setTemplate('view/Products/product_edit.php')->toHtml();
	}

	public function saveProduct( ) /*-----------------------------------------save function------------------------------------------------------------------*/
	{
		global $adapter ;
		if( !$adapter->getConnect() ){
			$adapter->connect();	
		}
		if( array_key_exists( 'p_id' , $_POST ) ){

			if( !(int)$_POST['p_id'] )
			{
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
			catch(Exception $e)
			{
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
		global $adapter ;
		$count = $adapter->delete("DELETE FROM Products WHERE id = " . $_GET['id'] );   
		$message = $count . " row deleted " ;                                
		$this->redirect("index.php?a=grid&c=Products&message=" . $message );           
	}

	public function gridProduct( )
	{	
		global $adapter;
		$query = "SELECT * FROM Products" ;
		$data = $adapter->fetch($query);
		$this->getView()->setData($data);
		$this->getView()->setTemplate("view/Products/product_grid.php")->toHtml();
	}

	public function errorAction( )
	{
		echo(' error occured ');
	}

}



?>