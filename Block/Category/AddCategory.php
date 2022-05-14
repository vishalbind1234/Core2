
<?php  Ccc::loadClass('Block_Core_Template');  ?>

<?php

class Block_Category_AddCategory extends Block_Core_Template{


	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('view/Category/addCategoryAction.php');    
	} 
	



}








?>