
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Admin_Grid extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Admin/gridAction.php');
	}

	public function getAdmin()
	{
		# code...
		$modelAdmin = Ccc::getModel('Admin');
		$admin = $modelAdmin->fetchAll(" SELECT * FROM Admin ");
		return $admin;
	}






}








?>