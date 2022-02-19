<?php  CCC::loadClass('Block_Core_Template'); ?>

<?php

class Block_Category_Add extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Category/addAction.php');
	}

	public function getCategory()
	{
		# code...
		$modelCategory = CCC::getModel('Category');
		$categories = $modelCategory->fetchAll("SELECT * FROM Category ORDER BY wholePath ");
		return $categories;
	}






}








?>