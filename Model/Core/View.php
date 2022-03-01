<?php



class Model_Core_View{

	protected $data = [];

	protected $template = null;

	public function getTemplate()
	{
		# code...
		return $this->template ;
	}

	public function setTemplate( $template )
	{														
		# code...
		$this->template = $template;
		return $this;
	}

	public function toHtml()
	{																				
		# code...
		require_once( $this->getTemplate() );									
		return $this;             
	}

	public function setData(array $data) /*--------here directly whole array  will be set-------------*/
	{
		# code...
		$this->data = $data;
		return $this;
	}

	public function addData($key , $value ) /*-----here key(Controller)-value(array) will be stored------*/
	{
		# code...
		$this->data[$key] = $value;
		return $this;
	}

	public function getData($key = null)
	{
		# code...
		if(!$key){
			return $this->data;
		}
		if(array_key_exists($key, $this->data)){
			return $this->data[$key];
		}
		return null; 
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}


	public function getUrl( $a = null , $c = null , $param = [] , $reset = false  )
	{
		# code...
		
		//print_r($param); exit();

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