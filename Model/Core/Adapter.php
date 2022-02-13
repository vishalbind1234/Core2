<?php

echo("<pre>");

class Model_Core_Adapter{

	private $connect = null;
	private $config = [ 
	              		"host" => "mysql:localhost"   , 
				  		"user" => "vishalbind"        , 
				  		"pass" => "vishal"       	  , 
				  		"dbname" => "php_practice_db"  ];


	public function connect(){

        try{
            $this->connect = new PDO($this->config["host"] , $this->config["user"] , $this->config["pass"]  );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $this->connect->setAttribute(PDO::MYSQL_ATTR_FOUND_ROWS ,  true );
            $this->connect->exec("use " . $this->config["dbname"]);
            
        }
        catch(Exception $e){

            echo("error in connection : \n\n" . $e->getMessage() );
        }  

	}

	public function setConnect($connect){
		try{
    		$this->connect = $connect;
    		$this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $this->connect->exec("use " . $this->config["dbname"]);
    		echo("connection successfull \n\n");
    	}
    	catch(Exception $e){

    		echo("error in connection : \n\n" . $e->getMessage() );
    	}	


	}

	public function getConnect(){
    	return $this->connect;
    }

    public function setConfig($config){
    	$this->config = $config;
    	return $this;
    }

    public function getConfig(){

       	return $this->config;
    }

    public function fetch($query){
    	try{
    		if( !$this->getConnect() ){
    			$this->connect();
    		}                
    		$result = $this->getConnect()->prepare($query);
            $bool = $result->execute();       //---------------------$result->execute() returns bool
           
            if(!$bool){                  
           	    return false;
            }

            $records = $result->fetchAll(PDO::FETCH_ASSOC) ;  //----$result->fetchAll() returns Array[][]
            return $records ;                                 // ASSOC , NUM , OBJ , BOTH  , COLUMN & col_idx
    	}
    	catch(Exception $e){

    		echo("error in query : \n\n" . $e->getMessage() );
    	}
    	
    }

    public function delete($query){
        try{
            if( !$this->getConnect() ){
                $this->connect();
            }                
            $del = $this->getConnect()->prepare($query); 
            $del->execute();
            if(!$bool){                  
                return false;
            }
            return $del->rowCount();
        }
        catch(Exception $e){

            echo("error in delete query : \n\n" . $e->getMessage() );
        }
        
    }

/*
    public function fetchOne($query , $column = 0 ,  $mode = PDO::FETCH_COLUMN  )
    {
        # code...
        if( !$this->getConnect() ){
            $this->connect();
        }
        $stmt = $this->getConnect()->prepare( $query );
        $bool = $stmt->execute();

        if( !$bool ){
            return false;
        }

        $result = $stmt->fetchAll( $mode , $column );
        return $result;


    }
*/

    public function fetchPairs( $firstColumn ,  $secondColumn , $tableName  )
    {
        # code...
        if( !$this->getConnect() ){
            $this->connect();
        }
        $query = " SELECT  {$firstColumn} , {$secondColumn} FROM {$tableName} " ;  
        $stmt = $this->getConnect()->prepare( $query );
        $bool = $stmt->execute();
        $firstArray = $stmt->fetchAll(PDO::FETCH_COLUMN , 0);        
        $bool = $stmt->execute();
        $secondArray = $stmt->fetchAll(PDO::FETCH_COLUMN , 1);         
        if(!$firstArray)
        {
        	return null ;
        }
        if(!$secondArray)
        {
        	$secondArray = array_fill(0, sizeof($firstArray) , 0) ;
        }
        $pairArray = array_combine($firstArray, $secondArray);
        return $pairArray;
    }



}





?>
