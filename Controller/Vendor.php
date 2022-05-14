
<?php

Ccc::loadClass('Controller_Admin_Action');

class Controller_Vendor extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$vendorGrid = Ccc::getBlock('Vendor_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorGrid,
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


	public function gridAction()
	{
		 //code...
		$currentPage =  $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage,  Model_Core_Message::WARNING );
		$vendorGrid = Ccc::getBlock('Vendor_Grid');

		$this->setTitle('Vendor_Grid');
		$this->getLayout()->getContent()->setChild($vendorGrid);
		$this->renderLayout();
	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$modelVendor = Ccc::getModel('Vendor')->load($id);
		Ccc::register('vendor', $modelVendor);

		$vendorEdit = Ccc::getBlock('Vendor_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $vendorEdit,
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
	
	

	public function deleteAction()  //-------------------------------------deleteAction()---------------------------------------------  
	{
		try
		{
            $modelVendor = Ccc::getModel('Vendor');
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelVendor->delete($id);

			$message = " row id " . $deletedRowId . " deleted successfully ";
			$this->getMessage()->addMessage($message);
			$this->indexAction();

        }
        catch(Exception $e)
        {
			$msg = $e->getMessage();
			$this->getMessage()->addMessage($msg);
			$this->indexAction();        
		}	

	
	}

	public function saveAction()
	{


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
					$vendorModel = Ccc::getModel('Vendor');
					$person['updatedAt'] = date('Y-m-d');
					$vendorModel->setData($person);
					$rowId = $vendorModel->save();

					$message = " Vendor row id " . $rowId . " Saved  " ;
					$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
    				$this->editAction();
				}
				else
				{
					$vendorModel = Ccc::getModel('Vendor');
					$vendorModel->setData($person);
					$rowId = $vendorModel->save();

					$message = " Vendor row id " . $rowId . " Saved  " ;
					$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);

					$url = $this->getUrl('edit' , 'Vendor' ,['id' => $rowId]);
					$this->redirect($url);
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
					
	        	if(!(int)$address['addressId'])
	        	{
	        		throw new Exception(" ID not Valid. "); 
	        	}
	        	$id = $this->getRequest()->getRequest('id');
	        	$vendorModel = Ccc::getModel('Vendor')->load($id);
				$rowId = $vendorModel->getAddress()->setData($address)->save();
				
				$message = " Address row id " . $rowId . " Saved  " ;
				$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
				$this->indexAction();
				
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
				$this->editAction();

			}
		}

		
	}

}




?>