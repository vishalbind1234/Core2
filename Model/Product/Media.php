<?php

Ccc::loadClass('Model_Core_Row');

class Model_Product_Media extends Model_Core_Row {

	const THUM = 1;
	const BASE = 1;
	const SMALL = 1;

	public function __construct()
	{
		$this->setResourceName('Product_Media_Resource');					
	}

	




}


?>