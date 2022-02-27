<?php  Ccc::loadClass('Model_Core_Row');   ?>
<?php  Ccc::loadClass('Model_Admin_Resource');   ?>

<?php

class Model_Admin extends Model_Core_Row {

	public function __construct()
	{
		$this->setResourceName('Admin_Resource');
		

	}







}


?>