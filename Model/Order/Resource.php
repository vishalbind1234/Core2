
<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php    

class Model_Order_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{

		$this->setTableName('Order_Table')->setPrimaryKey('id');
		
	}






}





?>