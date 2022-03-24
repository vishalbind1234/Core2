<?php

Ccc::loadClass('Block_Core_Template');

class Block_Vendor_Edit extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Vendor/editAction.php');
	}

	public function getCurrentVendor()
	{																																
		# code...
		$modelVendor = Ccc::getModel('Vendor');											
		$id = $this->id;
		//$id = $this->getData('id');
		$row = $modelVendor->fetchRow(" SELECT * FROM Vendor WHERE id = {$id}");
		return $row;

	}


}


?>