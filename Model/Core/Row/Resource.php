<?php

class Model_Core_Row_Resource{

	public $tableName = null;
	public $primaryKey = null;

	public function __construct()
	{
		# code... for now we keep it empty----
	}

	public function getAdapter()
	{
		return new Model_Core_Adapter();
	}

	public function setTableName($tableName)
	{
		# code...
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		# code...
		return $this->tableName;
	}

	public function setPrimaryKey($primaryKey)
	{
		# code...
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey()
	{
		# code...
		return $this->primaryKey;
	}


	//---------------------------------------------------------------------------------------------------------------------


	public function delete($id)
	{								
		# code...

		$adapter = $this->getAdapter() ;   
		$primaryKey = $this->getPrimaryKey();
		$tableName = $this->getTableName();
		$query =  " DELETE FROM {$tableName} WHERE {$primaryKey} = {$id}"  ; 				//echo($query); exit(); 
		$adapter->delete( $query );
		return $id ;
	}

	public function update($array , $id)
	{
		# code...
		$adapter = $this->getAdapter() ;
							
		$primaryKey = $this->getPrimaryKey();
		$tableName = $this->getTableName();

		$set = "";																			//print_r($array); exit();												

		foreach($array as $key => $value) 
		{
			if($value)
			{	//$adapter->getConnect()->quote($value)
				$set = $set . $key . " = " .  $adapter->getConnect()->quote($value)  . " , " ;
			}
		}
		$set = substr($set , 0 , -2 );
		 
		$query = " UPDATE {$tableName} SET {$set} WHERE {$primaryKey} = {$id} "  ;        //echo($query);  exit();   //if($tableName == 'Address')
		$update = $adapter->getConnect()->prepare( $query );
		$update->execute();																		
    	return $id ;
	}


	public function insert($array)
	{
		# code...
		$adapter  = $this->getAdapter() ;
		$primaryKey = $this->getPrimaryKey();
		$tableName = $this->getTableName(); 
				
		$keys = "";
		$values = "";
		foreach($array as $key => $value) 
		{
			if($value)
			{
				$keys = $keys . $key . " , " ;
				$values = $values . $adapter->getConnect()->quote($value) . " , " ;	
			}
			
		}
		$keys = substr($keys , 0 , -2 );
		$values = substr($values , 0 , -2 );		
		
		$query = " INSERT INTO {$tableName}( {$keys} )  VALUES( {$values} )  " ;            //echo($query); exit(); 
		$insert = $adapter->getConnect()->prepare( $query );
		$insert->execute();

		$query = " SELECT {$primaryKey} FROM {$tableName} ORDER BY {$primaryKey} DESC LIMIT 1" ;  
		$insertedRow = $adapter->fetchRow($query);
		$insertedRowKey = $insertedRow[$primaryKey];  

     	return $insertedRowKey ;
	}





}

?>