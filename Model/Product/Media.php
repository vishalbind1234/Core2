<?php

Ccc::loadClass('Model_Core_Row');

class Model_Product_Media extends Model_Core_Row {

	const THUM = 1;
	const BASE = 1;
	const SMALL = 1;
	protected $imagePath = "Media/Product/";

	public function __construct()
	{
		$this->setResourceName('Product_Media_Resource');					
	}

	public function getImageUrl($image = null)
	{
		# code...
		$url = Ccc::getBaseUrl();
		if($image)
		{
			return $this->imagePath.$image;	
		}
		return $this->imagePath; 
		//return $url.$this->imagePath.$image;  
	}

	




}


?>