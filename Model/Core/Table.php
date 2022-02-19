<?php



class Model_Core_Table{

	public $tableName = null ;
	public $primaryId = null ;

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setTableName($tableName)
	{
		# code...
		$this->tableName = $tableName;
		return $this;
	}

	public function getPrimaryId()
	{
		return $this->primaryId;
	}

	public function setPrimaryId($primaryId)
	{
		# code...
		$this->primaryId = $primaryId;
		return $this;
	}

	public function delete($id)
	{								
		# code...

		global $adapter ;   
		$primaryId = $this->getPrimaryId();
		$tableName = $this->getTableName();
		$id = $id['{$primaryId}'];						
		$query =  " DELETE FROM {$tableName} WHERE {$primaryId} = {$id}"  ; 
		$adapter->delete( $query );
		return $id ;
	}


	public function update($array , $id)
	{
		# code...
		global $adapter ;											

		$primaryId = $this->getPrimaryId();
		$tableName = $this->getTableName();

		$set = "";														

		foreach($array as $key => $value) 
		{
			$set = $set . $key . " = " . "'".$value."'" . " , " ;
		}
		$set = substr($set , 0 , -2 );
		$id = $id['id'];
 
		$query = " UPDATE {$tableName} SET {$set} WHERE {$primaryId} = {$id} "  ;   /*if($tableName == 'Address'){ echo($query); exit(); }*/
		
		$update = $adapter->getConnect()->prepare( $query );
		$update->execute();																		
    	return $id ;
	}


	public function insert($array)
	{
		# code...
		global $adapter ;
		$primaryId = $this->getPrimaryId();
		$tableName = $this->getTableName(); 
				
		$keys = "";
		$values = "";
		foreach($array as $key => $value) 
		{
			$keys = $keys . $key . " , " ;
			$values = $values . "'".$value."'" . " , " ;
		}
		$keys = substr($keys , 0 , -2 );
		$values = substr($values , 0 , -2 );		
		
		$query = " INSERT INTO {$tableName}( {$keys} )  VALUES( {$values} )  " ; 
		$insert = $adapter->getConnect()->prepare( $query );
		$insert->execute();

		$query = " SELECT {$primaryId} FROM {$tableName} ORDER BY {$primaryId} DESC LIMIT 1" ;  
		$insertedRow = $adapter->fetch($query);
		$insertedRowId = $insertedRow[$primaryId];  

     	return $insertedRowId ;
	}

	public function fetchAll($query)
	{
		global $adapter;
		$result = $adapter->fetchAll($query);
		return $result;

	}

	public function fetch($query)
	{
		global $adapter;
		$result = $adapter->fetch($query);
		return $result;

	}



}


?>