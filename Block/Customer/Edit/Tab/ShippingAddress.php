
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Customer_Edit_Tab_Personal extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Customer/edit/tab/personal.php');
	}

	
	public function getCurrentCustomer()
	{																
		$rowDetails = Ccc::getRegistry('customer');
		return $rowDetails;
	}






}








?>