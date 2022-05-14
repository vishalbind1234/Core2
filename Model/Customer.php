<?php

Ccc::loadClass('Model_Core_Row');

class Model_Customer extends Model_Core_Row {

	protected $billingAddress = null;
	protected $shippingAddress = null;
	protected $salesmanCustomerProduct = null;
	protected $cart = null;

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';
	const DEFAULT_LBL = 'undefined';
	
	public function __construct()
	{
		$this->setResourceName('Customer_Resource');
	}

	public function getStatus($key = null)
	{
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
		$address = $modelAddress->fetchRow("SELECT * FROM Customer_Address  WHERE  customerId = {$this->id} AND addressType = {$adapter->getConnect()->quote(Model_Customer_Address::BILLING)} ");
		if(!$address->addressId)
		{
			$modelAddress->customerId = $this->id;
			$modelAddress->addressType = Model_Customer_Address::BILLING;
			$id = $modelAddress->save();
			$address = $modelAddress->load($id);
		}
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
		$address = $modelAddress->fetchRow("SELECT * FROM Customer_Address WHERE customerId = {$this->id} AND addressType = {$adapter->getConnect()->quote(Model_Customer_Address::SHIPPING)} ");
		if(!$address->addressId)
		{
			$modelAddress->customerId = $this->id;
			$modelAddress->addressType = Model_Customer_Address::SHIPPING;
			$id = $modelAddress->save();        
			$address = $modelAddress->load($id);      //echo "<pre>";  print_r($address);  exit();

		}

		$this->setShippingAddress($address);
		return $address;
	}

	public function setShippingAddress(Model_Customer_Address $address)
	{
		$this->shippingAddress = $address;
		return $this;
	}

	//-------------------------------------------------------------------------------------------------------------------

	public function getPrice()
	{
		$modelSalesmanCustomerProduct = Ccc::getModel('Salesman_Customer_Product');
		if(!$this->id)
		{
			return [];
		}

		if($this->salesmanCustomerProduct)
		{
			return $this->salesmanCustomerProduct;
		}
		$price = $modelSalesmanCustomerProduct->fetchAll("SELECT * FROM Salesman_Customer_Price WHERE customerId = {$this->id} AND salesmanId = {$this->salesmanId} ");
		$this->setPrice($price);
		return $price;
	}

	public function setPrice(array $arr)
	{
		$this->salesmanCustomerProduct = $arr;
		return $this;
	}

	//-----------------------------------------cart functions--------------------------------------------------------------

	public function getCart()
	{
		$modelCart = Ccc::getModel('Cart');
		if(!$this->id)
		{
			return $modelCart;
		}
		/*if($this->cart)
		{
			return $cart;
		}*/

		$cart = $modelCart->load($this->id, "customerId");  
		if(!$cart->id)
		{
			$cart->customerId = $this->id;
			$cartId = $cart->save();
			$cart->load($cartId);					

												//echo "<pre>";    print_r($cart);  exit();
		}
		$this->setCart($cart);
		return $cart;
	}

	public function setCart(Model_Cart $cart)
	{
		$this->cart = $cart;
		return $this;
	}





}


?>