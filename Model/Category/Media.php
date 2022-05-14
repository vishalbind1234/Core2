<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php

class Model_Category_Media extends Model_Core_Row{

	const THUM = 1;
	const BASE = 1;
	const SMALL = 1;
	protected $category = null;
	protected $imagePath = "Media/Category/";

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';
	const DEFAULT_LBL = 'undefined';

	public function __construct()
	{											
		$this->setResourceName('Category_Media_Resource');
		parent::__construct();
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


	

}



?>