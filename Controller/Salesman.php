
<?php

Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action{

	public function gridAction()
	{
		# code...
		
		$blockSalesman = Ccc::getBlock('Salesman_Grid');       
		$blockSalesman->toHtml();

	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$blockSalesman = Ccc::getBlock('Salesman_Edit')->setData(['id' => $id]); 
		$blockSalesman->toHtml();
	
	}


	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
            $modelSalesman = Ccc::getModel('Salesman');
            //$deletedRowId = $modelSalesman->delete( $this->getRequest()->getRequest('id')  );
            //$customer = $modelSalesman->getRow();
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelSalesman->delete($id);
    
        }
        catch(Exception $e){

			$message = " row id " . $deletedRowId . " deleted successfully" ;
			$param['message'] = $message;
			$url = $this->getUrl( 'grid' , 'Salesman' , $param );
			$this->redirect( $url );        
		}	


		$message = " row id " . $deletedRowId . " deleted successfully" ;
		$param['message'] = $message;
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
				$message = " invalid id. " ;
        		$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Salesman' , $param );
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
        		$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Salesman' , $param );
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

				$message =  $e->getMessage() ;
				$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Salesman' , $param );
				$this->redirect( $url );			
			}

		}

		$message = "Row Id " . $rowId . " Inserted/Updated" ;
		$param['message'] = $message;
		$url = $this->getUrl( 'grid' , 'Salesman' , $param );
		$this->redirect( $url ); 

	}

}




?>