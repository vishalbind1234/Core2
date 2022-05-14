<?php 

class Model_Product_CategoryProduct extends Model_Core_Row{

	protected $product = null;

	public function __construct()
	{
		$this->setResourceName('Product_CategoryProduct_Resource');
	}

	public function getProduct()
	{
		if(!$this->product)
		{
			$this->setProduct(Ccc::getModel('Product'));
		}
		return $this->product;
	}

	public function setProduct($product)
	{
		$this->product = $product;
		return $this; 
	}

	public function getProductCategories()
	{
		$productCategories = $this->fetchAll("SELECT * FROM Category_Product Where productId = {$this->getProduct()->id} ");
		return $productCategories;
	}



}


 ?>