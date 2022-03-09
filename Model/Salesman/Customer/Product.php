
<?php  Ccc::loadClass('Model_Core_Row');  ?>
<?php

class Model_Salesman_Customer_Product extends Model_Core_Row{

	public function __construct()
	{
		$this->setResourceName('Salesman_Customer_Product_Resource');
		parent::__construct();
	}



}

?>