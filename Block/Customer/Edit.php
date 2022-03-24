
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Customer_Edit extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate('view/Customer/editAction.php');		
	}

	public function getCurrentCustomer()
	{																
		$modelCustomer = Ccc::getModel('Customer');                
		$id = $this->id; 
		//$id = $this->getData('id'); 
		$customer = $modelCustomer->load($id);
		
		return $customer;

	}



}





?>