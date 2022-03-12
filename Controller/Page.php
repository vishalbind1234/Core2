
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Page extends Controller_Admin_Action{

	public function gridAction()
	{																

		$modelCoreMessage = $this->getMessage();

		$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
		$modelCoreMessage->addMessage(" On Page " . $currentPage );
        $pageGrid  = Ccc::getBlock('Page_Grid')->setData(['currentPage' => $currentPage]);
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($pageGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();	

		$this->getMessage()->unsetMessages();
		
		//$blockPage->toHtml();
	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
		
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$this->getLayout()->getHeader()->setChild($menu);
		$pageEdit = Ccc::getBlock('Page_Edit')->setData(['id' => $id]);					
		
		$this->getLayout()->getContent()->setChild($pageEdit);
		$this->renderLayout();	
		//$blockPage->toHtml();

	}

	public function saveAction()
	{																		 
		# code... 
		$array = $this->getRequest()->getRequest('Page');                  
		if(array_key_exists('id', $array)  && $array['id'] != null )
		{
			if(!(int)$array['id'])
			{
				$message = 'error : id not valid. ';
        		$msg = $this->getMessage();
        		$msg->addMessage($message , Model_Core_Message::ERROR); 
				$url = $this->getUrl('grid' , 'Page' );
				$this->redirect($url);
			}

			$modelPage = Ccc::getModel('Page');
			foreach ($array as $key => $value) 
			{
				$modelPage->$key = $value;
			}
			$modelPage->updatedAt = date('Y-m-d');
			$id = $modelPage->save();

		}
		else
		{
			$modelPage = Ccc::getModel('Page');
			foreach ($array as $key => $value) 
			{
				$modelPage->$key = $value;
			}
			$id = $modelPage->save();
		}

		$message = "row id " . $id . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl('grid' , 'Page');
		$this->redirect($url);
	}

	public function deleteAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelPage = Ccc::getModel('Page');  
		$deletedId = $modelPage->delete($id); 
		$message = " row ID" . $deletedId . " deleted. " ;

		$modelMessage = $this->getMessage();
        $modelMessage->addMessage($message);
		$url = $this->getUrl('grid' , 'Page' );
		$this->redirect($url); 
	}


}


?>