<?php

Ccc::loadClass('Model_Core_Row');

class Model_Order_Item extends Model_Core_Row {

	public function __construct()
	{
		$this->setResourceName('Order_Item_Resource');					
	}


}


?>