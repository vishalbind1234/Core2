
<?php

Ccc::loadClass('Controller_Admin_Action');

class Controller_Salesman extends Controller_Admin_Action{

	public function gridAction()
	{
		 //code...
		//Ccc::register('name' , 'rahul');

		$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
		$perPageCount =  ($this->getRequest()->getRequest('perPageCount')) ? $this->getRequest()->getRequest('perPageCount') : 10 ;
		$this->getMessage()->addMessage(" On Page " . $currentPage );
		       
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$salesmanGrid->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);

		$this->setTitle('Salesman_Grid');
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

			try
			{  																				
				if(!(int)$salesman['id'])
				{
					throw new Exception(" ID not Valid.");
				}
				$salesmanModel = Ccc::getModel('Salesman');  
				$salesman['updatedAt'] =  date('Y-m-d');
				$rowId = $salesmanModel->setData($salesman)->save();    
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
				$rowId = $salesmanModel->setData($salesman)->save() ;
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