<?php

Ccc::loadClass('Model_Core_Row');

class Model_Cart_PaymentMethod extends Model_Core_Row {

	
	public function __construct()
	{
		$this->setResourceName('Cart_PaymentMethod_Resource');					
	}




}


?>