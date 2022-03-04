
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
		$this->getMessage()->getSession()->start();

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($customerGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();	

		$this->getMessage()->unsetMessages();
		//$customerGrid->toHtml();

		$message = $this->getRequest()->getRequest('message');
		$message = ($message) ? $this->getRequest()->getRequest('message') : '123' ;
		echo($message);
	}

	public function editAction()
	{

		$id = $this->getRequest()->getRequest('id');

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$this->getLayout()->getHeader()->setChild($menu);
		$customerEdit = Ccc::getBlock('Customer_Edit')->setData(['id' => $id]);   
		$this->getLayout()->getContent()->setChild($customerEdit);
		$this->renderLayout();	
		//$customerEdit->toHtml(); 							
		
	}

	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
            $modelProduct = Ccc::getModel('Customer');
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelProduct->delete($id);
    
        }
        catch(Exception $e){

			$msg = $e->getMessage();
			$modelMessage = $this->getMessage();
            $modelMessage->addMessage($msg);
			$url = $this->getUrl( 'grid' , 'Customer' );
			$this->redirect( $url );        
		}	


		$message = " row ID" . $deletedRowId . " deleted. " ;
		$modelMessage = $this->getMessage();
        $modelMessage->addMessage($message);
		$url = $this->getUrl( 'grid' , 'Customer' );
		$this->redirect( $url );
	
	}

	public function saveAction() /*-----------------------------------------saveAction()-------------------------------------------------------------*/
	{     

		$person = $this->getRequest()->getPost('Person');		
		$address = $this->getRequest()->getPost('Address');		

        if(array_key_exists( 'id' , $person )  &&   $person['id'] != null) {    /* update if key exist */ 		

        	if(!(int)$person['id'])
        	{
        		$message = 'error : id not valid. ';
        		$msg = $this->getMessage();
        		$msg->addMessage($message , Model_Core_Message::ERROR); 
				$url = $this->getUrl( 'grid' , 'Customer' );
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

				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl( 'grid' , 'Customer' );
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

				$$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl( 'grid' , 'Customer' );
				$this->redirect( $url );			
			}

		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl( 'grid' , 'Customer' );
		$this->redirect( $url );

	}

	

	public function errorAction()
	{
		echo(" some error occured.");
	}
	

}




?>