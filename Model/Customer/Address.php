<?php

Ccc::loadClass('Model_Core_Row');  

class Model_Customer_Address extends Model_Core_Row{

	const BILLING = "billing" ;
	const SHIPPING = "shipping" ;

	public function __construct()
	{
		$this->setResourceName('Customer_Address_Resource');

	}





}



?>