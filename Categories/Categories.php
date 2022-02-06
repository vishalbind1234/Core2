<?php  require_once("../Adapter.php");  ?>

<?php

class Categories{

	public function redirect($url)
	{
		header('Location:' . $url );
		exit();
	}

	public function gridCategory()
	{
		require_once("gridCategory.php");
		$message = ($_GET['message']) ? $_GET['message'] : " " ;
		echo($message );	
	}

	public function addCategory()
	{
		require_once("addCategory.php");
	}

	public function editCategory()
	{
		require_once("editCategory.php");
	}

	public function deleteCategory()/*-------------------------------------------------deleteCategory()-------------------------------------*/
	{
		try{
			$adapter =  new Adapter();
			$adapter->connect();
			$del = $adapter->getConnect()->prepare("DELETE FROM Categories WHERE id = :id");
			$del->bindValue(":id" , $_GET['id']);
			$del->execute();
        }
        catch(Exception $e){

        	$this->redirect('Categories.php?a=gridCategory&message=' . $e->getMessage() );
        }

        $message = $del->rowCount() . " rows deleted" ;
		$this->redirect('Categories.php?a=gridCategory&message=' . $message );
	}

	public function saveCategory() /*----------------------------------------------------saveCategory()----------------------------------------*/
	{
		$adapter =  new Adapter();        
		$adapter->connect();              
		if($_POST['Category']['id']){  

			try{
				$update = $adapter->getConnect()->prepare(" UPDATE Categories 
															SET name = :name ,
									         					status = :status ,
																createdAt = :createdAt ,
																updatedAt =  :updatedAt 
														    WHERE id = :id "  );

				$update->bindValue( ":name"      ,  $_POST['Category']['name']      );
				$update->bindValue( ":status"    ,  $_POST['Category']['status']    );
				$update->bindValue( ":createdAt" ,  $_POST['Category']['createdAt'] );
				$update->bindValue( ":updatedAt" ,  $_POST['Category']['updatedAt'] );
				$update->bindValue( ":id"        ,  $_POST['Category']['id']        );
					  					 
				$update->execute();
			}
			catch(Exception $e){

				$this->redirect('Categories.php?a=gridCategory&message=' . $e->getMessage() );
			}	

			$message = $update->rowCount() . " row updated " ;
			$this->redirect('Categories.php?a=gridCategory&message=' . $message );

		}	
		else{  

			try{ 

				$insert = $adapter->getConnect()->prepare(" INSERT INTO Categories( name, status, createdAt) 
															VALUES (:name,:status,:createdAt) ");

				$insert->bindValue( ":name"      ,  $_POST['Category']['name'] );
				$insert->bindValue( ":status"    ,  $_POST['Category']['status'] );
				$insert->bindValue( ":createdAt" ,  $_POST['Category']['createdAt'] );
				
					  					
				$insert->execute();
			}
			catch(Exception $e){

				$this->redirect('Categories.php?a=gridCategory&message=' . $e->getMessage() );
			}

			$message = $insert->rowCount() . " row inserted " ;
			$this->redirect('Categories.php?a=gridCategory&message=' . $message );

			
		}

	}

	public function errorAction()
	{
		echo("error occured in url");
		exit();		
	}


}

$method = ($_GET['a']) ? $_GET['a'] : errorAction ;
$category = new Categories();
$category->$method();


?>