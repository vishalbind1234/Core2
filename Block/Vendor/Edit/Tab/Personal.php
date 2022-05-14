
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Vendor_Edit_Tab_Personal extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Vendor/edit/tab/personal.php');
	}

	
	public function getCurrentVendor()
	{																
		$rowDetails = Ccc::getRegistry('vendor');
		return $rowDetails;
	}






}








?>