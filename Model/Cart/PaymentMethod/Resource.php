
<?php  Ccc::loadClass('Model_Core_Row_Resource');  ?>
<?php

class Model_Cart_PaymentMethod_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		$this->setTableName('Payment_Method')->setPrimaryKey('id');
		parent::__construct();
	}


}

?>