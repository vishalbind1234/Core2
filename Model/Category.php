<?php

Ccc::loadClass('Model_Core_Row');

class Model_Category extends Model_Core_Row {

	protected $category = null;

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';

	public function __construct()
	{
		$this->setResourceName('Category_Resource');
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
		$categoryMedia = Ccc::getModel('Category_Media');
		if(!$this->id)
		{
			return $categoryMedia;
		}

		if($this->thum)
		{
			return $this->thum;
		}
		$adapter = $this->getAdapter();
		$categoryThum = $categoryMedia->fetchRow("SELECT * FROM Category_Media WHERE categoryId = {$this->id} AND thum = {$adapter->getConnect()->quote(Model_Category_Media::THUM)}");
		$this->setThum($categoryThum);
		return $categoryThum;
	}

	public function setThum(Model_Category_Media $thum)
	{
		$this->thum = $thum;
		return $this;
	}

	public function getBase()
	{
		$categoryMedia = Ccc::getModel('Category_Media');
		if(!$this->id)
		{
			return $categoryMedia;
		}

		if($this->base)
		{
			return $this->base;
		}
		$adapter = $this->getAdapter();
		$categoryBase = $categoryMedia->fetchRow("SELECT * FROM Category_Media WHERE categoryId = {$this->id} AND base = {$adapter->getConnect()->quote(Model_Category_Media::BASE)}");
		$this->setBase($categoryBase);
		return $categoryBase;
	}

	public function setBase(Model_Category_Media $base)
	{
		$this->base = $base;
		return $this;
	}

	public function getSmall()
	{
		$categoryMedia = Ccc::getModel('Category_Media');
		if(!$this->id)
		{
			return $categoryMedia;
		}

		if($this->small)
		{
			return $this->small;
		}
		$adapter = $this->getAdapter();
		$categorySmall = $categoryMedia->fetchRow("SELECT * FROM Category_Media WHERE categoryId = {$this->id} AND small = {$adapter->getConnect()->quote(Model_Category_Media::SMALL)}");
		$this->setSmall($categorySmall);
		return $categorySmall;
	}

	public function setSmall(Model_Category_Media $small)
	{
		$this->small = $small;
		return $this;
	}




}


?>