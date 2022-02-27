
<?php  Ccc::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Customer extends Controller_Core_Action{

	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function gridAction() /*---------------------------------------------------------gridAction()-----------------------------------------*/
	{																
		$customerGrid = Ccc::getBlock('Customer_Grid');   
		$customerGrid->toHtml();

		$message = $this->getRequest()->getRequest('message');
		$message = ($message) ? $this->getRequest()->getRequest('message') : '123' ;
		echo($message);
	}

/*	public function addAction()
	{
		$customerAdd = Ccc::getBlock('Customer_Add'); 
		$customerAdd->toHtml(); 

	}*/

	public function editAction()
	{

		$customerEdit = Ccc::getBlock('Customer_Edit');    
		$customerEdit->toHtml(); 							
		
	}

	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
            $modelProduct = Ccc::getModel('Customer');
            //$deletedRowId = $modelProduct->delete( $this->getRequest()->getRequest('id')  );
            //$customer = $modelProduct->getRow();
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelProduct->delete($id);
    
        }
        catch(Exception $e){

			$message = " row id " . $deletedRowId . " deleted successfully" ;
			$param['message'] = $message;
			$url = $this->getUrl( 'grid' , 'Customer' , $param );
			$this->redirect( $url );        
		}	


		$message = " row id " . $deletedRowId . " deleted successfully" ;
		$param['message'] = $message;
		$url = $this->getUrl( 'grid' , 'Customer' , $param );
		$this->redirect( $url );
	
	}

	public function saveAction() /*-----------------------------------------saveAction()-------------------------------------------------------------*/
	{     

		$person = $this->getRequest()->getPost('Person');		
		$address = $this->getRequest()->getPost('Address');		

        if(array_key_exists( 'id' , $person )  &&   $person['id'] != null) {    /* update if key exist */ 		

        	if(!(int)$person['id'])
        	{
        		$message = " invalid id. " ;
        		$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Customer' , $param );
				$this->redirect( $url );     
        	}
			try{  																				

				$customerModel = Ccc::getModel('Customer');
				//$customerModel = $customerModel->getRow();
				$customerData = $customerModel->load($person['id']);
				

				foreach ($person as $key => $value) 
				{
					$customerModel->$key = $value;
				}
				$customerModel->updatedAt = date('Y-m-d');
				$rowId = $customerModel->save();		


				$address['customerId'] = $rowId ;
				$address['shipping'] = ($address["shipping"] == "1" ) ? 1 : 0 ;
				$address['billing'] = ($address["billing"] == "1" ) ? 1 : 0 ;		

				$customerAddressModel = Ccc::getModel('Customer_Address'); 		
				//$addressRow =  $customerAddressModel->getRow() ;  					

				foreach ($address as $key => $value) 
				{
					$customerAddressModel->$key = $value;
				}																				
				$addressId = $customerAddressModel->save();    
				
				//$customerAddressModel->update($address ,$address['aId'] ); 								


			}
			catch(Exception $e){

				$message =  $e->getMessage() ;
				$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Customer' , $param );
				$this->redirect( $url );			
			}

		}    
		else
		{ 

			try
			{   
				unset($person['updatedAt']);						              			
				$customerModel = Ccc::getModel('Customer');			  	
				/*$rowId = $customerModel->insert($person);*/
				//$customerModel = $customerModel->getRow();
				foreach ($person as $key => $value) 
				{
					$customerModel->$key = $value;
				}
				$rowId = $customerModel->save();


				$address['customerId'] = $rowId ;			
				$address['shipping'] = ($address["shipping"] == "1" ) ? 1 : 0 ;
				$address['billing'] = ($address["billing"] == "1" ) ? 1 : 0 ;

				$customerAddressModel = Ccc::getModel('Customer_Address'); 
				/*$customerAddressModel->insert($address);*/
				//$addressRow =  $customerAddressModel->getRow()  ; 

				foreach ($address as $key => $value) 
				{
					$customerAddressModel->$key = $value;
				}
				$addressId = $customerAddressModel->save();

			}
			catch(Exception $e)
			{

				$message =  $e->getMessage() ;
				$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Customer' , $param );
				$this->redirect( $url );			
			}

		}

		$message = " row id " . $rowId . " inserted/updated successfully." ;
		$param['message'] = $message;
		$url = $this->getUrl( 'grid' , 'Customer' , $param );
		$this->redirect( $url );

	}

	

	public function errorAction()
	{
		echo(" some error occured.");
	}
	

}




?>