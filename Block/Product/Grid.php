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
		$products = $modelProduct->fetchAll(" SELECT p.* , pmb.image as baseImage , pmt.image as thumImage , pms.image as smallImage  
															  FROM Product p  
														      LEFT JOIN Product_Media pmb ON p.id = pmb.productId AND pmb.base = 1
														      LEFT JOIN Product_Media pmt ON p.id = pmt.productId AND pmt.thum = 1
														      LEFT JOIN Product_Media pms ON p.id = pms.productId AND pms.small = 1	  ");
		return $products;
	}






}








?>