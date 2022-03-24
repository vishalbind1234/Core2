<?php

Ccc::loadClass('Model_Core_Row');

class Model_Cart extends Model_Core_Row {

	protected $cartItem = null;
	protected $cartBillingAddress = null;
	protected $cartShippingAddress = null;

	protected $shippingMethodInfo = null;
	protected $paymentMethodInfo = null;

	public function __construct()
	{
		$this->setResourceName('Cart_Resource');					
	}
	//---------------------------------------------------------------------------------------------------------------------------
	public function getCartItem()
	{
		$modelCartItem = Ccc::getModel('Cart_CartItem');
		if(!$this->id)
		{
			return [];
		}
		if($this->cartItem)
		{
			return $this->cartItem;
		}
		$modelCartItem = $modelCartItem->fetchAll("SELECT * FROM Cart_Item WHERE cartId = {$this->id}");   
		$this->setCartItem($modelCartItem);
		return $modelCartItem;
	}

	public function setCartItem(array $cartItem)
	{
		$this->cartItem = $cartItem;
		return $this;
	}
	//--------------------------------------------------------------------------------------------------------------------------
	public function getBillingAddress()
	{
		$modelCartAddress = Ccc::getModel('Cart_CartAddress');
		if(!$this->id)
		{
			return $modelCartAddress;
		}
		if($this->cartBillingAddress)
		{
			return $this->cartBillingAddress;
		}
		$modelCartAddress = $modelCartAddress->fetchRow("SELECT * FROM Cart_Address WHERE cartId = {$this->id} AND addressType = 'billing' ");
		if(!$modelCartAddress->id)
		{
			$modelCustomer = Ccc::getModel("Customer")->load($this->customerId);
			$modelCustomerAddress = $modelCustomer->getBillingAddress();
			$modelCustomerAddress->firstName = $modelCustomer->firstName;
			$modelCustomerAddress->lastName = $modelCustomer->lastName;
			$modelCustomerAddress->email = $modelCustomer->email;
			$modelCustomerAddress->mobile = $modelCustomer->mobile;
			if($modelCustomerAddress->id)
			{
				$this->setBillingAddress($modelCustomerAddress);
				return $modelCustomerAddress;
			}
		}
		$this->setBillingAddress($modelCartAddress);
		return $modelCartAddress;
	}

	public function setBillingAddress($cartAddress)
	{
		$this->cartBillingAddress = $cartAddress;
		return $this;
	}
	//-----------------------------------------------------------------------------------------------------------------------------
	public function getShippingAddress()
	{
		$modelCartAddress = Ccc::getModel('Cart_CartAddress');
		if(!$this->id)
		{
			return $modelCartAddress;
		}
		if($this->cartShippingAddress)
		{
			return $this->cartShippingAddress;
		}
		$modelCartAddress = $modelCartAddress->fetchRow("SELECT * FROM Cart_Address WHERE cartId = {$this->id} AND addressType = 'shipping' ");
		if(!$modelCartAddress->id)
		{
			$modelCustomer = Ccc::getModel("Customer")->load($this->customerId);
			$modelCustomerAddress = $modelCustomer->getShippingAddress();
			$modelCustomerAddress->firstName = $modelCustomer->firstName;
			$modelCustomerAddress->lastName = $modelCustomer->lastName;
			$modelCustomerAddress->email = $modelCustomer->email;
			$modelCustomerAddress->mobile = $modelCustomer->mobile;
			if($modelCustomerAddress->id)
			{
				$this->setShippingAddress($modelCustomerAddress);
				return $modelCustomerAddress;
			}
		}
		$this->setShippingAddress($modelCartAddress);
		return $modelCartAddress;
	}

	public function setShippingAddress($cartAddress)
	{
		$this->cartShippingAddress = $cartAddress;
		return $this;
	}

	//-------------------------------------------------------------------------------------------------------------------------
	public function getShippingMethod()
	{
		$modelShippingMethod = Ccc::getModel('Cart_ShippingMethod');
		if(!$this->id)
		{
			return $modelShippingMethod;
		}
		if($this->shippingMethodInfo)
		{
			return $this->shippingMethodInfo;
		}
		$modelShippingMethod = $modelShippingMethod->fetchRow("SELECT * FROM Shipping_Method WHERE id = {$this->shippingMethod}");
		$this->setShippingMethod($modelShippingMethod);
		return $modelShippingMethod;
	}

	public function setShippingMethod(Model_Cart_ShippingMethod $shippingMethodInfo)
	{
		$this->shippingMethodInfo = $shippingMethodInfo;
		return $this;
	}
    //--------------------------------------------------------------------------------------------------------------------------
	public function getPaymentMethod()
	{
		$modelPaymentMethod = Ccc::getModel('Cart_PaymentMethod');
		if(!$this->id)
		{
			return $modelPaymentMethod;
		}
		if($this->paymentMethodInfo)
		{
			return $this->paymentMethodInfo;
		}
		$modelPaymentMethod = $modelPaymentMethod->fetchRow("SELECT * FROM Payment_Method  WHERE id = {$this->paymentMethod}");
		$this->setPaymentMethod($modelPaymentMethod);
		return $modelPaymentMethod;
	}

	public function setPaymentMethod(Model_Cart_PaymentMethod $paymentMethodInfo)
	{
		$this->paymentMethodInfo = $paymentMethodInfo;
		return $this;
	}



}


?>