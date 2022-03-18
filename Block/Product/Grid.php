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
		$modelProduct = Ccc::getModel('Product');
		$products = $modelProduct->fetchAll(" SELECT *  FROM Product ");
		return $products;
	}

	public function getThum($id)
	{
		$modelProduct = Ccc::getModel('Product');
		$product = $modelProduct->load($id);
		$thumRow = $modelProduct->getProductMedia()->setProduct($product)->getThum();
		return $thumRow;
	}

	public function getBase($id)
	{
		$modelProduct = Ccc::getModel('Product');
		$product = $modelProduct->load($id);
		$baseRow = $modelProduct->getProductMedia()->setProduct($product)->getBase();
		return $baseRow;
	}

	public function getSmall($id)
	{
		$modelProduct = Ccc::getModel('Product');
		$product = $modelProduct->load($id);
		$smallRow = $modelProduct->getProductMedia()->setProduct($product)->getSmall();
		return $smallRow;
	}






}








?>