
<?php  Ccc::loadClass('Model_Core_Row_Resource');  ?>
<?php

class Model_Salesman_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		$this->setTableName('Salesman')->setPrimaryKey('id');
		parent::__construct();
	}



}

?>