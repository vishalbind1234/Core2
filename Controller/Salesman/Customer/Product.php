
<?php  Ccc::loadClass('Controller_Core_Action');  //------  ?>    

<?php 

class Controller_Salesman_Customer_Product extends Controller_Core_Action{

	public function indexAction()  //---------------------------------------------------------gridAction()----------------------------------------
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

	public function saveAction() //--------------------------------------------------saveAction()-------------------------------------------------------------
	{     
		$array = $this->getRequest()->getPost('Product');  							  
		$customerId = $this->getRequest()->getRequest('customerId');   
		$modelCustomer = Ccc::getModel('Customer')->load($customerId);
		$salesmanId = $modelCustomer->salesmanId;


		foreach($array['customerPrice'] as $key => $value) 
		{
			if($array['entityId'][$key] != null)
			{
				$modelProduct = Ccc::getModel("Salesman_Customer_Product")->load($array['entityId'][$key]);
				$modelProduct->customerPrice = $array['customerPrice'][$key];
				$modelProduct->save();                                                		//echo "<pre>"; print_r($modelProduct);  exit();

			}
			else
			{
				$modelProduct = Ccc::getModel("Salesman_Customer_Product");
				$modelProduct->productId = $key;
				$modelProduct->salesmanId = $salesmanId;
				$modelProduct->customerId = $customerId;
				$modelProduct->customerPrice = $value;
				$modelProduct->salesmanPrice = $array['salesmanPrice'][$key];
				$modelProduct->productPrice = $array['productPrice'][$key];
				$modelProduct->save();														 //echo "<pre>"; print_r($modelProduct);  exit();
			}
		}

		$this->getMessage()->addMessage(" Salesman Customer Prices updated successfully ");
		$this->indexAction();


		/*$url = $this->getUrl( 'grid' , 'Salesman' );
		$this->redirect($url);
*/
	}
	

}




?>