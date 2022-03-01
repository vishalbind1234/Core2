
<?php

Ccc::loadClass('Controller_Core_Action');

class Controller_Vendor extends Controller_Core_Action{

	public function gridAction()
	{
		# code...
		
		$blockVendor = Ccc::getBlock('Vendor_Grid');       
		$blockVendor->toHtml();

	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$blockVendor = Ccc::getBlock('Vendor_Edit')->setData(['id' => $id]); 
		$blockVendor->toHtml();
	
	}

	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
            $modelVendor = Ccc::getModel('Vendor');
            //$deletedRowId = $modelVendor->delete( $this->getRequest()->getRequest('id')  );
            //$customer = $modelVendor->getRow();
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelVendor->delete($id);
    
        }
        catch(Exception $e){

			$message = " row id " . $deletedRowId . " deleted successfully" ;
			$param['message'] = $message;
			$url = $this->getUrl( 'grid' , 'Vendor' , $param );
			$this->redirect( $url );        
		}	


		$message = " row id " . $deletedRowId . " deleted successfully" ;
		$param['message'] = $message;
		$url = $this->getUrl( 'grid' , 'Vendor' , $param );
		$this->redirect( $url );
	
	}

	public function saveAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$person = $this->getRequest()->getPost('Person');
		$address = $this->getRequest()->getPost('Address');

		if(array_key_exists('id', $person) && $person['id'] != null )
		{
			if(!(int)$person['id'])
			{
				$message = " invalid id. " ;
        		$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Vendor' , $param );
				$this->redirect( $url ); 
			}

			try
			{  																				

				$vendorModel = Ccc::getModel('Vendor');     
			
				foreach ($person as $key => $value) 
				{
					$vendorModel->$key = $value;
				}
				$vendorModel->updatedAt = date('Y-m-d');
				$rowId = $vendorModel->save();		
				
				$vendorAddressModel = Ccc::getModel('Vendor_Address'); 		
				//$addressRow =  $vendorAddressModel->getRow() ;  					

				foreach ($address as $key => $value) 
				{
					$vendorAddressModel->$key = $value;
				}																				
				$addressId = $vendorAddressModel->save();     
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
        		$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Vendor' , $param );
				$this->redirect( $url ); 
			}

		}
		else
		{
			try
			{   
								              			
				$vendorModel = Ccc::getModel('Vendor');	
				foreach ($person as $key => $value) 
				{
					$vendorModel->$key = $value;
				}
				$rowId = $vendorModel->save();

				$address['vendorId'] = $rowId ;			
				$vendorAddressModel = Ccc::getModel('Vendor_Address'); 
				foreach ($address as $key => $value) 
				{
					$vendorAddressModel->$key = $value;
				}
				$addressId = $vendorAddressModel->save();

			}
			catch(Exception $e)
			{

				$message =  $e->getMessage() ;
				$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Vendor' , $param );
				$this->redirect( $url );			
			}

		}

		$message = "Row Id " . $rowId . " Inserted/Updated" ;
		$param['message'] = $message;
		$url = $this->getUrl( 'grid' , 'Vendor' , $param );
		$this->redirect( $url ); 

	}

}




?>