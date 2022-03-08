
<?php  Ccc::loadClass('Model_Core_Row_Resource');  ?>
<?php

class  Model_Product_CategoryProduct_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		$this->setTableName('Category_Product')->setPrimaryKey('entityId');
		parent::__construct();
	}


}

?>