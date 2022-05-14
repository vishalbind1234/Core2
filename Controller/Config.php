
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Config extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configGrid,
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

	public function gridAction()
	{							
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage, Model_Core_Message::WARNING);

		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
		$configGrid = Ccc::getBlock('Config_Grid');

		$this->setTitle('Config_Grid');
		$this->getLayout()->getContent()->setChild($configGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);			//echo "<pre>"; print_r($this->getLayout()); exit();
		$this->renderLayout();											

	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelConfig = Ccc::getModel("Config")->load($id);
		Ccc::register('config', $modelConfig); 

		$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configEdit,
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
		//$blockConfig->toHtml();
	}

	public function saveAction()
	{																		 
		# code... 
		$array = $this->getRequest()->getRequest('Config');                  
		if(array_key_exists('id', $array)  && $array['id'] != null )
		{
			try
			{
				if(!(int)$array['id'])
				{
					throw new Exception(" ID not Valid. ");
				}

				$modelConfig = Ccc::getModel('Config');
				$rowId = $modelConfig->setData($array)->save();
				
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$this->indexAction(); 
			}

		}
		else
		{
			try 
			{
				$modelConfig = Ccc::getModel('Config');
				$rowId = $modelConfig->setData($array)->save();
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$this->indexAction(); 
			}
		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$this->indexAction(); 
	}

	public function deleteAction()
	{
		# code...
		try
		{
            $id = $this->getRequest()->getRequest('id');
            $modelConfig = Ccc::getModel('Config');
            $deletedRowId = $modelConfig->delete($id);

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


}


?>