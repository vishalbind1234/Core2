<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php

class Model_Category_Media extends Model_Core_Row{

	const THUM = 1;
	const BASE = 1;
	const SMALL = 1;
	protected $category = null;
	protected $imagePath = "Media/Category/";

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



	

}



?>