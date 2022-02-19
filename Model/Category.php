<?php

CCC::loadClass('Model_Core_Table');

class Model_Category extends Model_Core_Table {

	public function __construct()
	{
		$this->setTableName('Category')->setPrimaryId('id');

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

		
		$wholePath = "" ;
		if( $array['parentId']  == null)
		{
			$wholePath =  $id ;  
		}
		else
		{ 
			$parentId = $array['parentId'];
			$query = "SELECT wholePath FROM {$this->tableName} WHERE id = {$parentId} " ;       
			$stmt = $adapter->fetch( $query );         
	        $parentPath = $stmt['wholePath'] ; 
	        $wholePath =  $parentPath . " > " . $id ;  
		}

	
		$this->update(['wholePath' => $wholePath] , ['id' => $id]);
		
		return $id;
	}



}


?>