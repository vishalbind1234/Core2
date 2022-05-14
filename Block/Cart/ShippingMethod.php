
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Cart_ShippingMethod extends Block_Core_Template{
	
	public function __construct()
	{
		$this->setTemplate('view/Cart/shippingMethod.php');
	}

	public function getShippingMethod()
	{
		# code...
		return Ccc::getModel("Cart_ShippingMethod")->fetchAll("SELECT * FROM Shipping_Method");
	}

	public function getCart()
	{
		# code...
		return Ccc::getRegistry('cart');
	}



	

}


?>


