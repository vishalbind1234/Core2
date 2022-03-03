
<?php  Ccc::loadClass('Model_Core_View');   ?>
<?php  Ccc::loadClass('Model_Core_Request');   ?>

<?php

class Controller_Core_Action{

	public $view = null;
	public $request = null;
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

	public function renderLayout()
	{
		if(!$this->layout)
		{
			echo('No Layout Selected.');
			exit();
		}
		$this->layout->toHtml();
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

	/*public function getView( )
	{
		if( !$this->view ){
			$this->setView( new Model_Core_View() );
		}

		return $this->view;
	}

	public function setView( $view )
	{
		$this->view = $view;
		return $this;
		
	}*/

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