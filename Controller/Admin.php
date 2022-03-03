
<?php   Ccc::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Admin extends Controller_Core_Action{



	public function gridAction() /*---------------------------------------------------------gridAdmin()-----------------------------------------*/
	{
		
		
		$this->getMessage()->getSession()->start();

		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
        $menu = Ccc::getBlock('Core_Layout_Header_Menu');
        $adminGrid = Ccc::getBlock('Admin_Grid');

       	$this->getMessage()->addMessage('selfmade'   , Model_Core_Message::WARNING);
       	$this->getMessage()->addMessage('artificial' , Model_Core_Message::ERROR);

        $this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($adminGrid);
        $this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();

       	$this->getMessage()->unsetMessages();
		
	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$adminEdit = Ccc::getBlock('Admin_Edit')->setData(['id' => $id]);
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($adminEdit);
		$this->renderLayout();


	}

	public function deleteAction()  /*--------------------------------------deleteAdmin()----------------------------------------------*/  
	{
		try
		{  
            $modelAdmin = Ccc::getModel('Admin');   		 		
            $id = $this->getRequest()->getRequest('id');  					
            $deletedId = $modelAdmin->delete($id);
            $message = "row Id " . $deletedId . " deleted successfully";

            $modelMessage = $this->getMessage();
            $modelMessage->addMessage($message);
			$url = $this->getUrl('grid' , 'Admin' );
        	$this->redirect($url);
        }
        catch(Exception $e)
        {
        	$msg = $e->getMessage();
			$modelMessage = $this->getMessage();
            $modelMessage->addMessage($msg);
			$url = $this->getUrl('grid' , 'Admin' , $param );
        	$this->redirect($url);
		}
	
	}

	public function saveAction() //-----------------------------------------saveAdmin()-------------------------------------------------------------
	{     
		
		$array =  $this->getRequest()->getPost('Admin');

        if(array_key_exists('id' , $array) ) 					
        {     																			
        	if(!(int)$array['id'] )
        	{
        		$message = 'error : id not valid. ';
        		$msg = $this->getMessage();
        		$msg->addMessage($message , Model_Core_Message::ERROR);         
        		$url = $this->getUrl('grid' , 'Admin');
        		$this->redirect($url);      
        	}
			try
			{  
				$modelAdmin = Ccc::getModel('Admin');
				foreach ($array as $key => $value) 
				{
					$modelAdmin->$key = $value;
				}
				$modelAdmin->updatedAt = date('Y-m-d');
			    $rowId = $modelAdmin->save(); 
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid' , 'Admin' );    	
				$this->redirect($url);  
			}

		}    
		else
		{                       
			try
			{        
				$modelAdmin = Ccc::getModel('Admin');
				foreach ($array as $key => $value) 
				{
					$modelAdmin->$key = $value;
				}
				$rowId = $modelAdmin->save();
			}
			catch(Exception $e)
			{				
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid' , 'Admin' );    	
				$this->redirect($url); 			
			}

		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl('grid' , 'Admin' );    	
		$this->redirect($url);  

	}

	public function errorAction()
	{
		echo(" some error occured ");
		exit();
	}

}






?>