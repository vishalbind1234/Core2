<?php  Ccc::loadClass('Model_Core_Row'); ?>
<?php

class Model_Page extends Model_Core_Row{

	public function __construct()
	{
		# code...
		$this->setResourceName('Page_Resource');
	}


}

?>