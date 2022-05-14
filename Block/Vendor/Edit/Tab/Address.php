
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Vendor_Edit_Tab_Address extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Vendor/edit/tab/address.php');
	}

	
	public function getCurrentVendor()
	{																
		$rowDetails = Ccc::getRegistry('vendor');
		return $rowDetails;
	}






}








?>