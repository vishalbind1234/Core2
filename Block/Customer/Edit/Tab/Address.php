
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Customer_Edit_Tab_Address extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Customer/edit/tab/address.php');
	}

	
	public function getCurrentCustomer()
	{																
		$rowDetails = Ccc::getRegistry('customer');
		return $rowDetails;
	}






}








?>