
<?php  Ccc::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Salesman_Customer extends Controller_Core_Action{

	public function redirect($url)
	{
		header("Location:" . $url );
	    exit();
	    
	}

	public function gridAction() /*---------------------------------------------------------gridAction()-----------------------------------------*/
	{																
	
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$this->getLayout()->getHeader()->setChild($menu);

		$salesmanId = $this->getRequest()->getRequest('id');
		$customerId = $this->getRequest()->getRequest('customerId');
		$percentage = $this->getRequest()->getRequest('percentage');        

		$salesmanCustomerGrid = Ccc::getBlock('Salesman_Customer_Grid')->setData(['id' => $salesmanId , 'percentage' => $percentage , 'customerId' => $customerId ]);
		$this->getLayout()->getContent()->setChild($salesmanCustomerGrid);
		$this->renderLayout();	
		//$customerGrid->toHtml();

		$message = $this->getRequest()->getRequest('message');
		$message = ($message) ? $this->getRequest()->getRequest('message') : '123' ;
		echo($message);
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

		$url = $this->getUrl( 'grid' , 'Salesman_Customer' );
		$this->redirect( $url );


	}
	

}




?>