<!DOCTYPE html>
<html>
	<head>
		

	</head>

	<body>
		
		 <button> <a href="index.php?a=grid&c=Category"> Category  </a>  </button>     
		 <button> <a href="index.php?a=grid&c=Customer"> Customer  </a>  </button>  
		 <button> <a href="index.php?a=grid&c=Product">  Product   </a>  </button>  
		 <button> <a href="index.php?a=grid&c=Admin">    Admin     </a>  </button> 
		 <button> <a href="index.php?a=grid&c=Config">   Config    </a>  </button> 


	</body>
</html>


<?php 	Ccc::loadClass('Model_Core_Adapter');
        $adapter = new Model_Core_Adapter();      ?>

<?php 		

Ccc::loadClass('Controller_Core_Front') ;     

class Ccc {


	public static $front = null;                                      

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
		/*return $this;*/
	}

	public static function loadFile( $url )
	{	                                       
		require_once( $url );    
	}

	public static function loadClass( $className )
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


