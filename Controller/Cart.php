<?php

Ccc::loadClass("Controller_Admin_Action"); 

class Controller_Cart extends Controller_Admin_Action{

	public function addNewAction()
	{
		# code...
		try 
		{
			$blockAddNew = Ccc::getBlock("Cart_AddNew");
			$this->getLayout()->getContent()->setChild($blockAddNew);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			echo $msg = $e->getMessage();	exit();
		}
	}

	public function gridAction()
	{
		# code...
		try 
		{
			$cartDetails = $this->getMessage()->getMessages("cart");   
			$blockGrid = Ccc::getBlock("Cart_Grid")->setData(['cart' => $cartDetails]);
			$this->getLayout()->getContent()->setChild($blockGrid);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			echo $msg = $e->getMessage();	exit();
		}
	}

	public function createCartAction()
	{
		try 
		{
			$id = $this->getRequest()->getPost('customerId');
			$cart = Ccc::getModel('Customer')->load($id)->getCart();			//echo "<pre>";  print_r($cart);  exit();
			$this->getMessage()->setMessage($cart, "cart");						//echo "<pre>";  print_r($this->getMessage()->getMessages("cart"));  exit();
			$url = $this->getUrl('grid', 'Cart');
			$this->redirect($url);
		} 
		catch (Exception $e) 
		{
			echo $msg = $e->getMessage();	exit();
		}
	}

	public function saveBillingAction()
	{
		$array = $this->getRequest()->getPost();										//echo "<pre>";  print_r($array);   exit();
		$billing = $array['Cart']['Address'];
		$cartDetails = $this->getMessage()->getMessages("cart");
		$modelCartAddress = $cartDetails->getBillingAddress();
		//$modelCartAddress = Ccc::getModel('Cart')->load($billing['cartId'])->getBillingAddress();
		if(get_class($modelCartAddress) == get_class(Ccc::getModel('Customer_Address')))
		{
			$modelCartAddress = Ccc::getModel('Cart')->getBillingAddress();
			unset($billing['id']);	
		}
		$billing['same'] =  (array_key_exists("same", $billing)) ? 1 : 2 ;
		unset($billing['customerId']);
		if(array_key_exists("markAsShipping", $billing))
		{
			unset($billing['markAsShipping']);
		}
		if(array_key_exists("saveToAddressBook", $billing))
		{
			unset($billing['saveToAddressBook']);
		}
		$rowId = $modelCartAddress->setData($billing)->save();
		$modelCartAddress->id = $rowId;
		$cartDetails->setBillingAddress($modelCartAddress);
		$cartDetails->save();

		if(array_key_exists("saveToAddressBook", $array['Cart']['Address']))
		{
			$address = $array['Cart']['Address'];																			//echo "<pre>";  print_r($address); 
			$modelCustomerAddress = Ccc::getModel("Customer")->load($address['customerId'])->getBillingAddress();
			$address['id'] = $modelCustomerAddress->id;
			unset($address['cartId']);
			unset($address['firstName']);
			unset($address['lastName']);
			unset($address['mobile']);
			unset($address['email']);
			unset($address['saveToAddressBook']);
			if(array_key_exists("markAsShipping", $address))
			{
				unset($address['markAsShipping']);
			}
			$address['same'] =  (array_key_exists("same", $address)) ? 1 : 2 ;   				//echo "<pre>";  print_r($address);   exit(); 
			$rowId = $modelCustomerAddress->setData($address)->save();	

			if(array_key_exists("markAsShipping", $array['Cart']['Address']))
			{
				$address2 = $array['Cart']['Address'];
				$modelCustomerAddress = Ccc::getModel("Customer")->load($address2['customerId'])->getShippingAddress();
				unset($address2['id']);
				unset($address2['cartId']);
				unset($address2['firstName']);
				unset($address2['lastName']);
				unset($address2['mobile']);
				unset($address2['email']);
				unset($address2['saveToAddressBook']);
				unset($address2['markAsShipping']);
				$address2['addressType'] =  "shipping";
				$address2['same'] =  1;															//echo "<pre>";  print_r($address2);   exit(); 
				$rowId = $modelCustomerAddress->setData($address2)->save();
			}
		}

		if(array_key_exists("markAsShipping", $array['Cart']['Address']))
		{
			$shipping = $array['Cart']['Address'];
			$cartDetails = $this->getMessage()->getMessages("cart");
			$modelCartAddress = $cartDetails->getShippingAddress();
			if(get_class($modelCartAddress) == get_class(Ccc::getModel('Customer_Address')))
			{
				$modelCartAddress = Ccc::getModel('Cart')->getShippingAddress();
				unset($shipping['id']);	
			}
			else
			{
				if($modelCartAddress->id)
				{
					unset($shipping['id']);
				}
			}
			$shipping['addressType'] =  "shipping";
			$shipping['same'] =  1;
			unset($shipping['customerId']);
			unset($shipping['markAsShipping']);	
			if(array_key_exists("saveToAddressBook", $shipping))
			{
				unset($shipping['saveToAddressBook']);
			}
			$rowId = $modelCartAddress->setData($shipping)->save();  
			$modelCartAddress->id = $rowId;
			$cartDetails->setShippingAddress($modelCartAddress);
			$cartDetails->save();
		}

		$url = $this->getUrl('grid', 'Cart');
		$this->redirect($url);
		

	}

