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