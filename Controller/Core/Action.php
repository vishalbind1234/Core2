
<?php  Ccc::loadClass('Model_Core_View');   ?>
<?php  Ccc::loadClass('Model_Core_Request');   ?>
<?php  Ccc::loadClass('Model_Core_Response');   ?>

<?php

class Controller_Core_Action{

	public $view = null;
	public $request = null;
	public $response = null;
	protected $layout = null;
	protected $message = null;

	public function getMessage()
	{
		if(!$this->message)
		{
			$this->setMessage();
		}
		return $this->message;
	}

	public function setMessage()
	{
		$this->message = Ccc::getModel('Core_Message'); 					
		return $this;
	}

	public function setTitle($title)
	{
		$this->getLayout()->getHead()->setTitle($title);
		return $this;
	}

	public function getLayout()
	{
		if(!$this->layout)
		{
			$this->setLayout();
		}
		return $this->layout;
	}

	public function setLayout()
	{
		$this->layout = Ccc::getBlock('Core_Layout'); 					
		return $this;
	}

	public function getResponse()
	{
		if( !$this->response )
		{
			$this->setResponse( new Model_Core_Response() );
		}
		return $this->response;
	}

	public function setResponse( $response )
	{
		$this->response = $response;
		return $this;
		
	}

	public function renderLayout()
	{
		if(!$this->layout)
		{
			echo('No Layout Selected.');
			exit();
		}
		$this->getResponse()
					->setHeader('content-type' , 'text/html')
				    ->render($this->layout->toHtml());
	}
	

	public function redirect($url)
	{
		# code...
		header('Location:' . $url );
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

	
	public function getRequest()
	{
		if( !$this->request )
		{
			$this->setRequest( new Model_Core_Request() );
		}
		return $this->request;
	}

	public function setRequest( $request )
	{
		$this->request = $request;
		return $this;
		
	}

	public function getUrl( $a = null , $c = null , $param = [] , $reset = false  )
	{
		# code...
		

		$a = ($a) ? $a : $_GET['a'] ;
		$c = ($c) ? $c : $_GET['c'] ;
		if($reset)
		{
			$_GET = [];
		}
		unset($_GET['a']);
		unset($_GET['c']);
		$param = array_merge($_GET , $param);
		
		$url = "";
		$url = $url . $this->baseUrl() . "index.php?a={$a}&c={$c}" ;
		foreach ($param as $key => $value) {
			# code...
			if($value)
			{
				$url = $url . "&{$key}={$value}";
			}
		}
		
		return $url;
	}

	public function baseUrl()
	{
		# code...
		return "http://localhost/Cybercome/Core/" ;
	}


}

?>

<!-- 
hello sir

when we set message for admin we use Model_Admin_Message class

and the message will be set in 

$_SESSION[

			Admin => [
						message => [
										name => XXXXXX
									]

				     ]	

		 ]

but when we retrive message, we use Block_Core_Layout_Header_Message.php  which uses  Model_Core_Admin class and  odel_Core_Admin class is common for all 

So , what we should do to retrive messages  -->