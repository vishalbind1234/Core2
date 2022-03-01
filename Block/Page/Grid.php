
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Page_Grid extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Page/gridAction.php');
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
		return $pages;


	}

}



?>