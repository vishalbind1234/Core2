<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php

class Model_Category_Media extends Model_Core_Row{

	public function __construct()
	{											
		# code... 
		$this->setResourceName('Category_Media_Resource');
		parent::__construct();
	}

}



?>