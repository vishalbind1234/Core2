<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Grid extends Block_Core_Template{
	
	protected $pager = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Product/gridAction.php');
	}

	/*public function getProduct()
	{
		$modelProduct = Ccc::getModel('Product');
		$products = $modelProduct->fetchAll(" SELECT *  FROM Product ");
		return $products;
	}*/


	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager();
		}
		return $this->pager;
	}
	public function setPager()
	{
		$this->pager = Ccc::getModel('Core_Pager');
		return $this;
	}

	public function getProduct()
	{
	
		$modelProduct = Ccc::getModel('Product');
		$rowCount = $modelProduct->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelProduct->fetchAll("SELECT * FROM Product LIMIT {$start} , {$offset}");
		return $result;


	}





}








?>