<?php  CCC::loadClass('Block_Core_Template'); ?>

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
		$modelCustomer = CCC::getModel('Customer');
		$id = CCC::getFront()->getRequest()->getRequest('id');
		$customers = $modelCustomer->fetch("SELECT * FROM Customer c INNER JOIN Address a ON c.id = a.customerId Where id = {$id} ");
		return $customers;

	}

	public function getCustomer()
	{
		# code...
		$modelCustomer = CCC::getModel('Customer');
		$customers = $modelCustomer->fetchAll("SELECT * FROM Customer c INNER JOIN Address a ON c.id = a.customerId");
		return $customers;
	}






}








?>