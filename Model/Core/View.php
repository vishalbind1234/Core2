<?php



class Model_Core_View{

	public $data = [];

	public $template = null;

	public function getTemplate( )
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

	public function toHtml( )
	{
		# code...
		$data = $this->data; /*----------------here we set array-data to local variable($data) inside function-------------*/
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

	public function getData($key = 0)
	{
		# code...
		if(!$key){
			return $this->data;
		}
		if(array_key_exists($key, $data)){
			return $this->data[$key];
		}
		return null; 
	}
	




}


?>