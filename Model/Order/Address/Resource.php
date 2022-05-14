
<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php    

class Model_Order_Address_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{

		$this->setTableName('Order_Address')->setPrimaryKey('id');
		
	}






}





?>