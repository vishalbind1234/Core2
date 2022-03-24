
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Config_Grid extends Block_Core_Template{

	protected $pager = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Config/gridAction.php');
	}
/*
	public function getConfig()
	{
		# code...
		$modelConfig = Ccc::getModel('Config');
		$configs = $modelConfig->fetchAll("SELECT * FROM Config");
		if(!$configs)
		{
			return false;
		}
		return $configs;
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

	public function getConfig()
	{
	
		$modelConfig = Ccc::getModel('Config');
		$rowCount = $modelConfig->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelConfig->fetchAll("SELECT * FROM Config LIMIT {$start} , {$offset}");
		return $result;


	}


}



?>