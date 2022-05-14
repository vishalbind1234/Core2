<?php

Ccc::loadClass('Model_Core_Row');

class Model_Order extends Model_Core_Row {

	const PENDING_LBL = 'pending';
	const PROCESSING_LBL = 'processing';
	const DISPATCHED_LBL = 'dispatched';
	const DILIVERED_LBL = 'delivered';
	const DEFAULT_LBL = 'undefined';

	const ACTIVE_LBL = 'active';
	const INACTIVE_LBL = 'inactive';

	protected $orderItem = null;
	protected $orderComment = null;
	protected $orderBillingAddress = null;
	protected $orderShippingAddress = null;

	public function __construct()
	{
		$this->setResourceName('Order_Resource');					
	}
	//---------------------------------------------------------------------------------------------------------------------------

	public function getStatus($key = null)
	{
		$status = [ 
			self::PENDING_LBL    ,
			self::PROCESSING_LBL ,
			self::DISPATCHED_LBL ,
			self::DILIVERED_LBL  ,
			self::DEFAULT_LBL 
		];

		return $status;
	}

	public function getState($key = null)
	{
		$state = [ 
			self::ACTIVE_LBL    ,
			self::INACTIVE_LBL 
		];

		return $state;
	}


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

	public function getOrderComment()
	{
		$modelOrderComment = Ccc::getModel('Order_Comment');
		if(!$this->id)
		{
			return [];
		}
		if($this->orderComment)
		{
			return $this->orderComment;
		}
		$modelOrderComment = $modelOrderComment->fetchAll("SELECT * FROM Order_Comment WHERE orderId = {$this->id}");   
		$this->setOrderComment($modelOrderComment);
		return $modelOrderComment;
	}

	public function setOrderComment(array $orderComment)
	{
		$this->orderComment = $orderComment;
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