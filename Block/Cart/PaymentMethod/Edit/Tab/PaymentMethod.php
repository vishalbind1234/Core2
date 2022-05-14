
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Cart_PaymentMethod_Edit_Tab_PaymentMethod extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Cart/paymentMethod/edit/tab/paymentMethod.php');
	}

	
	public function getCurrentPaymentMethod()
	{																
		$rowDetails = Ccc::getRegistry('paymentMethod');
		return $rowDetails;
	}






}








?>