
<?php  Ccc::loadClass('Model_Core_Row_Resource');  ?>
<?php

class Model_Product_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		$this->setTableName('Product')->setPrimaryKey('id');
		parent::__construct();
	}


}

?>