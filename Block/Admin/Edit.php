<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Admin_Edit extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Admin/editAction.php');
	}

	public function getCurrentAdmin()
	{
		# code...
		$modelAdmin = Ccc::getModel('Admin');
		$id = $this->getData('id');
		if(!$id)
		{
			return false;
		}
		$admin = $modelAdmin->fetchRow("SELECT * FROM Admin Where id = {$id} ");
		return $admin;

	}






}








?>