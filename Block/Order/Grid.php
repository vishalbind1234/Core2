
<?php

Ccc::loadClass("Block_Core_Template"); 

class Block_Order_Grid extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate("view/Order/gridAction.php");
	}

	public function getOrderDetails()
	{
		$modelOrder = Ccc::getModel("Order");
		return $modelOrder->load($this->orderId);
	}


}

?>