	public function saveShippingAction()
	{
		$shipping = $this->getRequest()->getPost();
		$cartDetails = $this->getMessage()->getMessages("cart");
		if(array_key_exists('saveToAddressBook', $shipping['Cart']['ShippingAddress']))
		{
			$address = $shipping['Cart']["ShippingAddress"];
			$modelCustomerAddress = Ccc::getModel("Customer")->load($address['customerId'])->getShippingAddress();
			unset($address['id']);
			unset($address['cartId']);
			unset($address['firstName']);
			unset($address['lastName']);
			unset($address['mobile']);
			unset($address['email']);
			unset($address['saveToAddressBook']);
			$rowId = $modelCustomerAddress->setData($address)->save();
		}

		$address2 = $shipping['Cart']["ShippingAddress"];
		$modelCartAddress = $cartDetails->getShippingAddress();
		if(get_class($modelCartAddress) == get_class(Ccc::getModel('Customer_Address')))
		{
			$modelCartAddress = Ccc::getModel('Cart')->getShippingAddress();
		}
		$address2['same'] =  2;
		unset($address2['customerId']);
		unset($address2['id']);	
		if(array_key_exists("saveToAddressBook", $address2))
		{
			unset($address2['saveToAddressBook']);
		}	
		$rowId = $modelCartAddress->setData($address2)->save(); 

		$url = $this->getUrl('grid', 'Cart');
		$this->redirect($url);

	}

	public function savePaymentMethodAction()
	{
		# code...
		$cartDetails = $this->getMessage()->getMessages("cart");
		$array = $this->getRequest()->getPost();
		$method = $array['Cart']['paymentMethod']['method'];
		$cartDetails->paymentMethod = $method;
		$cartDetails->setPaymentMethod(Ccc::getModel("Cart_PaymentMethod")->load($method))->save();
		$cartDetails->save();

		$url = $this->getUrl('grid', 'Cart');
		$this->redirect($url);
	}

	public function saveShippingMethodAction()
	{
		# code...
		$cartDetails = $this->getMessage()->getMessages("cart");
		$array = $this->getRequest()->getPost();                          //print_r($array);  exit();
		$method = $array['Cart']['shippingMethod']['method'];
		$arr = explode("/", $method);           						  //print_r($arr);  exit();
		
		$cartDetails->shippingMethod = $arr['0'];
		$cartDetails->setShippingMethod(Ccc::getModel("Cart_ShippingMethod")->load($arr['0']))->save();
		$cartDetails->shippingCharge = $arr['1'];
		$cartDetails->save();

		$url = $this->getUrl('grid', 'Cart');
		$this->redirect($url);
	}

