<?php

 

class Model_Core_Adapter{

	private $connect = null;
	private $config = [ 
	              		"host" => "mysql:localhost"   , 
				  		"user" => "vishalbind"        , 
				  		"pass" => "vishal"       	  , 
				  		"dbname" => "php_practice_db"  ];


	public function setConnect(){

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


	public function getConnect(){
		if(!$this->connect){
			$this->setConnect();
		}
    	return $this->connect;
    }

    public function setConfig($config){
    	$this->config = $config;
    	return $this;
    }

    public function getConfig(){

       	return $this->config;
    }

    public function fetchAll($query){
    	try{
    		               
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

    public function fetchRow($query){
    	try{
    		               
    		$result = $this->getConnect()->prepare($query);
            $bool = $result->execute();       //---------------------$result->execute() returns bool
           
            if(!$bool){                  
           	    return false;
            }

            $record = $result->fetch(PDO::FETCH_ASSOC) ;  //----$result->fetch() returns Array[]
            return $record ;                                 // ASSOC , NUM , OBJ , BOTH  , COLUMN & col_idx
    	}
    	catch(Exception $e){

    		echo("error in query : \n\n" . $e->getMessage() );
    	}
    	
    }

    public function delete($query){
        try{
                        
            $del = $this->getConnect()->prepare($query); 
            $bool = $del->execute();
            if(!$bool){                  
                return false;
            }
            return $del->rowCount();
        }
        catch(Exception $e){

            echo("error in delete query : \n\n" . $e->getMessage() );
        }
        
    }

    public function fetchPairs( $firstColumn ,  $secondColumn , $tableName  )
    {
        # code...
      
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
