
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Customer_Edit extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Customer/editAction.php');		
	}

	public function getCurrentCustomer()
	{																
		# code... 
		$modelCustomer = Ccc::getModel('Customer');                
		$id = $this->getData('id');   
		if(!$id)
		{
			$id = -1;
		}  							
		$customers = $modelCustomer->fetchRow("SELECT * FROM Customer c INNER JOIN Customer_Address a ON c.id = a.customerId Where id = {$id} ");
		return $customers;

	}


}





?>