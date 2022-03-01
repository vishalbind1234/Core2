<?php 

class Model_Vendor_Address_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		# code...
		$this->setTableName('Vendor_Address')->setPrimaryKey('aId');
		parent::__construct();
	}



}

?>