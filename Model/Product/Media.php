<?php

Ccc::loadClass('Model_Core_Row');

class Model_Product_Media extends Model_Core_Row {

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';
	const DEFAULT_LBL = 'undefined';
	const THUM = 1;
	const BASE = 1;
	const SMALL = 1;
	protected $imagePath = "Media/Product/";

	public function __construct()
	{
		$this->setResourceName('Product_Media_Resource');					
	}


	public function getStatus($key = null)
	{
		# code...
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];

		if($key)
		{
			if(array_key_exists($key, $status))
			{
				return $status[$key];
			}
			return self::DEFAULT_LBL;
		}
		return $status;
	}


	public function getImageUrl($image = null)
	{
		//$url = Ccc::getBaseUrl();
		$url = "";
		$url = $url.$this->imagePath;	
		if($image)
		{
			$url = $url.$image;	
		}
		return $url; 

		//return $this->imagePath;


	}

	




}


?>