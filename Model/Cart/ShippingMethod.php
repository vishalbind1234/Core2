<?php

Ccc::loadClass('Model_Core_Row');

class Model_Cart_ShippingMethod extends Model_Core_Row {

	
	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';
	const DEFAULT_LBL = 'undefined';

	public function __construct()
	{
		$this->setResourceName('Cart_ShippingMethod_Resource');					
	}

	public function getStatus($key = null)
	{
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];

		if($key)
		{
			if(array_key_exists($key, $status))
			{
				return $status[$key];
			}
			return self::DEFAULT_LBL;
		}
		return $status;
	}



}


?>