
<?php Ccc::loadClass('Controller_Core_Action');  ?>

<?php

class Controller_Page extends Controller_Core_Action{

	public function gridAction()
	{																
		# code...
		$blockPage = Ccc::getBlock('Page_Grid');
		$blockPage->toHtml();
	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
		$blockPage = Ccc::getBlock('Page_Edit')->setData(['id' => $id]);					
		$blockPage->toHtml();

	}

	public function saveAction()
	{																		 
		# code... 
		$array = $this->getRequest()->getRequest('Page');                  
		if(array_key_exists('id', $array)  && $array['id'] != null )
		{
			if(!(int)$array['id'])
			{
				$message = 'Invalid ID.' ;
				$url = $this->getUrl('grid' , 'Page' , ['message' => $message]);
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

		$url = $this->getUrl('grid' , 'Page' , ['message' => $id]);
		$this->redirect($url);
	}

	public function deleteAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelPage = Ccc::getModel('Page');  
		$deletedId = $modelPage->delete($id); 

		$url = $this->getUrl('grid' , 'Page' , ['message' => $deletedId]);
		$this->redirect($url); 
	}


}


?>