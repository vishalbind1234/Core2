
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Page_Grid extends Block_Core_Template{

	protected $pager = null;
	//protected $currentPage = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Page/gridAction.php');
		//$this->currentPage = $this->getData('currentPage');
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
		# code...
		$modelPage = Ccc::getModel('Page');
		$pages = $modelPage->fetchAll("SELECT * FROM Page");
		if(!$pages)
		{
			return false;
		}

		$modelPager = $this->getPager();
		$modelPager->execute(count($pages), $this->getData('currentPage'));
		$pages = array_slice($pages, $modelPager->getStartLimit() - 1 , $modelPager->getPerPageCount() );
		return $pages;


	}

}



?>