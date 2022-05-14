
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Config_Edit_Tab_Config extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Config/edit/tab/config.php');
	}

	
	public function getCurrentConfig()
	{																
		$rowDetails = Ccc::getRegistry('config');
		return $rowDetails;
	}






}








?>