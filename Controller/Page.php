
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Page extends Controller_Admin_Action{

	public function gridAction()
	{																
		$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
		$perPageCount =  ($this->getRequest()->getRequest('perPageCount')) ? $this->getRequest()->getRequest('perPageCount') : 10 ;
		$this->getMessage()->addMessage(" On Page " . $currentPage );

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
        $pageGrid  = Ccc::getBlock('Page_Grid');
		$pageGrid->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);

		$this->setTitle('Page_Grid');
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
		
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$this->getLayout()->getHeader()->setChild($menu);
		$pageEdit = Ccc::getBlock('Page_Edit')->setData(['id' => $id]);					
		
		$this->getLayout()->getContent()->setChild($pageEdit);
		$this->renderLayout();	
		//$blockPage->toHtml();

	}

	public function saveAction()
	{																		 
		$array = $this->getRequest()->getRequest('Page');                  
		if(array_key_exists('id', $array)  && $array['id'] != null)
		{
			try 
			{
				if(!(int)$array['id'])
				{
					throw new Exception(" ID not Valid. ");
				}
				$modelPage = Ccc::getModel('Page');
				$array['updatedAt'] = date('Y-m-d');
				$rowId = $modelPage->setData($array)->save();
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid', 'Page');   
				$this->redirect($url);	
			}

		}
		else
		{
			try 
			{
				$modelPage = Ccc::getModel('Page');
				$rowId = $modelPage->setData($array)->save();
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid', 'Page');   
				$this->redirect($url);	
			}
		}

		$message = "row id " . $rowId . " Saved  " ;
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
		$modelMessage = $this->getMessage()->addMessage($message);
		$url = $this->getUrl('grid' , 'Page' );
		$this->redirect($url); 
	}

	public function multipleDeleteAction()
	{
		//echo "<pre>"; print_r($_POST);  exit();
		$array = $id = $this->getRequest()->getPost();
		$idArray = $array['Page']['id'];
		foreach ($idArray as $key => $value) 
		{
			$modelPage = Ccc::getModel("Page");
			$modelPage->delete($value);
		}
		$url = $this->getUrl("grid" , "Page");
		$this->redirect($url);

	}


}


?>