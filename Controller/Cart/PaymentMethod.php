
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Cart_PaymentMethod extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$paymentMethodGrid = Ccc::getBlock('Cart_PaymentMethod_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $paymentMethodGrid,
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
		$paymentMethodGrid = Ccc::getBlock('Cart_PaymentMethod_Grid');

		$this->setTitle('Cart_PaymentMethod_Grid');
		$this->getLayout()->getContent()->setChild($paymentMethodGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);			//echo "<pre>"; print_r($this->getLayout()); exit();
		$this->renderLayout();											

	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelPaymentMethod = Ccc::getModel("Cart_PaymentMethod")->load($id);
		Ccc::register('paymentMethod', $modelPaymentMethod); 

		$paymentMethodEdit = Ccc::getBlock('Cart_PaymentMethod_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $paymentMethodEdit,
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
		//$blockPaymentMethod->toHtml();
	}

	public function saveAction()
	{																		 
		# code... 
		$array = $this->getRequest()->getRequest('PaymentMethod');                  
		if(array_key_exists('id', $array)  && $array['id'] != null )
		{
			try
			{
				if(!(int)$array['id'])
				{
					throw new Exception(" ID not Valid. ");
				}

				$modelPaymentMethod = Ccc::getModel('Cart_PaymentMethod');
				$rowId = $modelPaymentMethod->setData($array)->save();
				
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
				$modelPaymentMethod = Ccc::getModel('Cart_PaymentMethod');
				$rowId = $modelPaymentMethod->setData($array)->save();
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
            $modelPaymentMethod = Ccc::getModel('Cart_PaymentMethod');
            $deletedRowId = $modelPaymentMethod->delete($id);

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