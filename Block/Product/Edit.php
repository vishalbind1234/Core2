<?php  CCC::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Edit extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Product/editAction.php');
	}

	public function getCurrentProduct()
	{
		# code...
		$modelProduct = CCC::getModel('Product');
		$id = CCC::getFront()->getRequest()->getRequest('id');
		$products = $modelProduct->fetch("SELECT * FROM Product Where id = {$id} ");
		return $products;

	}

	public function getProduct()
	{
		# code...
		$modelProduct = CCC::getModel('Product');
		$products = $modelProduct->fetchAll("SELECT * FROM Product");
		return $products;
	}






}








?>