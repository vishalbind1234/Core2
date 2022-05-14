
<?php

Ccc::loadClass('Controller_Admin_Action');

class Controller_Salesman extends Controller_Admin_Action{

	public function indexAction()
	{
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage );

		$salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanGrid,
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
		$this->getMessage()->addMessage(" On Page " . $currentPage );
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');

		$this->setTitle('Salesman_Grid');
		$this->getLayout()->getContent()->setChild($salesmanGrid);
		$this->renderLayout();	

	}

	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$modelSalesman = Ccc::getModel("Salesman")->load($id);
		Ccc::register('salesman', $modelSalesman); 

		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanEdit,
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


	public function deleteAction()  /*--------------------------------------deleteAction()----------------------------------------------*/  
	{
		try{
            
            $modelSalesman = Ccc::getModel('Salesman');
            $id = $this->getRequest()->getRequest('id');
            $deletedRowId = $modelSalesman->delete($id);

            $message = " row ID " . $deletedRowId . " deleted. " ;
			$this->getMessage()->addMessage($message);
			$this->indexAction();
    
        }
        catch(Exception $e){

			$msg = $e->getMessage();
			$this->getMessage()->addMessage($msg);
			$this->indexAction();    
		}	
	}

	public function saveAction()
	{
		# code...
		$salesman = $this->getRequest()->getPost('Salesman');

		if(array_key_exists('id', $salesman) && $salesman['id'] != null )
		{

			try
			{  																				
				if(!(int)$salesman['id'])
				{
					throw new Exception(" ID not Valid.");
				}
				$salesmanModel = Ccc::getModel('Salesman');  
				$salesman['updatedAt'] =  date('Y-m-d');
				$rowId = $salesmanModel->setData($salesman)->save();    
			}
			catch(Exception $e)
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
				$salesmanModel = Ccc::getModel('Salesman');  
				$rowId = $salesmanModel->setData($salesman)->save() ;
			}
			catch(Exception $e)
			{

				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$this->editAction();			
			}

		}

		$message = " Salesman row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$this->editAction(); 

	}

}




?>