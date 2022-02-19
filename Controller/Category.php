
<?php   CCC::loadClass('Controller_Core_Action');  ?>
<?php   CCC::loadClass('Model_Category');        ?>

<?php



class Controller_Category extends Controller_Core_Action{

	public function testAction()
	{																										
		# code...
		$model = CCC::getModel('Category');
		$model->getTableName() ; 
		
		
	}

 

	public function redirect($url) /*------------------------------------------redirect()-----------------------------------------------*/
	{
		header('Location:' . $url );
		exit();
	}

	public function gridAction() /*------------------------------------------gridCategory()----------------------------------------------*/
	{
	
		try{
			$categoriesGrid = CCC::getBlock('Category_Grid');
			$categoriesGrid->toHtml();
			$message = ($this->getRequest()->getRequest('message')) ? $this->getRequest()->getRequest('message') : " 123 " ;      
			echo($message );
		}
		catch(Exception $e)
		{
			echo($e->getMessage() );
			exit();
		}	
	}

	public function addAction()   /*----------------------------------------addCategory()---------------------------------------------------*/
	{
	
		$categoriesAdd = CCC::getBlock('Category_Add');
		$categoriesAdd->toHtml();
	}

	public function editAction()  /*----------------------------------------------editCategory()------------------------------------------*/
	{
	
		$categoriesEdit = CCC::getBlock('Category_Edit');
		$categoriesEdit->toHtml();
	}

	public function deleteAction() /*-------------------------------------------------deleteCategory()-------------------------------------*/
	{
		try
		{
			global $adapter ;
			$model = CCC::getModel('Category');			
			$deletedRow = $model->delete( ['id' => $this->getRequest()->getRequest('id')] ) ;
			
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
		global $adapter ; 
		                         
		if(array_key_exists( 'id' , $this->getRequest()->getPost('Category') ) )
		{    

			if(!(int)$this->getRequest()->getPost('Category')['id'] )
			{
				$errorMessage = 'Error - id not valid' ;
				$param['message'] = $errorMessage ;
        		$url = $this->getUrl( 'grid' , 'Category' , $param );
        		$this->redirect( $url );      
        	}

			$parentId = ( $this->getRequest()->getPost('Category')['parentId'] ) ? $this->getRequest()->getPost('Category')['parentId'] : null ;     
        	$wholePath = "" ;
			if($parentId == null)
			{    
				$wholePath =   $this->getRequest()->getPost('Category')['id'] ;
			}
			else
			{                               
		        $stmt = $adapter->fetchAll( "SELECT wholePath FROM Category WHERE id = " . $parentId );          
		        $parentPath = $stmt[0]['wholePath'] ;  
		        $wholePath =  $parentPath . " > " . $this->getRequest()->getPost('Category')['id'] ;   
			}
	       	try
	       	{

	       		$array = $this->getRequest()->getPost('Category');
	       		$array['wholePath'] = $wholePath;
	       		$array['parentId'] = $parentId;
	       	    $model = CCC::getModel('Category');
	       	    $returnRowId = $model->update($array , ['id' => $this->getRequest()->getRequest('Category')['id']  ]);
			
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
				$parentId = (  $this->getRequest()->getPost('Category')['parentId'] ) ?  $this->getRequest()->getPost('Category')['parentId'] : null ;
				$array = $this->getRequest()->getPost('Category');
				$array['parentId'] = $parentId;
				$model = CCC::getModel('Category');				
				$returnRowId = $model->insert($array);
				
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