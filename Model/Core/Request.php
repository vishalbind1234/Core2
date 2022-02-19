<?php
	  
class Model_Core_Request{


	public function getPost($key = null , $default = 10)
	{
		# code...
		if(!$this->isPost())
		{
			
			echo('invalid request method');
			exit();
		}
		if($key == null){
			return $_POST;
		}
		if(array_key_exists($key, $_POST))
		{
			if(!empty($_POST[$key]) )
			{
				return $_POST[$key];	
			}
			return $default;
		}
		return null;
	}

	public function isPost()
	{
		# code...
		if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
			return true;
		}
		return false;
	}

	public function getRequest($key = null)
	{
		# code...
		if(!$key){
			return $_REQUEST;
		}
		if(array_key_exists($key, $_REQUEST))
		{
			return $_REQUEST[$key];
		}
		return null;
	}


	public function getAction()
	{
		# code...
		return $_GET['a'];
	}

	public function getController()
	{
		# code...
		return $_GET['c'];
	}


}

?>