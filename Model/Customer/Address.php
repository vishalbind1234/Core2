<?php  

class Model_Customer_Address extends Model_Core_Table{


	public function __construct()
	{
		$this->setTableName('Address')->setPrimaryId('aId');

	}

	public function delete($id)   // $id ----- should be in  array-----
	{
		# code...
		$deletedRowId = parent::delete($id);
		return $deletedRowId;
	}
	
	public function update($array , $id)   // $id -----should be in  array-----
	{
		# code...
		$updatedRowId = parent::update($array , $id);  
		return $updatedRowId;
	}

	public function insert($array )
	{
		# code...
		global $adapter;      
		$id = parent::insert($array);


		
		return $id;
	}




}














?>