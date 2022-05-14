
<?php Ccc::loadClass('Controller_Admin_Action');  ?>

<?php

class Controller_Order extends Controller_Admin_Action{

	public function indexAction() //----------------------------------------------------gridAction()--------------------------------
	{															

		$currentPage =  ($this->getRequest()->getRequest('currentPage', 1));
		$this->getMessage()->addMessage(" On Page " . $currentPage , Model_Core_Message::WARNING);	
		
		$orderGrid = Ccc::getBlock('Order_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $orderGrid,
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
		$orderGrid = Ccc::getBlock('Order_Grid');

		$this->setTitle('Order_Grid');
		$this->getLayout()->getContent()->setChild($orderGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);			//echo "<pre>"; print_r($this->getLayout()); exit();
		$this->renderLayout();											

	}

	public function editAction()
	{																	
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelOrder = Ccc::getModel("Order")->load($id);
		Ccc::register('order', $modelOrder); 

		$orderEdit = Ccc::getBlock('Order_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $orderEdit,
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
		//$blockOrder->toHtml();
	}

	public function saveAction()
	{																		 
		# code... 
		$array = $this->getRequest()->getRequest('Order');                print_r($array);  
		if(array_key_exists('id', $array)  && $array['id'] != null )
		{
			try
			{
				if(!(int)$array['id'])
				{
					throw new Exception(" ID not Valid. ");
				}

				$modelOrder = Ccc::getModel('Order')->load($array['id']);
				$modelOrder->status = $array['status'];
				$modelOrder->state = $array['state'];
				$modelOrder->save();							print_r($modelOrder);

				unset($array['state']);
				$array['createdAt'] = date('Y-m-d');
				$array['notifyToCustomer'] = (isset($array['notifyToCustomer'])) ? "yes" : "no" ;
				$modelComment = Ccc::getModel('Comment');
				$modelComment->setData($array);
				$modelComment->save();								print_r($modelComment);

				$this->indexAction(); 

				
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
				$modelOrder = Ccc::getModel('Order');
				$rowId = $modelOrder->setData($array)->save();
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
            $modelOrder = Ccc::getModel('Order');
            $deletedRowId = $modelOrder->delete($id);

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