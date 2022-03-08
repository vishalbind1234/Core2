
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Edit extends Block_Core_Template{

	protected $productId;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Product/editAction.php');
	}

	public function getCurrentProduct()
	{
		$modelProduct = Ccc::getModel('Product');
		$this->productId = $this->getData('id');
		if(!isset($this->productId))
		{
			$this->productId = -1;
		}

		$products = $modelProduct->fetchRow("SELECT * FROM Product Where id = {$this->productId} ");
		return $products;

	}

	public function getCheckedCategories()
	{
		$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
		//$productId = $this->getData('id');														
		$categories = $modelCategoryProduct->fetchAll("SELECT * FROM Category_Product Where productId = {$this->productId} ");
		return $categories;
	}

	public function getAllCategories()
	{
		$modelCategory = Ccc::getModel('Category');
		$category = $modelCategory->fetchAll("SELECT * FROM Category  ");
		return $category ;
	}

	public function getCategoryName($id)
	{
		$modelCategory = Ccc::getModel('Category');
		$category = $modelCategory->fetchRow("SELECT name FROM Category WHERE id = {$id} ");
		return $category->name ;

	}

	
	







}








?>