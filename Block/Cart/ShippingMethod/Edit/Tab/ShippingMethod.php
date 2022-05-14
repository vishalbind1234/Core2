
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Cart_ShippingMethod_Edit_Tab_ShippingMethod extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Cart/shippingMethod/edit/tab/shippingMethod.php');
	}

	
	public function getCurrentShippingMethod()
	{																
		$rowDetails = Ccc::getRegistry('shippingMethod');
		return $rowDetails;
	}






}








?>