<?php

Ccc::loadClass('Model_Core_Row');

class Model_Product extends Model_Core_Row {

	protected $thum = null;
	protected $small = null;
	protected $base = null;
	protected $categoryProduct = null;
	protected $imagePath = "Media/Product/";

	//protected $categoryProduct = null;
	//protected $productMedia = null;

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';

	public function __construct()
	{
		$this->setResourceName('Product_Resource');					
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
	
	public function getStatus()
	{
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];
		return $status;
	}

	public function getThum()
	{
		$productMedia = Ccc::getModel('Product_Media');
		if(!$this->id)
		{
			return $productMedia;
		}

		if($this->thum)
		{
			return $this->thum;
		}
		$adapter = $this->getAdapter();
		$productThum = $productMedia->fetchRow("SELECT * FROM Product_Media WHERE productId = {$this->id} AND thum = {$adapter->getConnect()->quote(Model_Product_Media::THUM)}");
		$this->setThum($productThum);
		return $productThum;
	}

	public function setThum(Model_Product_Media $thum)
	{
		$this->thum = $thum;
		return $this;
	}

	public function getBase()
	{
		$productMedia = Ccc::getModel('Product_Media');
		if(!$this->id)
		{
			return $productMedia;
		}

		if($this->base)
		{
			return $this->base;
		}
		$adapter = $this->getAdapter();
		$productBase = $productMedia->fetchRow("SELECT * FROM Product_Media WHERE productId = {$this->id} AND base = {$adapter->getConnect()->quote(Model_Product_Media::BASE)}");
		$this->setBase($productBase);
		return $productBase;
	}

	public function setBase(Model_Product_Media $base)
	{
		$this->base = $base;
		return $this;
	}

	public function getSmall()
	{
		$productMedia = Ccc::getModel('Product_Media');
		if(!$this->id)
		{
			return $productMedia;
		}

		if($this->small)
		{
			return $this->small;
		}
		$adapter = $this->getAdapter();
		$productSmall = $productMedia->fetchRow("SELECT * FROM Product_Media WHERE productId = {$this->id} AND small = {$adapter->getConnect()->quote(Model_Product_Media::SMALL)}");
		$this->setSmall($productSmall);
		return $productSmall;
	}

	public function setSmall(Model_Product_Media $small)
	{
		$this->small = $small;
		return $this;
	}

	public function getCategoryProduct()
	{
		$categoryProduct = Ccc::getModel('Product_CategoryProduct');
		if(!$this->id)
		{
			//return $categoryProduct;
			return [];
		}

		if($this->categoryProduct)
		{
			return $this->categoryProduct;
		}

		$obj = $categoryProduct->fetchAll("SELECT * FROM Category_Product WHERE productId = {$this->id}");
		$this->setCategoryProduct($obj);
		return $obj;
	}

	public function setCategoryProduct(array $categoryProduct)
	{
		$this->categoryProduct = $categoryProduct;
		return $this;
	}

	public function getFinalPrice()
	{
		if(!$this->id)
		{
			return 0;
		}
		$modelProduct = $this->fetchRow("SELECT * FROM Product WHERE id = {$this->id}");
		if($modelProduct->discountMode == "percentage")
		{
			$price = $modelProduct->price - $modelProduct->price*($modelProduct->discount/100);
			return $price;
		}
		$price = $modelProduct->price - $modelProduct->discount;
		return $price;
	}




}


?>