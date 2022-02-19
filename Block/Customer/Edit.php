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
		$id = Ccc::getFront()->getRequest()->getRequest('id');
		$customers = $modelCustomer->fetch("SELECT * FROM Customer c INNER JOIN Address a ON c.id = a.customerId Where id = {$id} ");
		return $customers;

	}

	public function getCustomer()
	{
		# code...
		$modelCustomer = Ccc::getModel('Customer');
		$customers = $modelCustomer->fetchAll("SELECT * FROM Customer c INNER JOIN Address a ON c.id = a.customerId");
		return $customers;
	}






}








?>