
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Salesman_Edit_Tab_Customer extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Salesman/edit/tab/customer.php');
	}

	
	public function getSalesmanCustomers()
	{																
		$salesmanCustomers = Ccc::getRegistry('salesman')->getCustomers();
		return $salesmanCustomers;
	}






}








?>