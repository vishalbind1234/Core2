<?php  CCC::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Add extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Product/addAction.php');
	}

	public function getProduct()
	{
		
		$modelProduct = CCC::getModel('Product');
		$products = $modelProduct->fetchAll("SELECT * FROM Product");
		return $products;
	}






}








?>