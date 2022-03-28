
<?php  Ccc::loadClass('Controller_Admin_Action');   ?>

<?php 

class Controller_Customer extends Controller_Admin_Action{

	public function gridAction() /*---------------------------------------------------------gridAction()-----------------------------------------*/
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
		$perPageCount =  ($this->getRequest()->getRequest('perPageCount')) ? $this->getRequest()->getRequest('perPageCount') : 10 ;
		$this->getMessage()->addMessage(" On Page " . $currentPage );	
		
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$customerGrid->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);

		$this->setTitle('Customer_Grid');
		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($customerGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();	

		$this->getMessage()->unsetMessages("cart");
		$this->getMessage()->unsetMessages();
	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');

		//$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		//$this->getLayout()->getHeader()->setChild($menu);
		$id = $this->getRequest()->getRequest('id');
		$modelCustomer = Ccc::getModel("Customer")->load($id);
		Ccc::register('customer', $modelCustomer); 
		$customerEdit = Ccc::getBlock('Customer_Edit');
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message');
		$this->getLayout()->getContent()->setChild($customerEdit);
		$this->getLayout()->getFooter()->setChild($messageBlock);
		$this->renderLayout();	
		//$customerEdit->toHtml(); 							
	}

	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try
		{
            
            $modelProduct = Ccc::getModel('Customer');
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelProduct->delete($id);

            $message = " row ID " . $deletedRowId . " deleted. " ;
			$modelMessage = $this->getMessage()->addMessage($message);
			$url = $this->getUrl( 'grid' , 'Customer' );
			$this->redirect( $url );
    
        }
        catch(Exception $e)
        {

			$msg = $e->getMessage();
			$modelMessage = $this->getMessage()->addMessage($msg, Model_Core_Message::ERROR);
			$url = $this->getUrl( 'grid' , 'Customer' );
			$this->redirect( $url );        
		}	
	}

	public function saveAction() /*-----------------------------------------saveAction()--------------------------------------*/
	{     
		//echo"<pre>"; print_r($_POST); exit();

		$array = $this->getRequest()->getPost();

		if(array_key_exists('Person', $array))
		{
			try 
			{
				$person = $array['Person'];	
				if(array_key_exists('id', $person) && $person['id'] != null )
				{
		        	if(!(int)$person['id'])
		        	{
		        		throw new Exception(" ID not Valid. "); 
		        	}
					$customerModel = Ccc::getModel('Customer');
					$person['updatedAt'] = date('Y-m-d');
					$customerModel->setData($person);
					$rowId = $customerModel->save();

					$message = "row id " . $rowId . " Saved  " ;
					$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
					$url = $this->getUrl('edit' , 'Customer');
					$this->redirect($url);
				}
				else
				{
					$customerModel = Ccc::getModel('Customer');
					$customerModel->setData($person);
					$rowId = $customerModel->save();

					$message = "row id " . $rowId . " Saved  " ;
					$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
					$url = $this->getUrl('edit' , 'Customer' ,['id' => $rowId]);
					$this->redirect($url);
				}
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid' , 'Customer');
				$this->redirect($url);	
			}
		}
		if(array_key_exists('Address', $array))
		{
			try 
			{
				$address = $array['Address'];
				$shippingAddress = $array['ShippingAddress'];	
					
	        	if(!(int)$address['id'])
	        	{
	        		throw new Exception(" ID not Valid. "); 
	        	}
	        	$id = $this->getRequest()->getRequest('id');
	        	$customerModel = Ccc::getModel('Customer')->load($id);

	        	$address['same'] = (array_key_exists("same", $address)) ? 1 : 2;
				$rowId = $customerModel->getBillingAddress()->setData($address)->save();

				if(array_key_exists("same", $address) && $address["same"] == 1 )
				{
					$address['addressType'] = "shipping" ;
					$address['id'] = $shippingAddress['id'] ;
					$customerModel->getShippingAddress()->setData($address)->save();
				}
				else
				{
					$shippingAddress['same'] = 2;
					$customerModel->getShippingAddress()->setData($shippingAddress)->save();
				}
				$message = "row id " . $rowId . " Saved  " ;
				$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
				$url = $this->getUrl('edit' , 'Customer');
				$this->redirect($url);
			} 
			catch (Exception $e) 
			{
				$message = "row id " . $rowId . " Saved  " ;
				$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
				$url = $this->getUrl('edit' , 'Customer');
				$this->redirect($url);
			}
		}

	}

	

	public function errorAction()
	{
		echo(" some error occured.");
	}

}




?>
