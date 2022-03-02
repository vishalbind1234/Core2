<?php  Ccc::loadClass('Model_Core_Row'); ?>
<?php

class Model_Config extends Model_Core_Row{

	public function __construct()
	{
		# code...
		$this->setResourceName('Config_Resource');
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