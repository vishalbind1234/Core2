
<?php  Ccc::loadClass('Model_Core_Row_Resource');  ?>
<?php

class Model_Cart_CartItem_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		$this->setTableName('Cart_Item')->setPrimaryKey('id');
		parent::__construct();
	}


}

?>