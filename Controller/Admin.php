
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
		$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
		$perPageCount =  ($this->getRequest()->getRequest('perPageCount')) ? $this->getRequest()->getRequest('perPageCount') : 10 ;
		$this->getMessage()->addMessage(" On Page " . $currentPage );

		$modelAdminMessage = Ccc::getModel('Admin_Message');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message')->setData(['messageClassObject' => $modelAdminMessage ]);
        $menu = Ccc::getBlock('Core_Layout_Header_Menu');
        $adminGrid = Ccc::getBlock('Admin_Grid');
        $adminGrid->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);

       	//$modelAdminMessage = Ccc::getModel('Admin_Message');
      	
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
		//$admin = Ccc::getRegistry('admin');
		$admin = Ccc::getModel('Core_Message')->getMessages('admin');
		if(!$admin)
		{
			$modelAdmin = Ccc::getModel('Admin')->load($id);
			//Ccc::register('admin', $modelAdmin);
			Ccc::getModel('Core_Message')->setMessage($modelAdmin, 'admin');
		}

		//$menu = Ccc::getBlock('Core_Layout_Header_Menu');	
		$adminEdit = Ccc::getBlock('Admin_Edit');

		$this->getLayout()->getContent()->setChild($adminEdit);
		//$this->getLayout()->getHeader()->setChild($menu);
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
			try
			{  
	        	if(!(int)$array['id'] )
	        	{
	        		throw new Exception(" ID not Valid.");      
	        	}
				$modelAdmin = Ccc::getModel('Admin');
				$array['updatedAt'] =  date('Y-m-d');
				$rowId = $modelAdmin->setData($array)->save();
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$modelAdminMessage = Ccc::getModel('Admin_Message')->addMessage( $message , Model_Core_Message::ERROR );
				$url = $this->getUrl('grid' , 'Admin' );    	
				$this->redirect($url);  
			}
		}    
		else
		{                       
			try
			{        
				$modelAdmin = Ccc::getModel('Admin');
				$array['updatedAt'] =  date('Y-m-d');
				$array['password'] = md5($array['password']);    
				$rowId = $modelAdmin->setData($array)->save();
			}
			catch(Exception $e)
			{				
				$message = $e->getMessage() ;
				$modelAdminMessage = Ccc::getModel('Admin_Message')->addMessage( $message , Model_Core_Message::ERROR );
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