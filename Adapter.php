<?php

echo("<pre>");

class Adapter{

	private $connect = null;
	private $config = [ 
	              		"host" => "mysql:localhost"   , 
				  		"user" => "vishalbind"        , 
				  		"pass" => "vishal"       	  , 
				  		"dbname" => "php_practice_db"  ];

/*    $arr = array( 'PDO::MYSQL_ATTR_FOUND_ROWS' => TRUE );
*/
	public function connect(){

        try{
            $this->connect = new PDO($this->config["host"] , $this->config["user"] , $this->config["pass"]  );
            $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            $this->connect->exec("use " . $this->config["dbname"]);
            echo("connection successfull \n\n");
        }
        catch(Exception $e){

            echo("error in connection : \n\n" . $e->getMessage() );
        }  

		/*$connect = new PDO($this->config["host"] , $this->config["user"] ,
                             $this->config["pass"]  );
		$this->setConnect($connect);*/
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

    public function insert($query){
    	try{
           
    		if( !$this->getConnect() ){
    			$this->connect();
    		}

    		$result = $this->getConnect()->prepare($query); 
            $bool = $result->execute() ; 
            if(!$bool){
                return false;
            }
    		
            return $result->rowCount();  //---no of rows affected----
    	}
    	catch(Exception $e){

    		echo("error in insert : \n\n" . $e->getMessage() );
    	}
    	
    }

    public function fetch($query){
    	try{
                                            // ASSOC , NUM , OBJ , BOTH  
    		if( !$this->getConnect() ){
    			$this->connect();
    		}                
    		$result = $this->getConnect()->prepare($query);
            $bool = $result->execute();       //---------------------$result->execute() returns bool
            if(!$bool){                  
           	    return false;
            }

            $records = $result->fetchAll(PDO::FETCH_ASSOC) ;  //----$result->fetchAll() returns Array[]
            return $records ;
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


}

/*$adapter = new Adapter();

print_r( get_class_methods("PDO"  )   );*/


/*$config_array = [
				  "host" => "mysql:localhost"    , 
				  "user" => "vishalbind"   , 
				  "pass" => "vishal"       , 
				  "dbname" => "php_practice_db"	
				];

print_r($adapter->getConfig());

$connect = $adapter->setConfig($config_array);

print_r($adapter->getConfig());
*/

/*print_r( $adapter->fetch("select * from ProductGrid") );
*/
/*$adapter->connect();
*/



?>
