
<?php  Ccc::loadClass('Model_Core_Row_Resource');  ?>
<?php

class Model_Salesman_Customer_Product_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		$this->setTableName('Salesman_Customer_Price')->setPrimaryKey('entityId');
		parent::__construct();
	}



}

?>