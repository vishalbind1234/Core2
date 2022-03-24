<?php

Ccc::loadClass('Model_Core_Row');

class Model_Order extends Model_Core_Row {

	protected $orderItem = null;
	protected $orderBillingAddress = null;
	protected $orderShippingAddress = null;

	public function __construct()
	{
		$this->setResourceName('Order_Resource');					
	}
	//---------------------------------------------------------------------------------------------------------------------------
	public function getOrderItem()
	{
		$modelOrderItem = Ccc::getModel('Order_Item');
		if(!$this->id)
		{
			return [];
		}
		if($this->orderItem)
		{
			return $this->orderItem;
		}
		$modelOrderItem = $modelOrderItem->fetchAll("SELECT * FROM Order_Item WHERE orderId = {$this->id}");   
		$this->setOrderItem($modelOrderItem);
		return $modelOrderItem;
	}

	public function setOrderItem(array $orderItem)
	{
		$this->orderItem = $orderItem;
		return $this;
	}

	//--------------------------------------------------------------------------------------------------------------------------
	public function getBillingAddress()
	{
		$modelOrderAddress = Ccc::getModel('Order_Address');
		if(!$this->id)
		{
			return $modelOrderAddress;
		}
		if($this->orderBillingAddress)
		{
			return $this->orderBillingAddress;
		}
		$modelOrderAddress = $modelOrderAddress->fetchRow("SELECT * FROM Order_Address WHERE orderId = {$this->id} AND addressType = 'billing' ");
		$this->setBillingAddress($modelOrderAddress);
		return $modelOrderAddress;
	}

	public function setBillingAddress($orderAddress)
	{
		$this->orderBillingAddress = $orderAddress;
		return $this;
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------




	public function getShippingAddress()
	{
		$modelOrderAddress = Ccc::getModel('Order_Address');
		if(!$this->id)
		{
			return $modelOrderAddress;
		}
		if($this->orderShippingAddress)
		{
			return $this->orderShippingAddress;
		}
		$modelOrderAddress = $modelOrderAddress->fetchRow("SELECT * FROM Order_Address WHERE orderId = {$this->id} AND addressType = 'shipping' ");
		$this->setShippingAddress($modelOrderAddress);
		return $modelOrderAddress;
	}

	public function setShippingAddress($orderAddress)
	{
		$this->orderShippingAddress = $orderAddress;
		return $this;
	}

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
		$modelShippingMethod = $modelShippingMethod->fetchRow("SELECT * FROM Shipping_Method WHERE id = {$this->shippingMethodId}");
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
		$modelPaymentMethod = $modelPaymentMethod->fetchRow("SELECT * FROM Payment_Method  WHERE id = {$this->paymentMethodId}");
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