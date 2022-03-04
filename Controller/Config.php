
<?php Ccc::loadClass('Controller_Core_Action');  ?>

<?php

class Controller_Config extends Controller_Core_Action{

	public function gridAction()
	{																
		$this->getMessage()->getSession()->start();
	
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$configGrid = Ccc::getBlock('Config_Grid');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($configGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();	

		$this->getMessage()->unsetMessages();

		//$blockConfig->toHtml();
	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
	
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$this->getLayout()->getHeader()->setChild($menu);
		$configEdit = Ccc::getBlock('Config_Edit')->setData(['id' => $id]);					
		
		$this->getLayout()->getContent()->setChild($configEdit);
		$this->renderLayout();	
		//$blockConfig->toHtml();

	}

	public function saveAction()
	{																		 
		# code... 
		$array = $this->getRequest()->getRequest('Config');                  
		if(array_key_exists('id', $array)  && $array['id'] != null )
		{
			if(!(int)$array['id'])
			{
				$message = 'error : id not valid. ';
        		$msg = $this->getMessage();
        		$msg->addMessage($message , Model_Core_Message::ERROR); 
				$url = $this->getUrl('grid' , 'Config' );
				$this->redirect($url);
			}

			$modelConfig = Ccc::getModel('Config');
			foreach ($array as $key => $value) 
			{
				$modelConfig->$key = $value;
			}
			$id = $modelConfig->save();

		}
		else
		{
			$modelConfig = Ccc::getModel('Config');
			foreach ($array as $key => $value) 
			{
				$modelConfig->$key = $value;
			}
			$id = $modelConfig->save();
		}

		$message = "row id " . $id . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl('grid' , 'Config' );
		$this->redirect($url);
	}

	public function deleteAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelConfig = Ccc::getModel('Config');  
		$deletedId = $modelConfig->delete($id); 
		$message = " row ID" . $deletedId . " deleted. " ;

		$modelMessage = $this->getMessage();
        $modelMessage->addMessage($message);
		$url = $this->getUrl('grid' , 'Config' );
		$this->redirect($url); 
	}


}


?>