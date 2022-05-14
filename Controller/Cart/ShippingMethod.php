
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Cart_ShippingMethod extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$shippingMethodGrid = Ccc::getBlock('Cart_ShippingMethod_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $shippingMethodGrid,
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
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage, Model_Core_Message::WARNING);

		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
		$shippingMethodGrid = Ccc::getBlock('Cart_ShippingMethod_Grid');

		$this->setTitle('Cart_ShippingMethod_Grid');
		$this->getLayout()->getContent()->setChild($shippingMethodGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);			//echo "<pre>"; print_r($this->getLayout()); exit();
		$this->renderLayout();											

	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelShippingMethod = Ccc::getModel("Cart_ShippingMethod")->load($id);
		Ccc::register('shippingMethod', $modelShippingMethod); 

		$shippingMethodEdit = Ccc::getBlock('Cart_ShippingMethod_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $shippingMethodEdit,
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
		//$blockShippingMethod->toHtml();
	}

	public function saveAction()
	{																		 
		# code... 
		$array = $this->getRequest()->getRequest('ShippingMethod');                  
		if(array_key_exists('id', $array)  && $array['id'] != null )
		{
			try
			{
				if(!(int)$array['id'])
				{
					throw new Exception(" ID not Valid. ");
				}

				$modelShippingMethod = Ccc::getModel('Cart_ShippingMethod');
				$rowId = $modelShippingMethod->setData($array)->save();
				
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$this->indexAction(); 
			}

		}
		else
		{
			try 
			{
				$modelShippingMethod = Ccc::getModel('Cart_ShippingMethod');
				$rowId = $modelShippingMethod->setData($array)->save();
			} 
			catch (Exception $e) 
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$this->indexAction(); 
			}
		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$this->indexAction(); 
	}

	public function deleteAction()
	{
		# code...
		try
		{
            $id = $this->getRequest()->getRequest('id');
            $modelShippingMethod = Ccc::getModel('Cart_ShippingMethod');
            $deletedRowId = $modelShippingMethod->delete($id);

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


}


?>