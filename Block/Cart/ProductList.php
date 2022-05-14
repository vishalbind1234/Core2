
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Cart_ProductList extends Block_Core_Template{
	
	public function __construct()
	{
		$this->setTemplate('view/Cart/productList.php');
	}

	
	public function getProductList()
	{
		# code...
		$cart = Ccc::getRegistry('cart');
		$cartItems =  $cart->getCartItem();


		$alreadyAdded = [];
		foreach ($cartItems as $key => $value) 
		{
			array_push($alreadyAdded, $value->productId);
		} 

		$str = implode("," , $alreadyAdded);
		$str = "(".$str.")";

		$str = ($str == "()") ? "(-1)" : $str;


		$products = Ccc::getModel("Product")->fetchAll("SELECT * FROM Product WHERE id NOT IN {$str} "); 

		return $products;


	}

			



	

}



?>