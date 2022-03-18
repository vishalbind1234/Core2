<?php

Ccc::loadClass('Model_Core_Row');  

class Model_Customer_Address extends Model_Core_Row{

	const BILLING = 1;
	const SHIPPING = 1;

	public function __construct()
	{
		$this->setResourceName('Customer_Address_Resource');

	}





}



?>