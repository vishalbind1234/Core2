
<?php

Ccc::loadClass("Block_Core_Template"); 

class Block_Cart_AddNew extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate("view/Cart/addNewAction.php");
	}

	


}




?>