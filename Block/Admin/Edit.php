<?php  CCC::loadClass('Block_Core_Template'); ?>

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
		$modelAdmin = CCC::getModel('Admin');
		$id = CCC::getFront()->getRequest()->getRequest('id');
		$admin = $modelAdmin->fetch("SELECT * FROM Admin Where id = {$id} ");
		return $admin;

	}

	public function getAdmin()
	{
		# code...
		$modelAdmin = CCC::getModel('Admin');
		$admin = $modelAdmin->fetchAll("SELECT * FROM Admin ORDER BY wholePath ");
		return $admin;
	}






}








?>