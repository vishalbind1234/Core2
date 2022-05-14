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
		ob_start();
		require_once( $this->getTemplate() );
		$html = ob_get_contents();
		ob_end_clean();								
		return $html;             
	}

	public function setData(array $data) /*--------here directly whole array  will be set-------------*/
	{
		# code...
		$this->data = array_merge($this->data , $data);
		return $this;
	}

	public function __set($key , $value ) 
	{
		# code...
		$this->data[$key] = $value;
		return $this;
	}

	public function __get($key = null)
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

	public function __unset($key)
	{
		if(array_key_exists($key, $this->data))
		{
			unset($this->data[$key]);
		}
		return $this;
	}

	public function __isset($key)
	{
		if(array_key_exists($key, $this->data))
		{
			return true;
		}
		return false;
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
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