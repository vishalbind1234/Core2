
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Page_Edit_Tab_Page extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Page/edit/tab/page.php');
	}

	
	public function getCurrentPage()
	{																
		$rowDetails = Ccc::getRegistry('page');
		return $rowDetails;
	}






}








?>