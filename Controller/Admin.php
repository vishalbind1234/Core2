
<?php   Ccc::loadClass('Controller_Admin_Action');   ?>

<?php 

class Controller_Admin extends Controller_Admin_Action{

	public function indexAction()
	{
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page ". $currentPage , Model_Admin_Message::WARNING);
		
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$adminGrid = $adminGrid->toHtml();

		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminGrid,
					'addClass' => 'bgred'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgred'
				]
			]
		];

        $this->renderJson($response);

	}

	public function gridAction() //--------------------------------------------------------gridAdmin()-----------------------------------------
	{
       	$adminGrid = Ccc::getBlock('Admin_Grid');
      	$this->setTitle('Admin_Grid');

		$this->getLayout()->getContent()->setChild($adminGrid);
		$this->renderLayout();

	}

	public function editAction()
	{

		$id = $this->getRequest()->getRequest('id');
		$modelAdmin = Ccc::getModel('Admin')->load($id);
		Ccc::register('admin', $modelAdmin);

		$adminEdit = Ccc::getBlock('Admin_Edit')->toHtml();
        $response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminEdit,
					'addClass' => 'bgred'
				]
			]
		];

        $this->renderJson($response);

	}

	public function deleteAction()  //-------------------------------------deleteAdmin()----------------------------------------------  
	{
		try
		{  
            $modelAdmin = Ccc::getModel('Admin');   		 		
            $id = $this->getRequest()->getRequest('id');  					
            $deletedId = $modelAdmin->delete($id);

            $message = "row Id " . $deletedId . " deleted successfully";
            $this->getMessage()->addMessage($message);

            $adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $adminGrid,
						'addClass' => 'bgred'
					],
					[
						'element' => '#messageContent',
						'content' => $messageBlock,
						'addClass' => 'bgred'
					]
				]
			];

        $this->renderJson($response);
            
        }
        catch(Exception $e)
        {
        	$message = $e->getMessage() ;
			$this->getMessage()->addMessage($message,  Model_Core_Message::ERROR);

			$url = $this->getUrl('grid' , 'Admin' , $param );
        	$this->redirect($url);
		}
	
	}

	public function saveAction() //-----------------------------------------saveAdmin()-------------------------------------------------------------
	{     
		
		$array =  $this->getRequest()->getPost('Admin'); 

        if(array_key_exists('id' , $array) && !empty($array['id']) ) 					
        {     																			
			try
			{  
	        	if(!(int)$array['id'] )
	        	{
	        		throw new Exception(" ID not Valid.");      
	        	}
				$modelAdmin = Ccc::getModel('Admin');
				$array['updatedAt'] =  date('Y-m-d');
				$rowId = $modelAdmin->setData($array)->save();
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message,  Model_Core_Message::ERROR);

				$url = $this->getUrl('grid' , 'Admin' );    	
				$this->redirect($url);  
			}
		}    
		else
		{                       
			try
			{        
				$modelAdmin = Ccc::getModel('Admin');
				$array['updatedAt'] =  date('Y-m-d');
				$array['password'] = md5($array['password']);    
				$rowId = $modelAdmin->setData($array)->save();
			}
			catch(Exception $e)
			{				
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message,  Model_Core_Message::ERROR);

				$url = $this->getUrl('grid', 'Admin');    	
				$this->redirect($url); 			
			}

		}

		$message = "row id " . $rowId . " Saved  " ;
        $this->getMessage()->addMessage($message,  Model_Core_Message::SUCCESS);
        
        $adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
            
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminGrid,
					'addClass' => 'bgred'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgred'
				]
			]
		];

        $this->renderJson($response);		
	}

	public function errorAction()
	{
		echo(" some error occured ");
		exit();
	}

}






?>