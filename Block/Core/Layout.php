
<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Core_Layout extends Block_Core_Template{


	public function __construct()
	{														
		parent::__construct();
		$this->setTemplate('view/core/layout.php');			
	}

	


}



?>