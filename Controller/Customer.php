
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
		$customersGrid = Ccc::getBlock('Customer_Grid');   
		$customersGrid->toHtml();

		$message = $this->getRequest()->getRequest('message');
		$message = ($message) ? $this->getRequest()->getRequest('message') : '123' ;
		echo($message);
	}

	public function addAction()
	{
		$customersAdd = Ccc::getBlock('Customer_Add'); 
		$customersAdd->toHtml(); 

	}

	public function editAction()
	{

		$customersEdit = Ccc::getBlock('Customer_Edit'); 
		$customersEdit->toHtml(); 
		
	}

	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
            $modelProduct = Ccc::getModel('Customer');
            $deletedRowId = $modelProduct->delete([ 'id' => $this->getRequest()->getRequest('id') ] );
    
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


        $person = $this->getRequest()->getPost('Person');  			print_r($person);
        $address = $this->getRequest()->getPost('Address');				print_r($address);
       

        if(array_key_exists( 'id' , $person )) {    /* update if key exist */ 

        	if(!(int)$person['id'])
        	{
        		$message = " invalid id. " ;
				$param['message'] = $message;
				$url = $this->getUrl( 'grid' , 'Customer' , $param );
				$this->redirect( $url );     
        	}
			try{  																					

				$customersModel = Ccc::getModel('Customer');
				$rowId = $customersModel->update($person , ['id' => $person['id'] ]);						


				$address['customerId'] = $rowId ;
				$address['shipping'] = ($this->getRequest()->getPost('Address')["shipping"] == "1" ) ? 1 : 0 ;
				$address['billing'] = ($this->getRequest()->getPost('Address')["billing"] == "1" ) ? 1 : 0 ;

				$customersAddressModel = Ccc::getModel('Customer_Address');     
				$customersAddressModel->update($address , ['id' => $address['aId'] ]); 								


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

				$customersModel = Ccc::getModel('Customer');
				$rowId = $customersModel->insert($person);

				$address['customerId'] = $rowId ;
				$address['shipping'] = ($this->getRequest()->getPost('Address')["shipping"] == "1" ) ? 1 : 0 ;
				$address['billing'] = ($this->getRequest()->getPost('Address')["billing"] == "1" ) ? 1 : 0 ;

				$customersAddressModel = Ccc::getModel('Customer_Address');
				$customersAddressModel->insert($address);

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