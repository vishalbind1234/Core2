
<?php  Ccc::loadClass('Model_Core_Row');   ?>
<?php  Ccc::loadClass('Model_Admin_Resource');   ?>

<?php

class Model_Admin extends Model_Core_Row {

	public function __construct()
	{
		$this->setResourceName('Admin_Resource');
	}

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';
	const DEFAULT_LBL = 'undefined';

	public function getStatus($key = null)
	{
		# code...
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