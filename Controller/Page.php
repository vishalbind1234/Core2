
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Page extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$pageGrid = Ccc::getBlock('Page_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageGrid,
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


	public function gridAction()
	{																
		$currentPage = $this->getRequest()->getRequest('currentPage',1) ;
		$this->getMessage()->addMessage(" On Page " . $currentPage, Model_Core_Message::ERROR);

		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
        $pageGrid  = Ccc::getBlock('Page_Grid');

		$this->setTitle('Page_Grid');
		$this->getLayout()->getContent()->setChild($pageGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();	
	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelPage = Ccc::getModel("Page")->load($id);
		Ccc::register('page', $modelPage); 

		$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageEdit,
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
				$this->indexAction(); 
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
            $modelPage = Ccc::getModel('Page');
            $deletedRowId = $modelPage->delete($id);

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