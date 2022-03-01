<?php Ccc::loadClass('Model_Core_Row_Resource'); ?>
<?php 

class Model_Page_Resource extends Model_Core_Row_Resource{

	public function __construct()
	{
		# code...
		$this->setTableName('Page')->setPrimaryKey('id');
	}

}





?>