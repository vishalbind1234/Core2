
<?php  Ccc::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Salesman_Customer extends Controller_Core_Action{

	public function indexAction() /*---------------------------------------------------------gridAction()-----------------------------------------*/
	{																
		$salesmanId = $this->getRequest()->getRequest('id');

		$salesman = Ccc::getModel("Salesman")->load($salesmanId);
		Ccc::register('salesman', $salesman);

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

	public function saveAction() /*-----------------------------------------saveAction()-------------------------------------------------------------*/
	{     
		$array = $this->getRequest()->getPost('Salesman');  
		$salesmanId = $this->getRequest()->getRequest('id'); 

		foreach ($array['reference'] as $key => $value) 
		{
			$modelCustomer = Ccc::getModel('Customer');
			$modelCustomer->id = $value;
			$modelCustomer->salesmanId = -1;
			$modelCustomer->save();
		}

		foreach ($array['customer'] as $key => $value) 
		{
			$modelCustomer = Ccc::getModel('Customer');
			$modelCustomer->id = $value;
			$modelCustomer->salesmanId = $salesmanId;
			$modelCustomer->save();
		}

		$this->getMessage()->addMessage(" Salesman Customer data updated successfully ");
		$this->indexAction();

	}
	

}




?>