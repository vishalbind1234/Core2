
<?php 	Ccc::loadClass('Model_Core_Adapter');
        $adapter = new Model_Core_Adapter();      ?>

<?php 		

Ccc::loadClass('Controller_Core_Front') ;     

class Ccc{


	public static $front = null;  
	//public static $config = null;  

	public static function getConfig($key)
	{
		if(!($config = self::getRegistry('config')) )
		{
			$config = self::loadFile('etc/config.php');
			self::register('config' , $config);
		}
		if(!array_key_exists($key, $config))
		{
			return null;
		}
		return $config[$key];
	}


	public static function register($key, $value)
    {
    	$GLOBALS[$key] = $value;
    	//return $this;
    }

    public static function getRegistry($key)
    {
    	if(!array_key_exists($key, $GLOBALS))
    	{
    		return null;
    	}
    	return $GLOBALS[$key];
    }                                    

	public static function unregister($key)
    {
    	if(array_key_exists($key, $GLOBALS))
    	{
    		unset($GLOBALS[$key]);
    	}
    	//return $this ;
    }                                    

	public static  function getFront()
	{				
		# code...
		if(!self::$front)
		{
			$front =   new Controller_Core_Front() ;      
			self::setFront($front);
		}      
		return self::$front;
	}

	public static function setFront($front)
	{
		# code...
		self::$front = $front;
		//return $this;
	}

	public static function loadFile($url)
	{	                                   				   
		return require_once(getCwd().DIRECTORY_SEPARATOR.$url);
	}

	public static function loadClass($className)
	{
		$controllerClassPath = str_replace( "_", "/" , $className ) ;    

		$controllerClassFile = $controllerClassPath . ".php" ;      
		self::loadFile( $controllerClassFile );  								 
	}
	
	public static function getModel($modelName)
	{
		# code...
		$modelName = "Model_" . $modelName;
		self::loadClass($modelName);
		return new $modelName();

	}
	
	public static function getBlock($blockName)
	{
		# code...
		$blockName = "Block_" . $blockName;
		self::loadClass($blockName);
		return new $blockName();

	}

	public static function init()
	{
		
		self::getFront()->init();      

	}



}

Ccc::init();

/*$Ccc = new Ccc();
$Ccc->init();*/

/*Ccc::init();*/







?>


