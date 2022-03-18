<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php

class Model_Category_Media extends Model_Core_Row{

	protected $category = null;
	const THUM = 1;
	const BASE = 1;
	const SMALL = 1;

	public function __construct()
	{											
		$this->setResourceName('Category_Media_Resource');
		parent::__construct();
	}



	

}



?>