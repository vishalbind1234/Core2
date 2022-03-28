
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Admin_Edit_Tab_Personal extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Admin/edit/tab/personal.php');
	}

	/*public function getCurrentAdmin()
	{
		# code...
		$modelAdmin = Ccc::getModel('Admin');
		$id = $this->id;
		$admin = $modelAdmin->fetchRow("SELECT * FROM Admin Where id = {$id} ");
		return $admin;

	}*/

	public function getCurrentAdmin()
	{
		# code...
		//$rowDetails = Ccc::getRegistry('admin');
		$rowDetails = Ccc::getModel('Core_Message')->getMessages('admin');
		return $rowDetails;
	}






}








?>