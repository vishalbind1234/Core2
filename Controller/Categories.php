
<?php   CCC::loadClass('Controller_Core_Action');   ?>

<?php

class Controller_Categories extends Controller_Core_Action{

	public function redirect($url) /*------------------------------------------redirect()-----------------------------------------------*/
	{
		header('Location:' . $url );
		exit();
	}

	public function gridCategory() /*------------------------------------------gridCategory()----------------------------------------------*/
	{
		global $adapter;

		function wholePathName( $id )
		{
			global $adapter;	

			$query = "SELECT * FROM Categories";
			$idNameArray = $adapter->fetchPairs('id' , 'name' , 'Categories');
			$idWholePathArray = $adapter->fetchPairs('id' , 'wholePath' , 'Categories');
			
		    $wholePathAsArray = explode( " > " , $idWholePathArray[$id] );  // note the spaces around seperator ( > ) is also a path of delimiter  //
		    $wholePathAsString = "";
		    foreach ($wholePathAsArray as $key => $value) {
		    	# code...
		     	$wholePathAsString = $wholePathAsString  . $idNameArray[$value] .  " > "  ; 
		    }
		    return $wholePathAsString;
		}

		$data = $adapter->fetch("SELECT * FROM Categories ORDER BY wholePath ");
		$this->getView()->addData('Categories' , $data);
		$this->getView()->setTemplate("view/Categories/gridCategory.php")->toHtml();

		$message = ($_GET['message']) ? $_GET['message'] : " " ;
		echo($message );	
	}

	public function addCategory() /*----------------------------------------addCategory()---------------------------------------------------*/
	{
		global $adapter;
		$data = $adapter->fetch("SELECT id , name FROM Categories");
		$this->getView()->addData('Categories' , $data);
		$this->getView()->setTemplate("view/Categories/addCategory.php")->toHtml();
	}

	public function editCategory()  /*----------------------------------------------editCategory()------------------------------------------*/
	{
		global $adapter ;

		function canBePlaced( $id  , $currentRecordParentId )
		{
			global $adapter;
			$query = "SELECT * FROM Categories";
			$idNameArray = $adapter->fetchPairs('id' , 'name' , 'Categories');
			$idWholePathArray = $adapter->fetchPairs('id' , 'wholePath' , 'Categories');

		    $wholePathAsArray = explode( " > " , $idWholePathArray[$id] ); 
		    $wholePathAsArray[sizeof($wholePathAsArray) - 1] = 0;           /*-----just excluded parent from array (check) so that it appears in the list------*/
		    if(  in_array( $currentRecordParentId , $wholePathAsArray ) )
		    {
		   		return false;
		    }
		    return true;
		}

		$Parent = $adapter->fetch("SELECT id , parentId , name FROM Categories");   /*---returns all table rows ----*/
		$this->getView()->addData('Parent' , $Parent);
		$data = $adapter->fetch("SELECT * FROM Categories WHERE id =" . $_GET['id'] );  /*----returns current record----*/
		$this->getView()->addData('Categories' , $data);
		$this->getView()->setTemplate("view/Categories/editCategory.php")->toHtml();
	}

	public function deleteCategory()/*-------------------------------------------------deleteCategory()-------------------------------------*/
	{
		try
		{
			global $adapter ;
			$query =  " DELETE FROM Categories WHERE id = " . $_GET['id'] ;
			$count = $adapter->delete( $query );
        }
        catch(Exception $e)
        {
        	$this->redirect('index.php?a=grid&c=Categories&message=' . $e->getMessage() );
        }
        $message = $count . " rows deleted" ;
		$this->redirect('index.php?a=grid&c=Categories&message=' . $message );

	}

	public function saveCategory() /*----------------------------------------------------saveCategory()----------------------------------------*/
	{
		global $adapter ;         
		$adapter->connect();                           
		if(array_key_exists( 'id' , $_POST['Category'] ) )
		{    
			if(!(int)$_POST['Category']['id'])
			{
        		$message = 'error : id not valid ';
        		$this->redirect("index.php?a=grid&c=Categories&message=" . $message );      
        	}

			$parentId = ( $_POST['Category']['parentId'] ) ? $_POST['Category']['parentId'] : null ;     
        	$wholePath = "" ;
			if($parentId == null)
			{    
				$wholePath =   $_POST['Category']['id'] ;
			}
			else
			{                               
		        $stmt = $adapter->fetch( "SELECT wholePath FROM Categories WHERE id = " . $parentId );          
		        $parentPath = $stmt[0]['wholePath'] ;  
		        $wholePath =  $parentPath . " > " . $_POST['Category']['id'] ;   
			}
	       	try
	       	{
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
			catch(Exception $e)
			{
				$this->redirect('index.php?a=grid&c=Categories&message=' . $e->getMessage() );
			}	

			$message = $update->rowCount() . " row updated " ;
			$this->redirect('index.php?a=grid&c=Categories&message=' . $message );
		}	
		else
		{  
			try
			{ 
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
				if($parentId == null)
				{
					$wholePath =  $id ;
				}
				else
				{ 
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

	public function errorAction() /*----------------------------------------------------------errorAction()-------------------------------------------------*/
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