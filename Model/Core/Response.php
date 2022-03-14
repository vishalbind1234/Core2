
<?php 

class Model_Core_Response{

	public function render($content)
	{
		echo $content;
		return $this;
	}

	public function setHeader($key , $type)
	{
		header("{$key}: {$type}");
		return $this;
	}


}


?>