	public function addProductAction()
	{
		# code...
		$cartDetails = $this->getMessage()->getMessages("cart");			
		$array = $this->getRequest()->getPost();
		$products = $array['Cart']['ProductGrid']['ProductId'];   				 // echo "<pre>";  print_r($products); // exit();
		foreach($products as $key => $value) 
		{
			$product = [];
			$modelProduct = Ccc::getModel("Product")->load($value);
			$product['cartId'] = $cartDetails->id;
			$product['productId'] = $modelProduct->id;
			$product['productName'] = $modelProduct->name;
			$product['quantity'] = 1;
			$product['price'] = $modelProduct->getFinalPrice();
			$product['taxPercentage'] = $modelProduct->taxPercentage;
			$product['taxAmount'] = $modelProduct->price * ($modelProduct->taxPercentage/100) ;
			$modelCartItem = Ccc::getModel("Cart_CartItem");
			$modelCartItem->setData($product)->save(); 

			$cartDetails->setCartItem([]);
			$cartDetails->save();    						 //echo "<pre>";  print_r($modelCartItem);  exit();    

			$cartDetails->cartTotal = $cartDetails->cartTotal + ($modelCartItem->price * $modelCartItem->quantity  + $modelCartItem->taxAmount);   // echo "<pre>";  print_r($modelCart);  exit();
			$cartDetails->save();
		}

		$url = $this->getUrl('grid', 'Cart');
		$this->redirect($url);

	}

	public function deleteItemAction()
	{
		# code...
		$id = $this->getRequest()->getRequest("id"); 
		$modelCartItem = Ccc::getModel("Cart_CartItem")->load($id);
		$cartDetails = $this->getMessage()->getMessages("cart");     				//echo "<pre>";  print_r($cartDetails);   exit();
		$cartDetails->cartTotal = $cartDetails->cartTotal - $modelCartItem->getFinalPrice();
		$cartDetails->discount = $cartDetails->discount - $modelCartItem->getDiscountAmount();
		$cartDetails->setCartItem([]);
		$cartDetails->save();

		$modelCartItem->delete($id);
		$url = $this->getUrl('grid', 'Cart');    					//echo "<pre>";  print_r($cartDetails);   exit();
		$this->redirect($url);
	}

	public function saveProductItemAction()		
	{
		# code...
		$array = $this->getRequest()->getPost(); 					  //echo "<pre>";  print_r($array);  exit();
		$quantity = $array['Cart']['productItem']['Item']; 					 // echo "<pre>";  print_r($quantity);  exit();
		$cartDetails = $this->getMessage()->getMessages("cart");

		$cartDetails->cartTotal = 0;								//echo "<pre>";  print_r($modelCart);  exit();	
		$cartDetails->discount = 0;								//echo "<pre>";  print_r($modelCart);  exit();	
		$cartDetails->save();
		$arr = [];									 					//echo "<pre>";  print_r($modelCart);  exit();
		foreach ($quantity as $key => $value) 
		{
			$modelCartItem = Ccc::getModel("Cart_CartItem")->load($key);
			$modelCartItem->quantity = $value;
			$modelCartItem->taxAmount = ($modelCartItem->price*($modelCartItem->taxPercentage/100)) * $modelCartItem->quantity;
			$modelCartItem->discount = $array['Cart']['discountAmount'][$key];
			$modelCartItem->discountMode = $array['Cart']['discountMode'][$key];
			$modelCartItem->save();
			array_push($arr, $modelCartItem);

			$cartDetails->cartTotal = $cartDetails->cartTotal + $modelCartItem->getFinalPrice();
			$cartDetails->discount = $cartDetails->discount + $modelCartItem->getDiscountAmount();
			$cartDetails->save();
		}
		$cartDetails->setCartItem($arr)->save();
		
		$url = $this->getUrl('grid', 'Cart');
		$this->redirect($url);
	}

