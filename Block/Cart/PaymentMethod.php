
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Cart_PaymentMethod extends Block_Core_Template{
	
	public function __construct()
	{
		$this->setTemplate('view/Cart/paymentMethod.php');
	}

	public function getPaymentMethod()
	{
		# code...
		return Ccc::getModel("Cart_PaymentMethod")->fetchAll("SELECT * FROM Payment_Method");
	}

	public function getCart()
	{
		# code...
		return Ccc::getRegistry('cart');
	}

	

}



?>