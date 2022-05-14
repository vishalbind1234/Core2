
<?php  Ccc::loadClass('Controller_Admin_Action');   ?>

<?php 

class Controller_Customer extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$customerGrid = Ccc::getBlock('Customer_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $customerGrid,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);

		$this->getMessage()->unsetMessages("cart");
	}

	public function gridAction() //---------------------------------------------------------gridAction()---------------------------------
	{																
		$customerGrid = Ccc::getBlock('Customer_Grid');

		$this->setTitle('Customer_Grid');
		$this->getLayout()->getContent()->setChild($customerGrid);
		$this->renderLayout();	

		$this->getMessage()->unsetMessages("cart");
	}


	public function deleteAction()  //--------------------------------------deleteAction()----------------------------------------------  
	{
		try
		{
            $id = $this->getRequest()->getRequest('id');
            $modelCustomer = Ccc::getModel('Customer');
            $deletedRowId = $modelCustomer->delete($id);

            $message = " row ID " . $deletedRowId . " deleted. " ;
			$this->getMessage()->addMessage($message);

			$this->indexAction();

        }
        catch(Exception $e)
        {
			$msg = $e->getMessage();
			$modelMessage = $this->getMessage()->addMessage($msg, Model_Core_Message::ERROR);

			$this->indexAction();   
		}	
	}

	public function editAction() //-------------------------------------------editAction()-----------------------------------
	{
		$id = $this->getRequest()->getRequest('id');
		$modelCustomer = Ccc::getModel("Customer")->load($id);
		Ccc::register('customer', $modelCustomer); 

		$customerEdit = Ccc::getBlock('Customer_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $customerEdit,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);
	}

	public function saveAction() //----------------------------------------saveAction()--------------------------------------
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

					$message = " Customer row id " . $rowId . " Saved  " ;
					$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
					$this->editAction();
				}
				else
				{
					$customerModel = Ccc::getModel('Customer');
					$customerModel->setData($person);
					$rowId = $customerModel->save();

					$message = " Customer row id " . $rowId . " Saved  " ;
					$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);

					$url = $this->getUrl('edit', 'Customer', ['id' => $rowId]);
					$this->redirect($url);		//----------------------------------------------------here redirect is necessary to carry id---------
				}

			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);

				$this->editAction();
			}
		}
		if(array_key_exists('Address', $array))
		{
			try 
			{
				$address = $array['Address'];
				$shippingAddress = $array['ShippingAddress'];	
					
	        	if(!(int)$address['addressId'])
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
					$address['addressId'] = $shippingAddress['addressId'] ;
					$customerModel->getShippingAddress()->setData($address)->save();
				}
				else
				{
					$shippingAddress['same'] = 2;
					$customerModel->getShippingAddress()->setData($shippingAddress)->save();
				}
				$message = " Address row id " . $rowId . " Saved  " ;
				$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);

				$this->indexAction();

			} 
			catch (Exception $e) 
			{
				$message = "row id " . $rowId . " Saved  " ;
				$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);

				$this->indexAction();
			}

		}

	}

	

	public function errorAction()
	{
		echo(" some error occured.");
	}

}




?>