	public function placeOrderAction()
	{
		# code...
		//echo "<pre>";  print_r($_POST); // exit();
		//echo "<pre>";  print_r($cartDetails = $this->getMessage()->getMessages("cart"));  exit();

		$array = $this->getRequest()->getPost(); 
		$addressData = $array['Cart']['Address'];
		$cartData = $array['Cart']['cartSummary'];
		$paymentData = $array['Cart']['paymentMethod'];
		$shippingData = explode("/", $array['Cart']['shippingMethod']['method']);

		$modelOrder = Ccc::getModel("Order");
		$modelOrder->customerId = $addressData['customerId'];
		$modelOrder->firstName = $addressData['firstName'];
		$modelOrder->lastName = $addressData['lastName'];
		$modelOrder->email = $addressData['email'];
		$modelOrder->mobile = $addressData['mobile'];
		$modelOrder->grandTotal = $cartData['grandTotal'];
		$modelOrder->discount = $cartData['discount'];
		$modelOrder->paymentMethodId = $paymentData['method'];
		$modelOrder->shippingMethodId = $shippingData['0'];
		$modelOrder->shippingAmount = $shippingData['1'];
		$orderId = $modelOrder->save();
		//------------------------------------------------------------------------------------------------
		$billingData = $array['Cart']['Address'];
		unset($billingData['customerId']);
		unset($billingData['cartId']);
		if(array_key_exists("markAsShipping", $billingData))
		{
			unset($billingData['markAsShipping']);
		}
		if(array_key_exists("saveToAddressBook", $billingData))
		{
			unset($billingData['saveToAddressBook']);
		}
		
		$billing = $modelOrder->getBillingAddress(); 
		$billing->orderId = $orderId; 
		$billing->addressId = $billingData['id'];
		unset($billingData['id']); 
		$billing->same = (array_key_exists("same", $billingData)) ? 1 : 2 ;
		$billing->setData($billingData)->save();
		//------------------------------------------------------------------------------------------------------
		$shippingData = $array['Cart']['ShippingAddress'];
		unset($shippingData['customerId']);
		unset($shippingData['cartId']);
		if(array_key_exists("saveToAddressBook", $shippingData))
		{
			unset($shippingData['saveToAddressBook']);
		}
		
		$shipping = $modelOrder->getShippingAddress(); 
		$shipping->orderId = $orderId; 
		$shipping->addressId = $shippingData['id']; 
		unset($shippingData['id']);
		$shipping->same = (array_key_exists("same", $shippingData)) ? 1 : 2 ;
		$shipping->setData($shippingData)->save();

		//$modelItem = $modelOrder->getOrderItem(); 
		$cartDetails = $this->getMessage()->getMessages("cart");
		$array = $cartDetails->getCartItem();
		foreach ($array as $key => $value) 
		{
			$modelItem = Ccc::getModel("Order_Item");
			$modelItem->itemId = $value->id;	
			$modelItem->orderId = $orderId;	
			$modelItem->productId = $value->productId;	
			$modelItem->name = $value->productName;	
			$modelItem->cost = $value->price ;	
			$modelItem->price = $value->getFinalPrice() + $value->getDiscountAmount();	
			$modelItem->discount = $value->getDiscountAmount();	
			$modelItem->quantity = $value->quantity;	
			$modelItem->save();	
		}


		$url = $this->getUrl('orderGrid', 'Cart' , ['orderId' => $orderId]);
		$this->redirect($url);

	}


	public function orderGridAction()
	{
		# code...
		try 
		{
			$orderId = $this->getRequest()->getRequest('orderId'); 
			$blockOrderGrid = Ccc::getBlock("Order_Grid")->setData(['orderId' => $orderId]);
			$this->getLayout()->getContent()->setChild($blockOrderGrid);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			echo $msg = $e->getMessage();	exit();
		}
	}


}


?>