<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Admin_Add extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Admin/addAction.php');
	}

	public function getAdmin()
	{
		
		$modelAdmin = Ccc::getModel('Admin');
		$admin = $modelAdmin->fetchAll("SELECT * FROM Admin");
		return $admin;
	}






}








?>