
<?php   Ccc::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Admin extends Controller_Core_Action{



	public function gridAction() /*---------------------------------------------------------gridAdmin()-----------------------------------------*/
	{
		
		
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$this->getLayout()->getContent()->setChild($adminGrid);
		$this->renderLayout();

		/*$adminGrid = Ccc::getBlock('Admin_Grid');    
		$adminGrid->toHtml();*/

		$message = $this->getRequest()->getRequest('message');
		$message = ($message) ? $message : " 123 " ;
		echo($message );
	}

	public function editAction()
	{
		//$this->getLayout()->resetChild();
		$id = $this->getRequest()->getRequest('id');
		$adminEdit = Ccc::getBlock('Admin_Edit')->setData(['id' => $id]);
		$this->getLayout()->getContent()->setChild($adminEdit);
		$this->renderLayout();

		//$adminEdit->toHtml();

	}

	public function deleteAction()  /*--------------------------------------deleteAdmin()----------------------------------------------*/  
	{
		try
		{  
            $modelAdmin = Ccc::getModel('Admin');   		 		
            $id = $this->getRequest()->getRequest('id');  					
            $deletedId = $modelAdmin->delete($id);
                               
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
		
		$array =  $this->getRequest()->getPost('Admin');

        if(array_key_exists('id' , $array)  &&  $array['id'] != null) 					
        {     																			
        	if(!(int)$array['id'] )
        	{
        		$message = 'error : id not valid ';         
        		$param['message'] = $message;
        		$url = $this->getUrl('grid' , 'Admin' , $param);
        		$this->redirect($url);      
        	}
			try{  

				$modelAdmin = Ccc::getModel('Admin');

				foreach ($array as $key => $value) 
				{
					$modelAdmin->$key = $value;
				}
				$modelAdmin->updatedAt = date('Y-m-d');
			    $rowId = $modelAdmin->save(); 
												
				$param['message'] = "row id " . $rowId . "  updated ";
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

				//unset($array['updatedAt']);
				$modelAdmin = Ccc::getModel('Admin');

				foreach ($array as $key => $value) 
				{
					$modelAdmin->$key = $value;
				}

				$rowId = $modelAdmin->save();
		
			}
			catch(Exception $e)
			{
				$param['message'] = $e->getMessage() ;
				$url = $this->getUrl('grid' , 'Admin' , $param);    	
				$this->redirect($url); 			
			}

		}

		$param['message'] = "row id " . $rowId . "  updated/inserted ";
		$url = $this->getUrl('grid' , 'Admin' , $param);    	
		$this->redirect($url);  

	}

	

	public function errorAction()
	{

		echo(" some error occured ");
		exit();
	}

}






?>