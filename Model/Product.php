<?php

Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row {

	public function __construct()
	{
		$this->setResourceName('Product_Resource');					


	}

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';

	public function getStatus()
	{
		# code...
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];

		return $status;
	}



}


?>