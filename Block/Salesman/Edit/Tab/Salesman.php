
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Salesman_Edit_Tab_Salesman extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Salesman/edit/tab/salesman.php');
	}

	
	public function getCurrentSalesman()
	{																
		$rowDetails = Ccc::getRegistry('salesman');
		return $rowDetails;
	}






}








?>