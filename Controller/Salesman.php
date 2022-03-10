
<?php

Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action{

	public function gridAction()
	{
		$this->getMessage()->getSession()->start();
		       
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($salesmanGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();	

		$this->getMessage()->unsetMessages();

	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					//-------------------------------
		$this->getLayout()->getHeader()->setChild($menu);
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->setData(['id' => $id]); 
		
		$this->getLayout()->getContent()->setChild($salesmanEdit);
		$this->renderLayout();	
		//$blockSalesman->toHtml();
	
	}


	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
            $modelSalesman = Ccc::getModel('Salesman');
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelSalesman->delete($id);
    
        }
        catch(Exception $e){

			$msg = $e->getMessage();
			$modelMessage = $this->getMessage();
            $modelMessage->addMessage($msg);
			$url = $this->getUrl( 'grid' , 'Salesman' , $param );
			$this->redirect( $url );        
		}	


		$message = " row ID" . $deletedRowId . " deleted. " ;
		$modelMessage = $this->getMessage();
        $modelMessage->addMessage($message);
		$url = $this->getUrl( 'grid' , 'Salesman' , $param );
		$this->redirect( $url );
	
	}

	public function saveAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$salesman = $this->getRequest()->getPost('Salesman');

		if(array_key_exists('id', $salesman) && $salesman['id'] != null )
		{
			if(!(int)$salesman['id'])
			{
				$message = 'error : id not valid. ';
        		$msg = $this->getMessage();
        		$msg->addMessage($message , Model_Core_Message::ERROR); 
				$url = $this->getUrl( 'grid' , 'Salesman');
				$this->redirect( $url ); 
			}

			try
			{  																				

				$salesmanModel = Ccc::getModel('Salesman');     
			
				foreach ($salesman as $key => $value) 
				{
					$salesmanModel->$key = $value;
				}
				$salesmanModel->updatedAt = date('Y-m-d');
				$rowId = $salesmanModel->save();		
				
				     
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl( 'grid' , 'Salesman' );
				$this->redirect( $url ); 
			}

		}
		else
		{
			try
			{   
								              			
				$salesmanModel = Ccc::getModel('Salesman');	
				foreach ($salesman as $key => $value) 
				{
					$salesmanModel->$key = $value;
				}
				$rowId = $salesmanModel->save();

				

			}
			catch(Exception $e)
			{

				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl( 'grid' , 'Salesman'  );
				$this->redirect( $url );			
			}

		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl( 'grid' , 'Salesman' );
		$this->redirect( $url ); 

	}

}




?>