<?php

Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row {

	public function __construct()
	{
		$this->setResourceName('Category_Resource');
		//$this->setTableName('Category')->setPrimaryId('id')->setRowClassName('Category_Resource');

	}

	public function hello()
	{
		# code...
		return 'My_Name_is_Anonymous';
	}




}


?>