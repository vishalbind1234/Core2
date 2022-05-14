
<?php   Ccc::loadClass('Controller_Admin_Action');  ?>
<?php   Ccc::loadClass('Model_Category');        ?>

<?php   



class Controller_Category extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$categoryGrid = Ccc::getBlock('Category_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $categoryGrid,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);

		$this->getMessage()->unsetMessages("cart");
	}

	public function gridAction() /*------------------------------------------gridCategory()----------------------------------------------*/
	{										
	
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage, Model_Core_Message::WARNING);

		$categoryGrid = Ccc::getBlock('Category_Grid');

		$this->setTitle('Category_Grid');
		$this->getLayout()->getContent()->setChild($categoryGrid);
		$this->renderLayout();	

	}


	public function editAction()  /*----------------------------------------------editCategory()------------------------------------------*/
	{

		$id = $this->getRequest()->getRequest('id');
		$modelCategory = Ccc::getModel("Category")->load($id);
		Ccc::register('category', $modelCategory); 

		$categoryEdit = Ccc::getBlock('Category_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $categoryEdit,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);
	}

	public function deleteAction() /*-------------------------------------------------deleteCategory()-------------------------------------*/
	{
		try
		{
            $id = $this->getRequest()->getRequest('id');
            $modelCategory = Ccc::getModel('Category');
            $deletedRowId = $modelCategory->delete($id);

            $message = " row ID " . $deletedRowId . " deleted. " ;
			$this->getMessage()->addMessage($message);

			$this->indexAction();

        }
        catch(Exception $e)
        {
			$msg = $e->getMessage();
			$modelMessage = $this->getMessage()->addMessage($msg, Model_Core_Message::ERROR);

			$this->indexAction();  
		}	

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
				$this->editAction(); 
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
				$this->editAction();
			}
		
		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$this->editAction();

	}


	
	public function errorAction() /*----------------------------------------------------------errorAction()-------------------------------------------------*/
	{
		echo("error occured in url");
		exit();		
	}


}







?>