<?php

Ccc::loadClass('Model_Core_Table');

class Model_Product extends Model_Core_Table {

	public function __construct()
	{
		$this->setTableName('Product')->setPrimaryId('id');

	}

	public function delete($id)
	{
		# code...
		$deletedRowId = parent::delete($id);
		return $deletedRowId;
	}
	
	public function update($array , $id)
	{
		# code...
		$updatedRowId = parent::update($array , $id);
		return $updatedRowId;
	}

	public function insert($array)
	{
		# code...
		global $adapter;
		unset($array['updatedAt']);
		$id = parent::insert($array);
		
		return $id;
	}



}


?>