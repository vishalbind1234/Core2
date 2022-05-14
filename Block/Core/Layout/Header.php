
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Core_Layout_Header extends Block_Core_Template{

	public function __construct()						
	{												
		# code...
		$this->setTemplate('view/core/layout/header.php');			
	}

	public function getMenu()
	{
		return Ccc::getBlock("Core_Layout_Header_Menu");
	}

	public function getMessage()
	{
		return Ccc::getBlock("Core_Layout_Header_Message");
	}






}

?>