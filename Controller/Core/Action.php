
<?php  CCC::loadClass('Model_Core_View');   ?>
<?php  CCC::loadClass('Model_Core_Request');   ?>

<?php

class Controller_Core_Action{

	public $view = null;
	public $request = null;

	public function getView( )
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
		
	}

	public function getRequest( )
	{
		if( !$this->request ){
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
		
		$url = "index.php?c={$c}&a={$a}" ;
		foreach ($param as $key => $value) {
			# code...
			if($value)
			{
				$url = $url . "&{$key}={$value}";
			}
		}
		
		return $url;
	}


}

?>