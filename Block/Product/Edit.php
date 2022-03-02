
<?php  Ccc::loadClass('Block_Core_Template'); ?>

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
		$modelProduct = Ccc::getModel('Product');
		$id = $this->getData('id');
		if(!isset($id))
		{
			$id = -1;
		}

		$products = $modelProduct->fetchRow("SELECT * FROM Product Where id = {$id} ");
		return $products;

	}

	
	

/*	public function getProduct()
	{
		# code...
		$modelProduct = Ccc::getModel('Product');
		$products = $modelProduct->fetchAll("SELECT * FROM Product");
		return $products;
	}
*/





}








?>