
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Page_Edit extends Block_Core_Template{

	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Page/editAction.php');	
	}

	public function getCurrentPage()
	{
		# code...
		$modelPage = Ccc::getModel('Page');
		$id = $this->getData('id');
		if(!isset($id))
		{
			return false;
		}
		$pages = $modelPage->fetchRow("SELECT * FROM Page where id = {$id}");
		return $pages;

		
	}

}



?>