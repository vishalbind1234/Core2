
<?php   Ccc::loadClass('Controller_Admin_Action');   ?>

<?php 

class Controller_Admin extends Controller_Admin_Action{

	public function testAction()
	{
		$modelAdminMessage = Ccc::getModel('Admin_Message');
       	$modelAdminMessage->addMessage('selfmade'   , Model_Admin_Message::WARNING);
       	$modelAdminMessage->addMessage('artificial' , Model_Admin_Message::ERROR);
       	print_r($_SESSION);  exit();
	}

	public function gridAction() /*---------------------------------------------------------gridAdmin()-----------------------------------------*/
	{
		
		$modelAdminMessage = Ccc::getModel('Admin_Message');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message')->setData(['messageClassObject' => $modelAdminMessage ]);
        $menu = Ccc::getBlock('Core_Layout_Header_Menu');
        $adminGrid = Ccc::getBlock('Admin_Grid');

       	$modelAdminMessage = Ccc::getModel('Admin_Message');
      	
      	$this->setTitle('Admin_Grid');
        $this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($adminGrid);
        $this->getLayout()->getFooter()->setChild($blockMessage);   //print_r($_SESSION);  exit();
		$this->renderLayout();

       	$modelAdminMessage->unsetMessages();
		
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

            $modelAdminMessage = Ccc::getModel('Admin_Message');
            $modelAdminMessage->addMessage( $message );
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

        if(array_key_exists('id' , $array) && !empty($array['id']) ) 					
        {     																			
        	if(!(int)$array['id'] )
        	{
        		$message = 'error : id not valid. ';
        		$modelAdminMessage = Ccc::getModel('Admin_Message');
           		$modelAdminMessage->addMessage( $message , Model_Core_Message::ERROR );        
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
				$modelAdminMessage = Ccc::getModel('Admin_Message');
           		$modelAdminMessage->addMessage( $message , Model_Core_Message::ERROR );
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
				$modelAdmin->password = md5($modelAdmin->password);    
				$rowId = $modelAdmin->save();
			}
			catch(Exception $e)
			{				
				$message = $e->getMessage() ;
				$modelAdminMessage = Ccc::getModel('Admin_Message');
           		$modelAdminMessage->addMessage( $message , Model_Core_Message::ERROR );
				$url = $this->getUrl('grid' , 'Admin' );    	
				$this->redirect($url); 			
			}

		}

		$message = "row id " . $rowId . " Saved  " ;
		$modelAdminMessage = Ccc::getModel('Admin_Message');
        $modelAdminMessage->addMessage( $message , Model_Core_Message::SUCCESS );
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