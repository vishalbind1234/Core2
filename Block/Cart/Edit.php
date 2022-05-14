
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Cart_Edit extends Block_Core_Template{
	
	public function __construct()
	{
		$this->setTemplate('view/Cart/editAction.php');
	}

	public function getCart()
	{
		# code...
		$cart = Ccc::getRegistry('cart');
		return $cart;
	}

	public function getCustomers()
	{
		$modelCustomer = Ccc::getModel("Customer");
		return $modelCustomer->fetchAll("SELECT * FROM Customer");
	}


	

}



?>