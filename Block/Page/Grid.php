
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Page_Grid extends Block_Core_Template{

	protected $pager = null;
	//protected $currentPage = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Page/gridAction.php');
		//$this->currentPage = $this->currentPage;
	}

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

	public function getPage()
	{
	
		$modelPage = Ccc::getModel('Page');
		$rowCount = $modelPage->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelPage->fetchAll("SELECT * FROM Page LIMIT {$start} , {$offset}");
		return $result;


	}

}



?>