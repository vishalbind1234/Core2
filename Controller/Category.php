
<?php   Ccc::loadClass('Controller_Admin_Action');  ?>
<?php   Ccc::loadClass('Model_Category');        ?>

<?php   



class Controller_Category extends Controller_Admin_Action{

	public function testAction()
	{																										
		$model = Ccc::getModel('Category');
		$model->getTableName() ; 
	}

	public function gridAction() /*------------------------------------------gridCategory()----------------------------------------------*/
	{										
		try
		{	
			$this->getMessage()->getSession()->start();

			$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
			$categoryGrid = Ccc::getBlock('Category_Grid');
			$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

			$this->setTitle('Category_Grid');
			$this->getLayout()->getContent()->setChild($categoryGrid);
			$this->getLayout()->getHeader()->setChild($menu);
			$this->getLayout()->getFooter()->setChild($blockMessage);
			$this->renderLayout();	

			$this->getMessage()->unsetMessages();

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


		$id = $this->getRequest()->getRequest('id');																		

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$categoryEdit = Ccc::getBlock('Category_Edit')->setData(['id' => $id]);
		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($categoryEdit);
		$this->renderLayout();	     
		//$categoriesEdit->toHtml();
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
        	$msg = $e->getMessage();
			$modelMessage = $this->getMessage();
            $modelMessage->addMessage($msg);
		    $url = $this->getUrl('grid' , 'Category');
			$this->redirect($url);
        	
        }
        $message = " rows id " . $deletedRow .  " deleted" ;
        $modelMessage = $this->getMessage();
        $modelMessage->addMessage($message);
        $url = $this->getUrl('grid' , 'Category');
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
				$message = 'error : id not valid. ';
        		$msg = $this->getMessage();
        		$msg->addMessage($message , Model_Core_Message::ERROR); 
        		$url = $this->getUrl( 'grid' , 'Category' );
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
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl( 'grid' , 'Category' );
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
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl( 'grid' , 'Category');
				$this->redirect( $url );
			}
		
		}

		$message = "row id " . $returnedRowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl( 'grid' , 'Category' );
		$this->redirect( $url );

	}


	
	public function errorAction() /*----------------------------------------------------------errorAction()-------------------------------------------------*/
	{
		echo("error occured in url");
		exit();		
	}


}







?>