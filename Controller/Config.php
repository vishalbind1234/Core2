
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Config extends Controller_Admin_Action{

	public function gridAction()
	{							
		$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
		$perPageCount =  ($this->getRequest()->getRequest('perPageCount')) ? $this->getRequest()->getRequest('perPageCount') : 10 ;
		$this->getMessage()->addMessage(" On Page " . $currentPage );

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
		$configGrid = Ccc::getBlock('Config_Grid');
		$configGrid->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);

		$this->setTitle('Config_Grid');
		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($configGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);			//echo "<pre>"; print_r($this->getLayout()); exit();
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