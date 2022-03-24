
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Admin_Grid extends Block_Core_Template{

	protected $pager = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Admin/gridAction.php');
	}
/*
	public function getAdmin()
	{
		# code...
		$modelAdmin = Ccc::getModel('Admin');
		$admin = $modelAdmin->fetchAll(" SELECT * FROM Admin ");
		return $admin;
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

	public function getAdmin()
	{
	
		$modelAdmin = Ccc::getModel('Admin');
		$rowCount = $modelAdmin->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelAdmin->fetchAll("SELECT * FROM Admin LIMIT {$start} , {$offset}");
		return $result;


	}







}








?>