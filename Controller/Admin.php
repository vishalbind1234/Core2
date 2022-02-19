
<?php   Ccc::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Admin extends Controller_Core_Action{

	/*public $adapter = new Model_Core_Adapter();*/

	public function testAction()
	{
		# code...
		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel->getTableName();
		echo($admin);
		exit();
	}

	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function gridAction() /*---------------------------------------------------------gridAdmin()-----------------------------------------*/
	{
		$adminGrid = Ccc::getBlock('Admin_Grid');    
		$adminGrid->toHtml();

		$message = ( $this->getRequest()->getRequest('message') ) ? $this->getRequest()->getRequest('message') : " 123 " ;
		echo($message );
	}

	public function addAction()
	{
		$adminAdd = Ccc::getBlock('Admin_Add');
		$adminAdd->toHtml();
		
	}

	public function editAction()
	{
		$adminEdit = Ccc::getBlock('Admin_Edit');
		$adminEdit->toHtml();

	}

	public function deleteAction()  /*--------------------------------------deleteAdmin()----------------------------------------------*/  
	{
		try{  
            $modelAdmin = Ccc::getModel('Admin');   		 		
            $id = $this->getRequest()->getRequest('id');  					

            $deletedId = $modelAdmin->delete( ['id' => $id] );        
            
			$param['message'] = " id " . $deletedId . " row deleted " ;
			$url = $this->getUrl('grid' , 'Admin' , $param );
        	$this->redirect($url);
        }
        catch(Exception $e)
        {
			$param['message'] = $e ;
			$url = $this->getUrl('grid' , 'Admin' , $param );
        	$this->redirect($url);
		}

	
	}

	public function saveAction() //-----------------------------------------saveAdmin()-------------------------------------------------------------
	{     
		global $adapter;    
				
        if(array_key_exists( 'id' , $this->getRequest()->getPost('Admin') )) 					
        {     																			
        	if(!(int)$this->getRequest()->getPost('Admin')['id'] )
        	{
        		$message = 'error : id not valid ';         
        		$param = [];
        		$param['message'] = $message;
        		$url = $this->getUrl('grid' , 'Admin' , $param);
        		$this->redirect($url);      
        	}
			try{  

				$modelAdmin = Ccc::getModel('Admin');
				$rowId = $modelAdmin->update( $this->getRequest()->getPost('Admin') , [ 'id' => $this->getRequest()->getPost('Admin')['id'] ] );
												
				$param['message'] = " id " . $rowId . " row updated ";
        		$url = $this->getUrl('grid' , 'Admin' , $param);    	
        		$this->redirect($url);  

			}
			catch(Exception $e)
			{
				$param['message'] = $e->getMessage() ;
				$url = $this->getUrl('grid' , 'Admin' , $param);    	
				$this->redirect($url);  
			}

		}    
		else{                       
			try{        

				$modelAdmin = Ccc::getModel('Admin');
				$rowId = $modelAdmin->insert($this->getRequest()->getPost('Admin'));  
		
			}
			catch(Exception $e)
			{
				$param['message'] = $e->getMessage() ;
				$url = $this->getUrl('grid' , 'Admin' , $param);    	
				$this->redirect($url); 			
			}

		}

		$param['message'] = " id " . $rowId . " row updated/inserted ";
		$url = $this->getUrl('grid' , 'Admin' , $param);    	
		$this->redirect($url);  

	}

	

	public function errorAction()
	{

		echo(" some error occured ");
	}

}






?>