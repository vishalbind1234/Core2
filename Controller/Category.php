
<?php   Ccc::loadClass('Controller_Core_Action');  ?>
<?php   Ccc::loadClass('Model_Category');        ?>

<?php   



class Controller_Category extends Controller_Core_Action{

	public function testAction()
	{																										
		# code...
		$model = Ccc::getModel('Category');
		$model->getTableName() ; 
		
		
	}

 

	public function redirect($url) /*------------------------------------------redirect()-----------------------------------------------*/
	{
		header('Location:' . $url );
		exit();
	}

	public function gridAction() /*------------------------------------------gridCategory()----------------------------------------------*/
	{										
	
		try
		{		
			$categoriesGrid = Ccc::getBlock('Category_Grid'); 
			$categoriesGrid->toHtml();							
			$message = ($this->getRequest()->getRequest('message')) ? $this->getRequest()->getRequest('message') : "123" ;      
			echo($message );
		}
		catch(Exception $e)
		{
			echo($e->getMessage() );
			exit();
		}	
	}


	public function editAction()  /*----------------------------------------------editCategory()------------------------------------------*/
	{
																				
		$categoriesEdit = Ccc::getBlock('Category_Edit');      
		$categoriesEdit->toHtml();
	}

	public function deleteAction() /*-------------------------------------------------deleteCategory()-------------------------------------*/
	{
		try
		{
			
			$modelCategory = Ccc::getModel('Category');
			$id = $this->getRequest()->getRequest('id');			
			$deletedRow =  $modelCategory->delete($id);
				
      	}
        catch(Exception $e)
        {
        	$message = $e->getMessage() ;
		    $param['message'] = $message ;
		    $url = $this->getUrl('grid' , 'Category' , $param );
			$this->redirect($url);
        	
        }
        $message = " rows id " . $deletedRow .  " deleted" ;
        $param['message'] = $message;
        $url = $this->getUrl('grid' , 'Category' , $param );
		$this->redirect($url);

	}

	public function saveAction() /*----------------------------------------------------saveCategory()----------------------------------------*/
	{
																		
		$adapter = $this->getAdapter();									
		$array = $this->getRequest()->getPost('Category');
		$categoryModel = Ccc::getModel('Category');	



		if(array_key_exists( 'id' , $array )  && $array['id'] != null )
		{    
			if(!(int)$array['id'] )
			{
				$errorMessage = 'Error - id not valid' ;
				$param['message'] = $errorMessage ;
        		$url = $this->getUrl( 'grid' , 'Category' , $param );
        		$this->redirect( $url );      
        	}

			$parentId = ( isset($array['parentId']) ) ? $array['parentId'] : null ;    
        	$wholePath = "" ;
			if($parentId == null)
			{    
				$wholePath =   $array['id'] ;
			}
			else
			{                               
		        $row = $categoryModel->load($parentId);          
		        //$stmt = $adapter->fetchRow( "SELECT wholePath FROM Category WHERE id = {$parentId} " );          
		        $parentPath = $row->wholePath ;  						
		        $wholePath =  $parentPath . " > " . $array['id'] ;   
			}
	       	try
	       	{
	       		$array['wholePath'] = $wholePath;
	       		$array['parentId'] = $parentId;
	       		$array['updatedAt'] = date('Y-m-d');

	       	    foreach ($array as $key => $value) 
	       	    {
	       	    	$categoryModel->$key = $value;
	       	    }
	       	    $returnRowId = $categoryModel->save();
			}
			catch(Exception $e)
			{
				$message = $e->getMessage();
				$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Category' , $param );
        		$this->redirect( $url );
			}	
			
		}	
		else
		{  
			try
			{ 
				$parentId = (  isset($array['parentId']) ) ?  $array['parentId'] : null ;        
				$array['parentId'] = $parentId;
				$array['wholePath'] = null;
			
	       	    foreach ($array as $key => $value) 
	       	    {
	       	    	$categoryModel->$key = $value;
	       	    }										//print_r($category);  var_dump($category);  exit();
	       	    $returnRowId = $categoryModel->save();  

				$wholePath = "";
				if($parentId == null)
				{
					$wholePath = $returnRowId;
				}			
				else
				{
					$stmt = $categoryModel->load($parentId); 
					$parentPath = $stmt->wholePath;
					$wholePath = $parentPath . " > " . $returnRowId; 	
				}

				$array['wholePath'] = $wholePath;
				$array['id'] = $returnRowId;
				foreach ($array as $key => $value) 
	       	    {
	       	    	$categoryModel->$key = $value;
	       	    }
				$categoryModel->wholePath = $wholePath;       //print_r($categoryModel);  exit();
				$returnRowId =  $categoryModel->save();

			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Category' , $param );
				$this->redirect( $url );
			}
		
		}

		$message = " row id " . $returnRowId . " updated/inserted successfully" ;
		$param['message'] = $message;
		$url = $this->getUrl( 'grid' , 'Category' , $param );
		$this->redirect( $url );

	}


	
	public function errorAction() /*----------------------------------------------------------errorAction()-------------------------------------------------*/
	{
		echo("error occured in url");
		exit();		
	}


}







?>