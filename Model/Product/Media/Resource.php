
<?php  Ccc::loadClass('Model_Core_Row_Resource');  ?>
<?php

class Model_Product_Media_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		$this->setTableName('Product_Media')->setPrimaryKey('id');
		parent::__construct();
	}


}

?>