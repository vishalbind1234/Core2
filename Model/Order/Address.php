<?php

Ccc::loadClass('Model_Core_Row');

class Model_Order_Address extends Model_Core_Row {

	public function __construct()
	{
		$this->setResourceName('Order_Address_Resource');					
	}


}


?>