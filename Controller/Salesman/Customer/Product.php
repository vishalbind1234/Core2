
<?php  Ccc::loadClass('Controller_Core_Action');  //------  ?>    

<?php 

class Controller_Salesman_Customer_Product extends Controller_Core_Action{

	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function gridAction()  //---------------------------------------------------------gridAction()----------------------------------------
	{																
	
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$this->getLayout()->getHeader()->setChild($menu);
		
		$salesmanId = $this->getRequest()->getRequest('id');
		$percentage = $this->getRequest()->getRequest('percentage');
		$customerId = $this->getRequest()->getRequest('customerId');

		$salesmanCustomerProductGrid = Ccc::getBlock('Salesman_Customer_Product_Grid')->setData(['id' => $salesmanId])->setData(['percentage' => $percentage])->setData(['customerId' => $customerId]);
		$this->getLayout()->getContent()->setChild($salesmanCustomerProductGrid);
		$this->renderLayout();	
		//$customerGrid->toHtml();

		$message = $this->getRequest()->getRequest('message');
		$message = ($message) ? $this->getRequest()->getRequest('message') : '123' ;
		echo($message);
	}

	public function saveAction() //--------------------------------------------------saveAction()-------------------------------------------------------------
	{     
		$array = $this->getRequest()->getPost('Product');   //print_r($array);  exit();  

		foreach ($array['customerPrice'] as $key => $value) 
		{
			$modelSalesmanCustomerProduct = Ccc::getModel('Salesman_Customer_Product');
			if(isset($array['entityId']))
			{
				$modelSalesmanCustomerProduct->entityId = $array['entityId'][$key];
			}
			$modelSalesmanCustomerProduct->salesmanId = $array['salesmanId'];
			$modelSalesmanCustomerProduct->customerId = $array['customerId'];
			$modelSalesmanCustomerProduct->productId = $key; 
			$modelSalesmanCustomerProduct->customerPrice = $value; 
			$modelSalesmanCustomerProduct->salesmanPrice = $array['salesmanPrice'][$key]; 
			$modelSalesmanCustomerProduct->productPrice = $array['productPrice'][$key]; 

			//print_r($modelSalesmanCustomerProduct); 
			$modelSalesmanCustomerProduct->save(); 
			
		}

		//exit();

		$url = $this->getUrl( 'grid' , 'Salesman_Customer' );
		$this->redirect( $url );


	}
	

}




?>