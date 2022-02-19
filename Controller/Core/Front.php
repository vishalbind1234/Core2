

<?php
		
CCC::loadClass('Model_Core_Request');


class Controller_Core_Front{


	public $request = null;

	public function getRequest()
	{
		# code...
		if(!$this->request)
		{
			$request = new Model_Core_Request();
			$this->setRequest($request);
		}
		return $this->request;
	}
	
	public function setRequest($request)
	{
		# code...
		$this->request = $request;
		return $this;
	}

	public function init()
	{                               
		# code... 
		$method =  (!empty($this->getRequest()->getAction() )) ? $this->getRequest()->getAction() . 'Action' : 'errorAction' ;  echo($method);
		
		$controllerName =  $this->getRequest()->getController()  ; 
		$controllerClassName = 'Controller_' . $controllerName ;                    
		$controllerClassName = $this->prepareClassName($controllerClassName);        /*--------------------actual name of controller class------------------*/
	
		CCC::loadClass( $controllerClassName ); 
		$obj = new $controllerClassName(); 
		$obj->$method() ; 
	}

	public function prepareClassName($name)
	{
		# code...
		$name = ucwords($name , "_");
		return $name;
	}



}


?>