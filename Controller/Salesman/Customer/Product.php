
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

		$customerId = $this->getRequest()->getRequest('customerId');
		$percentage = $this->getRequest()->getRequest('percentage');

		$salesmanCustomerProductGrid = Ccc::getBlock('Salesman_Customer_Product_Grid')->setData(['customerId' => $customerId , 'percentage' => $percentage]);
		$this->getLayout()->getContent()->setChild($salesmanCustomerProductGrid);
		$this->renderLayout();	

		$message = $this->getRequest()->getRequest('message');
		$message = ($message) ? $this->getRequest()->getRequest('message') : '123' ;
		echo($message);
	}

	public function saveAction() //--------------------------------------------------saveAction()-------------------------------------------------------------
	{     
		$array = $this->getRequest()->getPost('Product');  							  
		$id = $this->getRequest()->getRequest('customerId');   
		$modelCustomer = Ccc::getModel('Customer')->load($id);
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
				$modelProduct->customerId = $modelCustomer->id;
				$modelProduct->customerPrice = $value;
				$modelProduct->salesmanPrice = $array['salesmanPrice'][$key];
				$modelProduct->productPrice = $array['productPrice'][$key];
				$modelProduct->save();														 //echo "<pre>"; print_r($modelProduct);  exit();
			}
		}

		$url = $this->getUrl( 'grid' , 'Salesman' );
		$this->redirect($url);

	}
	

}




?>