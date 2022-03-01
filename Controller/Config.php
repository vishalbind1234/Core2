
<?php Ccc::loadClass('Controller_Core_Action');  ?>

<?php

class Controller_Config extends Controller_Core_Action{

	public function gridAction()
	{																
		# code...
	
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$this->getLayout()->getHeader()->setChild($menu);
		$configGrid = Ccc::getBlock('Config_Grid');
		$this->getLayout()->getContent()->setChild($configGrid);
		$this->renderLayout();	

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
				$message = 'Invalid ID.' ;
				$url = $this->getUrl('grid' , 'Config' , ['message' => $message]);
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

		$url = $this->getUrl('grid' , 'Config' , ['message' => $id]);
		$this->redirect($url);
	}

	public function deleteAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelConfig = Ccc::getModel('Config');  
		$deletedId = $modelConfig->delete($id); 

		$url = $this->getUrl('grid' , 'Config' , ['message' => $deletedId]);
		$this->redirect($url); 
	}


}


?>