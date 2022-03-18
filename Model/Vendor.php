<?php

Ccc::loadClass('Model_Core_Row');

class Model_Vendor extends Model_Core_Row {

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';

	protected $address = null;

	public function __construct()
	{
		$this->setResourceName('Vendor_Resource');					
	}

	public function getStatus()
	{
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];
		return $status;
	}

	public function getAddress()
	{
		$address = Ccc::getModel("Vendor_Address");
		if(!$this->id)
		{
			return $address;
		}

		if($this->address)
		{
			return $this->address;
		}

		$vendorAddress = $address->fetchRow("SELECT * FROM Vendor_Address WHERE aId = {$this->id}");
		$this->setAddress($vendorAddress);
		return $vendorAddress;
	}

	public function setAddress(Model_Vendor_Address $address)
	{
		$this->address = $address;
		return $this;
	}


	



}


?>