<?php

Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row {

	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $salesmanCustomerProduct = null;

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';
	
	public function __construct()
	{
		$this->setResourceName('Customer_Resource');
	}

	public function getStatus()
	{
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];
		return $status;
	}

	public function getBillingAddress($reload = false)
	{
		$modelAddress = Ccc::getModel('Customer_Address');
		if(!$this->id)
		{
			return $modelAddress;
		}

		if($this->billingAddress && !$reload)
		{
			return $this->billingAddress;
		}
		$adapter = $this->getAdapter();
		$address = $modelAddress->fetchRow("SELECT * FROM Customer_Address WHERE customerId = {$this->id} AND billing = {$adapter->getConnect()->quote(Model_Customer_Address::BILLING)} ");
		$this->setBillingAddress($address);
		return $address;
	}

	public function setBillingAddress(Model_Customer_Address $address)
	{
		$this->billingAddress = $address;
		return $this;
	}

	public function getShippingAddress($reload = false)
	{
		$modelAddress = Ccc::getModel('Customer_Address');
		if(!$this->id)
		{
			return $modelAddress;
		}

		if($this->shippingAddress && !$reload)
		{
			return $this->shippingAddress;
		}
		$adapter = $this->getAdapter();
		$address = $modelAddress->fetchRow("SELECT * FROM Customer_Address WHERE customerId = {$this->id} AND shipping = {$adapter->getConnect()->quote(Model_Customer_Address::SHIPPING)} ");
		$this->setShippingAddress($address);
		return $address;
	}

	public function setShippingAddress(Model_Customer_Address $address)
	{
		$this->shippingAddress = $address;
		return $this;
	}

	//-------------------------------------------------------------------------------------------------------------------

	public function getPrice($productId)
	{
		$modelSalesmanCustomerProduct = Ccc::getModel('Salesman_Customer_Product');
		if(!$this->id)
		{
			return $modelSalesmanCustomerProduct;
		}

		if($this->salesmanCustomerProduct)
		{
			return $this->salesmanCustomerProduct;
		}
		//$adapter = $this->getAdapter();
		$price = $modelSalesmanCustomerProduct->fetchRow("SELECT * FROM Salesman_Customer_Price WHERE customerId = {$this->id} AND salesmanId = {$this->salesmanId} AND productId = {$productId}");
		$this->setPrice($price);
		return $price;
	}

	public function setPrice(Model_Salesman_Customer_Product $obj)
	{
		$this->salesmanCustomerProduct = $obj;
		return $this;
	}





}


?>