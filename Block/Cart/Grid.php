
<?php

Ccc::loadClass("Block_Core_Template"); 

class Block_Cart_Grid extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate("view/Cart/gridAction.php");
	}

	public function getCustomers()
	{
		$modelCustomer = Ccc::getModel("Customer");
		return $modelCustomer->fetchAll("SELECT * FROM Customer");
	}


}

?>