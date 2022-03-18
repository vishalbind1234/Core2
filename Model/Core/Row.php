
<?php

class Model_Core_Row {


	public $data = [] ;
	public $resourceName = null ;
	
//-------------------------------------------------------------------
	public function __construct()
	{
		# code...
	}

	public function getAdapter()
	{
		return new Model_Core_Adapter();
	}

	public function setData($data)
	{
		# code...
		$this->data = array_merge($this->data , $data);
		return $this;
	}

	public function getData($key = null)
	{
		# code...
		if($key)
		{
			if(array_key_exists($key, $this->data))
			{
				return $this->data[$key];
			}
			return null;
		}
		return $this->data;
	}

	public function setResourceName($resourceName)
	{
		# code...
		$this->resourceName = $resourceName;
		return $this;
	}

	public function getResourceName()
	{
		# code...
		return $this->resourceName;
	}

	public function getResource()
	{
		# code...
		return Ccc::getModel($this->getResourceName());
	}

	public function __set($key , $value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function __get($key)
	{
		if(!array_key_exists($key, $this->data))
		{
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		unset($this->data[$key]);
		return $this;
	}

	public function __isset($key)
	{
		if(isset($this->data[$key]))
		{
			return true;
		}
		return false;
	}

	public function load($id = null)
	{
		$adapter = $this->getAdapter();
		$primaryKey = $this->getResource()->getPrimaryKey();
		$tableName = $this->getResource()->getTableName(); 
		$rowData = $this->fetchRow("SELECT * FROM {$tableName} WHERE {$primaryKey} = {$adapter->getConnect()->quote($id)}");
		if(!$rowData)
		{
			return $this;
		}
		return $rowData ;
		
	}

	public function fetchAll($query)
	{
		$adapter  = $this->getAdapter();
		$rows = $adapter->fetchAll($query);
		foreach ($rows as &$row) 
		{
			$row = (new $this())->setData($row);
		}
		return $rows;

	}

	public function fetchRow($query)
	{
		$adapter  = $this->getAdapter();         //echo($query); //exit();
		$row = $adapter->fetchRow($query);		 //print_r($row);  // exit();

		$currentRow = new $this();
		if($row)
		{
			foreach ($row as $key => $value) 
			{
				$currentRow->$key = $value;
			}
		}
		return $currentRow;

	}															

	public function save()
	{																							
		# code...
		$primaryKey = $this->getResource()->getPrimaryKey();

		if(array_key_exists($primaryKey , $this->data) && $this->data[$primaryKey] != null )
		{												
			//print_r($this->data); exit();	
			$id = $this->data[$primaryKey];
			unset($this->data[$primaryKey]);																	 
			$updatedRowKey = $this->getResource()->update($this->data , $id );    
			return $updatedRowKey;  
		}
		$insertedRowKey = $this->getResource()->insert($this->data);   
		return $insertedRowKey;
	}

	public function delete($id)
	{								
		return $this->getResource()->delete($id);
	}



	public function resetData()
	{
		# code...
		$this->data = [];
	}


}


?>