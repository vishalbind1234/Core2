<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Customer_Grid extends Block_Core_Template{

	protected $pager = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Customer/gridAction.php');     
	}
/*
	public function getCustomer()
	{

		$modelCustomer = Ccc::getModel('Customer');						
		$customers = $modelCustomer->fetchAll(" SELECT * FROM Customer ");  
		return $customers;
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

	public function getCustomer()
	{
	
		$modelCustomer = Ccc::getModel('Customer');
		$rowCount = $modelCustomer->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelCustomer->fetchAll("SELECT * FROM Customer LIMIT {$start} , {$offset}");
		return $result;


	}






}








?>