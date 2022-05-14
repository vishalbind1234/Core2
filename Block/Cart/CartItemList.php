
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Cart_CartItemList extends Block_Core_Template{
	
	public function __construct()
	{
		$this->setTemplate('view/Cart/cartItemList.php');
	}

	
	public function getCartItem()
	{
		# code...
		$cart = Ccc::getRegistry('cart');
		return $cart->getCartItem();
	}



	

}



?>