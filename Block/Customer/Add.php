<?php  CCC::loadClass('Block_Core_Template'); ?>

<?php

class Block_Customer_Add extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Customer/addAction.php');
	}

	public function getCustomer()
	{
		
		$modelCustomer = CCC::getModel('Customer');
		$customers = $modelCustomer->fetchAll("SELECT * FROM Customer c INNER JOIN Address a ON c.id = a.customerId");
		return $customers;
	}






}








?>