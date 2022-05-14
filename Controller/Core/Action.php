
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
		
		$this->getResponse()
					->setHeader('Content-type', 'text/html')
				    ->render($this->getLayout()->toHtml());
		
	}

	public function renderJson($content)
	{
		
		$this->getResponse()
					->setHeader('Content-type', 'application/json')
				    ->render(json_encode($content));
		
	}
	

	public function redirect($url)
	{
		# code...
		header('Location:' . $url );
		exit();
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

	public function getUrl( $a = null , $c = null , $param = null , $reset = false  )
	{
		$param = ($param) ? $param : [];
		$a = ($a) ? $a : $_GET['a'] ;
		$c = ($c) ? $c : $_GET['c'] ;
		
		if($reset)
		{
			$_GET = [];
		}
		$_GET['a'] = $a;
		$_GET['c'] = $c;
		$param = array_merge($_GET , $param);
		
		$url = "";
		$url = $url . $this->getBaseUrl() . "index.php?" ;
		foreach ($param as $key => $value) {
			# code...
			if($value)
			{
				$url = $url . "{$key}={$value}&";
			}
		}
		
		return substr($url, 0 , -1);
	}

	public static function getBaseUrl($subUrl = null)
    {
        $url = Ccc::getBaseUrl();
        if($subUrl)
        {
            $url = $url . $subUrl;
        }
        return $url;
    }


}

?>

