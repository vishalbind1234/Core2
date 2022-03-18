
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Config extends Controller_Admin_Action{

	public function gridAction()
	{																
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$configGrid = Ccc::getBlock('Config_Grid');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

		$this->setTitle('Config_Grid');
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
		$configEdit = Ccc::getBlock('Config_Edit')->setData(['id' => $id]);					
		
		$this->getLayout()->getHeader()->setChild($menu);
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
				$url = $this->getUrl('grid', 'Config');   
				$this->redirect($url);
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
				$url = $this->getUrl('grid', 'Config');   
				$this->redirect($url);
			}
		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl('grid' , 'Config');
		$this->redirect($url);
	}

	public function deleteAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelConfig = Ccc::getModel('Config');  
		$deletedId = $modelConfig->delete($id); 

		$message = " row ID" . $deletedId . " deleted. " ;
		$modelMessage = $this->getMessage()->addMessage($message);
		$url = $this->getUrl('grid' , 'Config' );
		$this->redirect($url); 
	}


}


?>