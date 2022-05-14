
<?php  Ccc::loadClass('Block_Core_Template');  ?>

<?php

class Block_Product_AddProduct extends Block_Core_Template{


	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/Product/addProductAction.php');    
	} 
	



}








?>