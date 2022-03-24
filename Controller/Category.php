
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
			 //code...
			$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
			$perPageCount =  ($this->getRequest()->getRequest('perPageCount')) ? $this->getRequest()->getRequest('perPageCount') : 10 ;
			$this->getMessage()->addMessage(" On Page " . $currentPage );

			$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
			$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
			$categoryGrid = Ccc::getBlock('Category_Grid');
			$categoryGrid->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);

			$this->setTitle('Category_Grid');
			$this->getLayout()->getContent()->setChild($categoryGrid);
			$this->getLayout()->getHeader()->setChild($menu);
			$this->getLayout()->getFooter()->setChild($blockMessage);
			$this->renderLayout();	

			$this->getMessage()->unsetMessages();

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
																		
		$array = $this->getRequest()->getPost('Category');

		if(array_key_exists( 'id' , $array )  && $array['id'] != null )
		{   

	       	try
	       	{
				if(!(int)$array['id'] )
				{
					throw new Exception(" ID not Valid. ");     
	        	}

				$parentId = ( isset($array['parentId']) ) ? $array['parentId'] : null ;    
	        	$wholePath = "" ;
	        	$categoryModel = Ccc::getModel('Category');
				if($parentId == null)
				{    
					$wholePath =   $array['id'] ;
				}
				else
				{                               
	       			//$categoryModel = Ccc::getModel('Category');
			        $row = $categoryModel->load($parentId);          
			        $parentPath = $row->wholePath ;  						
			        $wholePath =  $parentPath . " > " . $array['id'] ;   
				}
	       		$array['wholePath'] = $wholePath;
	       		$array['parentId'] = $parentId;
	       		$array['updatedAt'] = date('Y-m-d');

				$rowId = $categoryModel->setData($array)->save();
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
				$parentId = (isset($array['parentId'])) ?  $array['parentId'] : null ;        
				$array['parentId'] = $parentId;
				$array['wholePath'] = null;
				
				$categoryModel = Ccc::getModel('Category');
	       	   	$rowId = $categoryModel->setData($array)->save();								//print_r($category);  var_dump($category);  exit();

				$wholePath = "";
				if($parentId == null)
				{
					$wholePath = $rowId;
				}			
				else
				{
					$stmt = $categoryModel->load($parentId); 
					$parentPath = $stmt->wholePath;
					$wholePath = $parentPath . " > " . $rowId; 	
				}

				$array['wholePath'] = $wholePath;
				$array['id'] = $rowId;

				$categoryModel = Ccc::getModel('Category');
	       	   	$rowId = $categoryModel->setData($array)->save();
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl( 'grid' , 'Category');
				$this->redirect($url);
			}
		
		}

		$message = "row id " . $rowId . " Saved  " ;
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