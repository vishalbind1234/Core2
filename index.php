<!DOCTYPE html>
<html>
	<head>
		

	</head>

	<body>
		
		 <button> <a href="index.php?a=grid&c=Categories"> Categories  </a>  </button>     
		 <button> <a href="index.php?a=grid&c=Customers"> Customers  </a>  </button>  
		 <button> <a href="index.php?a=grid&c=Products"> Products  </a>  </button>  
		 <button> <a href="index.php?a=grid&c=Admin"> Admin    </a>  </button> 
		 <button> <a href="index.php?a=fetchOne&c=Admin"> Admin Fetch One   </a>  </button> 


	</body>
</html>


<?php require_once("Model/Core/Adapter.php"); 
       $adapter = new Model_Core_Adapter();      ?>

<?php


class CCC {




	public static function loadFile( $url )
	{	                                       
		require_once( $url );    
	}

	public static function loadClass( $className )
	{
		$controllerClassPath = str_replace( "_", "/" , $className ) ;    

		$controllerClassFile = $controllerClassPath . ".php" ;      
		
		CCC::loadFile( $controllerClassFile );  

	}
	
	public static function init( )
	{
		if( ucfirst($_GET['c']) == 'Categories'){

			$method =  (!empty($_GET['a']) ) ? $_GET['a'] . 'Category' : 'errorAction' ; 
		}
		elseif( ucfirst($_GET['c']) == 'Products' ){

			$method =  (!empty($_GET['a']) ) ? $_GET['a'] . 'Product' : 'errorAction' ;            /*--------------here we have got method name------------*/
		}
		elseif( ucfirst($_GET['c']) == 'Admin' ){

			$method =  (!empty($_GET['a']) ) ? $_GET['a'] . 'Admin' : 'errorAction' ;            /*--------------here we have got method name------------*/
		}
		else{

			$method =  (!empty($_GET['a']) ) ? $_GET['a'] . 'Action' : 'errorAction' ;            /*--------------here we have got method name------------*/
		}

		$controllerName = ucfirst( $_GET['c'] ) ;         /*-----------here we have got controller class File name -----------------*/
		
		$controllerClassName = 'Controller_' . $controllerName ;    /*--------------------actual name of controller class------------------*/

		CCC::loadClass( $controllerClassName ); 

		$obj = new $controllerClassName(); 
		$obj->$method() ; 


	}



}

CCC::init();







?>


