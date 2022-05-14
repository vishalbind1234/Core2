
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Cart_CartSummary extends Block_Core_Template{
	
	public function __construct()
	{
		$this->setTemplate('view/Cart/cartSummary.php');
	}

	
	public function getCart()
	{
		# code...
		$cart = Ccc::getRegistry('cart');
		return $cart;
	}



	

}



?>