<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Grid extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Product/gridAction.php');
	}

	public function getProduct()
	{
		# code...
		$modelProduct = Ccc::getModel('Product');
		$products = $modelProduct->fetchAll(" SELECT * FROM Product ");
		return $products;
	}






}








?>