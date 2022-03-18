
<?php  Ccc::loadClass('Controller_Admin_Action');   ?>

<?php 

class Controller_Customer extends Controller_Admin_Action{

	public function gridAction() /*---------------------------------------------------------gridAction()-----------------------------------------*/
	{																
		try 
		{
			$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
			$customerGrid = Ccc::getBlock('Customer_Grid');
			$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

			$this->setTitle('Customer_Grid');
			$this->getLayout()->getHeader()->setChild($menu);
			$this->getLayout()->getContent()->setChild($customerGrid);
			$this->getLayout()->getFooter()->setChild($blockMessage);
			$this->renderLayout();	

			$this->getMessage()->unsetMessages();
			
		} 
		catch (Exception $e) 
		{
			$message = $e->getMessage() ;
			$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
			$url = $this->getUrl( 'grid' , 'Customer' );
			$this->redirect( $url );	
		}
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
			$modelMessage = $this->getMessage()->addMessage($msg);
			$url = $this->getUrl( 'grid' , 'Customer' );
			$this->redirect( $url );        
		}	


		$message = " row ID" . $deletedRowId . " deleted. " ;
		$modelMessage = $this->getMessage()->addMessage($message);
		$url = $this->getUrl( 'grid' , 'Customer' );
		$this->redirect( $url );
	
	}

	public function saveAction() /*-----------------------------------------saveAction()-------------------------------------------------------------*/
	{     
		//echo"<pre>"; print_r($_POST); exit();

		$person = $this->getRequest()->getPost('Person');		
		$address = $this->getRequest()->getPost('Address');		
		$shippingAddress = $this->getRequest()->getPost('ShippingAddress');		

        if(array_key_exists('id', $person) && $person['id'] != null ) 
        {   								 // update if key exist 		
			try
			{  																				
	        	if(!(int)$person['id'])
	        	{
	        		throw new Exception(" ID not Valid. "); 
	        	}

				$customerModel = Ccc::getModel('Customer');
				$person['updatedAt'] = date('Y-m-d');
				$customerModel->setData($person);
				$rowId = $customerModel->save();	

				$address['customerId'] = $rowId ;
				$customerModel->getBillingAddress()->setData($address)->save();

				if(isset($customer['same']))
				{
					$address['customerId'] = $rowId ;
					unset($address['billing']);
					$address['shipping'] = 1;
					$customerModel->getBillingAddress()->setData($address)->save();
				}
				else
				{
					$shippingAddress['customerId'] = $rowId ;
					$customerModel->getShippingAddress()->setData($shippingAddress)->save();
				}	

			}
			catch(Exception $e)
			{
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
				$customerModel = Ccc::getModel('Customer');
				$customerModel->setData($person);
				$rowId = $customerModel->save();	

				$address['customerId'] = $rowId ;
				$customerModel->getBillingAddress()->setData($address)->save();

				if(isset($customer['same']))
				{
					$address['customerId'] = $rowId ;
					unset($address['billing']);
					$address['shipping'] = 1;
					$customerModel->getBillingAddress()->setData($address)->save();
				}
				else
				{
					$shippingAddress['customerId'] = $rowId ;
					$customerModel->getShippingAddress()->setData($shippingAddress)->save();
				}	


			}
			catch(Exception $e)
			{

				$message = $e->getMessage() ;
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