<?php  Ccc::loadClass('Model_Core_Row'); ?>
<?php

class Model_Config extends Model_Core_Row{

	public function __construct()
	{
		# code...
		$this->setResourceName('Config_Resource');
	}


}

?>