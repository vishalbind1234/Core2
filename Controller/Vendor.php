
<?php

Ccc::loadClass('Controller_Admin_Action');

class Controller_Vendor extends Controller_Admin_Action{

	public function gridAction()
	{
		 //code...
		
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$vendorGrid = Ccc::getBlock('Vendor_Grid');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

		$this->setTitle('Vendor_Grid');
		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($vendorGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();
		//$blockVendor->toHtml();

	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$vendorEdit = Ccc::getBlock('Vendor_Edit')->setData(['id' => $id]); 

		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($vendorEdit);
		$this->renderLayout();

		$this->getMessage()->unsetMessages();
		//$blockVendor->toHtml();
	
	}

	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try
		{
            $modelVendor = Ccc::getModel('Vendor');
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelVendor->delete($id);
    
        }
        catch(Exception $e)
        {
			$msg = $e->getMessage();
			$modelMessage = $this->getMessage()->addMessage($msg);
			$url = $this->getUrl( 'grid' , 'Vendor' );
			$this->redirect( $url );        
		}	

		$message = " row id " . $deletedRowId . " deleted successfully" ;
		$modelMessage = $this->getMessage()->addMessage($message);
		$url = $this->getUrl( 'grid' , 'Vendor' );
		$this->redirect( $url );
	
	}

	public function saveAction()
	{
		$person = $this->getRequest()->getPost('Person');
		$address = $this->getRequest()->getPost('Address');

		if(array_key_exists('id', $person) && $person['id'] != null )
		{
			try
			{  																				
				if(!(int)$person['id'])
				{
					throw new Exception(" ID not Valid.");
				}

				$vendorModel = Ccc::getModel('Vendor');
				$person['updatedAt'] = date('Y-m-d');     
				$rowId = $vendorModel->setData($person)->save();     
				
				$address['vendorId'] = $rowId;
				$vendorModel->getAddress()->setData($address)->save();
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid', 'Vendor');
				$this->redirect($url); 
			}

		}
		else
		{
			try
			{  																				
				$vendorModel = Ccc::getModel('Vendor');
				$rowId = $vendorModel->setData($person)->save();     
				
				$address['vendorId'] = $rowId;
				$vendorModel->getAddress()->setData($address)->save();
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid', 'Vendor');
				$this->redirect($url); 
			}

		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl( 'grid' , 'Vendor' );
		$this->redirect( $url ); 

	}

}




?>